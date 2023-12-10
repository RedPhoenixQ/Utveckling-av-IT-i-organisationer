<?php
require_once "../scripts/erp.php";
if (!empty($_POST["name"])) {
    var_dump(Erp::update(Doc::PATIENT_NOTIFICATOIN, $_POST["name"], ["seen" => true]));
    header("HX-Trigger: unread_notifications");
} else {
    http_response_code(400); // 400 = BAD REQUEST
}
?>