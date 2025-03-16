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
}
?>