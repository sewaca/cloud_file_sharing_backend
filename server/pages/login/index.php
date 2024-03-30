<?php 

try {
  // Accepting data: 
  $json = json_decode(file_get_contents('php://input'));
  $email = $json->email;
  $password = $json->password;
  if (!isset($email) || !isset($password)) {
    throw new Exception("Invalid request. Empty login or password.");
  }
  
  // Получаем данные из БД
  $link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if ($link->connect_error)
    throw new Exception("Connection failed");
  
  $sql = "SELECT `password`,`email` FROM employees WHERE `email`=? LIMIT 1";
  $stmt = $link->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

  // Проверяем полученные данные
  if (!count($res)){
    echo json_encode([
      "status" => false,
      "jwt" => ""
    ]);
    exit;
  }
  // Проверяем совпадают ли хэши :
  if (password_verify($password, $res[0]["password"]))
    echo json_encode([
      "status" => true,
      "jwt" => encode_jwt($res[0]["email"])
    ]);
  else
    echo json_encode([
      "status" => false,
      "jwt" => ""
    ]);
}
catch ( Exception $e ) {
  include BASE_PATH."/server/500.php";
} 

