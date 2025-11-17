<?php
require '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $token = $_POST['token'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $db->prepare("SELECT * FROM users WHERE reset_token=? AND token_expiry > NOW()");
    $stmt->execute([$token]);

    if ($stmt->rowCount() === 1) {
        $update = $db->prepare("UPDATE users 
                                SET password=?, reset_token=NULL, token_expiry=NULL 
                                WHERE reset_token=?");
        $update->execute([$password, $token]);

        header("Location: ../login.php?reset=success");
        exit();
    } else {
        header("Location: ../reset_form.php?error=invalid");
        exit();
    }
}
?>
