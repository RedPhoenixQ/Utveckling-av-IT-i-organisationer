<?php
require_once "../../scripts/db.php";

// Make sure all params we expect are present in $_POST
$expected_params = ["patient", "name", "appointment_date", "appointment_time", "title"];
if (!empty(array_diff_key(array_flip($expected_params), $_POST))) {
    echo "Expected params: ";
    print_r($expected_params);
    http_response_code(400); // 400 = BAD REQUEST
    die("Invalid input");
}

$doctype = "Patient Appointment";

if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    $msg = "En bokning har ändrats: ";
} else {
    $msg = "En ny bokning har skapats: ";
}

$content = $msg . date("y/m/d", $_POST["appiontment_date"])." klockan " . date("H:i", $_POST("appointment_time")) . ": " . $_POST["title"];

$stmt = $db->prepare("INSERT INTO notification(patient_name, doctype, doc_name, content) VALUES (:patient_name, :doctype, :doc_name, :content)");
$stmt->bindParam("patient_name", $_POST["patient"]);
$stmt->bindParam("doc_name", $_POST["name"]);
$stmt->bindParam("doctype", $doctype);
$stmt->bindParam("content", $content);
$stmt->execute();
?>