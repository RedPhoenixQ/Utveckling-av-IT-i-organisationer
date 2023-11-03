<?php
try {
    $db = new PDO('mysql:host=127.0.0.1;dbname=grupp3', "sqllab", "Hare#2022", [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    echo "<div>DB Error:". $e->getMessage() ."<div>";
    http_response_code(500);
    die();
}
?>