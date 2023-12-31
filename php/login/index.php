<?php require_once "../scripts/globals.php" ?>
<?php require_once "../scripts/session.php" ?>
<?php require_once "../scripts/db.php" ?>
<?php
if (!empty($_POST["ssn"]) && !empty($_POST["pwd"])) {
    // Remove '-' to only leave 12 numbers
    $ssn = preg_replace("/[^0-9]/", "", $_POST["ssn"]);
    $pwd = $_POST["pwd"];
    if (strlen($ssn) != 12) {
        $form_error = "Personnummer måste vara 12 siffror";
    } else { 
        $stmt = $db->prepare("CALL verify_auth(:ssn, :pwd)");
        $stmt->bindParam("ssn", $ssn, PDO::PARAM_STR);
        $stmt->bindParam("pwd", $pwd, PDO::PARAM_STR);
        if ($stmt->execute()) {
            $auth = $stmt->fetch();
            $_SESSION[Session::IS_LOGGED_IN] = true;
            $_SESSION[Session::NAME] = $auth["name"];
            if (!empty($_GET["redirect"])) {
                $redirect = $_GET["redirect"];
            } else {
                $redirect = $base_url . "/";
            }
            header("Location: " . $redirect);
            die();
        } else {
            $form_error = "Något gick fel, " . $stmt->errorInfo()[2];
        }
    }
}
?>

<?php $title = "Logga in"; require_once "../templates/header.php" ?>

<h1>Logga in</h1>
<p>Endast personer som tidigare har besökt vårdcentralen kan för nuvarande använda våra digitala tjänster. Vänligen kontakt telefonrådgivningen om ni inte tidigare har besökt oss.</p>
<form method="post" class="my-4">
    <div class="form-floating my-2">
        <input class="form-control" type="text" name="ssn" id="ssn" pattern="\d{8}-?\d{4}" title="Ditt personnummer med 12 siffor, 'YYYYMMDD-XXXX'" value="<?= $_POST["ssn"] ?? "" ?>" required>
        <label for="ssn">Personnummer (12-siffror):</label>
    </div>
    <div class="form-floating my-2">
        <input class="form-control" type="password" name="pwd" id="pwd" required>
        <label for="pwd">Lösenord:</label>
    </div>
    <?php if (!empty($form_error)) {
        echo "<div class='m-4'><span class='badge text-bg-danger fs-5'>";
        echo $form_error;
        echo "</span></div>";
    }?>
    <div class="my-4 mx-auto mw-100" style="width:fit-content">
        <button class="btn btn-primary">Logga in</button>
        <span>eller</span>
        <a href="<?= "$base_url/registrera" ?>">registrera dig här</a>
    </div>
</form>

<?php require_once "../templates/footer.php" ?>