<?php
require_once "../scripts/erp.php";
if (!empty($_POST["name"])) {
    $erp_notif = new Erp("Gr3 Notification");
    var_dump($erp_notif->update($_POST["name"], ["seen" => true]));
} else {
    http_response_code(400); // 400 = BAD REQUEST
}
?>