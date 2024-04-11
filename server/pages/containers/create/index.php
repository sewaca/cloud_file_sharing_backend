<?php

function rand_str($length, $charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789') {
    $result = '';
    $count = strlen($charset);
    for ($i = 0; $i < $length; $i++) {
        $result .= $charset[mt_rand(0, $count - 1)];
    }
    return $result;
}

// Проверяем что пользователь залогинен
$login = decode_jwt($_COOKIE["jwt"]);
if (!file_exists(BASE_PATH."/server/temp/users/".$login))
    include BASE_PATH."/server/403.php";

// Генерируем имя контейнера
$flag = true; $container_name; $path;
while ($flag) {
    $container_name = rand_str(25);
    $path = "/server/temp/users/".$login."/containers/".$container_name;
    $flag = file_exists(BASE_PATH.$path);
}

// Получаем данные
$data = json_decode(file_get_contents("php://input"), true);

// Создаём необходимые папки
mkdir(BASE_PATH."/server/temp/users/".$login."/containers/");
mkdir(BASE_PATH.$path);
mkdir(BASE_PATH.$path."/files/");

// Записываем файлы переданные с фронта
$filenames = [];
foreach ($data["files"] as $file) {
    // Даём файлу уникальное название в рамках директории
    $real_filename = implode(".", array_slice(explode(".", $file["name"]), 0, -1));
    $file_extension = ".".array_pop(explode(".", $file["name"]));
    while (in_array ($real_filename.$file_extension, $filenames)) 
        $real_filename .= "__copy";
    $real_filename .= $file_extension; // возвращаем файлу его первоначальное расширение
    array_push($filenames, $real_filename); // добавляем имя текущего файла в массив имён

    // Создаём и записываем файл
    $f = fopen(BASE_PATH.$path."/files/".$real_filename, "wb");
    fputs($f, base64_decode($file["data"]));
    fclose($f);
}

// создаём файл с настройками:
$settings = [
    "title" => $data["title"],
    "files" => $filenames,
    "viewers" => $data["viewers"]
];
$settingsFile = fopen(BASE_PATH.$path."/settings.json", "wb");
fputs($settingsFile, json_encode($settings));
fclose($settingsFile);

echo json_encode(str_replace("/server/temp", "", $path));