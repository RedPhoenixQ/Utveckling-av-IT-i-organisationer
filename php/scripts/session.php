<?php
class Session {
    public const IS_LOGGED_IN = "is_logged_in";
    public const NAME = "name";
    public const THEME = "theme";
    public const BS_THEME_MODE = "bs-theme";
}

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

// Set eventual default values on the session here
if (!isset($_SESSION[Session::IS_LOGGED_IN])) {
    $_SESSION[Session::IS_LOGGED_IN] = false;
}
?>