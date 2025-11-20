<?php
session_start();
require 'config/db.php'; // Your DB connection

// Generate CSRF token if not set
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Fake login for demo - REPLACE WITH REAL AUTH
if (!isset($_SESSION['user_id'])) {
    $_SESSION['user_id'] = 1;
}
$user_id = $_SESSION['user_id'];

// Fetch user
$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Reset spins daily (simple check - in production, use cron)
$today = date('Y-m-d');
if ($user['last_spin_reset'] !== $today) {
    $stmt = $db->prepare("UPDATE users SET spins_today = 0, last_spin_reset = ? WHERE id = ?");
    $stmt->execute([$today, $user_id]);
    $user['spins_today'] = 0;
    $user['last_spin_reset'] = $today;
}

// Handle AJAX completeMission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'completeMission' && isset($_POST['missionId']) && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    $missionId = (int)$_POST['missionId'];
    // Hardcoded missions - in production, fetch from DB
    $missions = [
        1 => ['reward' => 5, 'premium' => false],
        2 => ['reward' => 8, 'premium' => false],
        3 => ['reward' => 10, 'premium' => false],
        4 => ['reward' => 12, 'premium' => false],
        5 => ['reward' => 15, 'premium' => false],
        6 => ['reward' => 10, 'premium' => false],
        7 => ['reward' => 20, 'premium' => false],
        8 => ['reward' => 9, 'premium' => false],
        9 => ['reward' => 7, 'premium' => false],
        10 => ['reward' => 6, 'premium' => false],
    ];
    if (!isset($missions[$missionId])) {
        echo json_encode(['error' => 'Invalid mission']);
        exit;
    }
    $reward = $missions[$missionId]['reward'];
    if ($missions[$missionId]['premium'] && !$user['is_premium']) {
        echo json_encode(['error' => 'Premium required']);
        exit;
    }
    if ($user['is_premium']) $reward *= 4; // Premium multiplier
    $stmt = $db->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
    $stmt->execute([$reward, $user_id]);
    $user['balance'] += $reward;
    echo json_encode(['balance' => $user['balance'], 'reward' => $reward]);
    exit;
}

// Handle AJAX spin
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'spin' && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    $limit = $user['is_premium'] ? 5 : 1;
    if ($user['spins_today'] >= $limit) {
        echo json_encode(['error' => 'Spin limit reached']);
        exit;
    }
    // Define wheel segments (8 slices, fixed rewards)
    $segments = $user['is_premium'] ? [50, 40, 30, 60, 45, 35, 55, 70] : [5, 10, 3, 15, 8, 12, 7, 20];
    $index = rand(0, 7);
    $reward = $segments[$index];
    $stopAngle = ($index * 45) + rand(0, 44); // 45 degrees per segment
    $stmt = $db->prepare("UPDATE users SET balance = balance + ?, spins_today = spins_today + 1 WHERE id = ?");
    $stmt->execute([$reward, $user_id]);
    $user['balance'] += $reward;
    $user['spins_today']++;
    echo json_encode(['balance' => $user['balance'], 'reward' => $reward, 'stopAngle' => $stopAngle]);
    exit;
}

// Handle AJAX toggle premium
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'togglePremium' && isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    $newPremium = !$user['is_premium'];
    $stmt = $db->prepare("UPDATE users SET is_premium = ? WHERE id = ?");
    $stmt->execute([$newPremium, $user_id]);
    $user['is_premium'] = $newPremium;
    echo json_encode(['is_premium' => $user['is_premium']]);
    exit;
}

// Set defaults
$user['balance'] = $user['balance'] ?? 0;
$user['is_premium'] = $user['is_premium'] ?? 0;
$user['spins_today'] = $user['spins_today'] ?? 0;
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Earn & Play — Missions</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/a2d9b5fdd4.js" crossorigin="anonymous"></script>
<style>
:root{
  --primary-yellow:#ffc107;
  --neon-blue:#00d4ff;
  --neon-purple:#b537f2;
  --dark-bg:#0f0f1e;
  --dark-card:#1a1a2e;
  --dark-lighter:#252541;
  --text-light:#ffffff;
  --text-gray:#b0b0c8;
  --success-green:#00ff88;
  --glass: rgba(255,255,255,0.03);
}
html,body{height:100%;background:linear-gradient(180deg,var(--dark-bg),#0b0b12);color:var(--text-light);font-family:Inter,Segoe UI,system-ui;}
.container{max-width:1200px;}
header.navbar{background:transparent;backdrop-filter:blur(8px);border-radius:999px;padding:0.5rem 1rem;}
.brand{font-weight:800;color:var(--primary-yellow);}
.hero{padding:2rem;border-radius:16px;background:linear-gradient(180deg,rgba(255,193,7,0.03),transparent);box-shadow:0 10px 30px rgba(0,0,0,0.6);}
.card-mission{background:var(--dark-card);border:1px solid rgba(255,255,255,0.03);border-radius:12px;padding:1rem;transition:transform .18s,box-shadow .18s;}
.card-mission:hover{transform:translateY(-6px);box-shadow:0 20px 40px rgba(0,0,0,0.6);}
.card-mission .locked{opacity:.4;pointer-events:none;}
.pill{background:var(--dark-lighter);padding:.25rem .6rem;border-radius:999px;font-size:.8rem;color:var(--text-gray);}
.badge-earn{background:linear-gradient(90deg,var(--neon-blue),var(--neon-purple));color:#08101a;padding:.35rem .6rem;border-radius:10px;font-weight:700;}
.btn-primary-custom{background:linear-gradient(135deg,var(--primary-yellow),#ff9800);color:#071018;border-radius:999px;border:none;}
.sidebar{position:sticky;top:90px;}
.muted{color:var(--text-gray);}
.ghost{background:transparent;border:1px dashed rgba(255,255,255,0.03);}
.wheel{width:220px;height:220px;border-radius:50%;background:conic-gradient(from 0deg, var(--neon-blue) 0deg 45deg, var(--neon-purple) 45deg 90deg, var(--primary-yellow) 90deg 135deg, var(--success-green) 135deg 180deg, var(--neon-blue) 180deg 225deg, var(--neon-purple) 225deg 270deg, var(--primary-yellow) 270deg 315deg, var(--success-green) 315deg 360deg);display:flex;align-items:center;justify-content:center;box-shadow:0 10px 30px rgba(0,0,0,0.6);}
.pointer{width:0;height:0;border-left:12px solid transparent;border-right:12px solid transparent;border-bottom:18px solid var(--primary-yellow);position:absolute;margin-top:-120px;}
.loading{display:none;}
@media (max-width:767px){.sidebar{position:static;margin-top:1rem}.wheel{width:160px;height:160px;}}
</style>
</head>
<body>
<div class="py-3">
<div class="container">
<nav class="navbar d-flex align-items-center justify-content-between">
  <div class="d-flex align-items-center gap-3">
    <div class="brand d-flex align-items-center gap-2"><i class="fa-solid fa-gem" style="color:var(--primary-yellow)"></i>EarnForce</div>
    <div class="pill">Earnings · Missions</div>
  </div>
  <div class="d-flex align-items-center gap-2">
    <div class="me-2 text-end">
      <div class="muted" style="font-size:.8rem">Balance</div>
      <div style="font-weight:800;font-size:1.15rem">Coins <span id="balance"><?php echo $user['balance']; ?></span></div>
    </div>
    <button id="btnTogglePremium" class="btn btn-sm btn-outline-light"><?php echo $user['is_premium']?'Premium':'Activate Premium'; ?></button>
  </div>
</nav>

<main class="mt-4">
<div class="row g-4">
<div class="col-lg-8">
  <section class="hero mb-3">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h2 style="margin:0">Missions</h2>
        <div class="muted">Complete missions to earn Coins. Free users get low rewards — Premium multiplies earnings.</div>
      </div>
      <div class="text-end">
        <div class="muted">Your Tier</div>
        <div id="tierBadge" class="badge-earn"><?php echo $user['is_premium']?'Premium':'Free'; ?></div>
      </div>
    </div>
  </section>

  <section>
    <div class="d-flex gap-2 align-items-center mb-3">
      <button class="btn btn-sm ghost active" id="filterAll">All</button>
      <button class="btn btn-sm ghost" id="filterDaily">Daily</button>
      <button class="btn btn-sm ghost" id="filterSpin">Spins</button>
      <button class="btn btn-sm ghost" id="filterTasks">Tasks</button>
      <div class="ms-auto muted">Available missions: <span id="missionCount">0</span></div>
    </div>

    <div id="missionsList" class="row g-3"></div>
  </section>
</div>

<aside class="col-lg-4">
<div class="sidebar">
  <div class="card-mission p-3 mb-3 text-center">
    <div class="muted">Quick Spin</div>
    <div class="position-relative my-3">
      <div class="pointer"></div>
      <div id="wheel" class="wheel mx-auto"></div>
    </div>
    <button id="spinBtn" class="btn btn-sm btn-primary-custom">Spin Now</button>
    <div class="loading" id="spinLoading">Spinning...</div>
    <div class="muted mt-2" style="font-size:.85rem">Free: 1/day · Premium: 5/day (Used: <span id="spinsUsed"><?php echo $user['spins_today']; ?></span>)</div>
  </div>

  <div class="card-mission p-3 mb-3">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <div><strong>Premium Access</strong><div class="muted" style="font-size:.85rem">Unlock high-earning missions</div></div>
      <div class="text-end">
        <div style="font-weight:800">Coins 149</div>
        <small class="muted">one-time</small>
      </div>
    </div>
    <button id="buyPremium" class="btn btn-sm btn-primary-custom w-100">Buy Premium</button>
  </div>

  <div class="card-mission p-3 mb-3">
    <h6>Stats</h6>
    <div class="d-flex justify-content-between muted"><small>Completed</small><strong id="completed">0</strong></div>
    <div class="d-flex justify-content-between muted"><small>In-progress</small><strong id="inprogress">0</strong></div>
    <div class="d-flex justify-content-between muted"><small>Available</small><strong id="available">0</strong></div>
  </div>

  <div class="card-mission p-3 text-center">
    <div class="muted">Referral Bonus</div>
    <div style="font-weight:800;font-size:1.1rem">Share & Earn</div>
    <button id="copyRef" class="btn btn-sm btn-outline-light mt-2">Copy Link</button>
  </div>
</div>
</aside>
</div>
</main>

<div id="notification-container" style="position:fixed;right:20px;top:110px;z-index:9999"></div>
</div>
</div>

<script>
const csrfToken = '<?php echo $_SESSION['csrf_token']; ?>';

// Missions data (hardcoded - move to DB in production)
const freeMissions = [
  {id:1,title:'Daily Check-in',type:'daily',reward:5,estimate:10},
  {id:2,title:'Watch Short Ad',type:'task',reward:8,estimate:30},
  {id:3,title:'Micro Survey',type:'task',reward:10,estimate:60},
  {id:4,title:'Daily Quiz',type:'daily',reward:12,estimate:90},
  {id:5,title:'Mini Game Top Score',type:'task',reward:15,estimate:120},
  {id:6,title:'Spin (free)',type:'spin',reward:10,estimate:0},
  {id:7,title:'Invite Friend',type:'task',reward:20,estimate:0},
  {id:8,title:'Watch 2 Videos',type:'task',reward:9,estimate:60},
  {id:9,title:'App Feedback',type:'task',reward:7,estimate:15},
  {id:10,title:'Daily Streak',type:'daily',reward:6,estimate:5}
];
const premiumMissions = freeMissions.map(m => ({...m, reward: m.reward * 4, premium: true}));

var isPremium = <?php echo $user['is_premium'] ? 'true' : 'false'; ?>;
var balance = <?php echo $user['balance']; ?>;
var spinsUsed = <?php echo $user['spins_today']; ?>;
var completed = 0;
var inprogress = 0;

var missionsList = document.getElementById('missionsList');
var balanceEl = document.getElementById('balance');
var tierBadge = document.getElementById('tierBadge');
var missionCount = document.getElementById('missionCount');
var completedEl = document.getElementById('completed');
var inprogressEl = document.getElementById('inprogress');
var availableEl = document.getElementById('available');
var btnTogglePremium = document.getElementById('btnTogglePremium');
var spinBtn = document.getElementById('spinBtn');
var spinLoading = document.getElementById('spinLoading');
var spinsUsedEl = document.getElementById('spinsUsed');
var wheel = document.getElementById('wheel');

// Notifications
function notify(msg, type = 'success') {
  let div = document.createElement('div');
  div.className = `notification p-2 mb-2 ${type}`;
  div.style.background = 'var(--dark-card)';
  div.innerHTML = `<div>${msg}</div>`;
  document.getElementById('notification-container').appendChild(div);
  setTimeout(() => { if (div.parentNode) div.parentNode.removeChild(div); }, 3000);
}

// Render missions
function renderMissions(filter = 'all') {
  missionsList.innerHTML = '';
  let pool = freeMissions.concat(premiumMissions);
  if (filter !== 'all') pool = pool.filter(m => m.type === filter);
  missionCount.textContent = pool.length;
  availableEl.textContent = pool.length;

  pool.forEach(m => {
    let col = document.createElement('div'); col.className = 'col-md-6';
    let card = document.createElement('div'); card.className = 'card-mission';
    let premiumLabel = m.premium ? '<span class="ms-2 badge bg-warning text-dark">Premium</span>' : '';
    let estText = m.estimate ? (m.estimate + 's') : 'Instant';
    let locked = (m.premium && !isPremium) ? 'locked' : '';
    card.innerHTML = `
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div style="font-weight:800">${m.title} ${premiumLabel}</div>
          <div class="muted" style="font-size:.85rem">Est: ${estText}</div>
        </div>
        <div class="text-end">
          <div class="pill">${m.type.toUpperCase()}</div>
          <div style="margin-top:.6rem;font-weight:800">Coins ${m.reward}</div>
        </div>
      </div>
      <div class="mt-3 d-flex gap-2">
        <button class="btn btn-sm btn-outline-light start-btn ${locked}">${m.premium && !isPremium ? 'Premium Only' : 'Start'}</button>
        <button class="btn btn-sm btn-primary-custom info-btn">Info</button>
      </div>
    `;
        missionsList.appendChild(col);

    card.querySelector('.start-btn').addEventListener('click', () => {
      if (m.premium && !isPremium) { 
        notify('This mission is for Premium users only'); 
        return; 
      }
      fetch('', {
        method: 'POST',
        headers: {'Content-Type':'application/x-www-form-urlencoded'},
        body: `action=completeMission&missionId=${m.id}&csrf_token=${csrfToken}`
      })
      .then(res => res.json())
      .then(data => {
        if (data.error) { notify(data.error, 'error'); return; }
        balance = data.balance;
        balanceEl.textContent = balance;
        completed++;
        updateStats();
        notify(`Mission complete! +${data.reward} Coins`);
      });
    });

    card.querySelector('.info-btn').addEventListener('click', () => {
      notify(`${m.title}: Complete this to earn ${m.reward} Coins`);
    });
  });
}

function updateStats() {
  completedEl.textContent = completed;
  inprogressEl.textContent = inprogress;
}

// Filters
document.getElementById('filterAll').addEventListener('click', () => renderMissions('all'));
document.getElementById('filterDaily').addEventListener('click', () => renderMissions('daily'));
document.getElementById('filterSpin').addEventListener('click', () => renderMissions('spin'));
document.getElementById('filterTasks').addEventListener('click', () => renderMissions('task'));

// Premium toggle
btnTogglePremium.addEventListener('click', () => {
  fetch('', {
    method: 'POST',
    headers: {'Content-Type':'application/x-www-form-urlencoded'},
    body: `action=togglePremium&csrf_token=${csrfToken}`
  })
  .then(res => res.json())
  .then(data => {
    isPremium = data.is_premium;
    tierBadge.textContent = isPremium ? 'Premium' : 'Free';
    renderMissions();
    notify(isPremium ? 'Premium Activated' : 'Premium Deactivated');
  });
});

// Spin wheel
spinBtn.addEventListener('click', () => {
  const limit = isPremium ? 5 : 1;
  if (spinsUsed >= limit) { notify('Spin limit reached', 'error'); return; }

  spinBtn.disabled = true;
  spinLoading.style.display = 'block';

  fetch('', {
    method: 'POST',
    headers: {'Content-Type':'application/x-www-form-urlencoded'},
    body: `action=spin&csrf_token=${csrfToken}`
  })
  .then(res => res.json())
  .then(data => {
    spinBtn.disabled = false;
    spinLoading.style.display = 'none';
    if (data.error) { notify(data.error, 'error'); return; }

    spinsUsed++;
    spinsUsedEl.textContent = spinsUsed;
    balance = data.balance;
    balanceEl.textContent = balance;

    wheel.style.transition = 'transform 3s cubic-bezier(.2,.9,.2,1)';
    wheel.style.transform = `rotate(${data.stopAngle + 720}deg)`; // 2 spins
    setTimeout(() => { wheel.style.transition = ''; wheel.style.transform = ''; }, 3200);

    notify(`Spin reward: +${data.reward} Coins`);
  });
});

// Referral copy
document.getElementById('copyRef').addEventListener('click', () => {
  navigator.clipboard.writeText('https://rewardzone.pk/ref/ABC123');
  notify('Referral link copied!');
});

// Initial render
renderMissions();
updateStats();
</script>
</body>
</html>
