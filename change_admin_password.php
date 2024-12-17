<?php
// change_admin_password.php

session_start();

require 'functions.php';

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['new_password'])) {
    $newPassword = $_POST['new_password'];
    setAdminPassword($newPassword);
}

header("Location: admin_dashboard.php");
exit;
?>
