<?php
session_start();
require '../config/db.php';

// Prevent browser caching (back button fix)
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

$message = '';

// If user is already logged in, redirect to homepage
if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// Login processing
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        header("Location: ../index.php");
        exit();
    } else {
        $message = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RewardZone - Secure Login</title>
<link rel="stylesheet" href="login.css">
</head>
<body>

<div class="container">

  <div class="form-card">
    <h1 class="highlight">Login</h1>
    <p>Access your account to start creating & earning</p>

    <?php if($message): ?>
        <p style="color:red;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <div class="divider"><span>or</span></div>

    <button onclick="window.location.href='signup.php'">Create Account</button>

    <div class="text-center">
        <p>Forgot password? <a href="reset.php" class="highlight-link">Reset</a></p>
    </div>

    <div class="security">
      🔒 Secure Login — Your data is protected
    </div>
  </div>

</div>

</body>
</html>
