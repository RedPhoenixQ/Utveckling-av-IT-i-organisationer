<?php require_once "../scripts/erp.php" ?>
<?php $title = "Erp test"; require_once "../templates/header.php" ?>

<main>
    <h1>Erp test</h1>
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
