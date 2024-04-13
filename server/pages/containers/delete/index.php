<?php 

function removeDirectory($dir) {
    if ($objs = glob($dir."/*")) {
        foreach($objs as $obj) {
            is_dir($obj) ? removeDirectory($obj) : unlink($obj);
        }
    }
    rmdir($dir);
}

// Получаем данные из запроса
$uri = explode("/", explode('?', $_SERVER['REQUEST_URI'])[0]);
$data = [
    "userId" => $uri[2],
    "containerId" => $uri[4],
    "filename" => isset($_GET["filename"]) ? $_GET["filename"] : null,
];

// Получаем залогиненного пользователя
$login = decode_jwt($_COOKIE["jwt"]);

// Если искомого файла не существует или пользователь не является владельцем
if (
    $login !== $data["userId"] or 
    !file_exists(TEMP_PATH."/users/".$login."/containers/".$data["containerId"]) or 
    ($data["filename"] !== null and !file_exists(TEMP_PATH."/users/".$login."/containers/".$data["containerId"]."/files/".$data["filename"]))
) include BASE_PATH."/server/404.php";

// Если пользователь хочет удалить весь контейнер целиком:
if ($data["filename"] === null) 
    removeDirectory (TEMP_PATH."/users/".$login."/containers/".$data["containerId"]);
// Если необходимо удалить только один файл
else {
    $settings_file = TEMP_PATH."/users/".$login."/containers/".$data["containerId"]."/settings.json";
    $file_to_delete = TEMP_PATH."/users/".$login."/containers/".$data["containerId"]."/files/".$data["filename"];
    // Удаляем файл
    unlink($file_to_delete);
    // Обновляем настройки контейнера
    $settings = json_decode(file_get_contents($settings_file), true);
    array_splice($settings["files"], array_search($data["filename"], $settings["files"]), 1);
    file_put_contents($settings_file, json_encode($settings));
}

header("HTTP/1.1 200 OK");
echo json_encode(true);
