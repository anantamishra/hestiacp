<?php
// Init
error_reporting(NULL);
ob_start();
session_start();
include($_SERVER['DOCUMENT_ROOT']."/inc/main.php");

// Check token
if ((!isset($_GET['token'])) || ($_SESSION['token'] != $_GET['token'])) {
    header('location: /login/');
    exit();
}

if ($_SESSION['user'] == 'admin') {
    exec (HESTIA_CMD."v-add-cron-hestia-autoupdate", $output, $return_var);
    $_SESSION['error_msg'] = __('Autoupdate has been successfully enabled');
    unset($output);
}

header("Location: /list/updates/");
exit;
