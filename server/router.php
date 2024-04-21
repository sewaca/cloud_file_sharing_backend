<?php

// ENDPOINTS: 
// ! POST /users/login
endpoint("users/login", "POST");
// ! POST /users/register
endpoint("users/register", "POST");

if (!isset($_COOKIE["jwt"])) include BASE_PATH."/server/401.php";
// ! POST /containers/create
endpoint("containers/create", "POST");
// & DELETE /users/*/containers/*
endpoint("users/.{1,}/containers/.{1,}", 'DELETE', "/server/pages/containers/delete/");
// ^ GET /users/*/containers/*/download
endpoint("users/.{1,}/containers/.{1,}/download", "GET", "/server/pages/containers/download/");
// ^ GET /users/*/containers/*
endpoint("users/.{1,}/containers/.{1,}", "GET", "/server/pages/containers/get/");

include BASE_PATH."/server/404.php";