<?php


function endpoint($path, $method = 'GET', $backendFilePath = ""){
  // CONSTANTS
  $method_dictonary = [
    "GET" => ["GET"],
    "POST" => ["POST", "OPTIONS"],
    "DELETE" => ["DELETE", "OPTIONS"],
    "PUT" => ["PUT", "OPTIONS"],
  ];
  // 
  $request_url = explode('?', $_SERVER['REQUEST_URI'])[0];
  $request_method = $_SERVER['REQUEST_METHOD'];
  
  $regex = "/^\/".str_replace('/', '\/', $path)."\/?$"
  ."|^\/".str_replace('/', '\/', $path)."\/.*$/i";

  // Проверяем совпадает ли запрос с эндпоинтом
  if (!preg_match($regex, $request_url)) return;

  if (
    ($backendFilePath == "" and !file_exists(BASE_PATH."/server/pages/$path/index.php"))
    or ($backendFilePath != "" and !file_exists(BASE_PATH.$backendFilePath."index.php"))
  ) return;

  if( !in_array($request_method, $method_dictonary[$method]) ) return;
  
  // Если совпадает, то подключаем необходимый обработчик
  if($request_method !== $method) include BASE_PATH."/server/200.php";
  else if ($backendFilePath == "") include BASE_PATH."/server/pages/$path/index.php";
  else include BASE_PATH.$backendFilePath."index.php";
  exit;
}