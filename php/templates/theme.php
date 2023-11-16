<?php require_once __DIR__ . "/../scripts/globals.php" ?>

<button class="btn" type="button" onclick="document.getElementById('theme-dialog')?.showModal()">
    <span class="position-relative">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-palette" viewBox="0 0 16 16">
            <path d="M8 5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm4 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM5.5 7a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm.5 6a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
            <path d="M16 8c0 3.15-1.866 2.585-3.567 2.07C11.42 9.763 10.465 9.473 10 10c-.603.683-.475 1.819-.351 2.92C9.826 14.495 9.996 16 8 16a8 8 0 1 1 8-8zm-8 7c.611 0 .654-.171.655-.176.078-.146.124-.464.07-1.119-.014-.168-.037-.37-.061-.591-.052-.464-.112-1.005-.118-1.462-.01-.707.083-1.61.704-2.314.369-.417.845-.578 1.272-.618.404-.038.812.026 1.16.104.343.077.702.186 1.025.284l.028.008c.346.105.658.199.953.266.653.148.904.083.991.024C14.717 9.38 15 9.161 15 8a7 7 0 1 0-7 7z"/>
        </svg>
        <span class="visually-hidden">Tema</span>
    </span>
</button>
<dialog class="border-0 rounded-4 px-4 py-0 text-bg-dark text-start position-relative" id="theme-dialog">
    <section>
        <header class="d-flex align-items-center mb-2 pt-2 sticky-top bg-dark">
            <span class="fs-4 fw-bold">Byt tema</span>
            <button class="btn ms-auto" onclick="document.getElementById('notification-dialog')?.close()" title="Close">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16" aria-hidden="true">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
                </svg>
                <span class="visually-hidden">Close</span>
            </button>
        </header>
        <form action="<?= "$base_url/api/theme.php" ?>" method="post" hx-trigger="change changed" hx-boost="false">
            <input type="hidden" name="redirect" value="<?= $_SERVER["REQUEST_URI"] ?>">
            <label class="form-label" for="theme-select">
                Tema
            </label>
            <select class="form-select" name="theme" id="theme-select">
                <?php
                $themes = [
                    "Standard" => "output.css",
                    "1" => "theme1.css",
                    "2" => "theme2.css",
                    "3" => "theme3.css",
                    "4" => "theme4.css",
                    "5" => "theme5.css",
                    "6" => "theme6.css",
                    "7" => "theme7.css",
                    "8" => "theme8.css",
                ];
                foreach ($themes as $name => $path) {
                    echo "<option value='$path'>$name</option>";
                } ?>
            </select>
            <button class="btn btn-primary">Byt tema</button>
        </form>
</dialog>