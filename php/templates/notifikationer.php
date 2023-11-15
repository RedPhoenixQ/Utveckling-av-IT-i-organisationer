<?php
require_once __DIR__ ."/../scripts/erp.php";
$erp_notification = new Erp("Gr3 Notification");
$erp_notification->fields = ["name", "title", "description", "related_type", "related_name", "seen", "creation"];
$erp_notification->limit_page_length = 5;
$erp_notification->add_filter(["Gr3 Notification", "seen", "=", "false"]);
$notifications = $erp_notification->list()["data"];
?>

<button class="btn" type="button" onclick="document.getElementById('notification-dialog')?.showModal()">
    <span class="position-relative">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16" aria-hidden="true">
            <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
        </svg>
        <?php if (!empty($notifications)): ?>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?= count($notifications) ?></span>
        <?php endif ?>
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
                <?php if (!$notification["seen"]) {
                    $unread = '<span class="text-primary"><span class="visually-hidden">Oläst.</span>
                    ●</span>';
                }
                switch ($notification["related_type"]) {
                    case "Patient Appointment":
                        // Link to appointment site when availible
                    break;
                    default:
                    $link_to_related = "$base_url/minasidor/journal/" . rawurlencode($notification["related_type"]). "/?name=" . rawurlencode($notification["related_name"]);
                    break;
                }
                ?>
                <li class="list-group-item <?php if (!empty($link_to_related)) {
                    echo "list-group-item-action"; } ?> position-relative">
                    <?php if (isset($link_to_related)): ?>
                        <a class="stretched-link" href="<?=$link_to_related?>">
                            <span class="visually-hidden">Notifikationsdetaljer</span>
                        </a>
                    <?php endif ?>
                    <small>
                        <?= $unread ?? "" ?>
                        <span><?= $notification["related_type"] ?></span>
                        -
                        <time datetime="<?= $notification["creation"] ?>"><?= date("Y/m/d H:i", (new DateTime($notification["creation"]))->getTimestamp()) ?></time>
                    </small>
                    <div class="fs-5 fw-bold"><?= $notification["title"] ?></div>
                    <small><?= $notification["description"] ?></small>
                </li>
            <?php endforeach ?>
        </ul>
    </main>
    <footer class="mt-2">
        <a href="<?= "$base_url/minasidor/notification/" ?>">Alla notifikationer</a>
    </footer>
</dialog>