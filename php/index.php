<?php $title = "Hemsidan"; require_once "templates/header.php" ?>

<h1>Detta är förstsidan</h1>

<?php 
$articles = [
    [
        "title" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem, magnam!",
        "author" => "Testing tester",
        "date" => "2023-10-12",
        "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum maxime sapiente voluptatibus eum. Dolores, perspiciatis dolorum atque voluptatibus voluptates aliquid!",
        "content" => "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores qui architecto non sint sequi exercitationem totam nihil esse eligendi illo laborum eum ullam iste quaerat excepturi debitis ad, consequatur ratione officia itaque. Reprehenderit sed quia unde voluptate repudiandae blanditiis aliquid!</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis numquam saepe sunt sequi ullam iure molestiae ab velit, magnam, doloribus error animi possimus voluptatum hic earum! Dolores beatae sunt nobis?</p>"
    ], [
        "title" => "Adipisicing elit. Quidem",
        "author" => "Tester McTest",
        "date" => "2023-08-24",
        "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum maxime sapiente voluptatibus eum. Dolores, perspiciatis dolorum atque voluptatibus voluptates aliquid!",
        "content" => "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores qui architecto non sint sequi exercitationem totam nihil esse eligendi illo laborum eum ullam iste quaerat excepturi debitis ad, consequatur ratione officia itaque. Reprehenderit sed quia unde voluptate repudiandae blanditiis aliquid!</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis numquam saepe sunt sequi ullam iure molestiae ab velit, magnam, doloribus error animi possimus voluptatum hic earum! Dolores beatae sunt nobis?</p>"
    ], [
        "title" => "Lorem ipsum dolor sisicing elit. Quidem, magnam!",
        "author" => "Testing tester",
        "date" => "2023-05-28",
        "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum maxime sapiente voluptatibus eum. Dolores, perspiciatis dolorum atque voluptatibus voluptates aliquid!",
        "content" => "<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores qui architecto non sint sequi exercitationem totam nihil esse eligendi illo laborum eum ullam iste quaerat excepturi debitis ad, consequatur ratione officia itaque. Reprehenderit sed quia unde voluptate repudiandae blanditiis aliquid!</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis numquam saepe sunt sequi ullam iure molestiae ab velit, magnam, doloribus error animi possimus voluptatum hic earum! Dolores beatae sunt nobis?</p>"
    ]
]
?>

<section style="display: grid; gap: 1rem; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));">
    <header style="grid-column: 1 / -1;">
        <h2>Information</h2>
    </header>
    <?php foreach ($articles as $article): ?>
        <article class="rounded-4 p-4 bg-body-secondary">
            <header>
                <h3><?= $article["title"] ?></h3>
                <span class="text-secondary">
                    <time datetime="<?= $article["date"] ?>"><?= $article["date"] ?></time>
                     - 
                    <address class="author d-inline"><?= $article["author"] ?></address>
                </span>
            </header>
            <div class="mt-2">
                <?= $article["description"] ?>
            </div>
        </article>
    <?php endforeach; ?>
</section>

<?php require_once "templates/footer.php" ?>