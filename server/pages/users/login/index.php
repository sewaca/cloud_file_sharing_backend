<?php

$data = json_decode(file_get_contents("php://input"), true);

if (!file_exists(TEMP_PATH."/users/".$data['login'])) 
    include BASE_PATH."/server/401.php";

$saved_password = file_get_contents(TEMP_PATH."/users/".$data['login']."/password");
if (!password_verify($data["password"], $saved_password))     
    include BASE_PATH."/server/401.php";

header("HTTP/1.1 200 OK");
setcookie("jwt", encode_jwt($data['login']), time() + (int)$_ENV["JWT_TTL"], "/");
echo json_encode(true);
exit;