<?php 
$groups = [
    "Verksamhetschef och Business Controller" => [
        [
            "name" => "Anna Carlsson",
            "title" => "Verksamhetschef",
            "img" => null,
        ], [
            "name" => "Petter Petersson",
            "title" => "Controller",
            "img" => null,
        ]
    ],
    "Läkare" => [
        [
            "name" => "Ingrid-Marie Svensson",
            "title" => "Specialist i allmänmedicin",
            "img" => null,
        ], [
            "name" => "Philip Ka",
            "title" => "Leg. läkare",
            "img" => null,
        ]
    ],
    "Sjuksköterskor" => [
        [
            "name" => "Beata Brax",
            "title" => "Distriktssköterska och chefssjuksköterska",
            "img" => null,
        ], [
            "name" => "Linda Mark",
            "title" => "Distriktssköterska",
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
        <div class="d-flex gap-4 flex-wrap">
            <?php foreach ($people as $person): ?>
                <div class="d-flex flex-column align-items-center p-2 text-center" style="max-width: 200px;">
                    <img class="border border-dark-subtle rounded-circle" width="200" height="200" src="<?= $person["img"] ?? "$base_url/static/img/avatar.jpg" ?>" alt="<?= $person["name"] ?>">
                    <span class="fs-4"><?= $person["name"] ?></span>
                    <span class="opacity-75"><?= $person["title"] ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endforeach; ?>

<?php require_once "../templates/footer.php" ?>