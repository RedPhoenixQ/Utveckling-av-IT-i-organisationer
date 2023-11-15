<?php
require_once "../scripts/erp.php";
if (!empty($_POST["name"])) {
    var_dump(Erp::update(Doc::PATIENT_NOTIFICATOIN, $_POST["name"], ["seen" => true]));
} else {
    http_response_code(400); // 400 = BAD REQUEST
}
?>