<?php 

// Получаем данные из запроса
$uri = explode("/", explode('?', $_SERVER['REQUEST_URI'])[0]);
$data = [
    "userId" => $uri[2],
    "containerId" => $uri[4]
];

// Получаем залогиненного пользователя
$login = decode_jwt($_COOKIE["jwt"]);

// Получаем настройки контейнера
$settings_file__path = BASE_PATH."/server/temp/users/".$login."/containers/".$data["containerId"]."/settings.json";
$settings = json_decode(file_get_contents($settings_file__path), true);

// Проверяем разрешено ли пользователю просматривать контейнер
if (!in_array($login, $settings["viewers"]))
    include BASE_PATH."/server/403.php";

// Отправляем ответ клиенту
echo json_encode([
    "title" => $settings["title"],
    "filenames" => $settings["files"],
    "isOwner" => $data["userId"] === $login
]);