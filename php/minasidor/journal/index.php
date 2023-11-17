<?php require_once "../../scripts/auth/verify_logged_in.php" ?>
<?php require_once "../../scripts/erp.php" ?>
<?php require_once "../../scripts/session.php" ?>
<?php $title = "Journal";
require_once "../header.php" ?>

<?php
$erp = new Erp(Doc::PATIENT_MEDICAL_RECORD);
$erp->fields = ["status", "communication_date", "reference_doctype", "reference_name", "subject", "attach"];
$erp->order_by("communication_date", Erp::ORDER_ASC);
$erp->add_filter([Doc::PATIENT_MEDICAL_RECORD, "patient", "=", $_SESSION[Session::NAME]]);
$records = $erp->list()["data"];
?>

<div class="table-responsive">
    <table class="table">
        <thead>
            <th>Detaljer</th>
            <th>Datum</th>
            <th>Sammanfattning</th>
            <th></th>
        </thead>
        <tbody>
            <?php foreach ($records as $record) { ?>
                <tr class="position-relative">
                    <th scope="row">
                        <a class="btn btn-primary"
                            href="<?= "$base_url/minasidor/journal/" . $record["reference_doctype"] . "?name=" . rawurlencode($record["reference_name"]) ?>">Detaljer</a>
                    </th>
                    <td class="text-nowrap">
                        <?= $record["communication_date"] ?>
                    </td>
                    <td class="w-100">
                        <details>
                            <summary><?= $record["reference_doctype"] ?></summary>
                            <?= $record["subject"] ?>
                        </details>
                    </td>
                    <td class="table-ste">
                        <?php if ($record["attach"]) { ?>
                        <a class="btn btn-secondary position-relative z-2" href="<?= ERP::BASE_URL . $record["attach"] ?>" target="_blank" rel="noopener noreferrer" hx-boost="false">Attachment</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php require_once "../footer.php" ?>