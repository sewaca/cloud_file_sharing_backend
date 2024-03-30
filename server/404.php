<?php 
header("HTTP/1.1 404 Not Found");

echo json_encode([
  'code' => 404,
  'message'=> 'Invalid request'
]);

exit;