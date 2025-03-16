<?php
namespace App\Providers;

use App\Configs\Database;
use App\Models\User;
use PDO;
use PDOException;

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

    public function getUserById($id)
    {
        $query = "SELECT * FROM users WHERE id = $id";
        $stmt = $this->db->query($query);
        $userData = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        $user = new User($userData['id'], $userData['first_name'], $userData['last_name'], $userData['email'], $userData['phone'], $userData['avatar'], $userData['gender'], $userData['address']);
        return $user;
    }

    public function saveUser()
    {
        $uploadDir = "../../uploads/";

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $avatar = $_FILES['avatar']['name'];

        if (empty($firstName) || empty($lastName) || empty($email) || empty($phone) || empty($address) || empty($gender) || empty($avatar)) {
            die("Hãy nhập đầy đủ thông tin!");
        }
        $avatarPath = $uploadDir . time() . $avatar;
        $uploadDir = __DIR__ . "/" . $avatarPath;
        $avatarFileType = strtolower(pathinfo($uploadDir, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'jfif'];
        if (!in_array($avatarFileType, $allowedTypes)) {
            die("Chỉ hỗ trợ các định dạng JPG, JPEG, PNG, JFIF!");
        }
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $uploadDir)) {
            try {
                $stmt = $this->db->prepare("INSERT INTO users (first_name, last_name, email, phone, avatar, gender, address) VALUES (:first_name, :last_name, :email, :phone, :avatar, :gender, :address)");
                $stmt->bindParam(':first_name', $firstName);
                $stmt->bindParam(':last_name', $lastName);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':avatar', $avatarPath);
                $stmt->bindParam('gender', $gender);
                $stmt->bindParam('address', $address);
                $stmt->execute();

                header('Location: /');
            } catch (PDOException $e) {
                echo "Lỗi lưu database: " . $e->getMessage();
            }
        }
    }

    public function editUser($id)
    {
        $user = $this->getUserById($id);
        if (!$user) {
            die("Không tìm thấy user!");
        }

        $uploadDir = "../../uploads/";
        $firstName = $_POST['firstName'] ?? null;
        $lastName = $_POST['lastName'] ?? null;
        $email = $_POST['email'] ?? null;
        $phone = $_POST['phone'] ?? null;
        $address = $_POST['address'] ?? null;
        $gender = $_POST['gender'] ?? null;
        $avatar = $_FILES['avatar']['name'] ?? null;

        $avatarPath = __DIR__ . "/" . $user->getAvatar();

        if ($avatar) {
            $imageFileType = strtolower(pathinfo($avatar, PATHINFO_EXTENSION));
            $allowedTypes = ['jpg', 'jpeg', 'png', 'jfif'];
            if (!in_array($imageFileType, $allowedTypes)) {
                die("Chỉ hỗ trợ các định dạng JPG, JPEG, PNG, JFIF!");
            }
            $newAvatarPath = $uploadDir . time() . $avatar;
            if (file_exists($avatarPath)) {
                unlink($avatarPath);
            }
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], __DIR__ . "/" . $newAvatarPath)) {
                $avatarPath = $newAvatarPath;
            }
        }

        try {
            $stmt = $this->db->prepare("
            UPDATE users 
            SET first_name = :first_name, last_name = :last_name, email = :email, phone = :phone, avatar = :avatar, gender = :gender, address = :address
            WHERE id = $id
        ");
            $stmt->bindParam(':first_name', $firstName);
            $stmt->bindParam(':last_name', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':avatar', $avatarPath);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':address', $address);
            $stmt->execute();

            header("Location: /");
        } catch (PDOException $e) {
            echo "Lỗi lưu database: " . $e->getMessage();
        }
    }
}
?>