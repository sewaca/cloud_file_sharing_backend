<?php

define('BASE_PATH', ($_ENV['IS_BUILD'] ? '' : '.'));

include_once BASE_PATH."/server/headers.php";
include_once BASE_PATH."/server/definitions.php";
include_once BASE_PATH."/server/vendor/autoload.php";
include_once BASE_PATH."/server/functions/index.php";

// ~ ENDPOINTS: 


include BASE_PATH."/server/404.php";
?>