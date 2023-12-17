<?php $title = "Hemsidan"; require_once "templates/header.php" ?>

<h1>Välkommen till Mölndals Vårdcentral</h1>

<?php 
$articles = [
    [
        "title" => "Hög tid att vaccinera sig!",
        "author" => "Karin Petersson",
        "date" => "2023-12-05",
        "description" => "Nu finns det tider att boka på vaccinationsmottagningen i Mölndals vårdcentral. Våra duktiga sjuksköterskor ansvarar för vaccinationen och kommer ta väl hand om dig!",
        "content" => "<p>Nu är det hög tid att vaccinera sig mot covid-19 och influensa för att hinna skydda sig inför alla helger och firanden i December. Det är extra viktigt att skydda sig om du tillhör en medicinsk riskgrupp som inkluderar personer över 65, gravida och människor med vissa kroniska sjukdomar som hjärt-eller lungsjukdom. Personer som tillhör en medicinsk riskgrupp är mer sårbara för smittorna, särskilt med tanke på att smittspridningen av covid-19 och influensan har varit hög de senaste veckorna. Eftersom det tar två veckor att få skydd av vaccinationerna är det hög tid att vaccinera sig nu, säger Ingrid-Marie Svensson, specialist läkare.</p>"
    ], [
        "title" => "Nu kan du boka videosamtal!",
        "author" => "Karl Olsson",
        "date" => "2023-12-02",
        "description" => "Det efterlängtade alternativet till fysiska vårdbesök, nämligen videosamtal, är nu tillgängligt på Mölndals vårdcentral. Från den 1 december 2023 kan våra patienter välja mellan att boka ett fysiskt vårdbesök där de kommer till vårdcentralen eller ett digitalt vårdbesök via videosamtal. Detta underlättar för fler av våra patienter med ångestproblematik som känner sig mest bekväma med digitala möten. Det är en självklarhet för oss på vårdcentralen att göra det så bekvämt som möjligt för våra patienter då alla har rätt till vård oavsett i vilken form.",
        "content" => "<p>Det efterlängtade alternativet till fysiska vårdbesök, nämligen videosamtal, är nu tillgängligt på Mölndals vårdcentral. Från den 1 december 2023 kan våra patienter välja mellan att boka ett fysiskt vårdbesök där de kommer till vårdcentralen eller ett digitalt vårdbesök via videosamtal. Detta underlättar för fler av våra patienter med ångestproblematik som känner sig mest bekväma med digitala möten. Det är en självklarhet för oss på vårdcentralen att göra det så bekvämt som möjligt för våra patienter då alla har rätt till vård oavsett i vilken form.</p>"
    ], [
        "title" => "Störningar i journalsystem för Mölndals vårdcentral",
        "author" => "Anna Carlsson",
        "date" => "2023-11-30",
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