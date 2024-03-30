<?php

header("HTTP/1.1 500 Internal Server Error");
echo json_encode([
  'code' => 500,
  'message'=> 'Internal Server Error'
]);

exit;