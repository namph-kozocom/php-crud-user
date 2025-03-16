<?php

namespace App\Controllers;

use App\Providers\UserProvider;

class UserController {
    private $userProvider;

    public function __construct()
    {
        $this->userProvider = new UserProvider();
    }

    public function index() {
        $users = $this->userProvider->getAllUser();
        include __DIR__ . '/../views/index.php';
    }

    public function showAddUser()
    {
        include __DIR__ . '/../views/addUser.php';
    }

    public function saveUser()
    {
        $this->userProvider->saveUser();
    }

    public function showEditUser($id)
    {
        $user = $this->userProvider->getUserById($id);
        include __DIR__ . '/../views/editUser.php';
    }

    public function editUser($id)
    {
        $this->userProvider->editUser($id);
    }

    public function deleteUser($id)
    {
        $this->userProvider->deleteUser($id);
    }
}

?>