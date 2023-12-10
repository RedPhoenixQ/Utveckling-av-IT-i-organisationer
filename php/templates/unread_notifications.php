<?php 
require_once __DIR__ . "/../scripts/globals.php";
require_once __DIR__ . "/../scripts/erp.php";
// Could return "error" instead of "unseen"
$unseen_amount = Erp::method(Method::UNSEEN_NOTIFICATIONS, ["patient" => $_SESSION[Session::NAME]])["unseen"];
if ($unseen_amount > 0): ?>
    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
    hx-trigger="unread_notifications from:body delay:1s"
    hx-target="this"
    hx-swap="outerHTML"
    hx-get="<?= "$base_url/templates/unread_notifications.php" ?>"
    >
        <?= $unseen_amount ?>
    </span>
<?php endif ?>