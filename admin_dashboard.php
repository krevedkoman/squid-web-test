<?php
// admin_dashboard.php

session_start();

require 'functions.php';

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: index.php");
    exit;
}

$users = getAllUsers();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора</title>
</head>
<body>
    <h2>Панель администратора</h2>
    <a href="logout.php">Выйти</a><br><br>

    <form method="post" action="add_user.php">
        Добавить пользователя:<br>
        Логин: <input type="text" name="username"><br>
        Пароль: <input type="password" name="password"><br><br>
        <button type="submit">Добавить</button>
    </form>

    <h3>Список пользователей:</h3>
    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                <?php echo htmlspecialchars($user); ?>
                <a href="delete_user.php?username=<?php echo urlencode($user); ?>">Удалить</a>
                <form method="post" action="change_user_password.php" style="display:inline;">
                    Новый пароль: <input type="password" name="new_password">
                    <input type="hidden" name="username" value="<?php echo htmlspecialchars($user); ?>">
                    <button type="submit">Изменить пароль</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <form method="post" action="change_admin_password.php">
        Изменить пароль администратора:<br>
        Новый пароль: <input type="password" name="new_password"><br><br>
        <button type="submit">Изменить пароль</button>
    </form>
</body>
</html>
