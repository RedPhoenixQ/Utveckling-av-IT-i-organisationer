<?php require_once "../../scripts/auth/verify_logged_in.php" ?>
<?php require_once "../../scripts/erp.php" ?>
<?php require_once "../../scripts/session.php" ?>
<?php $title = "Journal";
require_once "../../templates/header.php" ?>

<main>
    <h1>Detta är min journal</h1>
    <?php
    $erp = new Erp("Patient Encounter");
    $erp->fields = ["title", "appointment", "appointment_type", "practitioner_name", "encounter_date", "encounter_time"];
    $erp->add_filter(["Patient Encounter", "patient", "=", $_SESSION[Session::NAME]]);
    $list = $erp->list()["data"];
    ?>

    <ol>
        <?php foreach ($list as $encounter) { ?>
            <li>
                <details>
                    <summary>
                    Patient Encounters
                    </summary>
                <table class="table">
                <tr>
                    <?php foreach ($encounter as $col => $value){
                        echo "<td>$value</td>";
                    } ?>
                </tr>
                </table>
                </details>
            </li>
        <?php } ?>
    </ol>

</main>

<?php require_once "../../templates/footer.php" ?>