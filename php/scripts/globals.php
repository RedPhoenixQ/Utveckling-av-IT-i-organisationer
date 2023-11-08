<?php 
require_once(__DIR__ ."/polyfills.php");
class Session {
    public const IS_LOGGED_IN = "is_logged_in";
    public const NAME = "name";
}
// Replace with updated url when not in testing
$base_url = substr(__DIR__, 19, strlen(__DIR__) - (19 + strlen("/scripts")));
?>