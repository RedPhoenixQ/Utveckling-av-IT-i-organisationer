<?php require_once "../../../scripts/auth/verify_logged_in.php" ?>
<?php require_once "../../../scripts/erp.php" ?>
<?php require_once "../../../scripts/session.php" ?>
<?php $title = "Patient Encounter";
require_once "../../header.php" ?>

<h1>Patient Encounter</h1>
<?php
$encounter = Erp::read(Doc::PATIENT_ENCOUNTER, $_GET["name"])["data"];
?>
<?php if (isset(Erp::read(Doc::PATIENT_APPOINTMENT_EVALUATION, $_SESSION[Session::NAME]." - ".$_GET["name"])["data"])): ?>
    <button disabled class="btn btn-secondary">Detta encounter har redan utvärderats</button>
<?php else: ?>
    <a class="btn btn-primary" href="<?= "$base_url/minasidor/journal/Patient Encounter/Utvärdering/?" . http_build_query($_GET) ?>">Utvärdera</a>
<?php endif; ?>

<dl>
    <?php foreach ($encounter as $col => $value) {
        echo "<dt>$col</dt>";
        echo "<dd>";
        if (is_array($value)) {
            foreach ($value as $key => $v) {
                if (is_array($v)) {
                    echo "<div class='table-responsive'><table class='table'><thead><tr>";
                    foreach ($v as $n => $fv) {
                        echo "<th>$n</th>";
                    }
                    echo "</tr></thead><tbody><tr>";
                    foreach ($v as $n => $fv) {
                        echo "<td>$fv</td>";
                    }
                    echo "</tr></tbody></table></div>";
                }
            }
        } else {
            echo "<dd>$value</dd>";
        }
    } ?>
</dl>

<?php require_once "../../footer.php" ?>