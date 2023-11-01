<?php require_once "../scripts/erp.php" ?>
<?php $title = "Erp test"; require_once "../templates/header.php" ?>

<main>
    <h1>Erp test</h1>
    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $erp = new Erp("Patient");
        print_r($_POST);
        var_dump($erp->create($_POST));
    }
    ?>
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
        <button>Create Patient</button>
    </form>
    <details>
        <summary>Users</summary>
        <pre><?php
        $erp = new Erp("User");
        var_dump($erp->list()) 
        ?></pre>
    </details>
    <details>
        <summary>Patients</summary>
        <pre><?php
        $erp = new Erp("Patient");
        $erp->fields = ["name", "uid", "first_name", "sex"];
        var_dump($erp->list()) 
        ?></pre>
    </details>
    <details>
        <summary>Female Patients</summary>
        <pre><?php
        $erp = new Erp("Patient");
        $erp->fields = ["name", "uid", "first_name", "sex"];
        $erp->add_filter(["Patient", "sex", "=", "Female"]);
        var_dump($erp->list()) 
        ?></pre>
    </details>
    <details>
        <summary>One Patient: Test Female</summary>
        <pre><?php
        $erp = new Erp("Patient");
        $erp->fields = ["name", "uid", "first_name", "sex"];
        var_dump($erp->read("Test Female")) 
        ?></pre>
    </details>
</main>

<?php require_once "../templates/footer.php" ?>
