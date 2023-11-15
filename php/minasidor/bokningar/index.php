<?php require_once "../../scripts/auth/verify_logged_in.php" ?>
<?php require_once "../../scripts/erp_appointment.php" ?>
<?php require_once "../../scripts/session.php" ?>
<?php $title = "Bokningar";
require_once "../../templates/header.php" ?>

<!-- Möjlighet att boka om och avboka besök i listan -->
<h1>Detta är mina bokningar</h1>

<?php
$erp_appointment = new Erp("Patient Appointment");
$erp_appointment->fields = ["name", "practitioner_name", "duration", "department", "appointment_time", "appointment_date", "appointment_type"];
$erp_appointment->add_filter(["Patient Appointment", "patient", "=", $_SESSION[Session::NAME]]);
$erp_appointment->add_filter(["Patient Appointment", "status", "!=", "CLOSED"]);

$records = $erp_appointment->list()["data"];
?>

<div class="table-responsive">
    <table class="table">
        <thead>
            <th>Vårdtyp</th>
            <th>Datum</th>
            <th>Tid</th>
            <th>Duration</th>
            <th>Avdelning</th>
            <th>Läkarnamn</th>
        </thead>
        <tbody>
            <?php foreach ($records as $record) { ?>
                <tr class="position-relative">
                    <td>
                        <?= $record["appointment_type"] ?>
                    </td>
                    <td>
                        <?= $record["appointment_date"] ?>
                    </td>
                    <td>
                        <?= $record["appointment_time"] ?>
                    </td>
                    <td>
                        <?= $record["duration"] ?>
                    </td>
                    <td>
                        <?= $record["department"] ?>
                    </td>
                    <td>
                        <?= $record["practitioner_name"] ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once "../../templates/footer.php" ?>