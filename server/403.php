<?php

header("HTTP/1.1 403 Forbidden");
echo json_encode(["code" => 403, "message" => "Incorrect data"]);
exit;