<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AI Powered Automobile Workshop</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

  <style>
    /* Background video style */
    

    body ,html{
      font-family: "Poppins", sans-serif;
      margin: 0px;
      padding: 0px;
      background-color: #f4f7f6;
      color: #333;
      box-sizing: border-box;
    }
    h1, h2, p {
      margin: 0;
      padding: 0;
    }
    a {
      text-decoration: none;
    }

    nav {
      background-color: #ff6600;
      padding: 6px 30px;
      position: sticky;
    
      z-index: 1000;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      flex-wrap: wrap;
      margin-top:0px;
    }

    .navbar-logo {
      font-size: 28px;
      color: #fff;
      font-weight: 700;
    }

    .navbar-logo:hover {
      animation: shake 5s linear infinite;
    }

    .nav-links {
      display: flex;
      gap: 25px;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
    }

    .nav-links a {
      color: white;
      font-size: 18px;
      padding: 8px 16px;
      position: relative;
      transition: color 0.3s ease;
    }

    .nav-links a::after {
      content: "";
      display: block;
      width: 0%;
      height: 2px;
      background: white;
      transition: width 0.3s;
      position: absolute;
      bottom: 0;
      left: 0;
    }

    .nav-links a:hover::after {
      width: 100%;
    }

    .user-info {
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
    }

    .username {
      color: white;
      font-weight: 600;
      font-size: 18px;
    }

    .user-info i {
      color: white;
      font-size: 20px;
    }

    @keyframes shake {
      0% { transform: translate(0px,0px) }
      25% { transform: translate(20px,0px); }
      50% { transform: translate(0px,0px); }
      75% { transform: translate(-20px,0px); }
      100% { transform: translate(0px,0px); }
    }
    header {
      position: relative;
      overflow: hidden;
      height: 100vh;
      color: orange;
      text-align: center;
      margin-bottom: 1px;
     
    }
    header h1 {
      font-size: 44px;
      font-weight: 700;
      margin-bottom: 452px;
      z-index: 2;
      white-space: nowrap;
      overflow: hidden;
      display: inline-block;
      position:relative;
    }
    header p {
      font-size: 24px;
      font-weight: 300;
      margin-bottom: 25px;
      z-index: 2;
      position:relative;
    }
    .cta-button {
      background-color: red;
      color: white;
      padding: 15px 30px;
      font-size: 18px;
      position:relative;
      font-weight: 600;
      border-radius: 50px;
      text-transform: uppercase;
      letter-spacing: 2px;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.3s;
      z-index: 2;
    }
    .cta-button:hover {
      background-color: #3498db;
      transform: translateY(-2px);
    }
    #background-video {
      position: absolute;
      top: 0px;
      left: 50%;
      transform: translateX(-50%);
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: 1;
    }
    .smooth-text {
      display: inline-block;
      overflow: hidden;
      border-right: 2px solid red;
      -webkit-font-smoothing: antialiased;
      will-change: clip-path, border-color;
      animation: reveal 4s ease-in-out infinite alternate, blink 0.75s step-end infinite;
    }
    @keyframes reveal {
      0% { clip-path: inset(0 100% 0 0); }
      100% { clip-path: inset(0 0 0 0); }
    }
    @keyframes blink {
      0%, 100% { border-color: red; }
      50% { border-color: transparent; }
    }
    .sidebar {
  position: fixed;
  top: 0;
  right: -350px;
  width: 300px;
  height: 100%;
  background: linear-gradient(135deg,rgba(225, 220, 215, 0.84),rgba(255, 255, 255, 0.8));
  backdrop-filter: blur(12px);
  border-left: 2px solid #ffffff40;
  border-top: 2px solid #ffffff30;
  border-radius: 20px 0 0 20px;
  box-shadow: -10px 0 30px rgba(0, 0, 0, 0.1);
  transition: right 0.4s ease-in-out;
  z-index: 2000;
  padding: 25px;
  padding-top:0px;
  margin-top: 55px;
}

.sidebar.active {
  right: 0;
}

.sidebar .top-section {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.sidebar .close-btn {
  background: none;
  border: none;
  font-size: 22px;
  color: #555;
  cursor: pointer;
  transition: transform 0.2s;
}

.sidebar .close-btn:hover {
  transform: rotate(90deg);
}

.profile-section {
  text-align: center;
  margin: 30px 0;
}

.profile-pic {
  width: 120px;
  height: 120px;
  object-fit: cover;
  border-radius: 20%;
  border: 4px solid #eee;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  transition: transform 0.3s;
}

.profile-pic:hover {
  transform: scale(1.05);
}

.avatar-options p {
  font-size: 15px;
  color: #666;
  margin-bottom: 10px;
}

.avatar-list {
  display: flex;
  justify-content: center;
  gap: 12px;
  flex-wrap: wrap;
}

.avatar {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  cursor: pointer;
  transition: transform 0.3s, box-shadow 0.3s;
  border: 2px solid transparent;
}

.avatar:hover {
  transform: scale(1.15);
  border-color: #ff6600;
  box-shadow: 0 4px 10px rgba(255, 102, 0, 0.3);
}

.menu {
  margin-top: 30px;
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.menu a {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px;
  border-radius: 12px;
  font-size: 16px;
  color: #333;
  background: #fff;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  transition: all 0.3s ease;
}

.menu a i {
  transition: transform 0.3s ease;
}

.menu a:hover {
  background-color: #ff6600;
  color: white;
}

.menu a:hover i {
  transform: scale(1.2);
}

.logout-btn {
  margin-top: 20px;
  padding: 12px 20px;
  width: 100%;
  background: linear-gradient(135deg, #ff4d4d, #cc0000);
  border: none;
  border-radius: 30px;
  color: white;
  font-weight: 600;
  cursor: pointer;
  transition: transform 0.3s, box-shadow 0.3s;
}

.logout-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 15px rgba(204, 0, 0, 0.4);
}


    @media (max-width: 768px) {
      .navbar-logo { font-size: 20px; }
      .nav-links a { font-size: 16px; padding: 6px 10px; }
      .username { font-size: 14px; }
    }
  </style>
</head>
<body>

<!-- Background Video -->
 
    

<nav>
  <div class="navbar-logo">Xfinity</div>
  <div class="nav-links">
    <a href="#ai-features">AI Features</a>
    <a href="#schedule-pickup">Schedule Pickup</a>
    <a href="#diagnosis">AI Diagnosis</a>
    <a href="#track-status">Track Status</a>
  </div>
  <?php if ($isLoggedIn): ?>
  <div class="user-info" onclick="toggleSidebar()">
    <i class="fa-solid fa-user"></i>
    <span class="username"><?php echo html_escape($userName); ?></span>
  </div>
  <?php else: ?>
  <div class="user-info">
    <a href="<?php echo site_url('login'); ?>" class="logout-btn" style="background: #007bff; padding: 8px 20px; border-radius: 30px;">Login</a>
  </div>
  <?php endif; ?>
</nav>

<header>
    <!-- Background Video -->
    <video autoplay muted loop id="background-video">
      <source src="<?php echo base_url('assets/videos/4488720-uhd_4096_2160_25fps.mp4'); ?>" type="video/mp4" />
      Your browser does not support the video tag.
    </video>
    <h1 class="smooth-text">Redifining Auto Care Through Innovation!</h1>
    <p>Your trusted partner for intelligent car diagnostics and repair</p>
    <!-- Explore Now Button -->
    <a href="#ai-features" id="explore-now-btn" class="cta-button">EXPLORE NOW</a>
  </header>

<div class="sidebar" id="sidebar">
  <div class="top-section">
  <h3>Hello, <?php echo html_escape($this->session->userdata('name')); ?></h3>

    <button class="close-btn" onclick="toggleSidebar()"><i class="fas fa-times"></i></button>
  </div>

  <div class="profile-section">
    <img src="<?= html_escape( $this->session->userdata('avatar') ) ?>" class="profile-pic" alt="Profile Picture">
    <p style="margin-top: 10px; font-weight: 500;"><?php echo html_escape($this->session->userdata('name')); ?></p>
  </div>

  <div class="avatar-options">
    <p style="margin-left:80px;">Choose Your Avatar</p>
    <div class="avatar-list" id="avatar-list"></div>
  </div>

  <div class="menu">
    <a href="<?= site_url('home/profile') ?>"><i class="fas fa-user-circle"></i> Profile</a>
    <a href="<?= site_url('home/settings') ?>"><i class="fas fa-cogs"></i> Settings</a>
    <a href="<?= site_url('home/support') ?>"><i class="fas fa-headset"></i> Support</a>
  </div>

  <a href="<?php echo site_url('home/logout'); ?>">
    <button class="logout-btn">Logout</button>
  </a>
</div>
<div class="sidebar" id="sidebar">
  <div class="top-section">
  <h3>Hello, <?php echo html_escape($this->session->userdata('name')); ?></h3>

    <button class="close-btn" onclick="toggleSidebar()"><i class="fas fa-times"></i></button>
  </div>

  <div class="profile-section">
    <img src="<?= html_escape( $this->session->userdata('avatar') ) ?>" class="profile-pic" alt="Profile Picture">
    <p style="margin-top: 10px; font-weight: 500;"><?php echo html_escape($this->session->userdata('name')); ?></p>
  </div>

  <div class="avatar-options">
    <p style="margin-left:80px;">Choose Your Avatar</p>
    <div class="avatar-list" id="avatar-list"></div>
  </div>

  <div class="menu">
    <a href="<?= site_url('home/profile') ?>"><i class="fas fa-user-circle"></i> Profile</a>
    <a href="<?= site_url('home/settings') ?>"><i class="fas fa-cogs"></i> Settings</a>
    <a href="<?= site_url('home/support') ?>"><i class="fas fa-headset"></i> Support</a>
  </div>

  <a href="<?php echo site_url('home/logout'); ?>">
    <button class="logout-btn">Logout</button>
  </a>
</div>

<script>
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('active');
  }

  function createRandomAvatar() {
    const seed = Math.random().toString(36).substring(2, 10);
    return `https://api.dicebear.com/9.x/bottts/svg?seed=${seed}`;
  }

  function populateAvatars(count = 4) {
    const container = document.getElementById('avatar-list');
    container.innerHTML = '';
    for (let i = 0; i < count; i++) {
      const img = document.createElement('img');
      img.src = createRandomAvatar();
      img.className = 'avatar';
      img.onclick = () => selectAvatar(img.src);
      container.appendChild(img);
    }
  }

  function selectAvatar(src) {
    document.querySelector('.profile-pic').src = src;
    fetch('<?= site_url("home/update_avatar") ?>', {
      method: 'POST',
      credentials: 'same-origin',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ avatar_url: src })
    });
  }

  setInterval(() => populateAvatars(), 10000);
  populateAvatars();
</script>

</body>
</html>
