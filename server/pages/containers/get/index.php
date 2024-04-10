<?php 

// Получаем данные из запроса
$uri = explode("/", explode('?', $_SERVER['REQUEST_URI'])[0]);
$data = [
    "userId" => $uri[2],
    "containerId" => $uri[4]
];

// Получаем залогиненного пользователя
$login = decode_jwt($_COOKIE["jwt"]);

// TODO: Добавить проверку разрешено ли пользователю просматривать этот контейнер

$indexfile_path = BASE_PATH."/server/temp/users/".$login."/containers/".$data["containerId"]."/index";


$data = [
    // TODO: Сделать название контейнера
    "title" => "",
    "filenames" => explode("\n", file_get_contents($index_file)),
    "isOwner" => $data["userId"] === $login
];