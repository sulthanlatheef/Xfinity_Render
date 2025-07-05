<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>XFINITY – Create Your Free Account</title>
  <!-- Font Awesome for icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <!-- Particles.js -->
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js" defer></script>
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <style>
    :root {
      --gradient-start: #FF5722;
      --gradient-end:   #FF8A50;
      --bg-dark:        #0d0d0d;
      --card-bg:        rgba(255,255,255,0.08);
      --text-light:     #eef2f7;
      --input-bg:       rgba(255,255,255,0.12);
      --focus-color:    #FF8A50;
      --radius:         12px;
      --transition:     0.4s ease;
      --icon-size:      1.2rem;
      --input-padding:  0.75rem 1rem;
    }
    *, *::before, *::after { box-sizing: border-box; }
    body, html {
      margin: 0; padding: 0;
      width: 100%; height: 100%;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: var(--text-light);
      background: var(--bg-dark);
      overflow-x: hidden;
    }
    #particles-js { position: absolute; inset: 0; z-index: 0;   pointer-events: none !important;}

    /* Navbar */
    .navbar {
      position: fixed; top: 0; left: 0; right: 0; z-index: 999;
      display: flex; justify-content: space-between; align-items: center;
      padding: 1rem 2rem;
      background: rgba(0,0,0,0.5);
      backdrop-filter: blur(12px);
    }
    .logo {
      font-size: 1.8rem; font-weight: 700;
      background: linear-gradient(45deg, var(--gradient-start), var(--gradient-end));
      -webkit-background-clip: text; color: transparent;
    }
    .nav-links a {
      cursor:pointer;
      margin-left: 1.5rem; color: #fff; text-decoration: none;
      transition: color var(--transition);
    }
    .nav-links a:hover { color: var(--gradient-start); }

    /* Container & Card */
    .container {
      position: relative; z-index: 2;
      display: flex; justify-content: center; align-items: flex-start;
      padding: 120px 1rem 2rem; min-height: 100vh;
    }
    .register-card {
      width: 100%; max-width: 700px;
      background: var(--card-bg);
      border-radius: var(--radius);
      padding: 2.5rem;
 
      box-shadow: 0 8px 24px rgba(0,0,0,0.6);
      backdrop-filter: blur(15px);
      transition: transform var(--transition);
    }
    .register-card:hover { transform: translateY(0px); }

    /* Steps */
  .step-progress {
  position: relative;
  display: flex;
  justify-content: space-between;
  margin: 0px 10px;
  margin-bottom:10px;
  padding: 20px 0;
  transform:translateY(-15px);
}

.redline {
    transform:translateY(-9px);
  position: absolute;
  top: 50%; /* Adjust to sit behind the middle of the icons */
  left: 60px;
  right: 60px;
  height: 2.5px;
  background:rgb(255, 255, 255);
  z-index: 0; /* Push behind everything else */
}

.step {
  position: relative;
  text-align: center;
  z-index: 1;
  flex: 1;
}

.icon {
  position: relative;
  z-index: 10;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  background: white;
  border: 2px solid rgb(255, 255, 255);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  margin: 0 auto 8px auto;
  color: #333;
}

   
    .step:first-child::before { display: none; }
   
    .step.active, .step.completed { color: #fff; }
    .step.active .icon {
      background: linear-gradient(45deg, var(--gradient-start), var(--gradient-end));
     border:2.5px solid rgb(255, 255, 255);
    }
    .step.completed .icon {
      background:rgb(65, 221, 3); color: var(--bg-dark); border:2.5px solid rgb(255, 255, 255);
    }

    /* Form Steps */
    .form-step { display: none; animation: fadeIn .5s forwards; }
    .form-step.active { display: block; }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .form-heading {
      font-size: 1.5rem; margin-bottom: .5rem; text-align: center;
      background: linear-gradient(45deg, var(--gradient-start), var(--gradient-end));
      -webkit-background-clip: text; color: transparent;
    }
    .form-desc {
      font-size: .95rem; opacity: .8; text-align: center; margin-bottom: 1.5rem;
    }

    /* Inputs */
    .form-group {
      position: relative; margin-top: 1rem;
    }
    .form-group label {
      display: block; margin-bottom: .3rem; font-size: .9rem;
      color: rgba(255,255,255,0.7);
    }
    .form-group input {
      width: 100%;
      padding: var(--input-padding);
      padding-right: 3rem; /* space for icon */
      border: none; border-radius: var(--radius);
      background: var(--input-bg); color: #fff;
      font-size: 1rem;
      transition: background var(--transition), box-shadow var(--transition);
    }
    .form-group input:focus {
      background: rgba(255, 255, 255, 0.12);
      outline: none;
      box-shadow: 0 0 0 2px var(--focus-color);
    }
    .form-group .fa-icon {
      position: absolute; top: 50%; right: 1rem;
      transform: translateY(0%);
      font-size: var(--icon-size);
      color: #ccc;
      pointer-events: none;
      transition: color var(--transition);
    }
    .form-group input:focus + .fa-icon {
      color: var(--focus-color);
    }
    .error {
  position: absolute;
  opacity: 0;
  color:red;
  pointer-events: none;
  font-size: 0; /* Ensure it doesn’t take up space */
}


    .details-grid {
      display: grid; grid-template-columns: repeat(auto-fit, minmax(200px,1fr));
      gap: 1rem;
    }

    /* Buttons */
    .btn-group {
      display: flex; justify-content: flex-end; gap: .8rem; margin-top: 2rem;
    }
    .btn {
      
      position: relative; overflow: hidden;
     
      padding: .75rem 1.6rem;
      border: none; border-radius: var(--radius);
      background: linear-gradient(45deg, var(--gradient-start), var(--gradient-end));
      color: #fff; cursor: pointer;
      transition: transform var(--transition), box-shadow var(--transition);
    }
    .btn::before {
      content: ''; position: absolute; inset: 0;
      background: rgba(255,255,255,0.1);
      transform: scaleX(0); transform-origin: left;
      transition: transform var(--transition);
    }
    .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.4);
    }
    .btn:hover::before { transform: scaleX(1); }
    .btn:active { transform: translateY(0); }
    .btn--secondary {
      background: transparent; border: 2px solid var(--text-light);
      color: var(--text-light);
    }
    .btn--secondary:hover {
      background: var(--text-light); color: var(--bg-dark);
    }
    

    @media (max-width: 600px) {
      .step-progress { grid-template-columns: 1fr; }
      .step::before { display: none; }
    }
    /* Override Chrome autofill white background */
 /* Override Chrome autofill white background */
/* 1. Force the dark RGBA background on autofill */
.form-group input:-webkit-autofill,
.form-group input:-webkit-autofill:hover,
.form-group input:-webkit-autofill:focus {
  background-color: rgba(255, 255, 255, 0.12) !important;
  -webkit-box-shadow: inset 0 0 0 1000px rgba(255, 255, 255, 0.12) !important;
          box-shadow: inset 0 0 0 1000px rgba(255, 255, 255, 0.12) !important;
  background-clip: padding-box !important;
  -webkit-text-fill-color: #fff !important;
  caret-color: #fff !important;
  transition: background-color 5000s ease-in-out 0s !important;
}

/* 2. Re-apply your default border on autofill */
.form-group input:-webkit-autofill,
.form-group input:-webkit-autofill:hover,
.form-group input:-webkit-autofill:focus {
  border: 1px solid rgba(255,255,255,0.5) !important; /* default input border */
}

/* 3. Orange focus ring when autofilled+focused */
.form-group input:-webkit-autofill:focus {
  border-color: var(--focus-color) !important;
  box-shadow: 0 0 0 1px var(--focus-color) !important;
}
.form-group input:-webkit-autofill {
  

 border: none !important;
  outline: none !important;
  box-shadow: 0 0 0 0px rgba(15, 15, 15, 0.61)!important;
}
.form-group input:-webkit-autofill:hover {
  border: none !important;
  outline: none !important;
  box-shadow: 0 0 0 1px  rgba(15, 15, 15, 0.61) !important;
}
.red-placeholder::placeholder {
    color:rgb(154, 152, 152);
}



@keyframes shake {
  0% { transform: translateX(0); }
  20% { transform: translateX(-8px); }
  40% { transform: translateX(8px); }
  60% { transform: translateX(-6px); }
  80% { transform: translateX(6px); }
  100% { transform: translateX(0); }
}

.gsignup {
  margin-right:10px;
  background-color:rgb(255, 106, 0);
  padding-top: 10px;
  padding-right: 35px;
  padding-bottom: 10px;
  padding-left: 60px;
  color: white;
  border: none;
  border-radius: 50px;
  text-align: center;
  text-decoration: none;
  font-weight: 650;
  font-size:17.5px;
  position:relative;
  transition:all .3s ease-in;
}

.gsignup:hover{

  transform:translateY(-1.3px);
}


  </style>
</head>
<body>
  <div id="particles-js"></div>
  <nav class="navbar">
    <div class="logo">XFINITY</div>
    <div style="cursor:pointer;"class="nav-links">
      <p style="">Already have an account? <a style="margin-left:3px;"href="<?php echo site_url('Home'); ?>">Login here</a></p>
    </div>
  </nav>

  <div class="container">
    <div class="register-card">
    <div class="step-progress">
  <div class="redline"></div>

  <div class="step active">
    <div class="icon"><i class="fas fa-user"></i></div>
    <div class="label">User Info</div>
  </div>
  <div class="step">
    <div class="icon"><i class="fas fa-address-card"></i></div>
    <div class="label">Details</div>
  </div>
  <div class="step">
    <div class="icon"><i class="fas fa-key"></i></div>
    <div class="label">OTP</div>
  </div>
  <div class="step">
    <div class="icon"><i class="fas fa-check"></i></div>
    <div class="label">Confirm</div>
  </div>
</div>


      <form id="regForm" action="register/submit" method="POST" novalidate>
        <input type="hidden" name="email" id="emailHidden"/>

        <!-- Step 1 -->
        <section class="form-step active" data-step="1">
  <div class="form-heading" style="font-size:28px;">Welcome to <span style="font-weight:bold;">XFINITY!</span></div>

  <div class="form-desc">
    <lottie-player src="https://lottie.host/ebb466e6-bf3c-4823-93c4-c3949ba8741b/9Ve4ObJiJE.json"
      background="transparent" speed="1" loop autoplay
      style="margin-left:-10px; transform:translateY(30px);display:inline-block;width: 200px; height:200px;padding-top:20px;margin-top:-75px;">
    </lottie-player>
  </div>

  <div class="form-desc">
    Enter the email you’d like to use to access our exclusive services.
  </div>

  <div class="form-group">
    <label for="email"></label>
    <input type="email" id="email" name="email" placeholder="you@example.com" required />
    <i class="fas fa-envelope fa-icon" style="transform:translateY(-11px);"></i>
    <div class="error" id="emailError"></div>
  </div>

  <div class="btn-group" style="">
     <a href="<?= base_url('index.php/register2/googlecallback'); ?>" 
       class="gsignup">
       <img style= "padding:2px 2px;background:white;border-radius:7px;width:26px; height:26px;position:absolute;left:23px;" src="https://img.icons8.com/color/48/google-logo.png" alt="google-logo"/>Sign up with Google
    </a>
    <button type="button" class="btn" id="nextBtn1" style="">
      Next <i class="fas fa-arrow-right" style="margin-left:10px"></i>
    </button>
   
  </div>
</section>


        <!-- Step 2 -->
        <section class="form-step" data-step="2">
          <div class="form-heading" style="font-size:30px;margin-bottom:18px;">Tell Us About Yourself</div>
          <div class="form-desc">We just need a few details to personalize your experience.</div>
          <div class="details-grid">
            <div class="form-group">
              <label for="name">Full Name </label>
            <input id="name" name="name" data-original-placeholder="Full Name" placeholder="Full Name" ... />
              <i class="fas fa-id-card fa-icon"></i>
              <div class="error" id="nameError"></div>
            </div>
            <div class="form-group">
              <label for="username">Choose a Username </label>
             <input id="username" name="username" data-original-placeholder="Username" placeholder="Username" ... />
              <i class="fas fa-user fa-icon"></i>
              <div class="error" id="usernameError"></div>
            </div>
            <div class="form-group">
              <label for="contact">Contact Number </label>
              <input id="contact" name="contact" data-original-placeholder="Contact Number" placeholder="Contact Number" ... />
              <i class="fas fa-phone fa-icon"></i>
              <div class="error" id="contactError"></div>
            </div>
            <div class="form-group">
              <label for="password">Create a Password </label>
              <input id="password" name="password" data-original-placeholder="Password" placeholder="Password" ... />
              <i class="fas fa-lock fa-icon"></i>
              <div class="error" id="passwordError"></div>
            </div>
          </div>
          <div class="btn-group">
           
            <button type="button" class="btn" id="nextBtn2">
              Next <i class="fas fa-arrow-right" style="margin-left:8px"></i>
            </button>
          </div>
        </section>

        <!-- Step 3 -->
        <section class="form-step" data-step="3">
          <div class="form-heading">Verify Your Account</div>
          <div id="otpInstruction" class="form-desc">We’ve sent a one-time code to your email. Enter it below to confirm you’re you.</div>
          <div class="form-group">
            <label for="otp">One-Time Password *</label>
           <input id="otp" name="otp" data-original-placeholder="Enter OTP Here" placeholder="Enter OTP Here" />

            <i class="fas fa-key fa-icon"></i>
            <div class="error" id="otpError"></div>
          </div>
         <p class="form-desc" id="otpTimerText">
  OTP expires in <strong style="color:red; font-size:16px;" id="otpCountdown">5:00</strong>
</p>
<p class="form-desc" id="resendOtpWrapper" style="display:none;">
  Didn’t receive it? <a  style="color:white;font-weight:bold;" href="#" id="resendOtp">Resend OTP</a>
</p>

          <div class="btn-group">
            
              
            <button type="button" style="font-size:17px;"class="btn" id="nextBtn3">
              Verify <i class="fas fa-shield-halved" style="margin-left:2px"></i>
            </button>
          </div>
        </section>

        <!-- Step 4 -->
    <section class="form-step" data-step="4">
  <!-- Initially visible registration panel -->
  <div class="form-heading" style="font-size:25px; font-weight:bold;">All Set!</div>
  <div class="lottie">
   <lottie-player
      src="https://lottie.host/507a1221-4e48-4e87-b305-bd5e10361bd1/FokzMiOxqc.json"
      background="transparent"  speed="1.5"
      style="width:210px; height:210px; margin:0 auto;"
      loop
      autoplay>
    </lottie-player>
           </div>
  <div class="form-desc">Click “Register” to finalize your new XFINITY account.</div>
  <div class="btn-group">
   
    <button type="button" class="btn" id="registerBtn">
      <i class="fas fa-user-check" style="margin-right:8px"></i>Register
    </button>
  </div>

  <!-- Hidden confirmation card -->
  <div id="confirmationMessage" class="confirmation-card" style="display:none;">
    <lottie-player
      src="https://lottie.host/034fa478-5474-4a40-9e0b-9d920b449ae1/QSPEoPwFgN.json"
      background="transparent"  speed="1"
      style="width:180px; height:180px; margin:0 auto;"
      loop
      autoplay>
    </lottie-player>

    <h3 class="confirm-title" style="color: #ff7500;text-align:center; font-size:26px;">Registration Successful!</h3>
    <p class="confirm-sub" style="color:rgb(4, 255, 0) ;text-align:center;">Your account is now active.</p>

    <button type="button" class="btn btn--secondary"  style="margin-left:234px;" id="goLoginBtn" onclick="window.location.href='<?php echo site_url('Home'); ?>';">
      <i class="fas fa-sign-in-alt" style="margin-right:8px"></i>Go to Login
    </button>
  </div>
</section>


      </form>
    </div>
  </div>
<script>
let countdownDuration = 5 * 60; // 5 minutes in seconds
let countdownInterval;

function startOtpCountdown() {
  let remainingTime = countdownDuration;
  const countdownEl = document.getElementById('otpCountdown');
  const otpTimerText = document.getElementById('otpTimerText');
  const resendWrapper = document.getElementById('resendOtpWrapper');

  countdownEl.textContent = formatTime(remainingTime);

  countdownInterval = setInterval(() => {
    remainingTime--;
    countdownEl.textContent = formatTime(remainingTime);

    if (remainingTime <= 0) {
      clearInterval(countdownInterval);
      otpTimerText.style.display = 'none';
      resendWrapper.style.display = 'block';
    }
  }, 1000);
}

function formatTime(seconds) {
  const m = Math.floor(seconds / 60).toString().padStart(2, '0');
  const s = (seconds % 60).toString().padStart(2, '0');
  return `${m}:${s}`;
}3

// Handle resend OTP click
document.getElementById('resendOtp').onclick = function (e) {
  e.preventDefault();

  const email = document.getElementById('emailHidden').value;

  // Call your backend to regenerate and send a new OTP
 fetch('register/otp', {   
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ email: email })
  })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        // Restart the countdown
        document.getElementById('otpTimerText').style.display = 'block';
        document.getElementById('resendOtpWrapper').style.display = 'none';
        startOtpCountdown();
      } else {
        alert('Failed to resend OTP. Please try again.');
      }
    })
    .catch(error => {
      console.error('Error resending OTP:', error);
    });
};

// Start countdown when the page or step is shown
startOtpCountdown();
</script>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      particlesJS('particles-js', {
        particles: {
          number:      { value: 60, density: { enable: true, value_area: 800 } },
          color:       { value: '#ffffff' },
          shape:       { type: 'circle' },
          opacity:     { value: 0.5, random: true },
          size:        { value: 3, random: true },
          line_linked: { enable: true, distance:150, color:'#fff', opacity:0.4, width:1 },
          move:        { enable: true, speed: 2 }
        },
        interactivity: {
          detect_on: 'canvas',
          events: {
            onhover: { enable: true, mode: 'grab' },
            onclick: { enable: true, mode: 'push' }
          },
          modes: {
            grab: { distance: 140, line_linked: { opacity: 0.5 } },
            push: { particles_nb: 4 }
          }
        },
        retina_detect: true
      });

      const steps   = [...document.querySelectorAll('.form-step')];
      const tabs    = [...document.querySelectorAll('.step-progress .step')];
      const show    = idx => {
        steps.forEach((s,i) => s.classList.toggle('active', i === idx));
        tabs.forEach((t,i) => {
          t.classList.toggle('active', i === idx);
          t.classList.toggle('completed', i < idx);
        });
      };

      const nxt1     = document.getElementById("nextBtn1");

     document.getElementById('nextBtn1').addEventListener('click', function () {
  const emailInput = document.getElementById('email');
  const email = emailInput.value.trim();

  const isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

  if (!isValidEmail) {
    emailInput.value = '';
     emailInput.classList.add('red-placeholder');

    emailInput.placeholder = 'Enter a valid email address';
    emailInput.classList.add('shake');
    emailInput.style.boxShadow = '0 0 0 2px rgb(255, 17, 0)';

    setTimeout(() => {
       emailInput.classList.remove('red-placeholder');

      emailInput.placeholder = 'you@example.com';
      emailInput.classList.remove('shake');
      emailInput.style.boxShadow = '';
    }, 2000);
  } else {
    // Send to backend for existence check
   nxt1.innerHTML = '<i style="font-size:17.5px;padding-right:18px;padding-left:17.5px;"class="fas fa-spinner fa-spin"></i>';
    fetch('Register/validate_email', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ email: email })
    })
    .then(res => res.json())
    .then(response => {
      if (response.status === 'error' && response.errors && response.errors.email) {
        nextBtn1.innerHTML = 'Next <i style="margin-left:10px;"class="fas fa-arrow-right"></i> ';
        emailInput.value = '';
          emailInput.classList.add('red-placeholder');
        emailInput.placeholder = response.errors.email;
        emailInput.classList.add('shake');
        emailInput.style.boxShadow = '0 0 0 2px rgb(255, 17, 0)';

        setTimeout(() => {
            emailInput.classList.remove('red-placeholder');
          emailInput.placeholder = 'you@example.com';
          emailInput.classList.remove('shake');
          emailInput.style.boxShadow = '';
        }, 2000);
      } else {
        document.getElementById('emailHidden').value = email;
        show(1);
      }
    });
  }
});



      // Step 2
document.getElementById('nextBtn2').onclick = async () => {
  // Clear previous errors visually
  ['name', 'username', 'contact', 'password'].forEach(f => {
    const input = document.getElementById(f);
    const errorElem = document.getElementById(f + 'Error');
    errorElem.textContent = '';
    input.style.boxShadow = '';
    input.classList.remove('shake');
    input.placeholder = input.getAttribute('data-original-placeholder') || '';
  });
  
  const nxt2     = document.getElementById("nextBtn2"); 

  const payload = {
    name:     document.getElementById('name').value.trim(),
    username: document.getElementById('username').value.trim(),
    contact:  document.getElementById('contact').value.trim(),
    password: document.getElementById('password').value
  };

  try {
    nxt2.innerHTML = '<i style="font-size:15px;padding-bottom:-5px;padding-right:18px;padding-left:18px;"class="fas fa-spinner fa-spin"></i>';
    const res  = await fetch('register/validate_details', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(payload)
    });
    const data = await res.json();

    if (data.status === 'error') {
      nextBtn2.innerHTML = 'Next <i style="margin-left:5px;"class="fas fa-arrow-right"></i> ';
      // For each field with an error, show the error using placeholder + shake + red border
      for (let [field, msg] of Object.entries(data.errors)) {
        const input = document.getElementById(field);
        const errorElem = document.getElementById(field + 'Error');

        // Clear input value and set placeholder to error message
        input.value = '';
    


        input.placeholder = msg;

        // Add red border + shake class
        input.style.boxShadow = '0 0 0 2px rgb(255, 17, 0)';

        input.classList.add('shake');

        // Also update the visible error text (optional)
        errorElem.textContent = msg;

        // Remove the effect after 2 seconds and reset placeholder
        setTimeout(() => {
          input.classList.remove('red-placeholder');

          input.placeholder = input.getAttribute('data-original-placeholder') || '';
          input.classList.remove('shake');
          input.style.boxShadow = '';
          errorElem.textContent = '';
        }, 2000);
      }
    } else {
       const nextBtn = document.getElementById('nextBtn2');
       nextBtn.disabled = true; // Disable the button immediately
       nextBtn.textContent = 'Hold On!'; 
  // Send email to backend to generate OTP
  const email = document.getElementById('emailHidden').value;

  try {
    const otpRes = await fetch('register/otp', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ email: email })
    });
    const otpData = await otpRes.json();

    if (otpData.status === 'success') {
      const email = document.getElementById('emailHidden').value;
      const otpInstruction = document.getElementById('otpInstruction');
      otpInstruction.innerHTML = `We’ve sent a one-time verification code to <strong>${email}</strong>`;
      show(2); // Continue to OTP entry step
    } else {
      alert('Failed to generate OTP. Please try again.');
    }
  } catch {
    alert('Server error during OTP generation.');
  }
}

  } catch {
    alert('Server error – please try again later.');
  }
};


      // Step 3
document.getElementById('nextBtn3').onclick = () => {
  const nxt3     = document.getElementById("nextBtn3"); 
  const otpEl = document.getElementById('otp');
  const err = document.getElementById('otpError');
  const otpValue = otpEl.value.trim();

  err.textContent = '';
  otpEl.style.boxShadow = '';
  otpEl.classList.remove('shake');

  // Basic input validation
  if (!otpValue) {
    otpEl.placeholder = 'Please enter the OTP';
    otpEl.style.boxShadow = '0 0 0 2px #f44336';
    return;
  }
  nxt3.innerHTML = 'Verify <i style="font-size:15px;margin-left:4px;"class="fas fa-spinner fa-spin"></i>';
  // Send OTP to server for verification
 fetch('register/verify_otp', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ otp: otpValue })
  })
  .then(response => response.json())
  .then(data => {
  if (data.status === 'success') {
    otpEl.value = '';
    otpEl.placeholder = 'Otp validated successfully!';
    otpEl.style.boxShadow = '0 0 0 2px rgb(64, 255, 0)';
    err.textContent = data.message;
    otpEl.classList.add('shake');

    setTimeout(() => {
      show(3); // Proceed to next step
    }, 1500);

  } else if (data.status === 'expired') { 
    nxt3.innerHTML = 'Verify <i style="font-size:15px;margin-left:4px;"class="fas fa-shield-halved "></i>';
    otpEl.value = '';
    otpEl.placeholder = data.message;
    otpEl.style.boxShadow = '0 0 0 2px orange';
    otpEl.classList.add('shake');
    err.textContent = data.message;

    setTimeout(() => {
      otpEl.placeholder = otpEl.getAttribute('data-original-placeholder') || 'Enter OTP';
      otpEl.style.boxShadow = '';
      otpEl.classList.remove('shake');
      err.textContent = '';
    }, 3000);

  } else if (data.status === 'invalid') {
    nxt3.innerHTML = 'Verify <i style="font-size:15px;margin-left:4px;"class="fas fa-shield-halved "></i>';
    otpEl.value = '';
    otpEl.placeholder = data.message;
    otpEl.style.boxShadow = '0 0 0 2px #f44336';
    otpEl.classList.add('shake');
    err.textContent = data.message;

    setTimeout(() => {
      otpEl.placeholder = otpEl.getAttribute('data-original-placeholder') || 'Enter OTP';
      otpEl.style.boxShadow = '';
      otpEl.classList.remove('shake');
      err.textContent = '';
    }, 2000);
  }

  else if (data.status === 'cleared') {
    nxt3.innerHTML = 'Verify <i style="font-size:15px;margin-left:4px;"class="fas fa-shield-halved "></i>';
    otpEl.value = '';
    otpEl.placeholder = data.message;
    otpEl.style.boxShadow = '0 0 0 2px #f44336';
    otpEl.classList.add('shake');
    err.textContent = data.message;

    setTimeout(() => {
      otpEl.placeholder = otpEl.getAttribute('data-original-placeholder') || 'Enter OTP';
      otpEl.style.boxShadow = '';
      otpEl.classList.remove('shake');
      err.textContent = '';
    }, 2000);
  }
})

  .catch(error => {
    console.error('Error verifying OTP:', error);
    err.textContent = 'Something went wrong. Please try again.';
    otpEl.style.boxShadow = '0 0 0 2px #f44336';
  });
};



      // Back buttons
      ['backBtn2','backBtn3','backBtn4'].forEach((id, i) => {
        document.getElementById(id).onclick = () => show(i);
      });
    });
    document.getElementById('registerBtn').addEventListener('click', async function(e) {
  // 1) Grab the current step container via `this.closest`
  const stepEl  = this.closest('.form-step');
   const nxt4     = document.getElementById("registerBtn"); 
  // 2) Find the button group inside *that* step
  const btnGroup = stepEl.querySelector('.btn-group');
  const confMsg  = stepEl.querySelector('#confirmationMessage');

  // disable them while we submit
  btnGroup.querySelectorAll('button').forEach(btn => btn.disabled = true);

  // gather data
  const formEl  = document.getElementById('regForm');
  const formData = new FormData(formEl);
  nxt4.innerHTML = '<i style="font-size:15px;padding-bottom:-5px;padding-right:18px;padding-left:18px;"class="fas fa-spinner fa-spin"></i>';

  try {
    const res  = await fetch('register/submit', {
      method: 'POST',
      body:   formData
    });
    const data = await res.json();

    if (data.status === 'success') {
      // hide the original header + description + buttons
      stepEl.querySelector('.form-heading').style.display = 'none';
      stepEl.querySelector('.form-desc'   ).style.display = 'none';
        stepEl.querySelector('.lottie'   ).style.display = 'none';
      btnGroup.style.display = 'none';

      // show your confirmation block
      confMsg.style.display  = 'block';
    } else {
      nxt4.innerHTML = ' <i class="fas fa-user-check" style="margin-right:8px"></i>Register';
      // server returned an error
      alert(data.message || 'Registration failed. Please try again.');
      btnGroup.querySelectorAll('button').forEach(btn => btn.disabled = false);
    }
  } catch (err) {
    console.error(err);
    alert('Network error—please try again.');
    btnGroup.querySelectorAll('button').forEach(btn => btn.disabled = false);
  }
});

  </script>
  
  
</body>
</html>
