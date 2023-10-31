<?php 
require_once __DIR__ . "/../scripts/globals.php";
require_once __DIR__ . "/../scripts/session.php";
require_once __DIR__ . "/../scripts/db.php";
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="<?= $base_url ?>/static/htmx.min.js"></script>
    <title><?= $title ?? "Hem" ?></title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg">
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
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mina sidor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Boka tid</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>