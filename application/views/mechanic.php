<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login / Registration</title>
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />


  <style>
    * {
      margin: 0; padding: 0; box-sizing: border-box;
      font-family: "Poppins", sans-serif;
      text-decoration: none; list-style: none;
    }
    body {
      display: flex; justify-content: center; align-items: center;
      flex-direction:column;
      min-height: 100vh;
      background: linear-gradient(90deg, #fff3e0, #ffd8b5);
      overflow: hidden;
      
    }

    /* particle canvas */
    #particles {
      position: fixed;
      top: 0; left: 0;
      width: 100vw;
      height: 100vh;
      z-index: 0;
      pointer-events: none;
    }

    .container {
      position: relative;
      display:flex;
     flex-direction:column;
      width: 850px; height: 550px;
      background: #fff8f1;
      margin: 20px;
      border-radius: 30px;
      box-shadow: 0 0 30px rgba(0,0,0,.1);
      overflow: hidden;
      z-index: 1; /* above canvas */
      opacity:100%;
    }
    .container h1 {
      font-size: 36px; margin: -10px 0;
      color: #ff6b00;
    }
    .container p {
      font-size: 14.5px; margin: 15px 0;
      color: #5a3410;
    }
    form { width: 100%; }
    .form-box {
      position: absolute; right: 0;
      width: 50%; height: 100%;
      background: #fff8f1;
      display: flex; align-items: center;
      text-align: center;
      padding: 40px;
      transition: .6s ease-in-out 1.2s, visibility 0s 1s;
      z-index:1;
    }
    .container.active .form-box.login  { visibility: hidden; }
    .container.active .form-box.register { right: 50%; visibility: visible; transition-delay: 1.2s; }
    .form-box.register { visibility: hidden; }
    .input-box {
      position: relative; margin: 30px 0;
    }
    .input-box input,
    .input-box select {
      width: 100%; padding: 13px 50px 13px 20px;
      background: #fff1e5; border-radius: 8px;
      border: none; outline: none;
      font-size: 16px; color: #333; font-weight: 500;
      appearance: none;
    }
    .input-box input::placeholder {
      color: #aa7a50; font-weight: 400;
    }
    .input-box i {
      position: absolute; right: 20px; top: 50%;
      transform: translateY(-50%); font-size: 20px;
      color: #ff7a00;
    }
    .btn {
      width: 100%; height: 48px;
      background: #ff7a00; border-radius: 30px;
      box-shadow: 0 0 10px rgba(0,0,0,.1);
      border: none; cursor: pointer;
      font-size: 16px; color: #fff; font-weight: 600;
      transition: background .3s;
    }
    .btn:hover {
      background:rgb(255, 102, 0);
    }
    .social-icons {
      display: flex; justify-content: center;
      margin-top: 10px;
    }
    .social-icons a {
      display: inline-flex; padding: 10px;
      border: 2px solid #ffaa66; border-radius: 8px;
      font-size: 24px; color: #ff6b00; margin: 0 8px;
      transition: background .3s, color .3s;
      
    }
    .social-icons a:hover {
      background: #ffd8b5; color: #ff7a00;
    }
    .toggle-box {
      position: absolute; width: 100%; height: 100%;
    }
    .toggle-box::before {
      content: ''; position: absolute;
      left: -250%; width: 300%; height: 100%;
      background: #ff6b00; border-radius: 150px;
      z-index: 2; transition: 1.8s ease-in-out;
    }
    .container.active .toggle-box::before { left: 50%; }
    .toggle-panel {
      position: absolute; width: 50%; height: 100%;
      color: #fff;
      display: flex; flex-direction: column;
      justify-content: center; align-items: center;
      z-index: 2; transition: .6s ease-in-out;
    }
    .toggle-panel.toggle-left {
      left: 0; transition-delay: 1.2s;
    }
    .container.active .toggle-panel.toggle-left {
      left: -50%; transition-delay: .6s;
    }
    .toggle-panel.toggle-right {
      right: -50%; transition-delay: .6s;
    }
    .container.active .toggle-panel.toggle-right {
      right: 0; transition-delay: 1.2s;
    }
    .toggle-panel p { margin-bottom: 20px; }
    .toggle-panel .btn {
      width: 160px; height: 46px;
      background: transparent; border: 2px solid #fff;
      box-shadow: none;
    }
    /* AJAX feedback */
    #regFeedback {
      display: none;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 4px;
      font-weight: 500;
    }
    .success-msg { margin-top:0px;border: 1px solid #ffe8d6; }
    .error-msg   { border: 0px solid #f5c6cb; }
    /* Responsive */
    @media screen and (max-width: 650px) {
      .container { height: calc(100vh - 40px); }
      .form-box {
        bottom: 0; width: 100%; height: 70%;
      }
      .container.active .form-box { right: 0; bottom: 30%; }
      .toggle-box::before {
        left: 0; top: -270%;
        width: 100%; height: 300%;
        border-radius: 20vw;
      }
      .container.active .toggle-box::before { top: 70%; }
      .toggle-panel {
        width: 100%; height: 30%;
      }
      .toggle-panel.toggle-left { top: 0; }
      .container.active .toggle-panel.toggle-left { top: -30%; }
      .toggle-panel.toggle-right { bottom: -30%; }
      .container.active .toggle-panel.toggle-right { bottom: 0; }
    }
    @media screen and (max-width: 400px) {
      .form-box { padding: 20px; }
      .toggle-panel h1 { font-size: 30px; }
    }

    
  </style>
</head>
<body>
  <!-- Particle Canvas -->
  <canvas id="particles"></canvas>

  <div class="container">
    
    <!-- Login Form -->
    <div class="form-box login">
      <form id="loginForm" action="<?= base_url('index.php/mechanic/login') ?>" method="post">
        <h1>Login</h1>
        <div class="input-box">
          <input type="text" name="username" placeholder="Username" required>
          <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
          <input type="password" name="password" placeholder="Password" required>
          <i class='bx bxs-lock-alt'></i>
        </div>
        <div class="input-box">
          <select name="city" required>
            <option value="" disabled selected>Select City</option>
            <option value="Kayamkulam">Kayamkulam</option>
            <option value="Haripad">Haripad</option>
            <option value="Kollam">Kollam</option>
            <option value="Karunagapally">Karunagapally</option>
            <option value="Chavara">Chavara</option>
          </select>
          <i class='bx bxs-map'></i>
        </div>
        <div class="error-msg" style="display:none; color:red; padding-bottom:10px;"></div>
        <button type="submit" class="btn"> 
        <i class="fa-solid fa-right-to-bracket" style="padding-right:5px;"></i>
        Login     
        </button>
      
        <div class="social-icons" style="Padding-top:20px;">
          <a href="#"><i class='bx bxl-google'></i></a>
          <a href="#"><i class='bx bxl-facebook'></i></a>
          <a href="#"><i class='bx bxl-github'></i></a>
          <a href="#"><i class='bx bxl-linkedin'></i></a>
        
        </div>
        <p style="padding-top:7px; padding-bottom:0px; ">© 2025 Xfinity.In All rights reserved.</p>
 
      </form>
      
    </div>
    

    <!-- Registration Form -->
    <div class="form-box register">
      <form id="registrationForm" action="<?= base_url('index.php/mechanic/registration') ?>" method="post">
        <h1>Registration</h1>
        <div class="input-box">
          <input type="text" name="username" placeholder="Username" required>
          <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
          <select name="city" required>
            <option value="" disabled selected>Select City</option>
            <option value="Kayamkulam">Kayamkulam</option>
            <option value="Haripad">Haripad</option>
            <option value="Karunagapally">Karunagapally</option>
            <option value="Kollam">Kollam</option>
            <option value="chavara">Chavara</option>
          </select>
          <i class='bx bxs-map'></i>
        </div>
        <div class="input-box">
          <input type="password" name="password" placeholder="Password" required>
          <i class='bx bxs-lock-alt'></i>
        </div>
        <div id="regFeedback"></div>
        <button type="submit" class="btn">Register</button>
        
        <div class="social-icons" style="Padding-top:20px;">
          <a href="#"><i class='bx bxl-google'></i></a>
          <a href="#"><i class='bx bxl-facebook'></i></a>
          <a href="#"><i class='bx bxl-github'></i></a>
          <a href="#"><i class='bx bxl-linkedin'></i></a>
        </div>
        <p style="padding-top:7px; padding-bottom:0px; ">© 2025 Xfinity.In All rights reserved.</p>
      </form>
      
    </div>
    
    

    <!-- Toggle Panels -->
    <div class="toggle-box">
      <div class="toggle-panel toggle-left">
        <h1 style="color:white;">Xfinity-Garage!</h1>
        <p style="color:white;">Don't have an account?</p>
        <button type="button" class="btn register-btn">Register</button>
        
      </div>
      <div class="toggle-panel toggle-right">
        <h1 style="color:white;">Welcome Back!</h1>
        <p style="color:white;">Already have an account?</p>
        <button type="button" class="btn login-btn">Login</button>
      </div>
      
    </div>
    
  </div>
  
 

  <script>
    // Toggle between login/register
    const container   = document.querySelector('.container');
    document.querySelector('.register-btn')
            .addEventListener('click', () => container.classList.add('active'));
    document.querySelector('.login-btn')
            .addEventListener('click',   () => container.classList.remove('active'));

    // AJAX Login
    document.getElementById('loginForm').addEventListener('submit', async function(e) {
      e.preventDefault();
      const form     = this;
      const errorDiv = form.querySelector('.error-msg');
      errorDiv.style.display = 'none';
      errorDiv.textContent   = '';

      const data = new FormData(form);
      try {
        const resp = await fetch(form.action, {
          method: 'POST',
          body: data,
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        const json = await resp.json();

        if (json.status) {
          window.location.href = json.redirect;
        } else {
          errorDiv.textContent = json.message;
          errorDiv.style.display = 'block';
        }
      } catch {
        errorDiv.textContent = 'An unexpected error occurred.';
        errorDiv.style.display = 'block';
      }
    });

    // AJAX Registration
    document.getElementById('registrationForm').addEventListener('submit', async function(e) {
      e.preventDefault();
      const form     = this;
      const fb       = document.getElementById('regFeedback');
      fb.style.display = 'none';
      fb.textContent   = '';
      fb.className     = '';

      const data = new FormData(form);
      try {
        const resp = await fetch(form.action, {
          method: 'POST',
          body: data,
          headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        const json = await resp.json();

        if (json.status) {
          fb.textContent = json.message;
          fb.classList.add('success-msg');
          fb.style.background = '#d4edda';
          fb.style.color      = '#155724';
          fb.style.display    = 'block';
          form.reset();
        } else {
          fb.textContent = json.message;
          fb.classList.add('error-msg');
          fb.style.background = '#f8d7da';
          fb.style.color      = '#721c24';
          fb.style.display    = 'block';
        }
      } catch {
        fb.textContent = 'An unexpected error occurred.';
        fb.classList.add('error-msg');
        fb.style.background = '#f8d7da';
        fb.style.color      = '#721c24';
        fb.style.display    = 'block';
      }
    });
  </script>

  <!-- Particle animation -->
  <script>
    (function() {
      const canvas = document.getElementById('particles');
      const ctx    = canvas.getContext('2d');
      let w, h, particles;

      function resize() {
        w = canvas.width  = window.innerWidth;
        h = canvas.height = window.innerHeight;
      }

      function init() {
        resize();
        particles = Array.from({ length: 100 }, () => ({
          x: Math.random() * w,
          y: Math.random() * h,
          r: 1 + Math.random() * 2,
          vx: -0.3 + Math.random() * 0.6,
          vy: -0.3 + Math.random() * 0.6,
          alpha: 0.2 + Math.random() * 0.3
        }));
      }

      function animate() {
        ctx.clearRect(0, 0, w, h);
        particles.forEach(p => {
          p.x += p.vx;
          p.y += p.vy;
          if (p.x < 0) p.x = w;
          if (p.x > w) p.x = 0;
          if (p.y < 0) p.y = h;
          if (p.y > h) p.y = 0;

          ctx.beginPath();
          ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
          ctx.fillStyle = `rgba(255,107,0,${p.alpha})`;
          ctx.fill();
        });
        requestAnimationFrame(animate);
      }

      window.addEventListener('resize', resize);
      init();
      animate();
    })();
  </script>
  <script>
  (function() {
    const form        = document.getElementById('loginForm');
    const userInput   = form.querySelector('input[name="username"]');
    const citySelect  = form.querySelector('select[name="city"]');
    const cityIcon    = citySelect.nextElementSibling; // the <i> right after select

    // Store original options & icon so we can restore
    const originalOptions  = citySelect.innerHTML;
    const originalIconCls  = cityIcon.className;

    // Trigger on blur or when they pause typing
    let typingTimer;
    userInput.addEventListener('input', () => {
      clearTimeout(typingTimer);
      typingTimer = setTimeout(checkUsername, 500);
    });
    userInput.addEventListener('blur', checkUsername);

    async function checkUsername() {
      const username = userInput.value.trim();
      if (!username) {
        restoreCity();
        return;
      }

      try {
        const resp = await fetch('<?= base_url("index.php/mechanic/get_user_info") ?>', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
          },
          body: JSON.stringify({ username })
        });
        const data = await resp.json();

        if (data.status) {
          // replace options with a single “Admin Login”
          citySelect.innerHTML = `<option value="${data.cityValue}" selected>${data.city}</option>`;
          // swap out the icon
          cityIcon.className = `bx ${data.iconClass}`;
        } else {
          // any other username: restore defaults
          restoreCity();
        }
      } catch (err) {
        console.error('Could not fetch user info:', err);
        restoreCity();
      }
    }

    function restoreCity() {
      citySelect.innerHTML = originalOptions;
      cityIcon.className   = originalIconCls;
    }
  })();
</script>

</body>
</html>
