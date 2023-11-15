<?php require_once "../scripts/auth/verify_logged_in.php" ?>
<?php
require_once "../scripts/erp.php";
require_once "../scripts/session.php";
?>
<?php $title = "Mina Sidor";
require_once "../templates/header.php" ?>

<main>
    <div class="d-grid gap-2 d-md-block">
        <h2 class="h2">Mina sidor</h2>
        <a class="btn btn-primary" href="<?= "$base_url/minasidor/journal/" ?>">Min journal</a>
        <a class="btn btn-primary" href="<?= "$base_url/minasidor/bokningar/" ?>">Mina bokningar</a>
        <a class="btn btn-primary" href="<?= "$base_url/minasidor/sokvard/" ?>">Sök vård</a>
    </div>
    <?php
    $patient = new Erp("Patient");
    $patient->fields = ["patient_name"];
    $patient->add_filter(["Patient", "patient_name", "=", $_SESSION[Session::NAME]]);
    $records = $patient->list()["data"];
    ?>
    <h3>Välkommen <?php echo $_SESSION[Session::NAME]; ?></h3>


    <?= var_dump($records); ?>
</main>

<?php require_once "../templates/footer.php" ?>