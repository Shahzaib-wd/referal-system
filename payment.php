<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Withdraw Payment - RewardZone</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --bg: #0f0f1e;
      --glass: rgba(255,255,255,0.04);
      --glass-2: rgba(255,255,255,0.03);
      --accent-from: #7c4dff;
      --accent-to: #ad00ff;
      --muted: rgba(255,255,255,0.7);
      --error-color: #ff4d4f;
      --card-shadow: 0 6px 20px rgba(14,10,30,0.6);
      font-family: 'Poppins', system-ui;
    }

    *{box-sizing:border-box;margin:0;padding:0}
    body{background: #0f0f1e;color:rgb(0, 0, 0);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px}

    .payment-card{background:var(--glass);backdrop-filter:blur(10px);padding:24px;border-radius:16px;max-width:400px;width:100%;box-shadow:var(--card-shadow);}
    h2{text-align:center;margin-bottom:20px;font-weight:700}

    label{display:block;margin-top:12px;font-size:14px;color:var(--muted)}
    input{width:100%;padding:10px;margin-top:6px;border-radius:10px;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.05);color:#eef;font-size:14px}
    .error-text{color:var(--error-color);font-size:12px;margin-top:4px;display:none;}

    .payment-icons{display:flex;gap:12px;margin-top:10px}
    .payment-icons div{
      flex:1;text-align:center;padding:12px;border-radius:12px;background:rgba(255,255,255,0.05);cursor:pointer;transition:0.2s;display:flex;align-items:center;justify-content:center;gap:8px;
    }
    .payment-icons div img{width:32px;height:auto;}
    .payment-icons div:hover{background: linear-gradient(135deg,#ffc107,#e2aa02);color:#000000}
    .payment-icons .active{background: linear-gradient(135deg,#ffc107,#e2aa02);color:#000000}

    .submit-btn{margin-top:20px;width:100%;padding:12px;background: linear-gradient(135deg,#ffc107,#e2aa02);border:none;border-radius:12px;color:#000000;font-weight:600;cursor:pointer;transition:0.2s}
    .submit-btn:hover{transform:translateY(-2px);}

    .trust-text{margin-top:14px;text-align:center;font-size:12px;color:var(--muted);display:flex;align-items:center;justify-content:center;gap:6px}
    .trust-text i{color:#6effb3}

    @media(max-width:500px){
      .payment-card{padding:16px}
      input{padding:8px;font-size:13px}
      .payment-icons div{padding:10px;font-size:13px}
      .submit-btn{padding:10px;font-size:14px}
    }
  </style>
</head>
<body>

<div class="payment-card">
  <h2 style="color: white;">Withdraw Funds</h2>
  
  <label>Select Payment Method</label>
  <div class="payment-icons">
    <div id="easy" style="color: white;">
      <img src="easy.jpg" alt="EasyPaisa">
      EasyPaisa 
    </div>
    <div id="jazz" style="color: white;">
      <img src="jazz.jpg" alt="JazzCash">
      JazzCash
    </div>
  </div>

  <label>Holder Name</label>
  <input type="text" id="holder" placeholder="Full Name" />
  <div id="holder-error" class="error-text">Please enter a valid name (letters only)</div>

  <label>Enter Amount</label>
  <input type="number" id="amount" placeholder="PKR 650" min="650" />
  <div id="amount-error" class="error-text">Minimum withdrawal amount is PKR 650</div>

  <label>Enter Your Number</label>
  <input type="text" id="number" placeholder="03XXXXXXXXX" maxlength="11" />
  <div id="number-error" class="error-text">Please enter a valid phone number</div>

  <button class="submit-btn" onclick="submitPayment()">Submit Payment</button>

  <div class="trust-text">
    <i class="fas fa-lock">Secure & Trusted Payment</i> 
  </div>
</div>

<script>
let selectedMethod = '';

const easy = document.getElementById('easy');
const jazz = document.getElementById('jazz');
const holderInput = document.getElementById('holder');
const numberInput = document.getElementById('number');
const amountInput = document.getElementById('amount');
const input       = document.querySelectorAll('input');

const holderError = document.getElementById('holder-error');
const numberError = document.getElementById('number-error');
const amountError = document.getElementById('amount-error');

// Select payment method
easy.onclick = () => selectMethod('EasyPaisa', easy);
jazz.onclick = () => selectMethod('JazzCash', jazz);


function selectMethod(method, element){
  selectedMethod = method;
  easy.classList.remove('active');
  jazz.classList.remove('active');
  element.classList.add('active');
  
  
}

// Regex patterns
const nameRegex = /^[A-Za-z ]+$/;
const phoneRegex = /^03\d{9}$/;

// Real-time validation
holderInput.addEventListener('input', () => {
  holderError.style.display = nameRegex.test(holderInput.value.trim()) ? 'none' : 'block';
});

numberInput.addEventListener('input', () => {
  numberError.style.display = phoneRegex.test(numberInput.value.trim()) ? 'none' : 'block';
});

amountInput.addEventListener('input', () => {
  amountError.style.display = amountInput.value > 0 ? 'none' : 'block';
});

// Submit payment
function submitPayment(){
  let valid = true;
input.value="";
  if(!selectedMethod){
    alert('Please select a payment method');
    valid = false;
  }

  if(!nameRegex.test(holderInput.value.trim())){
    holderError.style.display = 'block';
    valid = false;
  }

  if(!amountInput.value || amountInput.value < 650){
    amountError.style.display = 'block';
    valid = false;
  }

  if(!phoneRegex.test(numberInput.value.trim())){
    numberError.style.display = 'block';
    valid = false;
  }

  if(!valid) return;

  alert(`Your payment of Rs ${amountInput.value} will be successful within 24 hrs via ${selectedMethod}.`);
}
</script>




</body>
</html>
