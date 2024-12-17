<?php
// change_user_password.php

session_start();

require 'functions.php';

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['username']) && isset($_POST['new_password'])) {
    $username = $_POST['username'];
    $newPassword = $_POST['new_password'];
    changeUserPassword($username, $newPassword);
}

header("Location: admin_dashboard.php");
exit;
