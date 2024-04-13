<?php

// JWT params :
define ('JWT_SECRET', $_ENV["JWT_SECRET"]);
define ('JWT_ISS', $_ENV["DOMAIN"]);
define ('JWT_AUD', $_ENV["DOMAIN"]);
define ('JWT_ALG', 'HS256');
define ('JWT_TTL', (int)$_ENV["JWT_TTL"]);