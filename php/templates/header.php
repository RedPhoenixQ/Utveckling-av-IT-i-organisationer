<?php 
require_once __DIR__ . "/../scripts/globals.php";
require_once __DIR__ . "/../scripts/session.php";
?>
<!DOCTYPE html>
<html lang="sv" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="<?= $base_url ?>/static/htmx.min.js"></script>
    <title><?= $title ?? "Hem" ?></title>
</head>
<body class="d-flex flex-column" style="min-height: 100dvh; min-height: 100vh;" hx-boost="true">
    <header class="sticky-top bg-dark-subtle">
        <nav class="navbar navbar-expand-lg navbar-light mx-4">
            <a class="navbar-brand" href="<?= $base_url ?>">Mölndals Vårdcentral</a>
            <button class="navbar-toggler" type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#headerNavbar"
            aria-controls="headerNavbar"
            aria-expanded="false"
            aria-label="Öppna navigationen"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="headerNavbar">
                <ul class="navbar-nav text-end text-lg-start">
                    <?php 
                    $links = [
                        "Mina sidor" => "minasidor",
                    ];
                    foreach( $links as $title => $link ) {
                        $is_current = str_starts_with($_SERVER["REQUEST_URI"], $base_url . $link);
                        $active = $is_current ? "active" : "";
                        $ariacurrent = $is_current ? "aria-current='page'" : "";
                        echo "<li class='nav-item'><a class='nav-link $active' href='$base_url/$link/' $ariacurrent>$title</a></li>";
                    }
                    ?>
                </ul>
                <div class="ms-auto text-end">
                    <?php
                    // Save the current url in query params to redirect back to current page
                    $query = http_build_query(["redirect" => $_SERVER["REQUEST_URI"]]);
                    if ($_SESSION[Session::IS_LOGGED_IN]) {
                        echo "<span class='px-2'>". $_SESSION[Session::NAME] ."</span>";
                        echo "<a class='btn btn-secondary' href='$base_url/logout/?$query'>Logga ut</a>";
                    } else {
                        echo "<a class='btn btn-primary' href='$base_url/login/?$query'>Logga in</a>";
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>