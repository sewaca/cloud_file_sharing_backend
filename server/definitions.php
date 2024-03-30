<?php

// JWT params :
define('JWT_SECRET', 'secret_key_');
define('JWT_ISS', 'http://example.com');
define('JWT_AUD', 'http://example.com');
define('JWT_ALG', 'HS256');
define('JWT_TTL', 7*24*60*60); // Time to leave - 7 дней

// DB params : 
define('DB_HOST', ($_ENV['IS_BUILD'] ? 'database' : 'localhost')); 
define('DB_USER', 'root');
define('DB_PASSWORD', ($_ENV['IS_BUILD'] ? 'root' : '233215Sb')); 
define('DB_NAME', 'meetings');

// Yandex Calendar: 
define('YA_CALENDAR_LOGIN', 'sevabulgackov@yandex.ru');
define('YA_CALENDAR_PASSWORD', 'iisdxagvsnlejmns');