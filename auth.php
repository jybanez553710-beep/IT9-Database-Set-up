<?php
// Include at the very top of every protected page (before any output).
session_start();

$docroot = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']), '/');
$base = str_replace($docroot, '', str_replace('\\', '/', __DIR__));

if (empty($_SESSION['user_id'])) {
    header("Location: $base/login.php");
    exit;
}
?>
