<?php
class Auth
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function registerUser($username, $password, $email)
    {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE username = '$username'");
        $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($arr) > 0) {
            return array("message" => "El nombre de usuario ya está en uso.");
        }

        $token = bin2hex(random_bytes(16));
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $datetime = new DateTime();
        $date = $datetime->format('Y-m-d H:i:s');
        $pdo = $this->conn->prepare("INSERT INTO users (username, pass, email, token, created_at, updated_at) VALUES ('$username', '$hashed_password', '$email', '$token', '$date', '$date')");
        if ($pdo->execute()) {
            return array("message" => "Usuario creado con exito");
        } else {
            return array("message" => "Error");
        }
    }

    public function authenticateUser($username, $password)
    {
        $stmt = $this->conn->prepare("SELECT id, pass, token FROM users WHERE username = '$username'");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) == 1 && password_verify($password, $result[0]['pass'])) {
            return $result[0]['token'];
        } else {
            return null;
        }
    }
}
