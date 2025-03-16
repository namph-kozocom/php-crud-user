<?php
namespace App\Providers;

use App\Configs\Database;
use App\Models\User;
use PDO;

class UserProvider {
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getAllUser()
    {
        $query = "SELECT * FROM users ORDER BY id DESC";
        $stmt = $this->db->query($query);
        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($userData as $user) {
            $users[] = new User($user['id'], $user['first_name'], $user['last_name'], $user['email'], $user['phone'], $user['avatar'], $user['gender'], $user['address']);
        }
        return $users;
    }
}
?>