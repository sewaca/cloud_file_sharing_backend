<?php

$organization = $_GET['id']; // id компании
$city = $_GET['city']; // город где ищем офисы (может быть пустой строкой)

try {
  // Подключаемся к БД
  $link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if ($link->connect_error)
    throw new Exception("Connection failed");

  // Получаем информацию из БД
  $sql = "SELECT * FROM `offices` WHERE `organization_id`=? and `city` " . ($city ? "= ?" : "IS NOT NULL");
  $stmt = $link->prepare($sql);
  if ($city)
    $stmt->bind_param("ds", $organization, $city);
  else 
    $stmt->bind_param("d", $organization);
  $stmt->execute();
  $offices = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  $cities = array_values(array_unique(array_map(function($office){ return $office['city']; }, $offices)));
  echo json_encode([
    "offices" => $offices,
    "cities" => $cities
  ]);
}
catch ( Exception $e ) {
  include BASE_PATH."/server/500.php";
} 