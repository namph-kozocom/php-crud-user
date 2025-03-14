<?php

namespace App\Controllers;

class UserController {
    public function __construct() {

    }

    public function index() {
        include __DIR__ . '/../views/index.php';
    }
}

?>