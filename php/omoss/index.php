<?php 
$groups = [
    "Ledningen" => [
        [
            "name" => "Test Testson",
            "title" => "Manager",
            "img" => null,
        ]
    ]
]
?>

<?php $title = "Om oss"; require_once "../templates/header.php" ?>

<h1>Om oss</h1>
<?php foreach ($groups as $group_name => $people): ?>
    <section>
        <h2><?= $group_name ?></h2>
        <div class="d-flex gap-2 flex-wrap">
            <?php foreach ($people as $person): ?>
                <div class="d-flex flex-column justify-content-center p-2 text-center">
                    <img class="border border-dark-subtle    rounded-circle" width="200" height="200" src="<?= $person["img"] ?? "$base_url/static/img/avatar.jpg" ?>" alt="<?= $person["name"] ?>">
                    <span class="fs-4"><?= $person["name"] ?></span>
                    <span class="opacity-75"><?= $person["title"] ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endforeach; ?>

<?php require_once "../templates/footer.php" ?>