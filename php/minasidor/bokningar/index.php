<?php require_once "../../scripts/auth/verify_logged_in.php" ?>
<?php require_once "../../scripts/erp.php" ?>
<?php require_once "../../scripts/session.php" ?>
<?php $title = "Bokningar";
require_once "../../templates/header.php" ?>

<!-- Möjlighet att boka om och avboka besök i listan -->
<main class="container">
    <h1>Detta är mina bokningar</h1>

    <?php
    $erp = new Erp("Patient Appointment");
    $erp->fields = ["name", "practitioner_name", "duration", "department", "appointment_time", "appointment_date", "appointment_type"];
    $erp->add_filter(["Patient Appointment", "patient", "=", $_SESSION[Session::NAME]]);
    $erp->add_filter(["Patient Appointment", "status", "=", "CLOSED"]);

    $records = $erp->list()["data"];
    ?>

    <div class="table responsive">
        <table class="table">
            <thead>
                <th>Läkarnamn</th>
                <th>Duration</th>
                <th>Avdelning</th>
                <th>Tid</th>
                <th>Datum</th>
                <th>Vårdtyp</th>
            </thead>
            <tbody>
                <?php foreach ($records as $record) { ?>
                    <tr class="position-relative">
                        <td>
                            <?= $record["practitioner_name"] ?>
                        </td>
                        <td>
                            <?= $record["duration"] ?>
                        </td>
                        <td>
                            <?= $record["department"] ?>
                        </td>
                        <td>
                            <?= $record["appointment_time"] ?>
                        </td>
                        <td>
                            <?= $record["appointment_date"] ?>
                        </td>

                        <td>
                            <?= $record["appointment_type"] ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


</main>

<?php require_once "../../templates/footer.php" ?>