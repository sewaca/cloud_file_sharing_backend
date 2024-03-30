<?php


try {
  // Декодируем user_email из jwt
  $user_email = decode_jwt($_GET["id"]);
  $is_archive = json_decode(isset($_GET["is_archive"]) ? $_GET["is_archive"] : "false") or false;

  // Подключаемся к БД
  $link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if ($link->connect_error)
    throw new Exception("Connection failed");

  // Получаем все id пользователя
  $sql = "SELECT `id` FROM `employees` WHERE `email` = ?";
  $stmt = $link->prepare($sql);
  $stmt->bind_param("s", $user_email);
  $stmt->execute();
  $ids = array_map(function($row){ return $row['id']; }, $stmt->get_result()->fetch_all(MYSQLI_ASSOC));
  
  $response = [];

  // Получаем все события связанные с этим id
  date_default_timezone_set("Europe/London");
  // echo json_encode(date('Y-m-d H:i:s', time() - 10*60));
  $start = (string)date('Y-m-d H:i:s', time() - 10*60);       // NOW IN GMT - 10 min
  if ($is_archive) $start = (string)date('Y-m-d H:i:s', 0);   // начало эпохи по GMT

  $sql = "(SELECT * FROM `events` WHERE `start` >= ? and (`author` IN (".implode(", ", $ids).") or `paricipant` IN (".implode(", ", $ids)."))) ORDER BY `start` ";
  $stmt = $link->prepare($sql);
  $stmt->bind_param("s", $start);
  $stmt->execute();
  $events = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  
  $filters = [];
  $sql = "SELECT `name` FROM `meeting_rooms` WHERE `id` = ?";
  $stmt = $link->prepare($sql);
  foreach ($events as $event) {
    if (in_array($event["table_def_id"], $filters)) continue;
    array_push($filters, $event["table_def_id"]);
    
    $stmt->bind_param("i", $event['room_id']);
    $stmt->execute();
    $room_name = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);
    
    array_push($response, [
      "id" => $event["table_def_id"],
      "role" => in_array($event["author"], $ids) ? "author" : "participant",
      "name" => $event["name"],
      "description" => $event["description"],
      "start" => $event["start"],
      "end" => $event["end"],
    ] );
  }
  
  echo json_encode($response);
}
catch ( Exception $e ) {
  file_put_contents('php://stdout', $e->__toString());
  include BASE_PATH."/server/500.php";
} 


