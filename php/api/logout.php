<?php
require_once "../scripts/globals.php";
require_once "../scripts/session.php";
session_destroy();
if (!empty($_GET["redirect"])) {
    $redirect = urldecode($_GET["redirect"]);
}
else {
    $redirect = $base_url . "/";
}
header("Location: " . $redirect);
die();
?>