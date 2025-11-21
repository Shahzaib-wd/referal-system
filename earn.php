<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Earn & Play — Missions</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
  --danger-red:#ff4444;
  --warning-orange:#ffaa00;
}
body{
  font-family: 'Roboto', sans-serif;
  background: linear-gradient(180deg,var(--dark-bg),#0b0b12);
  color: var(--text-light);
  min-height:100vh;
  overflow-x: hidden;
}
.navbar{background:transparent;backdrop-filter:blur(8px);border-radius:999px;padding:.5rem 1rem;}
.brand{font-weight:800;color:var(--primary-yellow);}
.pill{background:var(--dark-lighter);padding:.25rem .6rem;border-radius:999px;font-size:.8rem;color:var(--text-gray);}
.hero{padding:1.5rem;border-radius:16px;background:linear-gradient(180deg,rgba(255,193,7,0.03),transparent);}
.card-mission{background:var(--dark-card);border-radius:12px;padding:1rem;transition:0.3s ease-in-out;cursor:pointer;animation: fadeInUp 0.5s ease-out;}
.card-mission:hover{transform:translateY(-8px) scale(1.02);box-shadow:0 20px 40px rgba(0,0,0,0.8);filter: brightness(1.1);}
.badge-earn{background:linear-gradient(90deg,var(--neon-blue),var(--neon-purple));color:#08101a;padding:.35rem .6rem;border-radius:10px;font-weight:700;}
.btn-primary-custom{background:linear-gradient(135deg,var(--primary-yellow),#ff9800);color:#071018;border-radius:999px;border:none;transition:0.2s;}
.btn-primary-custom:hover{transform:scale(1.05);box-shadow:0 5px 15px rgba(255,193,7,0.4);}
.muted{color:var(--text-gray);}
.wheel{width:220px;height:220px;border-radius:50%;background:conic-gradient(var(--neon-blue),var(--neon-purple),var(--primary-yellow),var(--success-green));display:flex;align-items:center;justify-content:center;box-shadow:0 10px 30px rgba(0,0,0,0.6);transition:0.3s;}
.wheel:hover{transform:rotate(10deg);}
.pointer{width:0;height:0;border-left:12px solid transparent;border-right:12px solid transparent;border-bottom:18px solid var(--primary-yellow);position:absolute;margin-top:-120px;}
.progress-bar-custom{background:linear-gradient(90deg,var(--neon-blue),var(--success-green));border-radius:10px;}
.mini-wheel{width:80px;height:80px;border-radius:50%;background:conic-gradient(var(--neon-purple),var(--primary-yellow));display:inline-flex;align-items:center;justify-content:center;margin-right:10px;}
.streak-badge{background:linear-gradient(90deg,var(--danger-red),var(--warning-orange));color:#fff;padding:.2rem .5rem;border-radius:20px;font-size:.75rem;font-weight:700;}
.urgency-timer{color:var(--danger-red);font-weight:800;animation:pulse 1s infinite;}
@keyframes fadeInUp{from{opacity:0;transform:translateY(20px);}to{opacity:1;transform:translateY(0);}}
@keyframes pulse{0%{opacity:1;}50%{opacity:0.5;}100%{opacity:1;}}
@media(max-width:767px){.wheel{width:160px;height:160px;}.mini-wheel{width:60px;height:60px;}}
.mission-grid{overflow-y:auto;max-height:80vh;padding-right:10px;}
.mission-grid::-webkit-scrollbar{width:8px;}
.mission-grid::-webkit-scrollbar-track{background:var(--dark-bg);}
.mission-grid::-webkit-scrollbar-thumb{background:var(--neon-blue);border-radius:4px;}

/* Filter active state + completed badge */
.btn-filter.active{
  background: linear-gradient(90deg, rgba(0,212,255,0.12), rgba(181,55,242,0.12));
  color: var(--neon-blue);
  border: 1px solid rgba(0,212,255,0.18);
  box-shadow: 0 6px 20px rgba(0,0,0,0.6), 0 0 10px rgba(0,212,255,0.06);
}
.mission-completed {
  opacity: 0.8;
  position: relative;
  pointer-events: none;
}
.completed-badge {
  position: absolute;
  top: 10px;
  left: 10px;
  background: linear-gradient(90deg,var(--success-green),#00c775);
  color:#071018;
  font-weight:800;
  padding:4px 8px;
  border-radius:999px;
  font-size:.75rem;
  z-index:2;
}
.btn-disabled {
  opacity:0.6;
  pointer-events:none;
}
.coin-pop {
  transform: translateY(-8px);
  transition: transform .6s cubic-bezier(.2,.9,.2,1);
}

</style>
</head>
<body>

<div class="container mb-3 py-4">
  <div class="d-flex justify-content-between align-items-center p-3" style="background:rgba(30,30,50,0.8);border-radius:12px;">
  <!-- Left side: Brand + Pill -->
  <div class="d-flex align-items-center gap-3">
    <div class="brand" style="font-weight:800;color:#ffc107;"><i class="fa-solid fa-gem"></i> EarnForce</div>
  </div>

  <!-- Right side: Balance + Button -->
  <div class="d-flex align-items-center gap-3">
    <div class="text-end">
      <div style="font-weight:800;font-size:1.1rem;color:#fff;"><img src="/coin.png" width="45" alt="coin-image"> 149</div>
    </div>
  </div>
</div>


  <!-- Hero -->
  <section class="hero mt-3 mb-4 d-flex justify-content-between align-items-center">
    <div>
      <h2 style="margin:0">Missions <i class="fa-solid fa-fire text-warning"></i></h2>
      <div class="muted">Complete missions to earn Coins. Premium multiplies rewards. Stay hooked with streaks & bonuses!</div>
    </div>
    <div class="text-end">
      <div class="muted">Your Tier</div>
      <div class="badge-earn">Free</div>
    </div>
  </section>

  <div class="row g-4">
    <!-- Missions List -->
    <div class="col-lg-8">
      <div class="d-flex gap-2 mb-3">
        <button class="btn btn-sm btn-outline-light">All</button>
        <button class="btn btn-sm btn-outline-light">Daily</button>
        <button class="btn btn-sm btn-outline-light">Spins</button>
        <button class="btn btn-sm btn-outline-light">Tasks</button>
        <div class="ms-auto muted">Available missions: 50</div>
      </div>

      <div class="mission-grid row g-3">
        <!-- Mission 1-2: Card Style -->
        <div class="col-md-6">
          <div class="card-mission">
            <div class="d-flex justify-content-between align-items-start">
              <div><strong>Daily Check-in</strong><div class="muted" style="font-size:.85rem">Est: Instant</div></div>
              <div class="text-end">
                <div class="pill">DAILY</div>
                <div style="margin-top:.6rem;font-weight:800">Coins 20</div>
              </div>
            </div>
            <div class="mt-3 d-flex gap-2">
              <button class="btn btn-sm btn-outline-light w-50">Start</button>
            </div>
          </div>
        </div>

        <div class="col-md-6">
            <div class="card-mission">
              <strong>Daily Login Streak</strong>
              <div class="muted" style="font-size:.85rem">Maintain a 7-day streak to earn 15 Coins</div>
              <div class="progress my-2" style="height:8px;border-radius:5px;">
                <div class="progress-bar bg-success" role="progressbar" style="width:30%"></div>
              </div>
              <div class="mt-2 d-flex justify-content-between">
                <small>Day 2/7</small>
                <div style="font-weight:800">Coins 150</div>
              </div>
              <div class="mt-2 d-flex gap-2">
                <button class="btn btn-sm btn-outline-light w-50">Start</button>
              </div>
            </div>
            </div>

        <div class="col-md-6">
                <div class="card-mission">
          <div class="d-flex justify-content-between align-items-start">
            <div>
              <strong>Upload Your Photo</strong>
              <div class="muted" style="font-size:.85rem">Earn 120 Coins by uploading a pic</div>
            </div>
            <div class="text-end">
              <div class="pill">TASK</div>
              <div style="margin-top:.6rem;font-weight:800">Coins 120</div>
            </div>
          </div>
          <div class="mt-3 d-flex gap-2">
            <button class="btn btn-sm btn-outline-light w-50">Start</button>
          </div>
        </div>
        </div>
        <div class="col-md-6">
          <div class="card-mission">
            <strong>Share Story on Facebook</strong>
            <div class="muted" style="font-size:.85rem">Post your achievement on FB story to earn 10 Coins</div>
            <div style="margin-top:.6rem;font-weight:800">Coins 40</div>
            <div class="mt-2 d-flex gap-2">
              <button class="btn btn-sm btn-outline-light w-50"><i class="fab fa-facebook"></i> Share</button>
            </div>
          </div>
        </div>

                  <!-- 65️⃣ Like Our Page on FB -->
          <div class="col-md-6">
            <div class="card-mission">
              <strong>Like FB Page</strong>
              <div class="muted" style="font-size:.85rem">Earn 8 Coins by liking our page</div>
              <button class="btn btn-sm btn-outline-light w-50 mt-2"><i class="fab fa-facebook"></i> Like</button>
            </div>
          </div>


        <!-- Mission 3-4: Progress Bar Style -->
        <div class="col-md-6">
          <div class="card-mission">
            <div class="d-flex justify-content-between align-items-start">
              <div><strong>Watch Ad Series</strong><div class="muted" style="font-size:.85rem">Est: 5 min</div></div>
              <div class="text-end">
                <div class="pill">VIDEO</div>
                <div style="margin-top:.6rem;font-weight:800">Coins 20</div>
              </div>
            </div>
            <div class="mt-2">
              <div class="progress" style="height:8px;">
                <div class="progress-bar progress-bar-custom" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <small class="muted">Progress: 3/5 videos</small>
            </div>
            <div class="mt-3 d-flex gap-2">
              <button class="btn btn-sm btn-outline-light w-50">Continue</button>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card-mission">
            <div class="d-flex justify-content-between align-items-start">
              <div><strong>Invite Friends</strong><div class="muted" style="font-size:.85rem">Est: Variable</div></div>
              <div class="text-end">
                <div class="pill">SOCIAL</div>
                <div style="margin-top:.6rem;font-weight:800">Coins 25</div>
              </div>
            </div>
            <div class="mt-2">
              <div class="progress" style="height:8px;">
                <div class="progress-bar progress-bar-custom" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <small class="muted">Progress: 2/5 invites</small>
            </div>
            <div class="mt-3 d-flex gap-2">
              <button class="btn btn-sm btn-outline-light w-50">Invite</button>
            </div>
          </div>
        </div>


                  <!-- 17️⃣ Mystery Box -->
          <div class="col-md-6">
            <div class="card-mission text-center">
              <strong>Mystery Reward</strong>
              <div class="muted mt-1" style="font-size:.85rem">Open the box to get random coins (5-50)</div>
              <button class="btn w-100 mt-3 btn-sm btn-primary-custom">Open</button>
            </div>
          </div>


          <!-- New Interesting Missions Added Here -->


<div class="col-md-6">
  <div class="card-mission">
    <div class="d-flex justify-content-between align-items-start">
      <div><strong>Follow on Instagram</strong><div class="muted" style="font-size:.85rem">Est: Instant</div></div>
      <div class="text-end">
        <div class="pill">SOCIAL</div>
        <div style="margin-top:.6rem;font-weight:800">Coins 15</div>
      </div>
    </div>
    <div class="mt-3 d-flex gap-2">
      <button class="btn btn-sm btn-outline-light w-50"><i class="fab fa-instagram"></i> Follow</button>
    </div>
  </div>
</div>

<div class="col-md-6">
  <div class="card-mission">
    <strong>Daily Riddle Solve</strong>
    <div class="muted" style="font-size:.85rem">Solve today's riddle for 25 Coins</div>
    <div class="mt-2">
      <small class="muted">What has keys but can't open locks? (Hint: Music)</small>
    </div>
    <input type="text" class="form-control form-control-sm mt-2" placeholder="Your answer">
    <button class="btn btn-sm btn-primary-custom w-100 mt-2">Submit</button>
  </div>
</div>



<div class="col-md-6">
  <div class="card-mission">
    <strong>Share on Twitter</strong>
    <div class="muted" style="font-size:.85rem">Tweet about EarnForce to earn 20 Coins</div>
    <div style="margin-top:.6rem;font-weight:800">Coins 20</div>
    <div class="mt-2 d-flex gap-2">
      <button class="btn btn-sm btn-outline-light w-50"><i class="fab fa-twitter"></i> Tweet</button>
    </div>
  </div>
</div>

<div class="col-md-6">
  <div class="card-mission">
    <div class="d-flex justify-content-between align-items-start">
      <div><strong>Play Mini-Game</strong><div class="muted" style="font-size:.85rem">Est: 5 min</div></div>
      <div class="text-end">
        <div class="pill">GAME</div>
        <div style="margin-top:.6rem;font-weight:800">Coins 60</div>
      </div>
    </div>
    <div class="mt-2">
      <div class="progress" style="height:8px;">
        <div class="progress-bar progress-bar-custom" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      <small class="muted">Progress: Level 3/6</small>
    </div>
    <div class="mt-3 d-flex gap-2">
      <button class="btn btn-sm btn-outline-light w-50">Play</button>
    </div>
  </div>
</div>

<div class="col-md-6">
  <div class="card-mission">
    <strong>Weekly Survey</strong>
    <div class="muted" style="font-size:.85rem">Complete a short survey for 40 Coins</div>
    <div style="margin-top:.6rem;font-weight:800">Coins 40</div>
    <div class="mt-2 d-flex gap-2">
      <button class="btn btn-sm btn-outline-light w-50">Start Survey</button>
    </div>
  </div>
</div>

<div class="col-md-6">
  <div class="card-mission">
    <div class="d-flex justify-content-between align-items-start">
      <div><strong>Subscribe to Newsletter</strong><div class="muted" style="font-size:.85rem">Est: Instant</div></div>
      <div class="text-end">
        <div class="pill">EMAIL</div>
        <div style="margin-top:.6rem;font-weight:800">Coins 10</div>
      </div>
    </div>
    <div class="mt-3 d-flex gap-2">
      <button class="btn btn-sm btn-outline-light w-50">Subscribe</button>
    </div>
  </div>
</div>

<div class="col-md-6">
  <div class="card-mission">
    <strong>Daily Fortune Cookie</strong>
    <div class="muted" style="font-size:.85rem">Open for a lucky tip and 5-20 Coins</div>
    <button class="btn w-100 mt-3 btn-sm btn-primary-custom">Open Cookie</button>
  </div>
</div>


          
          <!-- 54️⃣ Watch Story Ad -->
          <div class="col-md-6">
            <div class="card-mission">
              <strong>Watch Story Ad</strong>
              <div class="muted" style="font-size:.85rem">Earn 8 Coins per story ad</div>
              <strong>Upcoming</strong>
              <button class="btn btn-sm btn-primary-custom w-100">Watch Now</button>
            </div>
          </div>

                    <!-- 61️⃣ Daily Mood Poll -->
          <div class="col-md-6">
            <div class="card-mission">
              <strong>Daily Mood Poll</strong>
              <div class="muted" style="font-size:.85rem">Select your mood today and earn 5 Coins</div>
              <select class="form-select form-select-sm mt-2">
                <option>Happy</option>
                <option>Excited</option>
                <option>Neutral</option>
                <option>Tired</option>
              </select>
              <button class="btn btn-sm btn-primary-custom w-100 mt-2">Submit</button>
            </div>
          </div>



        <!-- Repeat the cycle for 50 missions (showing first 8 as example; in real code, loop or duplicate) -->
        <!-- For brevity, I'll note that missions 9-50 follow the same pattern: 1-2 Card, 3-4 Progress, 5-6 Spin, 7-8 Other, repeating. -->
        <!-- In a real implementation, use JS to generate dynamically. Here, placeholder for expansion. -->
        <div class="col-12 text-center muted mt-3">
          <small>Stay Tuned For Upcoming Missions...</small>
        </div>
      </div>
    </div>

    <!-- Sidebar -->
    <aside class="col-lg-4">
      <div class="d-flex flex-column gap-3">
        <div class="card-mission p-3 text-center">
          <div class="muted">Quick Spin</div>
          <div class="position-relative my-3">
            <div class="pointer"></div>
            <div class="wheel mx-auto"></div>
          </div>
          <button class="btn btn-sm btn-primary-custom">Spin Now</button>
          <div class="muted mt-2" style="font-size:.85rem">Free:1/day · Premium:5/day</div>
        </div>

        <div class="card-mission p-3 text-center">
          <strong>Premium Access</strong>
          <div class="muted mb-2">Unlock high-earning missions & 5x rewards!</div>
          <button class="btn btn-sm btn-primary-custom w-100">Buy Premium</button>
        </div>

        <div class="card-mission p-3">
          <h6>Stats</h6>
          <div class="d-flex justify-content-between muted"><small>Completed</small><strong>8</strong></div>
          <div class="d-flex justify-content-between muted"><small>In-progress</small><strong>12</strong></div>
          <div class="d-flex justify-content-between muted"><small>Available</small><strong>50</strong></div>
        </div>

        <div class="card-mission p-3 text-center">
          <div class="muted">Referral Bonus</div>
          <div style="font-weight:800;font-size:1.1rem">Share & Earn</div>
          <button class="btn btn-sm btn-outline-light mt-2 w-100">Copy Link</button>
        </div>
      </div>


    </aside>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<script>
(() => {
  // Keys
  const KEY_BAL = 'ef_balance';
  const KEY_MISSIONS = 'ef_missions';
  const FREE_SPIN_KEY = 'ef_free_spin_date';

  // Bootstrap modal helper
  const createBootstrapModal = (id, title, bodyHtml, footerHtml='') => {
    // remove if exists
    const prev = document.getElementById(id);
    if(prev) prev.remove();
    const modal = document.createElement('div');
    modal.className = 'modal fade';
    modal.id = id;
    modal.tabIndex = -1;
    modal.innerHTML = `
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark" style="border-radius:12px;border:none;">
          <div class="modal-header border-0">
            <h5 class="modal-title text-white">${title}</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-white">${bodyHtml}</div>
          <div class="modal-footer border-0">${footerHtml}</div>
        </div>
      </div>`;
    document.body.appendChild(modal);
    return new bootstrap.Modal(modal);
  };

  // Init balance
  const $balanceEl = document.querySelector('.container .d-flex .brand') ? null : null;
  // Find the balance element (image + number). We will search for the number text in page.
  const balanceNode = Array.from(document.querySelectorAll('div')).find(n => n.innerText && n.innerText.trim().match(/^\d+$/));
  // Better approach: if your coin element is the one with the image, match that pattern:
  const balanceDisplay = document.querySelector('div img[alt="coin-image"]')?.parentElement || balanceNode;
  const setBalanceDisplay = (val) => {
    if(!balanceDisplay) return;
    balanceDisplay.innerHTML = `<img src="/coin.png" width="45" alt="coin-image"> ${val}`;
    // pop animation
    balanceDisplay.classList.add('coin-pop');
    setTimeout(()=> balanceDisplay.classList.remove('coin-pop'), 600);
  };

  const getBalance = () => Number(localStorage.getItem(KEY_BAL) || ( (() => {
    // try parse from page
    const txt = (balanceDisplay && balanceDisplay.innerText.match(/\d+/))?.[0];
    return txt ? Number(txt) : 149;
  })() ));
  const setBalance = (v) => {
    localStorage.setItem(KEY_BAL, String(v));
    setBalanceDisplay(v);
  };

  // Initial balance
  setBalance(getBalance());

  // Build missions state (scan page mission cards)
  const missionCards = Array.from(document.querySelectorAll('.card-mission'));
  // Create mission objects by index
  const stored = JSON.parse(localStorage.getItem(KEY_MISSIONS) || '{}');
  const missionsState = stored && Object.keys(stored).length ? stored : {};
  missionCards.forEach((card, idx) => {
    const id = card.dataset.missionId || `m_${idx+1}`;
    card.dataset.missionId = id;
    // read pill/category text if exists
    const pill = card.querySelector('.pill')?.innerText?.trim()?.toLowerCase() || '';
    const rewardText = card.innerText.match(/Coins\s*(\d+)/i) || card.innerText.match(/Coins\s*(\d+)/i);
    const reward = rewardText ? Number(rewardText[1]) : (card.innerText.match(/(\d+)\s*Coins/i)?.[1] ? Number(card.innerText.match(/(\d+)\s*Coins/i)[1]) : 10);
    if(!missionsState[id]) {
      missionsState[id] = {
        id,
        title: (card.querySelector('strong')?.innerText || card.querySelector('h6')?.innerText || `Mission ${idx+1}`).trim(),
        category: pill || 'general',
        reward,
        status: 'available', // available | in-progress | completed
        progress: 0,
        meta: {}
      };
    }
    // add a small id label (optional)
    if(!card.querySelector('.mission-id')) {
      const span = document.createElement('div'); span.className='mission-id muted'; span.style.fontSize='.7rem'; span.innerText = id;
      card.appendChild(span);
    }
  });
  localStorage.setItem(KEY_MISSIONS, JSON.stringify(missionsState));

  // Utility: save and reapply state to DOM
  const applyStatesToDOM = () => {
    const st = JSON.parse(localStorage.getItem(KEY_MISSIONS) || '{}');
    Object.values(st).forEach(s => {
      const card = document.querySelector(`[data-mission-id="${s.id}"]`);
      if(!card) return;
      // remove existing overlays
      const oldBadge = card.querySelector('.completed-badge');
      if(oldBadge) oldBadge.remove();
      card.classList.remove('mission-completed');
      // update progress bar if any (if given)
      const progBar = card.querySelector('.progress-bar');
      if(progBar && typeof s.progress === 'number') {
        progBar.style.width = Math.min(100, s.progress)+'%';
      }
      // Completed
      if(s.status === 'completed') {
        // add badge
        const b = document.createElement('div');
        b.className = 'completed-badge';
        b.innerText = 'COMPLETED';
        card.appendChild(b);
        card.classList.add('mission-completed');
        // disable buttons inside card
        card.querySelectorAll('button, input, select').forEach(btn => btn.classList.add('btn-disabled'));
      } else {
        // enable buttons
        card.querySelectorAll('button, input, select').forEach(btn => btn.classList.remove('btn-disabled'));
      }
    });
  };
  applyStatesToDOM();

  // Filters
  const filterButtons = Array.from(document.querySelectorAll('.btn-group .btn, .d-flex.gap-2 .btn, .d-flex.gap-2 button'))
    .filter(b => /all|daily|spins|tasks|daily/i.test(b.innerText));
  // fallback to first row of buttons
  const headerFilterBtns = document.querySelectorAll('.d-flex.gap-2.mb-3 button');
  const filters = headerFilterBtns.length ? Array.from(headerFilterBtns) : filterButtons;
  filters.forEach(b => b.classList.add('btn-filter'));
  const setFilter = (cat) => {
    filters.forEach(f => f.classList.toggle('active', f.innerText.toLowerCase() === cat.toLowerCase()));
    const st = JSON.parse(localStorage.getItem(KEY_MISSIONS) || '{}');
    missionCards.forEach(card => {
      const mid = card.dataset.missionId;
      const m = st[mid];
      if(!m) return;
      if(cat.toLowerCase() === 'all') {
        card.style.display = '';
      } else if(m.category.includes(cat.toLowerCase())) {
        card.style.display = '';
      } else {
        card.style.display = 'none';
      }
    });
  };
  // initial filter = All
  const defaultFilterBtn = filters.find(f=>/all/i.test(f.innerText)) || filters[0];
  if(defaultFilterBtn) defaultFilterBtn.classList.add('active');
  filters.forEach(btn => btn.addEventListener('click', () => setFilter(btn.innerText)));

  // Click mission card => open modal
  missionCards.forEach(card => {
    card.style.cursor = 'pointer';
    card.addEventListener('click', (e) => {
      // ignore if clicked button inside
      if(e.target.tagName === 'BUTTON' || e.target.tagName === 'INPUT' || e.target.closest('button')) return;
      const id = card.dataset.missionId;
      const st = JSON.parse(localStorage.getItem(KEY_MISSIONS) || '{}')[id];
      const bodyHtml = `
        <p class="muted">${card.querySelector('.muted')?.innerText || 'Complete this mission to earn coins.'}</p>
        <p><strong>Reward:</strong> ${st.reward} Coins</p>
        <div class="my-2">
          <div class="progress" style="height:8px;">
            <div class="progress-bar" role="progressbar" style="width:${st.progress||0}%"></div>
          </div>
          <small class="muted">Progress: ${st.progress||0}%</small>
        </div>
      `;
      const footerHtml = `
        <button class="btn btn-sm btn-outline-light me-auto" id="mark-complete">Mark Complete</button>
        <button class="btn btn-sm btn-primary-custom" id="start-mission">Start</button>
      `;
      const modal = createBootstrapModal('missionModal', st.title, bodyHtml, footerHtml);
      modal.show();

      // wait for DOM ready inside modal
      setTimeout(() => {
        const startBtn = document.getElementById('start-mission');
        const compBtn = document.getElementById('mark-complete');
        startBtn.addEventListener('click', () => {
          // update status
          const all = JSON.parse(localStorage.getItem(KEY_MISSIONS) || '{}');
          all[id].status = 'in-progress';
          all[id].progress = Math.min(100, (all[id].progress||0) + 25);
          localStorage.setItem(KEY_MISSIONS, JSON.stringify(all));
          applyStatesToDOM();
          // update modal progress UI
          const progressBar = document.querySelector('#missionModal .progress-bar');
          if(progressBar) progressBar.style.width = all[id].progress + '%';
          // simple success feedback
          startBtn.innerText = 'In Progress';
          startBtn.classList.add('btn-disabled');
        });
        compBtn.addEventListener('click', ()=> {
          const all = JSON.parse(localStorage.getItem(KEY_MISSIONS) || '{}');
          all[id].status = 'completed';
          all[id].progress = 100;
          localStorage.setItem(KEY_MISSIONS, JSON.stringify(all));
          // add reward to balance
          const bal = getBalance();
          setBalance(bal + (all[id].reward || 0));
          applyStatesToDOM();
          // close modal
          modal.hide();
          // quick coin burst effect: create small toast
          const toast = document.createElement('div');
          toast.className = 'position-fixed top-50 start-50 translate-middle p-3 rounded';
          toast.style.zIndex = 9999;
          toast.innerHTML = `<div class="card-mission p-2 text-center" style="display:inline-block;">+${all[id].reward} Coins</div>`;
          document.body.appendChild(toast);
          setTimeout(()=> toast.remove(), 900);
        });
      }, 100);
    });
  });

  // Buttons inside cards (Start/Subscribe/Follow) - delegation
  document.body.addEventListener('click', (e) => {
    const t = e.target;
    // If Start inside card clicked directly
    if(t.matches('.card-mission button') || t.closest('.card-mission button')) {
      const btn = t.tagName === 'BUTTON' ? t : t.closest('button');
      const card = btn.closest('.card-mission');
      if(!card) return;
      // Determine mission id
      const id = card.dataset.missionId;
      // Riddle submit (if on card)
      if(btn.innerText.toLowerCase().includes('submit')) {
        const input = card.querySelector('input[type="text"]');
        const ans = input?.value?.trim()?.toLowerCase();
        if(!ans) { alert('Answer daal bhai'); return; }
        if(ans === 'piano') {
          // reward success
          const all = JSON.parse(localStorage.getItem(KEY_MISSIONS) || '{}');
          all[id].status = 'completed';
          all[id].progress = 100;
          localStorage.setItem(KEY_MISSIONS, JSON.stringify(all));
          setBalance(getBalance() + (all[id].reward || 25));
          applyStatesToDOM();
          alert('Sahi! Coins added.');
        } else {
          alert('Galat — hint: Music instrument. Try again.');
        }
        return;
      }
      // Follow / Share / Like buttons -> simulate completion and reward
      const text = btn.innerText.toLowerCase();
      if(/follow|like|share|tweet|subscribe|play|open|invite|start|watch|watch now/i.test(text)) {
        const all = JSON.parse(localStorage.getItem(KEY_MISSIONS) || '{}');
        all[id].status = 'completed';
        all[id].progress = 100;
        localStorage.setItem(KEY_MISSIONS, JSON.stringify(all));
        setBalance(getBalance() + (all[id].reward || 10));
        applyStatesToDOM();
        // small UI change
        btn.classList.add('btn-disabled');
        btn.innerText = 'Done';
      }
      // Spin Now button: open spin modal
      if(btn.innerText.toLowerCase().includes('spin')) {
        openSpinModal();
      }
      // Copy link button
      if(btn.innerText.toLowerCase().includes('copy link')) {
        const link = location.href + '?ref=YOU';
        navigator.clipboard?.writeText(link).then(()=> {
          btn.innerText = 'Copied';
          setTimeout(()=> btn.innerText = 'Copy Link', 900);
        }).catch(()=> alert('Copy failed'));
      }
    }
  });

  // Spin modal logic
  const openSpinModal = () => {
    const today = new Date().toISOString().slice(0,10);
    const used = localStorage.getItem(FREE_SPIN_KEY);
    const freeAvailable = used !== today; // one free per day
    const body = `
      <div class="text-center">
        <div class="pointer" style="margin:0 auto;"></div>
        <div class="wheel mx-auto my-3" id="spin-wheel" style="width:220px;height:220px;border-radius:50%;"></div>
        <div class="muted">Free spin: ${freeAvailable ? 'Available' : 'Used'}</div>
      </div>
    `;
    const footer = `<button class="btn btn-sm btn-outline-light" id="spinBtn">Spin</button>`;
    const modal = createBootstrapModal('spinModal', 'Quick Spin', body, footer);
    modal.show();
    setTimeout(()=> {
      const spinBtn = document.getElementById('spinBtn');
      spinBtn.addEventListener('click', ()=> {
        if(!freeAvailable) {
          // small paid simulation — still allow but less reward
        }
        spinBtn.disabled = true;
        // spin animation: random degrees
        const wheel = document.getElementById('spin-wheel');
        const deg = Math.floor(Math.random() * 360) + 720;
        wheel.style.transition = 'transform 3s cubic-bezier(.1,.9,.2,1)';
        wheel.style.transform = `rotate(${deg}deg)`;
        setTimeout(()=> {
          const prize = Math.floor(Math.random()*46) + 5; // 5-50
          // mark used free spin
          localStorage.setItem(FREE_SPIN_KEY, new Date().toISOString().slice(0,10));
          setBalance(getBalance() + prize);
          modal.hide();
          alert(`You won ${prize} coins!`);
        }, 3200);
      });
    }, 100);
  };

  // Subscribe flow (example)
  document.querySelectorAll('.card-mission button').forEach(b => {
    if(b.innerText.toLowerCase().includes('subscribe')) {
      b.addEventListener('click', (e) => {
        // pretend subscribe
        const id = b.closest('.card-mission')?.dataset.missionId;
        const all = JSON.parse(localStorage.getItem(KEY_MISSIONS) || '{}');
        if(id && all[id]) {
          all[id].status = 'completed';
          all[id].progress = 100;
          localStorage.setItem(KEY_MISSIONS, JSON.stringify(all));
          setBalance(getBalance() + (all[id].reward || 10));
          applyStatesToDOM();
        }
        b.innerText = 'Subscribed';
        b.classList.add('btn-disabled');
        alert('Subscribed! Coins added.');
      });
    }
  });

  // At first load, apply states
  applyStatesToDOM();

  // Expose a simple API for backend integration later:
  window.EarnForce = {
    getState: () => ({
      balance: getBalance(),
      missions: JSON.parse(localStorage.getItem(KEY_MISSIONS) || '{}'),
      freeSpinDate: localStorage.getItem(FREE_SPIN_KEY) || null
    }),
    setStateFromBackend: (obj) => {
      if(obj.balance !== undefined) localStorage.setItem(KEY_BAL, String(obj.balance));
      if(obj.missions) localStorage.setItem(KEY_MISSIONS, JSON.stringify(obj.missions));
      if(obj.freeSpinDate) localStorage.setItem(FREE_SPIN_KEY, obj.freeSpinDate);
      setBalance(getBalance());
      applyStatesToDOM();
    },
    clearAllLocal: () => {
      localStorage.removeItem(KEY_BAL);
      localStorage.removeItem(KEY_MISSIONS);
      localStorage.removeItem(FREE_SPIN_KEY);
      location.reload();
    }
  };

  // ======================
//  USER BALANCE — will sync with backend later
// ======================
let userBalance = 149;

// Show balance
function renderBalance() {
    const bal = document.querySelector(".balance-value");
    bal.textContent = userBalance;
}

// ======================
//  MISSIONS SYSTEM
// ======================
// All missions list
let missions = [
    { id: "m1", reward: 20, status: "pending" },
    { id: "m2", reward: 10, status: "pending" },
    { id: "m3", reward: 50, status: "pending" }
];

// Save missions (frontend only right now)
function saveMissions() {
    localStorage.setItem("missions", JSON.stringify(missions));
}

// Load missions
function loadMissions() {
    const saved = localStorage.getItem("missions");
    if (saved) missions = JSON.parse(saved);
}
loadMissions();

// ======================
//  COMPLETE MISSION FUNCTION
// ======================
function completeMission(id) {

    let m = missions.find(x => x.id === id);

    // 1. Check if mission exists
    if (!m) return console.log("Mission not found");

    // 2. If already completed → Prevent double earning
    if (m.status === "completed") {
        console.log("Mission already completed!");
        return;
    }

    // 3. Mark as completed
    m.status = "completed";
    saveMissions();

    // 4. Add coins AFTER completion
    userBalance += m.reward;
    renderBalance();

    // 5. UI feedback
    const btn = document.querySelector(`#${id}`);
    if (btn) {
        btn.textContent = "Completed ✔️";
        btn.classList.add("completed-btn");
        btn.disabled = true;
    }

    // 6. Optional coin animation
    coinPop(m.reward);
}

// ======================
//  COIN POP ANIMATION
// ======================
function coinPop(amount) {
    const pop = document.createElement("div");
    pop.classList.add("coin-pop");
    pop.textContent = `+${amount}`;
    document.body.appendChild(pop);

    setTimeout(() => pop.remove(), 1000);
}

renderBalance();


  // Debug: quick console hint
  console.log('EarnForce client JS loaded. API: window.EarnForce');
})();


</script>

</body>
</html>
