<?php 
    $notifications = [
        ["name" => "NOT-123-001", "read" => true, "date" => time(),"content"=> "This is a test message for you", "category" => "Lab Test"],
        ["name" => "NOT-123-002", "read" => false, "date" => time() - 7*24*60*60,"content"=> "En ny bokning har skapats den 2023-05-03", "category" => "Encounter"],
    ]
?>

<button class="btn" type="button" onclick="document.getElementById('notification-dialog')?.showModal()">
    <span class="position-relative">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16" aria-hidden="true">
            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
        </svg>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?= count($notifications) ?></span>
        <span class="visually-hidden">Notifikationer</span>
    </span>
</button>
<dialog class="border-0 rounded-4 text-bg-dark text-start position-relative" id="notification-dialog">
    <header class="d-flex align-items-center mb-2 sticky-top bg-dark">
        <span>Notifikationer</span>
        <button class="btn ms-auto" onclick="document.getElementById('notification-dialog')?.close()" title="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16" aria-hidden="true">
                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
            </svg>
            <span class="visually-hidden">Close</span>
        </button>
    </header>
    <main>
        <ul class="list-group">
            <?php foreach( $notifications as $notification ): ?>
                <?php if (!$notification["read"]) {
                    $unread = '<span class="text-primary"><span class="visually-hidden">Oläst.</span>
                    ●</span>';
                } ?>
                <li class="list-group-item list-group-item-action position-relative">
                    <a class="stretched-link" href="<?=$base_url."/minasidor/notifikationer?name=".rawurlencode($notification["name"])?>">
                        <span class="visually-hidden">Notifikationsdetaljer</span>
                    </a>
                    <small>
                        <?= $unread ?? "" ?>
                        <span><?= $notification["category"] ?></span>
                        -
                        <time datetime="<?= date("c", $notification["date"]) ?>"><?= date("Y/m/d H:i",$notification["date"]) ?></time>
                    </small>
                    <div><?= $notification["content"] ?></div>
                </li>
            <?php endforeach ?>
        </ul>
    </main>
    <footer class="mt-2">
        <a href="<?= "$base_url/minasidor/notification/" ?>">Alla notifikationer</a>
    </footer>
</dialog>