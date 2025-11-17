<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RewardZone - Earnings</title>
<!-- Google Fonts & Font Awesome -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Root Colors */
    :root {
        --primary-yellow: #ffc107;
        --neon-blue: #00d4ff;
        --neon-purple: #b537f2;
        --dark-bg: #0f0f1e;
        --dark-card: #1a1a2e;
        --text-light: #ffffff;
        --text-muted: #aaaaaa;
    }

    body {
        font-family: 'Roboto', sans-serif;
        background-color: var(--dark-bg);
        color: var(--text-light);
        margin: 0;
        padding: 0;
    }

    .container {
        width: 90%;
        max-width: 1200px;
        margin: auto;
        padding: 20px 0;
    }

    h1, h2, h3 {
        margin-bottom: 10px;
    }

    .section {
        margin-bottom: 40px;
    }

    /* Cards */
    .card {
        background-color: var(--dark-card);
        border-radius: 12px;
        padding: 20px;
        margin: 10px 0;
        box-shadow: 0 4px 15px rgba(0,0,0,0.5);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.7);
    }

    /* Referral Stats */
    .stats {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .stat-card {
        flex: 1 1 200px;
        text-align: center;
        padding: 25px 15px;
    }

    .stat-card i {
        font-size: 40px;
        color: var(--primary-yellow);
        margin-bottom: 10px;
    }

    .stat-card h3 {
        font-size: 28px;
        margin-bottom: 5px;
    }

    .stat-card p {
        color: var(--text-muted);
        font-size: 16px;
    }

    /* Tasks & Spins */
    .tasks, .spins {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .task-card, .spin-card {
        flex: 1 1 250px;
        background-color: #2a2a45;
        padding: 20px;
        border-radius: 12px;
        transition: 0.3s;
        cursor: pointer;
    }

    .task-card:hover, .spin-card:hover {
        background-color: #3b3b6e;
        transform: scale(1.05);
    }

    .task-card h4, .spin-card h4 {
        margin-bottom: 10px;
        color: var(--neon-blue);
    }

    .btn-redeem {
        display: inline-block;
        padding: 10px 20px;
        margin-top: 10px;
        border-radius: 8px;
        background: var(--primary-yellow);
        color: #000;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-redeem:hover {
        background: var(--neon-blue);
        color: #fff;
    }

    @media(max-width:768px){
        .stats, .tasks, .spins {
            flex-direction: column;
        }
    }
</style>
</head>
<body>

<div class="container">
    <h1>Welcome to Your Earnings Dashboard</h1>
    <p style="color:var(--text-muted)">Track your progress, complete tasks, spin for rewards, and earn more!</p>

    <!-- Referral Stats -->
    <div class="section">
        <h2>Referral Stats</h2>
        <div class="stats">
            <div class="stat-card">
                <i class="fa-solid fa-user-plus"></i>
                <h3 id="referrals">12</h3>
                <p>Total Referrals</p>
            </div>
            <div class="stat-card">
                <i class="fa-solid fa-coins"></i>
                <h3 id="earned">$150</h3>
                <p>Total Earnings</p>
            </div>
            <div class="stat-card">
                <i class="fa-solid fa-gift"></i>
                <h3 id="pending">$40</h3>
                <p>Pending Rewards</p>
            </div>
        </div>
    </div>

    <!-- Tasks -->
    <div class="section">
        <h2>Complete Tasks</h2>
        <div class="tasks">
            <div class="task-card">
                <h4>Share Referral Link</h4>
                <p>Share your unique link on social media to earn $5 per signup.</p>
                <div class="btn-redeem">Do Task</div>
            </div>
            <div class="task-card">
                <h4>Invite Friends</h4>
                <p>Invite 5 friends to unlock a $20 bonus.</p>
                <div class="btn-redeem">Do Task</div>
            </div>
            <div class="task-card">
                <h4>Daily Check-in</h4>
                <p>Check in daily to earn random rewards and boost your streak.</p>
                <div class="btn-redeem">Check In</div>
            </div>
        </div>
    </div>

    <!-- Spin Rewards -->
    <div class="section">
        <h2>Spin & Earn</h2>
        <div class="spins">
            <div class="spin-card">
                <h4>Daily Spin</h4>
                <p>Spin the wheel for a chance to win coins, bonuses, or gift cards!</p>
                <div class="btn-redeem">Spin Now</div>
            </div>
            <div class="spin-card">
                <h4>Lucky Wheel</h4>
                <p>Special weekly spins with bigger rewards.</p>
                <div class="btn-redeem">Try Luck</div>
            </div>
        </div>
    </div>
</div>

<script>
    // Example dynamic updates
    let referrals = 12;
    let earned = 150;
    let pending = 40;

    // This is where you can connect to backend to fetch real data
    document.getElementById('referrals').innerText = referrals;
    document.getElementById('earned').innerText = "$" + earned;
    document.getElementById('pending').innerText = "$" + pending;
</script>

</body>
</html>
