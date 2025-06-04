<?php
session_start();
require_once '../config/database.php';
require_once '../models/User.php';

$userModel = new User($pdo);
$action = $_GET['action'] ?? '';

if ($action === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user';

    $userModel->create($username, $password, $role);
    header("Location: ../views/auth/login.php");
    exit;
}

if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = $userModel->getByUsername($username);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: ../index.php");
        exit;
    } else {
        echo "<script>alert('Login gagal!'); window.location.href='../views/auth/login.php';</script>";
    }
}

if ($action === 'logout') {
    session_destroy();
    header("Location: ../views/auth/login.php");
    exit;
}
