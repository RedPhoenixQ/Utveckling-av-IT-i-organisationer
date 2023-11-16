<?php
require_once "../scripts/session.php";
var_dump($_POST);
$_SESSION[Session::THEME] = $_POST["theme"];
$_SESSION[Session::BS_THEME_MODE] = isset($_POST["dark"]) ? "dark" : "light" ;

header("Location: " . $_POST["redirect"] ?? ("$base_url/"));
die();
?>