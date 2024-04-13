<?php

// JWT params :
define('JWT_SECRET', 'secret_key_');
define('JWT_ISS', 'http://example.com');
define('JWT_AUD', 'http://example.com');
define('JWT_ALG', 'HS256');
define('JWT_TTL', 7*24*60*60); // Time to leave - 7 дней