?php
// add_user.php

session_start();

require 'functions.php';

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    addUser($username, $password);
}

header("Location: admin_dashboard.php");
exit;
?>
