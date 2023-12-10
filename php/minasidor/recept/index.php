<?php require_once "../../scripts/auth/verify_logged_in.php" ?>
<?php require_once "../../scripts/erp.php" ?>
<?php require_once "../../scripts/session.php" ?>

<?php
$erp_long_term = new Erp(Doc::LONG_TERM_MEDICATION);
$erp_long_term->fields = ["name", "creation", "patient", "ordering_practitioner", "practitioner_name", "ends_at", "medication", "dosage", "dosage_form", "period", "order_description"];
$erp_long_term->add_filter([Doc::LONG_TERM_MEDICATION, "patient", "=", $_SESSION[Session::NAME]]);
$long_term = $erp_long_term->list()["data"];

$erp_long_term_request = new Erp(Doc::LONG_TERM_MEDICATION_RENEW_REQUEST);
$erp_long_term_request->fields = ["custom_gr3_long_term_medication"];
$erp_long_term_request->add_filter([Doc::LONG_TERM_MEDICATION_RENEW_REQUEST, "patient", "=", $_SESSION[Session::NAME]]);
$erp_long_term_request->add_or_filter([Doc::LONG_TERM_MEDICATION_RENEW_REQUEST, "state", "=", "Pending"]);
$erp_long_term_request->add_or_filter([
    Doc::LONG_TERM_MEDICATION_RENEW_REQUEST,
    "creation",
    ">=",
    date("Y-m-d")
]);
$long_term_requests_response = $erp_long_term_request->list()["data"];
$long_term_requests = [];
foreach ($long_term_requests_response as $response) {
    // Create a list of names that have a pending request
    $long_term_requests[] = $response["custom_gr3_long_term_medication"];
}

$erp_medication_request = new Erp(Doc::MEDICATION_REQUEST);
$erp_medication_request->fields = ["name", "medication", "order_date", "dosage_form", "dosage", "period", "quantity", "number_of_repeats_allowed", "order_group"];
$erp_medication_request->add_filter([Doc::MEDICATION_REQUEST, "patient", "=", $_SESSION[Session::NAME]]);
$erp_medication_request->order_by("order_date", Erp::ORDER_ASC);
$medication_requests = $erp_medication_request->list()["data"];
?>

<?php 
if (!empty($_POST["long_term_medication"])) {
    $return = Erp::create(Doc::LONG_TERM_MEDICATION_RENEW_REQUEST, [
        "custom_gr3_long_term_medication" => $_POST["long_term_medication"]
    ]);
    if (!isset($return["data"])) {
        $renew_error = "Kunde inte skicka förfrågan för att förnya recept";
    }
}
?>

<?php $title = "Recept"; require_once "../header.php" ?>

<h1>Recept</h1>

<?php if (!empty($long_term)): ?>
    <h2>Långtidsmedicinering</h2>
    
    <?php if (isset($renew_error)) {
        echo "<p class='alert alert-danger'>$renew_error</p>";
    } ?>

    <div class="table-responsive">
        <table class="table">
            <thead class="text-nowrap">
                <th>Skapad</th>
                <th>Giltigt tills</th>
                <th>Läkare</th>
                <th>Medication</th>
                <th>Period</th>
                <th>Dos</th>
                <th>Medicin typ</th>
                <th></th>
            </thead>
            <tbody>
                <?php foreach ($long_term as $record): ?>
                    <tr>
                        <td class="text-nowrap">
                            <time datetime="<?= $record["creation"] ?>">
                                <?= (new DateTime($record["creation"]))->format("Y-m-d") ?>
                            </time>
                        </td>
                        <td class="text-nowrap"><?php if (empty($record["ends_at"])) {
                            echo "Inget slutdatum";
                        } else {
                            echo '<time datetime="' . $record["ends_at"] . '">';
                            echo (new DateTime($record["ends_at"]))->format("y-m-d");
                            echo '</time>';
                        }
                        ?>
                        <td><?= $record["practitioner_name"] ?></td>
                        <td><?= $record["medication"] ?></td>
                        <td><?= $record["period"] ?></td>
                        <td><?= $record["dosage"] ?></td>
                        <td><?= $record["dosage_form"] ?></td>
                        <td>
                            <?php if (!in_array($record["name"], $long_term_requests)): ?>
                                <form action="" method="post">
                                    <input type="hidden" name="long_term_medication" value="<?= $record["name"] ?>">
                                    <button class="btn btn-primary">Förnya</button>
                                </form>
                            <?php else: ?>
                                <span class="badge bg-secondary">Förfrågan har skickats</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<h2 class="mt-4">Tillgängliga recept</h2>
<div class="table-responsive">
    <table class="table align-middle">
        <thead class="text-nowrap">
            <th>Datum</th>
            <th>Medication</th>
            <th>Period</th>
            <th>Dos</th>
            <th>Medicin typ</th>
            <th>Mängd</th>
            <th>Repetitioner</th>
            <th></th>
        </thead>
        <tbody>
            <?php foreach ($medication_requests as $record): ?>
                <tr class="position-relative">
                    <td class="text-nowrap"><?= (new DateTime($record["order_date"]))->format("Y-m-d") ?></td>
                    <td><?= $record["medication"] ?></td>
                    <td><?= $record["period"] ?></td>
                    <td><?= $record["dosage"] ?></td>
                    <td><?= $record["dosage_form"] ?></td>
                    <td><?= $record["quantity"] ?></td>
                    <td><?= $record["number_of_repeats_allowed"] ?></td>
                    <td>
                        <?php if (!empty($record["order_group"])): ?>
                            <a href="<?= $record["order_group"] ?>">
                                <?= $record["order_group"] ?>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once "../footer.php" ?>