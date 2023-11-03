<?php

include("Auth.php");
include("Api.php");

header('Access-Control-Allow-Origin: *');

$conn = new PDO("mysql:host=localhost;dbname=clase26;", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$auth = new Auth($conn);

$api = new Api($auth);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo json_encode($auth->registerUser($data['username'], $data['password'], $data['email']));
    header("HTTP/1.1 200 OK");
    exit();
}
