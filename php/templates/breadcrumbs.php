<?php
$BREADCRUMBS_PATH = "$base_url/";
require_once __DIR__ ."/../scripts/globals.php";
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$path = str_replace($BREADCRUMBS_PATH, "", $path);
$breadcumbs = array_filter(explode("/", $path));
$breadcumbs_len = count($breadcumbs);
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb text-capitalize">
        <?php 
        foreach ($breadcumbs as $i => $link) {
            $BREADCRUMBS_PATH .= "$link/";
            $displayname = urldecode($link);
            if ($i == $breadcumbs_len - 1) {
                echo "<li class='breadcrumb-item active' aria-current='page'>$displayname</li";
            } else {
                echo "<li class='breadcrumb-item'><a href='$BREADCRUMBS_PATH?". http_build_query($_GET) ."'>$displayname</a></li>";
            }
        } 
        ?>
    </ol>
</nav>