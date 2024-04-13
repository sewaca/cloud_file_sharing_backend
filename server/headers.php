<?php

// Response headers : 
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('Access-Control-Allow-Methods: "GET,POST,OPTIONS,DELETE,PUT"');
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Max-Age: 360000");
header('Content-Type: application/json; charset=UTF-8');
