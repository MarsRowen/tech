<?php
// includes/auth.php

require_once __DIR__ . '/../config.php';

function require_login() {
    if (empty($_SESSION['user'])) {
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }
}

function current_user() {
    return $_SESSION['user'] ?? null;
}

function login_user($email, $password) {
    $db = get_db();
    $stmt = $db->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password'])) {
        // Do not store password in session
        unset($user['password']);
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}

function logout_user() {
    session_unset();
    session_destroy();
}
