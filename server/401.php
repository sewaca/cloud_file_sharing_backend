<?php 
header("HTTP/1.1 401 Unauthorized");

echo json_encode([
  'code' => 401,
  'message'=> 'Please, relogin'
]);

exit;