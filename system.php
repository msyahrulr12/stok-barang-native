<?php

include_once __DIR__.'/config/db.php';
include_once __DIR__.'/function.php';

$uri = $_SERVER['REQUEST_URI'];

$showDashboardLink = true;

if (strstr($uri, "dashboard") != false) {
    $showDashboardLink = false;
} else if (strstr($uri, "login") != false) {
    $showDashboardLink = false;
} else {
    $showDashboardLink = true;
}

?>

<?php if ($showDashboardLink): ?>
    <a href="../dashboard.php" id="link-dashboard">Dashboard</a>
<?php endif ?>