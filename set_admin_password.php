<?php
// set_admin_password.php

session_start();

require 'functions.php';

if (isAdminPasswordSet()) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['set_password'])) {
    $password = $_POST['password'];
    if (!empty($password)) {
        setAdminPassword($password);
        header("Location: index.php");
        exit;
    } else {
        $error = "Пароль не может быть пустым!";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Установка пароля администратора</title>
</head>
<body>
    <h2>Установите пароль для администратора</h2>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post">
        Пароль: <input type="password" name="password"><br><br>
        <button type="submit" name="set_password">Установить пароль</button>
    </form>
</body>
</html>
