<?php require_once "../../scripts/auth/verify_logged_in.php" ?>
<?php require_once "../../scripts/erp.php" ?>
<?php require_once "../../scripts/session.php" ?>

<?php
$erp_appointment = new Erp(Doc::PATIENT_APPOINTMENT);
$erp_appointment->fields = ["name", "practitioner_name", "duration", "department", "appointment_time", "appointment_date", "appointment_type"];
$erp_appointment->add_filter([Doc::PATIENT_APPOINTMENT, "patient", "=", $_SESSION[Session::NAME]]);
$erp_appointment->add_filter([Doc::PATIENT_APPOINTMENT, "status", "!=", "CLOSED"]);
$erp_appointment->order_by("appointment_datetime", Erp::ORDER_ASC);

$appointments = $erp_appointment->list()["data"];

$erp_appointment_request = new Erp(Doc::APPOINTMENT_REQUEST);
$erp_appointment_request->fields = ["creation", "category", "reason", "is_revisit", "wants_videocall"];
$erp_appointment_request->add_filter([Doc::APPOINTMENT_REQUEST, "state", "=", "Pending"]);
$erp_appointment_request->order_by("creation", Erp::ORDER_DESC);

$pending_requests = $erp_appointment_request->list()["data"];
?>


<?php $title = "Bokningar"; require_once "../header.php" ?>

<h1>Bokningar</h1>

<?php if (!empty($pending_requests)): ?>
    <h2>Vårdförfrågningar</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <th>Skapad</th>
                <th>Kategori</th>
                <th>Beskrivning</th>
                <th>Återbesök</th>
                <th>Önskat videosamtal</th>
            </thead>
            <tbody>
                <?php foreach ($pending_requests as $request): ?>
                    <tr>
                        <td class="text-nowrap"><?= (new DateTime($request["creation"]))->format("Y-m-d") ?></td>
                        <td><?= $request["category"] ?></td>
                        <td class="w-100">
                            <?php  if (!empty($request["reason"])): ?>
                                <details>
                                    <summary>Beskrivning</summary>
                                    <?= $request["reason"] ?>
                                </details>
                            <?php else: ?>
                                <small class="opacity-75">Ingen beskrivning</small>
                            <?php endif; ?>
                        </td>
                        <td><?= $request["is_revisit"] == 0 ? "Nej" : "Ja" ?></td>
                        <td><?= $request["wants_videocall"] == 0 ? "Nej" : "Ja" ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<h2>Bokade tider</h2>
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
            <?php foreach ($appointments as $record): ?>
                <tr class="position-relative">
                    <td><?= $record["name"] ?></td>
                    <td><?= $record["appointment_type"] ?></td>
                    <td class="test-nowrap"><?= $record["appointment_date"] ?></td>
                    <td><?= $record["appointment_time"] ?></td>
                    <td><?= $record["duration"] ?></td>
                    <td><?= $record["department"] ?></td>
                    <td><?= $record["practitioner_name"] ?></td>
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
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once "../footer.php" ?>