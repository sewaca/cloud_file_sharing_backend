<?php 

// Получаем данные из запроса
$uri = explode("/", explode('?', $_SERVER['REQUEST_URI'])[0]);
$data = [
    "userId" => $uri[2],
    "containerId" => $uri[4],
    "filename" => isset($_GET["filename"]) ? $_GET["filename"] : null
];

// Получаем залогиненного пользователя
$login = decode_jwt($_COOKIE["jwt"]);

// Получаем настройки контейнера
$settings_file__path = TEMP_PATH."/users/".$data["userId"]."/containers/".$data["containerId"]."/settings.json";
if (!file_exists($settings_file__path)) include BASE_PATH."/server/404.php";
$settings = json_decode(file_get_contents($settings_file__path), true);

// Проверяем разрешено ли пользователю просматривать контейнер
if (!in_array($login, $settings["viewers"])) include BASE_PATH."/server/403.php";

mkdir(TEMP_PATH."/archives/");
// Определяем путь до скачиваемого файла
$path = $data["filename"] === null 
            ? compress_folder(
                TEMP_PATH."/users/".$data["userId"]."/containers/".$data["containerId"]."/files/",
                TEMP_PATH."/archives/".random_string(20).".temp.zip"
            )
            : TEMP_PATH."/users/".$data["userId"]."/containers/".$data["containerId"]."/files/".$data["filename"];
// Отдаём файл на скачивание
send_file_stream($path);