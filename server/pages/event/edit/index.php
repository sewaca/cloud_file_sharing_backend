<?php

include BASE_PATH."/server/libraries/simpleCalDAV-master/SimpleCalDAVClient.php";

try {
  // Accepting data: 
  $params = json_decode(file_get_contents('php://input'), true);
  $params['user_id'] = decode_jwt($params['user_id']);
  $params['event_data']['start'] = str_replace(":", "", str_replace(" ", "T", str_replace(".", "", $params['start'])));
  $params['event_data']['end'] = str_replace(":", "", str_replace(" ", "T", str_replace(".", "", $params['end'])));

  if (
    !$params['user_id'] 
    or !$params['event_id']
    or !$params['event_data']['name']
    or !strtotime($params['event_data']['start']) 
    or !strtotime($params['event_data']['end'])
    or strtotime($params['event_data']['end']) <= strtotime($params['event_data']['start'])
  )
    include BASE_PATH."/server/404.php";

  // TODO: Проверка что пользователь - создатель события
  
  
  // Получаем данные из БД
  $link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if ($link->connect_error)
    throw new Exception("Connection failed");
  
  $sql = "SELECT `uniqueid` FROM `events` WHERE `id`=?";
  $stmt = $link->prepare($sql);
  $stmt->bind_param("i", $params['event_id']);
  $stmt->execute();
  $res = $stmt->get_result()->fetch_array(MYSQLI_ASSOC);
  $uniqueid = $res['uniqueid'];

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
  file_put_contents('php://stdout', $e->__toString());
  include BASE_PATH."/server/500.php";
} 

