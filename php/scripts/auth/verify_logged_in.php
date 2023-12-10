<?php
require_once __DIR__ . "/../globals.php";
require_once __DIR__ . "/../session.php";
if (!$_SESSION[Session::IS_LOGGED_IN]) {
    header("Location: " . ($redirect ?? ($base_url . "/login?" . http_build_query(["redirect" => $_SERVER["REQUEST_URI"]]))));
    die();
}
?>