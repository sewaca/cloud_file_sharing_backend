<?php

// TODO:! Отображать текущее состояние занятости и событие которое там идет, если такое есть 

$office_id = $_GET['office_id'];
$status = json_decode($_GET["status"] ? $_GET["status"] : "");


try {
  $res = [];
  // Подключаемся к БД
  $link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if ($link->connect_error)
    throw new Exception("Connection failed");
    
  // Получаем информацию из БД
  $sql = "SELECT `id`,`name`,`photo`,`status` FROM `meeting_rooms` WHERE `office_id` = ?" . (isset($status) ? " AND `status` = ? " : "");
  $stmt = $link->prepare($sql);
  if (isset($status) ){
    $stmt->bind_param("ii", $office_id, $status);
  } else {
    $stmt->bind_param("i", $office_id);
  }
  $stmt->execute();
  $rooms = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

  date_default_timezone_set("Europe/London");
  $now = (string)date('Y-m-d H:i:s', time());
  foreach ($rooms as $room){
    $sql = "SELECT `name` FROM `events` WHERE `room_id` = ? and `start` <= ? and `end` >= ? LIMIT 1";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("iss", $room['id'], $now, $now);
    $stmt->execute();
    $p = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    array_push($res, [
      "id" => $room['id'],
      "name" => $room['name'],
      "photo" => $room['photo'],
      "status" => $room['status'],
      "is_free" => count($p) > 0 ? false : true,
      "now_event" => count($p) > 0 ? $p[0]['name'] : ""
    ]);
  }  
  echo json_encode($res);
}
catch ( Exception $e ) {
  include BASE_PATH."/server/500.php";
} 