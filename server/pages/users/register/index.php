<?php

$data = json_decode(file_get_contents("php://input"), true);

if (file_exists(BASE_PATH."/server/temp/users/".$data['login'])) 
    include BASE_PATH."/server/409.php";

$encrypted_password = password_hash($data["password"], PASSWORD_ARGON2I, [
    "salt" => $_ENV["SALT"]
]);

// creating necessary folders and files
mkdir(BASE_PATH."/server/temp/");
mkdir(BASE_PATH."/server/temp/users/");
mkdir(BASE_PATH."/server/temp/users/".$data["login"]);
mkdir(BASE_PATH."/server/temp/users/".$data["login"]."/containers");
file_put_contents(BASE_PATH."/server/temp/users/".$data["login"]."/password", $encrypted_password);

// return the answer
header("HTTP/1.1 200 OK");
setcookie("jwt", encode_jwt($data['login']), time() + 60 * 60 * 24 * 30, "/");
echo json_encode(true);
exit;