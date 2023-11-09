<?php require_once "../scripts/auth/verify_logged_in.php" ?>
<?php
require_once "../scripts/erp.php";
require_once "../scripts/session.php";
?>
<?php $title = "Mina Sidor"; require_once "../templates/header.php" ?>

<main>
    <h1>Detta är mina sidor</h1>
</main>

<div>
    <?php
    $patient = new Erp("Patient");
    var_dump($patient->read($_SESSION[Session::NAME]));
    ?>
</div>

<?php require_once "../templates/footer.php" ?>