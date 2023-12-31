<? require_once __DIR__ . "/../scripts/globals.php" ?>

    </main>
    <footer class="d-flex flex-wrap py-2 px-4 bg-dark-subtle">
        <nav class="flex-fill">
            <a class="fw-bold mb-2 text-reset" href="<?= "$base_url/omoss" ?>">Om oss</a>
            <div class="fw-bold">Testing</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url."/test/erp.php" ?>">Erp test</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base_url."/test/users.php" ?>">Users list</a>
                </li>
            </ul>
        </nav>
        <div class="flex-fill">
            <div class="fw-bold">Kontakta oss</div>
            <address class="ps-4">
                Mölndals vårdcentral<br/>
                Göteborgsvägen XX<br/>
                431 82 Mölndal<br/>
                <a href="mailto:info@molddalsvardcentral.se">info@molddalsvardcentral.se</a><br/>
                <a href="tel:+46310000000">031-000 00 00</a>
            </address>
        </div>
        <div class="flex-fill">
            <div class="fw-bold">Öppettider</div>
            <ul class="list-unstyled ps-4">
                <li>Måndag: <time datetime="08:00">8</time>-<time datetime="20:00">20</li>
                <li>Tisdag: <time datetime="08:00">8</time>-<time datetime="20:00">20</li>
                <li>Onsdag: <time datetime="08:00">8</time>-<time datetime="20:00">20</li>
                <li>Torsdag: <time datetime="08:00">8</time>-<time datetime="20:00">20</li>
                <li>Fredag: <time datetime="08:00">8</time>-<time datetime="20:00">20</li>
                <li>Lördag: stängt</li>
                <li>Söndag: stängt</li>
            </ul>
        </div>
    </footer>
</body>
</html>