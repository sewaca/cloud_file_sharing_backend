<?php

include BASE_PATH."/server/libraries/simpleCalDAV-master/SimpleCalDAVClient.php";

// event_id

$params = json_decode(file_get_contents('php://input'), true);
$params['user_id'] = decode_jwt($params['user_id']); // user login
$params['event_id'];

if (!$params['event_id'] or !$params['user_id']) 
  include BASE_PATH."/server/404.php";

// Нужные данные:
$room = [
  'name' => "Экспресс №1",
];
$uniqueid = "6kqjide65508ffa355ccyandex.ru";

try{ 
  // ~ Удаляем в базе:
  $link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if ($link->connect_error)
    throw new Exception("Connection failed");
  // Сначала получаем id пользователя
  $sql = "SELECT `id` from `employees` where `login` = ?"; // получаем все id пользователя
  
  // Проверяем есть ли строки где $event_id и user - автор, если да, то получаем из одной из них uniqueid
  //    а сами строки потом удаляем.
  $sql = "SELECT `uniqueid` from `events` where `table_def_id` = ? and `author` in (SELECT `id` from `employees` WHERE `email` = ?) GROUP BY `uniqueid`"; // получаем все id пользователя
  $stmt = $link->prepare($sql);
  $stmt->bind_param("is", $params['event_id'], $params['user_id']);
  $stmt->execute();
  $uniqueids = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); 
  // Если нет строк где указанный пользователь - автор, то ищем строки где он 
  if (count($uniqueids) == 0) {
    $sql = "SELECT `uniqueid` from `events` where `table_def_id` = ? and `paricipant` in (SELECT `id` from `employees` WHERE `email` = ?) GROUP BY `uniqueid`";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("is", $params['event_id'], $params['user_id']);
    $stmt->execute();
    $uniqueids = $stmt->get_result()->fetch_all(MYSQLI_ASSOC); 
  }
  // Если даже нет строк где пользователь - участник, вернем 404
  if (count($uniqueids) <= 0)
    include BASE_PATH."/server/404.php";

  // Получаем все доступные календари
  $client = new SimpleCalDAVClient();
  $client->connect(
    'https://caldav.yandex.ru:443/',
    YA_CALENDAR_LOGIN,
    YA_CALENDAR_PASSWORD
  );
  // Получаем все доступные календари
  $all_calendars = $client->findCalendars();
  // 
  foreach($uniqueids as $uniqueid) {
    $uniqueid = $uniqueid['uniqueid'];
    // Получаем название комнаты:
    $sql = "SELECT `name` FROM `meeting_rooms` where `id` = (SELECT `room_id` from `events` WHERE `uniqueid` = ? LIMIT 1);";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("s", $uniqueid);
    $stmt->execute();
    $room = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];
    // Выбираем календарь  
    $calendar_id = null;
    foreach($all_calendars as $calendar){
      if ( $calendar->getDisplayName() === $room['name'] )
        $calendar_id = $calendar->getCalendarID();
    }
    if (!$calendar_id)  
      include BASE_PATH."/server/404.php";
    
      // Удаляем данные из Я.Календаря
    $client->setCalendar($all_calendars[$calendar_id]);
    $res = $client->getClient()->DoDELETERequest($client->getURL().$uniqueid.'.ics');

    // Удаляем данные из БД
    $sql = "DELETE from `events` WHERE `uniqueid` = ? and `id` != -1";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("s", $uniqueid);
    $stmt->execute();
  }
  // Удаляем
  echo json_encode(true);
} 
catch ( Exception $e ) {
  file_put_contents('php://stdout', $e->__toString());
  include BASE_PATH."/server/500.php";
} 
