<?php

$data = json_decode(file_get_contents("php://input"), true);

if (!file_exists(TEMP_FOLDER."/users/".$data['login'])) 
    include BASE_PATH."/server/401.php";

$saved_password = file_get_contents(TEMP_FOLDER."/users/".$data['login']."/password");
if (!password_verify($data["password"], $saved_password))     
    include BASE_PATH."/server/401.php";

header("HTTP/1.1 200 OK");
setcookie("jwt", encode_jwt($data['login']), time() + 60 * 60 * 24 * 30, "/");
echo json_encode(true);
exit;