<?php

define('BASE_PATH', ($_ENV['IS_BUILD'] ? '' : '.'));

include_once BASE_PATH."/server/headers.php";
include_once BASE_PATH."/server/definitions.php";
include_once BASE_PATH."/server/vendor/autoload.php";
include_once BASE_PATH."/server/functions/index.php";

// ~ ENDPOINTS: 
// ! POST /login/
endpoint("login", "POST");

// TODO: Регистрация

// ^ GET /user/organizations/
endpoint("user/organizations");

// ^ GET /organization/getOffices/
endpoint("organization/getOffices");

// ^ GET /office/getAllRooms/
endpoint("office/getAllRooms");

// ^ GET /room/info/
endpoint("room/info");

// ^ GET /room/isFree/
endpoint("room/isFree");


// ! POST /room/isFree/
endpoint("room/addEvent", "POST");

// ^ GET /user/getMyEvents/
endpoint("user/getMyEvents");

// ^ GET /event/getFullData/
endpoint("event/getFullData");

// ! POST /event/edit/
endpoint("event/edit", "POST");

// ! DELETE /event/delete/
endpoint("event/delete", "POST");

// FIXME: remove
// ^ GET /test/
endpoint("test");

include BASE_PATH."/server/404.php";
?>