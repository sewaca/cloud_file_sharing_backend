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
    "filename" => $_GET["filename"] ? $_GET["filename"] : null,
];

// Получаем залогиненного пользователя
$login = decode_jwt($_COOKIE["jwt"]);

// Если искомого файла не существует или пользователь не является владельцем
if (
    $login !== $data["userId"] or 
    !file_exists(BASE_PATH."/server/temp/users/".$login."/containers/".$data["containerId"]) or 
    ($data["filename"] !== null and !file_exists(BASE_PATH."/server/temp/users/".$login."/containers/".$data["containerId"]."/files/".$data["filename"]))
) {
    header("HTTP/1.1 403 Forbidden");
    echo json_encode(["code" => 403, "message" => "Incorrect data"]);
    exit;
}

// Если пользователь хочет удалить весь контейнер целиком:
if ($data["filename"] === null) 
    removeDirectory (BASE_PATH."/server/temp/users/".$login."/containers/".$data["containerId"]);
// Если необходимо удалить только один файл
else {
    $file_to_delete = BASE_PATH."/server/temp/users/".$login."/containers/".$data["containerId"]."/files/".$data["filename"];
    $index_file = BASE_PATH."/server/temp/users/".$login."/containers/".$data["containerId"]."/index";
    // Удаляем файл
    unlink($file_to_delete);
    // Обновляем index-файл
    file_put_contents($index_file, str_replace($data["filename"]."\n", '', file_get_contents($index_file)));
}

header("HTTP/1.1 200 OK");
echo json_encode(true);
