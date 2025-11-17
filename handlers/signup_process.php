<?php
require '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $referral = trim($_POST['referral']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users (username, email, phone, password, referral) 
                          VALUES (?, ?, ?, ?, ?)");

    try {
        $stmt->execute([$username, $email, $phone, $password, $referral]);
        header("Location: ../login.php?success=1");
        exit();
    } catch (PDOException $e) {
        header("Location: ../signup.php?error=EmailAlreadyExists");
        exit();
    }
}
?>
