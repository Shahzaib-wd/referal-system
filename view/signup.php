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

  <!-- Signup Form -->
  <div class="form-card">
    <h1 class="highlight">Create Account</h1>
    <p>Start earning instantly with RewardZone</p>

<!-- rename signup.html to signup.php -->
<form action="signup_process.php" method="POST">
  <input type="text" name="username" placeholder="Username" required>
  <input type="email" name="email" placeholder="Email" required>
  <input type="tel" name="phone" placeholder="Phone Number" required>
  <input type="password" name="password" placeholder="Password" required>
  <input type="text" name="referral" placeholder="Referral Code">
  <button type="submit">Signup</button>
</form>


    <div class="text-center">
      <p>Already have an account? <a href="login.html" class="highlight-link">Login</a></p>
    </div>

    <div class="security">
      🔒 Secure Signup — Your data is protected
    </div>
  </div>

</div>

</body>
</html>
