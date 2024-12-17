<?php
// delete_user.php

session_start();

require 'functions.php';

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    deleteUser($username);
}

header("Location: admin_dashboard.php");
exit;
?>
