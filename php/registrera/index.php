<?php
if (!empty($_POST["ssn"]) && !empty($_POST["pwd"]) && !empty($_POST["pwd2"])) {
    $form_error = handle_register($_POST["ssn"], $_POST["pwd"], $_POST["pwd2"]);
}

function handle_register(string $ssn, string $pwd, string $pwd2): ?string {
    require_once "../scripts/globals.php";
    require_once "../scripts/session.php";
    require_once "../scripts/erp.php";
    require_once "../scripts/db.php";

    // Remove '-' to only leave 12 numbers
    $ssn = preg_replace("/[^0-9]/", "", $ssn);
    if (strlen($ssn) != 12) {
        return "Personnummer måste vara 12 siffror";
    }
    if ($pwd != $pwd2) {
        return "Lösenorden matchar inte";
    }

    $erp_patients = new Erp(Doc::PATIENT);
    $erp_patients->add_filter([Doc::PATIENT, "uid", "=", $ssn]);
    $erp_patients->fields = ["name"];
    $erp_patients->limit_page_length = 1;
    $patients = $erp_patients->list();

    if (isset($patients["error"])) {
        return $patients["error"];
    }
    if (empty($patients["data"])) {
        return "Det finns ingen patient med detta personnummer på vårdcentralen. Om du inte har träffat vårdcentralen tidigare hänvisar vi till telefonrådgivningen";
    }

    $patient = $patients["data"][0];

    $stmt = $db->prepare("CALL new_auth(:ssn, :pwd, :name)");
    $stmt->bindParam("ssn", $ssn, PDO::PARAM_STR);
    $stmt->bindParam("pwd", $pwd, PDO::PARAM_STR);
    $stmt->bindParam("name", $patient["name"], PDO::PARAM_STR);
    if (!$stmt->execute()) {
        $error = $stmt->errorInfo();
        // Check error code
        switch ($error[1]) {
            case 1062:
                // DUPLICATE PRIMARYKEY
                // SSN already has a login
                return "Personnummret har redan ett konto";
            default:
                return "Något gick fel, " . $error[2];
        }
    }
    $auth = $stmt->fetch();

    $_SESSION[Session::IS_LOGGED_IN] = true;
    $_SESSION[Session::NAME] = $patient["name"];
    if (!empty($_GET["redirect"])) {
        $redirect = $_GET["redirect"];
    } else {
        $redirect = $base_url . "/";
    }
    header("Location: " . $redirect);
    die();
}
?>

<?php $title = "Registrera"; require_once "../templates/header.php" ?>

<h1>Registera</h1>
<form method="post" class="my-4">
    <div class="form-floating my-2">
        <input class="form-control" type="text" name="ssn" id="ssn" pattern="\d{8}-?\d{4}" title="Ditt personnummer med 12 siffor, 'YYYYMMDD-XXXX'" value="<?= $_POST["ssn"] ?? "" ?>" required>
        <label for="ssn">Personnummer (12-siffror):</label>
    </div>
    <div class="form-floating my-2">
        <input class="form-control" type="password" name="pwd" id="pwd" required>
        <label for="pwd">Lösenord:</label>
    </div>
    <div class="form-floating my-2">
        <input class="form-control" type="password" name="pwd2" id="pwd2" required>
        <label for="pwd2">Upprepa lösenord:</label>
    </div>
    <?php if (!empty($form_error)) {
        echo "<div class='m-4'><span class='badge text-bg-danger fs-5'>";
        echo $form_error;
        echo "</span></div>";
    }?>
    <div class="my-4 mx-auto mw-100" style="width:fit-content">
        <button class="btn btn-primary">Registera</button>
        <span>eller, om du redan har ett konto, </span>
        <a href="<?= "$base_url/login" ?>">logga in här</a>
    </div>
</form>

<?php require_once "../templates/footer.php" ?>