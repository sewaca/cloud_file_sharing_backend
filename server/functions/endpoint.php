<?php

function endpoint($path, $method = 'GET', $backendFilePath = ""){
  $request_url = explode('?', $_SERVER['REQUEST_URI'])[0];
  $request_method = $_SERVER['REQUEST_METHOD'];

  $regex = "/^\/".str_replace('/', '\/', $path)."\/?$"
          ."|^\/".str_replace('/', '\/', $path)."\/.*$/i";

  // Проверяем совпадает ли запрос с эндпоинтом
  $isNotMatchingEndpoint = !preg_match($regex, $request_url) or 
          ($backendFilePath == "" and !file_exists(BASE_PATH."/server/pages/$path/index.php")) or
          ($backendFilePath !== "" and !file_exists(BASE_PATH.$backendFilePath."index.php")) or
          $request_method !== $method;
  if ($isNotMatchingEndpoint) return;

  // Если совпадает, то подключаем необходимый обработчик
  if ($backendFilePath == "") include BASE_PATH."/server/pages/$path/index.php";
  else include BASE_PATH.$backendFilePath."index.php";
  exit;
}