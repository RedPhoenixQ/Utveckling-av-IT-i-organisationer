<?php require_once "../scripts/erp.php" ?>
<?php $title = "Erp test"; require_once "../templates/header.php" ?>

<h1>Erp test</h1>
<pre><?php
if (isset($_POST["delete_name"])) {
    var_dump(Erp::delete(Doc::PATIENT, $_POST["delete_name"]));
} else if (isset($_POST["create"])) {
    $data = array_filter($_POST);
    var_dump(Erp::create(Doc::PATIENT, $data));
} else if (isset($_POST["update"])) {
    $data = array_filter($_POST);
    var_dump(Erp::update(Doc::PATIENT, $_POST["name"], $data));
} else if (isset($_POST["test"])) {
    var_dump(Erp::method("healthcare.healthcare.doctype.patient_appointment.patient_appointment.update_status", [
        "appointment_id" => $_POST["id"],
        "status" => "Closed"
    ]));
}
?></pre>
<form action="" method="post">
    <label for="first_name">First name</label>
    <input type="text" name="first_name" id="first_name">
    <label for="sex">Gender</label>
    <select type="text" name="sex" id="sex">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>
    <label for="uid">SSN</label>
    <input type="text" name="uid" id="uid">
    <button name="create">Create Patient</button>
</form>
<form action="" method="POST">
    <label for="delete_name">Patient name</label>
    <input type="text" name="delete_name" id="delete_name">
    <button>Delete Patient</button>
</form>
<details>
    <summary>Users</summary>
    <pre><?php
    $erp = new Erp(Doc::USER);
    var_dump($erp->list()) 
    ?></pre>
</details>
<details>
    <summary>Patients</summary>
    <?php
    $erp = new Erp(Doc::PATIENT);
    $erp->fields = ["name", "uid", "first_name", "sex"];
    $patients = $erp->list();
    echo "<ul>";
    foreach ($patients["data"] as $patient) {
        echo "<form method='post' class='text-capitalize'>";
        foreach ($patient as $key => $value) {
            if ($key == "name") {
                echo "<label for='$key'>$key</label>";
                echo "<input readonly value='$value' name='$key' id='$key'>";
            } else {
                echo "<label for='$key'>$key</label>";
                echo "<input placeholder='$value' name='$key' id='$key'>";
            }
        }
        echo "<button name='update'>Update</button>";
        echo "</form>";
    }
    echo "</ul>";
    ?>
</details>
<details>
    <summary>Female Patients</summary>
    <pre><?php
    $erp = new Erp(Doc::PATIENT);
    $erp->fields = ["name", "uid", "first_name", "sex"];
    $erp->add_filter(["Patient", "sex", "=", "Female"]);
    var_dump($erp->list()) 
    ?></pre>
</details>
<details>
    <summary>One Patient: Test Female</summary>
    <pre><?php var_dump(Erp::read(Doc::PATIENT, "Test Female")) ?></pre>
</details>
<form action="" method="post">
    <input type="text" name="id">
    <button name="test">testing</button>
</form>

<?php require_once "../templates/footer.php" ?>
