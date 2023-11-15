<?php require_once "../scripts/auth/verify_logged_in.php" ?>
<?php
require_once "../scripts/erp.php";
require_once "../scripts/session.php";
?>
<?php $title = "Mina Sidor";
require_once "../templates/header.php" ?>

<main class="container">
    <h2>Mina sidor</h2>
    <nav class="nav nav-pills flex-column flex-sm-row flex-wrap">
        <?php 
        $links = [
            "Min journal" => "journal",
            "Mina bokningar" => "bokningar",
            "Sök vård" => "sokvard",
        ];
        foreach ($links as $title => $link): ?>
            <a class="nav-link" href="<?= "$base_url/minasidor/$link/" ?>">
                <?= $title ?>
            </a>
        <?php endforeach; ?>
    </nav>
    <?php
    $erp_patient = new Erp("Patient");
    $patient = $erp_patient->read($_SESSION[Session::NAME])["data"];
    ?>
    <h3>Välkommen <?php echo $patient["patient_name"] ?></h3>
</main>

<?php require_once "../templates/footer.php" ?>