<?php
require_once "../scripts/session.php";

$_SESSION[Session::THEME] = $_POST["theme"];

header("Location: " . $_POST["redirect"] ?? ("$base_url/"));
die();
?>