<?php

$data = json_decode(file_get_contents("php://input"), true);

if (file_exists(TEMP_PATH."/users/".$data['login'])) 
    include BASE_PATH."/server/409.php";

$encrypted_password = password_hash($data["password"], PASSWORD_ARGON2I);

// creating necessary folders and files
if (!file_exists(TEMP_PATH."/users/")) mkdir(TEMP_PATH."/users/");
mkdir(TEMP_PATH."/users/".$data["login"]);
mkdir(TEMP_PATH."/users/".$data["login"]."/containers");
file_put_contents(TEMP_PATH."/users/".$data["login"]."/password", $encrypted_password);

// return the answer
header("HTTP/1.1 200 OK");
setcookie("jwt", encode_jwt($data['login']), time() + (int)$_ENV["JWT_TTL"], "/");
echo json_encode(true);
exit;