<?php
$room_id = $_GET['id'];

try {
  // Подключаемся к БД
  $link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if ($link->connect_error)
    throw new Exception("Connection failed");

  // Получаем название офиса : 
  $sql = "(SELECT `name` FROM `offices` WHERE `id` = ( SELECT `office_id` FROM `meeting_rooms` WHERE `id` = ? ))";
  $stmt = $link->prepare($sql);
  $stmt->bind_param("d", $room_id);
  $stmt->execute();
  $res = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);
  $office_name = $res['name'];

// (SELECT * FROM `meeting_rooms` WHERE `id` = 6) 
// (SELECT `name` FROM `offices` WHERE `id` = ( SELECT `office_id` FROM `meeting_rooms` WHERE `id` = 6 ))

  // Получаем информацию из БД
  $sql = "SELECT * FROM `meeting_rooms` WHERE `id` = ?";
  $stmt = $link->prepare($sql);
  $stmt->bind_param("d", $room_id);
  $stmt->execute();
  $res = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);
  
  if (!$res) include BASE_PATH."/server/404.php";

  $res['office_name'] = $office_name;

  echo json_encode($res);
}
catch ( Exception $e ) {
  include BASE_PATH."/server/500.php";
} 