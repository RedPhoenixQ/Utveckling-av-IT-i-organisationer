<?php require_once "../../scripts/auth/verify_logged_in.php" ?>
<?php require_once "../../scripts/erp.php" ?>
<?php require_once "../../scripts/session.php" ?>
<?php $title = "Bokningar";
require_once "../../templates/header.php" ?>

<!-- Möjlighet att boka om och avboka besök i listan -->
<h1>Detta är mina bokningar</h1>

<?php
$erp_appointment = new Erp(Doc::PATEINT_APPOINTMENT);
$erp_appointment->fields = ["name", "practitioner_name", "duration", "department", "appointment_time", "appointment_date", "appointment_type"];
$erp_appointment->add_filter([Doc::PATEINT_APPOINTMENT, "patient", "=", $_SESSION[Session::NAME]]);
$erp_appointment->add_filter([Doc::PATEINT_APPOINTMENT, "status", "!=", "CLOSED"]);
$erp_appointment->order_by("appointment_datetime", Erp::ORDER_ASC);

$records = $erp_appointment->list()["data"];
?>

<div class="table-responsive">
    <table class="table align-middle">
        <thead>
            <th>ID</th>
            <th>Vårdtyp</th>
            <th>Datum</th>
            <th>Tid</th>
            <th>Duration</th>
            <th>Avdelning</th>
            <th>Läkarnamn</th>
            <th></th>
            <th></th>
        </thead>
        <tbody>
            <?php foreach ($records as $record) { ?>
                <tr class="position-relative">
                    <td>
                        <?= $record["name"] ?>
                    </td>
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
                    <td>
                        <form action="" method="post">
                            <button class="btn btn-secondary">Omboka</button>
                        </form>
                    </td>
                    <td>
                        <form action="" method="post">
                            <button class="btn btn-danger">Avboka</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once "../../templates/footer.php" ?>