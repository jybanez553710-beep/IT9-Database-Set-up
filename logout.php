<?php
session_start();
$_SESSION = [];
session_destroy();

$docroot = rtrim(str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']), '/');
$base = str_replace($docroot, '', str_replace('\\', '/', __DIR__));
header("Location: $base/login.php");
exit;
