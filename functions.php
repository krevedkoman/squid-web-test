<?php
// functions.php

define('ADMIN_PASSWORD_FILE', '/etc/squid/admin_password');
define('SQUID_USERS_FILE', '/etc/squid/passwd');
define('HTPASSWD_CMD', '/usr/bin/htpasswd');

function isAdminPasswordSet() {
    return file_exists(ADMIN_PASSWORD_FILE);
}

function checkAdminPassword($password) {
    $storedHash = trim(file_get_contents(ADMIN_PASSWORD_FILE));
    return password_verify($password, $storedHash);
}

function setAdminPassword($password) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    file_put_contents(ADMIN_PASSWORD_FILE, $hash);
}

function addUser($username, $password) {
    exec(HTPASSWD_CMD . " -b " . SQUID_USERS_FILE . " " . escapeshellarg($username) . " " . escapeshellarg($password));
}

function deleteUser($username) {
    exec(HTPASSWD_CMD . " -D " . SQUID_USERS_FILE . " " . escapeshellarg($username));
}

function getAllUsers() {
    $users = [];
    if (file_exists(SQUID_USERS_FILE)) {
        $lines = file(SQUID_USERS_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            list($user, ) = explode(':', $line, 2);
            $users[] = $user;
        }
    }
    return $users;
}

function changeUserPassword($username, $newPassword) {
    exec(HTPASSWD_CMD . " -b " . SQUID_USERS_FILE . " " . escapeshellarg($username) . " " . escapeshellarg($newPassword));
}
?>
