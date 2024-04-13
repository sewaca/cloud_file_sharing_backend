<?php

define('BASE_PATH', ($_ENV['IS_BUILD'] ? '' : '.'));
define('TEMP_FOLDER', ($_ENV['IS_BUILD'] ? sys_get_temp_dir() : BASE_PATH."/server/temp"));

include_once BASE_PATH."/server/headers.php";
include_once BASE_PATH."/server/definitions.php";
include_once BASE_PATH."/server/vendor/autoload.php";
include_once BASE_PATH."/server/functions/index.php";

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH."/server/");
$dotenv->load();

// ~ ENDPOINTS: 
// ! POST /users/login
endpoint("users/login", "POST");
// ! POST /users/register
endpoint("users/register", "POST");
// ! POST /containers/create
endpoint("containers/create", "POST");
// & DELETE /users/*/containers/*
endpoint("users/.{1,}/containers/.{1,}", 'DELETE', "/server/pages/containers/delete/");
// ^ GET /users/*/containers/*
endpoint("users/.{1,}/containers/.{1,}", "GET", "/server/pages/containers/get/");


include BASE_PATH."/server/404.php";
?>