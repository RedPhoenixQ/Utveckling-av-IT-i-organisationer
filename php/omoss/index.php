<?php 
$groups = [
    "Verksamhetschef och Business Controller" => [
        [
            "name" => "Anna Carlsson",
            "title" => "Verksamhetschef",
            "img" => "https://picsum.photos/200?random=10",
        ], [
            "name" => "Petter Petersson",
            "title" => "Controller",
            "img" => "https://picsum.photos/200?random=11",
        ],
    ],
    "Läkare" => [
        [
            "name" => "Ingrid-Marie Svensson",
            "title" => "Specialist i allmänmedicin",
            "img" => "https://picsum.photos/200?random=20",
        ], [
            "name" => "Janne Petersson",
            "title" => "Specialist i internmedicin",
            "img" => "https://picsum.photos/200?random=21",
        ], [
            "name" => "Julia Isias",
            "title" => "Specialist i allmänmedicin och medicinskt ledningsansvarig läkare",
            "img" => "https://picsum.photos/200?random=22",
        ], [
            "name" => "Karl Svensson",
            "title" => "Leg. läkare",
            "img" => "https://picsum.photos/200?random=23",
        ], [
            "name" => "Philip Ka",
            "title" => "Leg. läkare",
            "img" => "https://picsum.photos/200?random=24",
        ],
    ],
    "Sjuksköterskor" => [
        [
            "name" => "Beata Brax",
            "title" => "Distriktssköterska och chefssjuksköterska",
            "img" => "https://picsum.photos/200?random=30",
        ], [
            "name" => "Linda Mark",
            "title" => "Distriktssköterska",
            "img" => "https://picsum.photos/200?random=31",
        ], [
            "name" => "Amadeus Borges",
            "title" => "Sjuksköterska och Mottagningssköterska",
            "img" => "https://picsum.photos/200?random=32",
        ], [
            "name" => "Marcus Bengtsson",
            "title" => "Sjuksköterska och Mottagningssköterska",
            "img" => "https://picsum.photos/200?random=33",
        ],
    ],
    "Administrativ personal" => [
        [
            "name" => "Karin Petersson",
            "title" => "Medicinsk sekreterare",
            "img" => "https://picsum.photos/200?random=40",
        ], [
            "name" => "Karl Olsson",
            "title" => "Medicinsk sekreterare",
            "img" => "https://picsum.photos/200?random=41",
        ], [
            "name" => "Jening Fehram",
            "title" => "Medicinsk sekreterare",
            "img" => "https://picsum.photos/200?random=42",
        ],
    ],
    "Psykosocial mottagning" => [
        [
            "name" => "Mona Grealt",
            "title" => "Kurator",
            "img" => "https://picsum.photos/200?random=50",
        ], [
            "name" => "Agust Persson",
            "title" => "Kurator",
            "img" => "https://picsum.photos/200?random=51",
        ],
    ],
    "Fysioterapi och Dietist" => [
        [
            "name" => "Christian Eliasson",
            "title" => "Fysioterapeut",
            "img" => "https://picsum.photos/200?random=60",
        ], [
            "name" => "Roberto Absaruda",
            "title" => "Dietis",
            "img" => "https://picsum.photos/200?random=61",
        ],
    ],
];
?>

<?php $title = "Om oss"; require_once "../templates/header.php" ?>

<h1>Om oss</h1>
<?php foreach ($groups as $group_name => $people): ?>
    <section class="m-5">
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