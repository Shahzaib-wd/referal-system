<?php
session_start();
require '../config/db.php';

date_default_timezone_set('Asia/Karachi'); // timezone sync

$message = '';
$showForm = 'request'; // default form
$token = '';

// ----- RESET REQUEST -----
if (isset($_POST['email'])) {
    $email = trim($_POST['email']);

    // check if email exists
    $stmt = $db->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() === 0) {
        $message = "Email not found!";
    } else {
        $token = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", time() + 3600); // 1 hour

        // store token in DB
        $stmt = $db->prepare("UPDATE users SET reset_token=?, token_expiry=? WHERE email=?");
        $stmt->execute([$token, $expiry, $email]);

        // DEBUG: check if update worked
        if($stmt->rowCount() > 0){
            $message = "Reset link generated! Token stored in DB.";
        } else {
            $message = "Token update failed! Check email input.";
        }

        $resetLink = "http://localhost/website/view/reset.php?token=$token";

        // ----- LOCAL TESTING LOG -----
        $logDir = "../logs";
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }
        file_put_contents("$logDir/reset_links.txt", $email . " -> " . $resetLink . PHP_EOL, FILE_APPEND);

        // show link for testing
        $message .= "<br>Reset link (for testing): <a href='$resetLink'>$resetLink</a>";

        $showForm = 'reset';
    }
}

// ----- RESET PASSWORD -----
if (isset($_POST['token']) && isset($_POST['password'])) {
    $token = $_POST['token'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // check token validity + expiry
    $stmt = $db->prepare("SELECT * FROM users WHERE reset_token=? AND token_expiry > NOW()");
    $stmt->execute([$token]);

    if ($stmt->rowCount() === 1) {
        $update = $db->prepare("UPDATE users 
                                SET password=?, reset_token=NULL, token_expiry=NULL 
                                WHERE reset_token=?");
        $update->execute([$password, $token]);

        $message = "Password has been reset successfully! You can now <a href='login.php'>login</a>.";
        $showForm = 'request';
    } else {
        $message = "Invalid or expired token!";
        $showForm = 'request';
    }
}

// ----- DETERMINE FORM -----
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    if(!empty($token)){
        $showForm = 'reset';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RewardZone - Reset Password</title>
<link rel="stylesheet" href="reset.css">
</head>
<body>

<div class="container">
  <div class="form-card">
    <h1 class="highlight">
        <?php echo $showForm === 'request' ? 'Forget Password' : 'Reset Password'; ?>
    </h1>

    <?php if($message): ?>
        <p style="color:red;"><?php echo $message; ?></p>
    <?php endif; ?>

    <?php if($showForm === 'request'): ?>
        <p>Enter your email to receive a reset link</p>
        <form action="" method="POST">
            <input type="email" name="email" placeholder="Registered Email" required>
            <button type="submit">Send Reset Link</button>
        </form>
    <?php else: ?>
        <p>Enter your new password</p>
        <form action="" method="POST">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
            <input type="password" name="password" placeholder="New Password" required>
            <button type="submit">Reset Password</button>
        </form>
        <p style="font-size:0.9em; color:gray;">(Token valid for 1 hour)</p>
    <?php endif; ?>

    <div class="text-center">
        <p>Remembered your password? <a href="login.php" class="highlight-link">Login</a></p>
    </div>

    <div class="security">
        🔒 Secure process — Your email is protected
    </div>
  </div>
</div>

</body>
</html>
