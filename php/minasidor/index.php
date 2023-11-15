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
    $patient = new Erp("Patient");
    $patient->fields = ["patient_name"];
    $patient->add_filter(["Patient", "patient_name", "=", $_SESSION[Session::NAME]]);
    $records = $patient->list()["data"];
    ?>
    <h3>Välkommen <?php echo $_SESSION[Session::NAME]; ?></h3>


    <?= var_dump($records); ?>
</main>

<?php require_once "../templates/footer.php" ?>