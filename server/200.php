<?php 
header("HTTP/1.1 200 OK");

echo json_encode([
  'code' => 200,
  'message'=> 'Everything is OK'
]);

exit;