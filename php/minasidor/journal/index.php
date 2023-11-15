<?php require_once "../../scripts/auth/verify_logged_in.php" ?>
<?php require_once "../../scripts/erp.php" ?>
<?php require_once "../../scripts/session.php" ?>
<?php $title = "Journal";
require_once "../../templates/header.php" ?>

<?php
$erp = new Erp(Doc::PATIENT_MEDICAL_RECORD);
$erp->fields = ["status", "communication_date", "reference_doctype", "reference_name", "subject", "attach"];
$erp->add_filter([Doc::PATIENT_MEDICAL_RECORD, "patient", "=", $_SESSION[Session::NAME]]);
$records = $erp->list()["data"];
?>

<table class="table">
    <thead>
        <th></th>
        <th>Datum</th>
        <th>Typ</th>
        <th>Detaljer</th>
        <th></th>
    </thead>
    <tbody>
        <?php foreach ($records as $record) { ?>
            <tr class="position-relative">
                <th scope="row">
                    <a class="stretched-link"
                        href="<?= "$base_url/minasidor/journal/" . $record["reference_doctype"] . "?name=" . rawurlencode($record["reference_name"]) ?>"></a>
                </th>
                <td>
                    <?= $record["communication_date"] ?>
                </td>
                <td>
                    <?= $record["reference_doctype"] ?>
                </td>
                <td>
                    <?= $record["subject"] ?>
                </td>
                <td>
                    <?php if ($record["attach"]) { ?>
                    <a class="btn btn-secondary position-relative z-2" href="<?= ERP::BASE_URL . $record["attach"] ?>" target="_blank" rel="noopener noreferrer" hx-boost="false">Attachment</a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php require_once "../../templates/footer.php" ?>