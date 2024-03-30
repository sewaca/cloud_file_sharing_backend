<?php
try {
  // Декодируем user_email из jwt
  $user_email = decode_jwt($_GET["user_id"]);

  // Подключаемся к БД
  $link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if ($link->connect_error)
    throw new Exception("Connection failed");

  // Получаем из бд все id компаний где работает пользователь
  $sql = "SELECT `organization_id` FROM `employees` WHERE `email`=?";
  $stmt = $link->prepare($sql);
  $stmt->bind_param("s", $user_email);
  $stmt->execute();
  $ids = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  if (!count($ids)){
    echo json_encode([]);
    exit;
  }
  
  
  // Получаем из бд все компании, где работает пользователь
  $sql = "SELECT * FROM `organizations` WHERE `id`=".implode(' or `id`=', array_map(function($el){ return $el["organization_id"]; }, $ids));
  $stmt = $link->prepare($sql);
  $stmt->execute();
  $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  
  echo json_encode($res);
}
catch ( Exception $e ) {
  include BASE_PATH."/server/500.php";
} 
