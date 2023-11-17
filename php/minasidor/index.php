<?php require_once "../scripts/auth/verify_logged_in.php" ?>
<?php
require_once "../scripts/erp.php";
require_once "../scripts/session.php";
?>
<?php $title = "Mina Sidor";
require_once "header.php" ?>

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
$patient = Erp::read(Doc::PATIENT, $_SESSION[Session::NAME])["data"];
?>
<h3>Välkommen <?php echo $patient["patient_name"] ?></h3>
<details>
    <summary class="fs-5">Kontakt information</summary>
    <form action="" method="post">
        <div>
            <label class="form-label" for="patient_mobile">
                Mobile
            </label>
            <input class="form-control" type="mobile" name="mobile" id="patient_mobile" value="<?= $patient["mobile"] ?? "" ?>">
        </div>
        <div>
            <label class="form-label" for="patient_phone">
                Phone
            </label>
            <input class="form-control" type="phone" name="phone" id="patient_phone" value="<?= $patient["phone"] ?? ""  ?>">
        </div>
        <div>
            <label class="form-label" for="patient_email">
                Email
            </label>
            <input class="form-control" type="email" name="email" id="patient_email" value="<?= $patient["email"] ?? "" ?>">
        </div>
        <button class="mt-4 btn btn-primary" name="update_contact_info">Updatera kontaktinformation</button>
    </form>
</details>

<?php require_once "footer.php" ?>