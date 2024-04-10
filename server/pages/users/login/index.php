<?php

$data = json_decode(file_get_contents("php://input"), true);

if (!file_exists(BASE_PATH."/server/temp/users/".$data['login'])) {
    header("HTTP/1.1 403 Forbidden");
    echo json_encode(["code" => 403, "message" => "Incorrect data"]);
    exit;
}

$saved_password = file_get_contents(BASE_PATH."/server/temp/users/".$data['login']."/password");
if (!password_verify($data["password"], $saved_password)) {
    header("HTTP/1.1 403 Forbidden");
    echo json_encode(["code" => 403, "message" => "Incorrect data"]);
    exit;
}

header("HTTP/1.1 200 OK");
setcookie("jwt", encode_jwt($data['login']), time() + 60 * 60 * 24 * 30, "/");
echo json_encode(true);
exit;