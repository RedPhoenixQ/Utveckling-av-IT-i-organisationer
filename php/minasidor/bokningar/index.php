<?php require_once "../../scripts/auth/verify_logged_in.php" ?>
<?php require_once "../../scripts/erp.php" ?>
<?php require_once "../../scripts/session.php" ?>
<?php $title = "Bokningar"; require_once "../../templates/header.php" ?>

<!-- Möjlighet att boka om och avboka besök i listan -->
<main>
    <h1>Detta är mina bokningar</h1>

    <?php 
        $erp = new Erp("Patient Appointment");
        $erp->fields = ["name", "practitioner_name", "duration", "department", "appointment_date", "appointment_type"];
        $erp->add_filter(["Patient Appointment", "patient", "=", $_SESSION[Session::NAME]]);
        $erp->add_filter(["Patient Appointment", "status", "=","CLOSED"]);

        $records = $erp->list()["data"];
        var_dump($records);
    ?>
</main>

<?php require_once "../../templates/footer.php" ?>