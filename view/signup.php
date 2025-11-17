<?php
require '../config/db.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $referral = trim($_POST['referral']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users (username, email, phone, password, referral) VALUES (?, ?, ?, ?, ?)");

    try {
        $stmt->execute([$username, $email, $phone, $password, $referral]);
        header("Location: login.php?success=1");
        exit();
    } catch (PDOException $e) {
        $message = "Email already exists!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RewardZone - Signup</title>
<link rel="stylesheet" href="signup.css">
</head>
<body>

<div class="container">

  <div class="form-card">
    <h1 class="highlight">Create Account</h1>
    <p>Start earning instantly with RewardZone</p>

    <?php if($message): ?>
        <p style="color:red;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="tel" name="phone" placeholder="Phone Number" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="text" name="referral" placeholder="Referral Code">
      <button type="submit">Signup</button>
    </form>

    <div class="text-center">
      <p>Already have an account? <a href="login.php" class="highlight-link">Login</a></p>
    </div>

    <div class="security">
      🔒 Secure Signup — Your data is protected
    </div>
  </div>

</div>

</body>
</html>
