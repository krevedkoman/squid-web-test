<?php
// index.php

session_start();

require 'functions.php';

if (!isAdminPasswordSet()) {
    header("Location: set_admin_password.php");
    exit;
}

if (isset($_POST['login'])) {
    $password = $_POST['password'];
    if (checkAdminPassword($password)) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Неправильный пароль!";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход в систему</title>
</head>
<body>
    <h2>Вход в систему администратора</h2>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post">
        Пароль: <input type="password" name="password"><br><br>
        <button type="submit" name="login">Войти</button>
    </form>
</body>
</html>
