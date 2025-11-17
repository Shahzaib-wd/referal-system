<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RewardZone - Wallet</title>
<!-- Google Fonts & Font Awesome -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="wallet.css">
</head>
<body>

        <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-gift brand-icon"></i>
                <span class="brand-text">RewardZone</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="earn.html">Earn now</a></li>
                    <li class="nav-item"><a class="nav-link" href="wallet.html">Wallet</a></li>
                    <li class="nav-item"><a class="nav-link btn-login" href="login.html">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

<div class="main-content">
    <div class="topbar">
        <h1>My Wallet</h1>
        <div class="user-info">
            <span>Alpha</span>
            <img src="https://i.pravatar.cc/40" alt="user">
        </div>
    </div>

    <div class="cards">
        <div class="card wallet-card">
            <i class="fa-solid fa-wallet"></i>
            <h3>Wallet Balance</h3>
            <p>120 PKR</p>
        </div>
        <div class="card points-card">
            <i class="fa-solid fa-star"></i>
            <h3>Points</h3>
            <p>450</p>
        </div>
        <div class="card referrals-card">
            <i class="fa-solid fa-users"></i>
            <h3>Referrals</h3>
            <p>12</p>
        </div>
        <div class="card level-card">
            <i class="fa-solid fa-level-up-alt"></i>
            <h3>Level</h3>
            <p>5</p>
            <div class="progress-container">
                <div class="progress-bar">
                    <div class="progress-fill">70%</div>
                </div>
            </div>
        </div>
    </div>

    <div class="referral-panel">
        <h3>Invite Friends</h3>
        <div class="referral-input">
            <input type="text" value="https://alphaclub.com/referral/123" readonly>
            <button onclick="copyReferral()">Copy</button>
        </div>
    </div>
</div>

<script>
function copyReferral(){
    const input = document.querySelector('.referral-panel input');
    input.select();
    document.execCommand('copy');
    alert('Referral link copied!');
}
</script>

</body>
</html>
