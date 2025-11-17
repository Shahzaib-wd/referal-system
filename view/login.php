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

  <!-- Right Side: Login Form -->
  <div class="form-card">
    <h1 class="highlight">Login</h1>
    <p>Access your account to start creating & earning</p>

<form action="login_process.php" method="POST">
  <input type="email" name="email" placeholder="Email" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit">Login</button>
</form>


    <div class="divider"><span>or</span></div>

    <button onclick="window.location.href='signup.php'">Create Account</button>
    <div class="text-center">
      <p>Forgot password? <a href="/reset.php" class="highlight-link">Reset</a></p>
    </div>

    <div class="security">
      🔒 Secure Login — Your data is protected
    </div>
  </div>

</div>

</body>
</html>
