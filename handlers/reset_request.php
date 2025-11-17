<?php
require '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);

    $token = bin2hex(random_bytes(32));
    $expiry = date("Y-m-d H:i:s", time() + 3600); // 1 hour

    $stmt = $db->prepare("UPDATE users SET reset_token=?, token_expiry=? WHERE email=?");
    $stmt->execute([$token, $expiry, $email]);

    $resetLink = "http://localhost/project/views/reset_form.php?token=$token";

    mail($email, "Password Reset", "Use this link: $resetLink");

    header("Location: ../reset.php?sent=1");
    exit();
}
?>
