<?php

function endpoint($path, $method = 'GET'){
 
  $request_url = explode('?', $_SERVER['REQUEST_URI'])[0];
  $request_method = $_SERVER['REQUEST_METHOD'];  

  $regex = "/^\/".str_replace('/', '\/', $path)."\/?$"
          ."|^\/".str_replace('/', '\/', $path)."\/.*$/i";

  if (!preg_match($regex, $request_url) or !file_exists(BASE_PATH."/server/pages/$path/index.php") or $request_method !== $method)
    return;

  include BASE_PATH."/server/pages/$path/index.php";
  exit;
}