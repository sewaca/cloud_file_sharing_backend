<?php 

include BASE_PATH."/server/libraries/simpleCalDAV-master/SimpleCalDAVClient.php";

try {
  $params = json_decode(file_get_contents('php://input'), true);
  $params['author'] = decode_jwt($params['author']); // email автора события
  $start = str_replace(":", "", str_replace(" ", "T", str_replace(".", "", $params['start'])));
  $end = str_replace(":", "", str_replace(" ", "T", str_replace(".", "", $params['end'])));
  $response = [];
  $common_event_id = hexdec(uniqid()) % 1000000000;

  if (
    !$params['author']
    or !filter_var($params['author'], FILTER_VALIDATE_EMAIL)
    or !$params['event_name'] 
    or !strtotime($start) 
    or !strtotime($end)
    or strtotime($end) <= strtotime($start)
    or !count($params['rooms'])
    or !in_array($params['freq']['rule'], ["", "DAILY", "WEEKLY", "MONTHLY", "YEARLY"])
    or !is_int($params['freq']['interval'])
    or (int)$params['freq']['interval'] <= 0 
  )
    include BASE_PATH."/server/404.php";
  
  foreach($params['participants'] as $attendee){
    if (!filter_var($attendee, FILTER_VALIDATE_EMAIL)) {
      echo "incorect email : $attendee";
      include BASE_PATH."/server/404.php";
    }
  }

} catch (Exception $e) {
  file_put_contents('php://stdout', $e->__toString());
  include BASE_PATH."/server/404.php";
}

try{ 
  // ~ Получаем id календаря по имени:
  $client = new SimpleCalDAVClient();
  $client->connect(
    'https://caldav.yandex.ru:443/',
    YA_CALENDAR_LOGIN,
    YA_CALENDAR_PASSWORD
  );
  // Получаем все доступные календари
  $all_calendars = $client->findCalendars();

  // ~ Для каждой из занимаемых комнат
  foreach($params['rooms'] as $room){
    $calendar_id = null;
    foreach($all_calendars as $calendar){
      if ($calendar->getDisplayName() === $room['name'])
        $calendar_id = $calendar->getCalendarID();
    }
    if (!$calendar_id) {
      include BASE_PATH."/server/404.php";
    }
    $client->setCalendar($all_calendars[$calendar_id]);

    $events = $client->getEvents($start.'Z', $end.'Z');    
    if (count($events) > 0) {
      // Если занята, то записываем в ответ 0 и переходим к следующей комнате
      array_push($response, false);
      continue;
    } 
    
    // Выстраиваем запрос:
    $unique_id = '6kqjide'.uniqid().'yandex.ru';
    $req =  'BEGIN:VCALENDAR'.PHP_EOL.
            'VERSION:2.0'.PHP_EOL.
            'PRODID:-//Yandex LLC//Yandex Calendar//EN'.PHP_EOL.
            'BEGIN:VEVENT'.PHP_EOL.
            'UID:'.$unique_id.PHP_EOL. 
            "DTSTART;TZID=Europe/Moscow:".$start.PHP_EOL.       // Начало
            "DTEND;TZID=Europe/Moscow:".$end.PHP_EOL.         // Конец
            'SUMMARY:'.$params['event_name'].PHP_EOL.                                // Название
                                                                        // Повторять каждые
            ($params['freq']["rule"] ? "RRULE:FREQ=".$params['freq']["rule"].";INTERVAL=".$params['freq']["interval"].PHP_EOL : "" ).            
            'PUBLIC:PUBLIC'.PHP_EOL.
            'DESCRIPTION:'.$params['description'].PHP_EOL.                            // Описание
                                               // Создатель: 
            'ORGANIZER;CN="'.(explode('@', $params['author'])[0]).'":mailto:'.$params['author'].PHP_EOL;
    // Поочередно строки с приглашенными
    foreach($params['participants'] as $attendee){
      $req .= 'ATTENDEE;CN='.(explode('@', $attendee)[0]).':mailto:'.$attendee.PHP_EOL;
    }
    $req .= 'END:VEVENT'.PHP_EOL.
            'END:VCALENDAR';

    $res = $client->create($req);
  
    // ~ Работаем с БД
    $link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($link->connect_error)
      throw new Exception("Connection failed");
  
    $author = [
      'email' => $params['author'],
      'id' => null
    ];

    // TODO: Отслеживать, если в разных rooms числятся разные компании

    // Определяем в какой компании работает пользователь:
    $sql = "SELECT `id` from `employees` where `email` = ? and `organization_id` = (SELECT `organization_id` FROM `offices` WHERE `id` = (SELECT `office_id` FROM `meeting_rooms` WHERE `id` = ?))";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("sd", $author['email'], $room['id']);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);
    try{
      $author['id'] = $res['id'];
    } catch ( Exception $e ) {
      file_put_contents('php://stdout', $e->__toString());
      include BASE_PATH."/server/404.php";
    } 

    // Получаем организацию в которой работает каждый из приглашенных
    $participants = [];
    foreach ($params['participants'] as $participant_email) {
      $sql = 'SELECT `id` from `employees` where `email` = ? and `organization_id` = (SELECT `organization_id` FROM `offices` WHERE `id` = (SELECT `office_id` FROM `meeting_rooms` WHERE `id` = ?))';
      $stmt = $link->prepare($sql);
      $stmt->bind_param("sd", $participant_email, $room['id']);
      $stmt->execute();
      $res = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);
      
      if (!$res) {
        $sql = "INSERT INTO `employees` (`email`, `organization_id`) VALUES (?, (SELECT `organization_id` FROM `offices` WHERE `id` = (SELECT `office_id` FROM `meeting_rooms` WHERE `id` = ?) LIMIT 1));";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("si", $participant_email, $room['id']);
        $stmt->execute();
        $sql = 'SELECT `id` from `employees` where `email` = ? and `organization_id` = (SELECT `organization_id` FROM `offices` WHERE `id` = (SELECT `office_id` FROM `meeting_rooms` WHERE `id` = ?))';
        $stmt = $link->prepare($sql);
        $stmt->bind_param("si", $participant_email, $room['id']);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);
      }
      array_push($participants, [ "email" => $participant_email, "id" => $res['id'] ]);
    }

    // Если нет участников из бд
    if (count($participants) === 0){
      $sql = 'INSERT INTO `events` (`name`, `author`, `paricipant`, `room_id`, `start`, `end`, `description`, `uniqueid`, `freq_rule`, `freq_interval`, `table_def_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ';
      $stmt = $link->prepare($sql);
      $stmt->bind_param("sddsssssii", $params['event_name'], $author['id'], $author['id'], $room['id'], $params['start'], $params['end'], $params['description'], $unique_id, $params['freq']['rule'], $params['freq']["interval"], $common_event_id);
      $stmt->execute();
    }
    // Иначе для каждого участника сделать запрос
    else {
      $sql = 'INSERT INTO `events` (`name`, `author`, `paricipant`, `room_id`, `start`, `end`, `description`, `uniqueid`, `freq_rule`, `freq_interval`, `table_def_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);';
      $stmt = $link->prepare($sql);
      foreach($participants as $participant){
        $stmt->bind_param("siiisssssii", $params['event_name'], $author['id'], $participant['id'], $room['id'], $params['start'], $params['end'], $params['description'], $unique_id, $params['freq']['rule'], $params['freq']["interval"], $common_event_id);
        $stmt->execute();
      }
    }

    array_push($response, $unique_id);
  }
  echo json_encode($response);
} 
catch ( Exception $e ) {
  file_put_contents('php://stdout', $e->__toString());
  include BASE_PATH."/server/500.php";
} 
