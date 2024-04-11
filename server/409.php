<?php

header("HTTP/1.1 409 Conflict");
echo json_encode(["code" => 409, "message" => "User already exists"]);
exit;