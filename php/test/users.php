<?php require_once "../scripts/db.php" ?>
<?php $title = "Users"; require_once "../templates/header.php" ?>

<?php
if (!empty($_POST["ssn"]) && !empty($_POST["pwd"]) && !empty($_POST["name"])) {
    $ssn = preg_replace("/[^0-9]/", "", $_POST["ssn"]);
    if (strlen($ssn) != 12) {
        echo "SSN måste vara 12 siffor";
    } else {
        $stmt = $db->prepare("CALL new_auth(:ssn, :pwd, :name)");
        $stmt->bindParam("ssn", $ssn, PDO::PARAM_INT);
        $stmt->bindParam("pwd", $_POST["pwd"], PDO::PARAM_STR);
        $stmt->bindParam("name", $_POST["name"], PDO::PARAM_STR);
        $stmt->execute();
        var_dump($stmt->errorInfo());
    }
}
?>

<main>
    <h1>Användare med konton</h1>
    <form action="" method="post">
        <h2>Ny användare</h2>
        <label>
            ssn (12 siffor):
            <input type="text" name="ssn">
        </label>
        <label>
            password:
            <input type="password" name="pwd">
        </label>
        <label>
            Patient name (id):
            <input type="text" name="name">
        </label>
        <button>Create</button>
    </form>
    <table class="table table-striped">
        <thead>
            <th>SSN</th>
            <th>Name</th>
        </thead>
        <tbody>
            <?php 
            foreach ($db->query("SELECT ssn, name FROM auth") as $user) {
                echo "<tr>";
                echo "<td>". $user["ssn"]. "</td>";
                echo "<td>". $user["name"]. "</td>";
                echo "</td>";
            }
            ?>
        </tbody>
    </table>
</main>

<?php require_once "../templates/footer.php" ?>