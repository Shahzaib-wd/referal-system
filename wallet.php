<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Wallet - RewardZone</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --bg-1: #0f0f1e;
      --glass: rgba(255,255,255,0.04);
      --glass-2: rgba(255,255,255,0.03);
      --accent-from: #7c4dff;
      --accent-to: #ad00ff;
      --muted: rgba(255,255,255,0.7);
      --card-shadow: 0 6px 20px rgba(14,10,30,0.6);
      font-family: 'Poppins', system-ui;
    }

    *{box-sizing:border-box;margin:0;padding:0}
    body{background:linear-gradient(180deg,var(--bg-1), #0f0f1e);color:#eef;min-height:100vh;padding:20px}

    .wrap{max-width:400px;margin:auto;display:flex;flex-direction:column;gap:20px}

    /* LEFT PANEL */
    .panel{background:var(--glass);backdrop-filter:blur(8px);border-radius:16px;padding:18px;box-shadow:var(--card-shadow)}
    .profile{display:flex;gap:14px;align-items:center}
    .avatar{width:70px;height:70px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:28px;background:linear-gradient(135deg,#2b0b4d,#3b1a8d)}

    .balance-box{margin-top:20px;padding:16px;background:var(--glass-2);border-radius:12px;text-align:center}
    .balance{font-size:26px;font-weight:700;margin-top:4px}
    .withdraw-btn{margin-top:12px;padding:10px 16px;background: linear-gradient(135deg,#ffc107,#e2aa02);;color:#000000;border:none;border-radius:10px;font-weight:600;cursor:pointer;transition:0.2s}
    .withdraw-btn:hover{transform:translateY(-2px);}

    .stats{margin-top:18px;display:grid;gap:12px}
    .stat-box{padding:14px;background:var(--glass-2);border-radius:12px;text-align:center}
    .stat-title{font-size:13px;color:var(--muted)}
    .stat-value{font-size:20px;font-weight:600;margin-top:4px}

    /* LOGOUT BUTTON */
    .logout-btn{margin-top:20px;padding:10px 18px;background:linear-gradient(135deg,#ff4d4d,#ff1a1a);color:#fff;border:none;border-radius:10px;font-weight:600;cursor:pointer;transition:0.2s;display:block;margin-left:auto;margin-right:72%;
    }
    .logout-btn:hover{transform:translateY(-2px);box-shadow:0 6px 15px rgba(255,0,0,0.3)}

    /* MOBILE TWEAKS */
    @media(max-width:600px){
      body{padding:14px}
      .avatar{width:60px;height:60px}
      .balance{font-size:22px}
      .stat-value{font-size:18px}
      .withdraw-btn{padding:8px 14px;font-size:14px}
      .btnn{padding:8px 14px;font-size:14px; margin-left: 60%;}
    }
  </style>
</head>
<body>

<div class="wrap">

  <!-- LEFT SIDE PANEL -->
  <aside class="panel">
    <div class="profile">
      <div class="avatar">T</div>
      <div>
        <h3>Tayyab</h3>
        <p style="font-size:13px;color:var(--muted)">Full Member • Joined 2025</p>
      </div>
    </div>

    <div class="balance-box">
      <div class="stat-title" >Total Balance</div>
      <div class="balance">PKR 12,450.75</div>
     <a href="payment.php"><button class="withdraw-btn">Withdraw</button></a> 
    </div>

    <!-- Stats Section -->
    <div class="stats">
      <div class="stat-box">
        <div class="stat-title">Total Referrals</div>
        <div class="stat-value">128</div>
      </div>

      <div class="stat-box">
        <div class="stat-title">Today's Earnings</div>
        <div class="stat-value">PKR 950</div>
      </div>

      <div class="stat-box">
        <div class="stat-title">Minimum Withdrawal</div>
        <div class="stat-value">PKR 1,000</div>
      </div>
    </div>

<!-- Logout Button Centered -->
  <button style="width: 100%; margin-top: 10px;" class="logout-btn">Logout</button>


  </aside>

</div>
</body>
</html>
