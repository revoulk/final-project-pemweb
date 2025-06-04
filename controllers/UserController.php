<?php
require_once '../config/database.php';
require_once '../models/User.php';

$userModel = new User($pdo);

$action = $_GET['action'] ?? 'list';

if ($action == 'list') {
    $users = $userModel->getAll();
    include '../views/admin/user-list.php';

} elseif ($action == 'create') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $userModel->create($username, $password, $role);
        header('Location: UserController.php?action=list');
        exit;
    }
    include '../views/admin/user-create.php';

} elseif ($action == 'edit') {
    $id = $_GET['id'];
    $user = $userModel->getById($id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];  // kosongkan kalau tidak ingin update password
        $role = $_POST['role'];

        $userModel->update($id, $username, $password, $role);
        header('Location: UserController.php?action=list');
        exit;
    }
    include '../views/admin/user-edit.php';

} elseif ($action == 'delete') {
    $id = $_GET['id'];
    $userModel->delete($id);
    header('Location: UserController.php?action=list');
    exit;
}