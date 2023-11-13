<?php require_once "../../../scripts/auth/verify_logged_in.php" ?>
<?php require_once "../../../scripts/erp.php" ?>
<?php require_once "../../../scripts/session.php" ?>
<?php $title = "Clinical Procedure";
require_once "../../../templates/header.php" ?>

<main class="container">
    <h1>Clinical Procedure</h1>
    <?php
    $erp = new Erp("Clinical Procedure");
    $erp->add_filter(["Clinical Procedure", "patient", "=", $_SESSION[Session::NAME]]);
    $encounter = $erp->read($_GET["name"])["data"];
    ?>

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
</main>

<?php require_once "../../../templates/footer.php" ?>