<?php 

if ($_ENV['IS_BUILD']) {
    error_reporting(E_ERROR);
} else {
    error_reporting(E_ALL);
}

define('BASE_PATH', ($_ENV['IS_BUILD'] ? '' : '.'));
define('TEMP_PATH', ($_ENV['IS_BUILD'] ? sys_get_temp_dir() : BASE_PATH."/server/temp"));

include_once BASE_PATH."/server/vendor/autoload.php";
include_once BASE_PATH."/server/functions/index.php";

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH."/server/");
$dotenv->load();

include_once BASE_PATH."/server/headers.php";
include_once BASE_PATH."/server/definitions.php";
include_once BASE_PATH."/server/router.php";