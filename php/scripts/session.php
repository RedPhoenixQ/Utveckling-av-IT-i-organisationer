<?php
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

// Set eventual default values on the session here
if (!isset($_SESSION[Session::IS_LOGGED_IN])) {
    $_SESSION[Session::IS_LOGGED_IN] = false;
}
?>