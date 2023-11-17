<?php require_once "../../../scripts/auth/verify_logged_in.php" ?>
<?php require_once "../../../scripts/erp.php" ?>
<?php require_once "../../../scripts/session.php" ?>
<?php $title = "Therapy Session";
require_once "../../header.php" ?>

<h1>Therapy Sessoin</h1>
<?php
$therapy_session = Erp::read(Doc::THERAPY_SESSION, $_GET["name"])["data"];
?>

<dl>
    <?php foreach ($therapy_session as $col => $value) {
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