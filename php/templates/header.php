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
    <script src="<?= $base_url ?>/static/htmx.min.js"></script>
    <title><?= $title ?? "Hem" ?></title>
</head>
<body>
