<?php
// Navigation: base path is worked out from this file's location,
// so links work whatever the project folder is called.
$docroot = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']), '/');
$base = str_replace($docroot, '', str_replace('\\', '/', __DIR__));
?>

<div class="nav">
    <a href="<?php echo $base; ?>/index.php">🏠 Dashboard</a>
    <a href="<?php echo $base; ?>/pages/clients_list.php">💕 Clients</a>
    <a href="<?php echo $base; ?>/pages/services_list.php">🛠️ Services</a>
    <a href="<?php echo $base; ?>/pages/bookings_list.php">📅 Bookings</a>
    <a href="<?php echo $base; ?>/pages/tools_list_assign.php">🧰 Tools</a>
    <a href="<?php echo $base; ?>/pages/payments_list.php">💰 Payments</a>
    <a class="logout" href="<?php echo $base; ?>/logout.php">👋 Logout</a>
</div>

