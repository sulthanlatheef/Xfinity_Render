<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tracking - AutoService</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Google Fonts: Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    /* Global Styles */
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      background: #fefbf7;
      color: #444;
      overflow-x: hidden;
      padding-top: 60px; /* Adjust this value as needed */
    }
    a { text-decoration: none; }
    
    /* Navigation */
    nav {
      position: fixed; /* Changed from sticky to fixed */
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000; /* Ensure it stays above other content */
      background-color: #ff6600;
      padding: 7.5px 0;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .navbar-logo {
      font-size: 28px;
      color: #fff;
      font-weight: 600;
      margin-left: 30px;
      animation: bounce 1.5s ease infinite;
    }
    @keyframes bounce {
      0%, 50%, 100% { transform: translateY(0); }
      25% { transform: translateY(-10px); }
      75% { transform: translateY(-5px); }
    }
    .nav-links {
      flex: 1;
      display: flex;
      justify-content: center;
      gap: 20px;
    }
    nav a {
      color: #fff;
      font-size: 20px;
      padding: 10px 30px;
      border-radius: 4px;
      transition: background-color 0.3s, transform 0.3s;
    }
    nav a:hover {
      background-color: #ff944d;
      transform: translateY(-3px);
    }
    .user-info {
      display: flex;
      align-items: center;
      margin-right: 30px;
    }
    .user-info .username {
      font-size: 18px;
      color: #fff;
      font-weight: 600;
      margin-right: 15px;
    }
    .user-info .logout-btn {
      background: #e60000;
      color: #fff;
      padding: 8px 16px;
      border: none;
      border-radius: 30px;
      cursor: pointer;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .user-info .logout-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }
    @media (max-width: 768px) {
      .navbar-logo { font-size: 22px; margin-left: 15px; }
      nav a { padding: 10px 20px; font-size: 18px; }
      .user-info .username { font-size: 16px; }
    }
    
    /* Header Background */
    .animated-bg {
      background: linear-gradient(45deg, #f6ea3f, #e99983, #b0edf3, #c7afff);
      background-size: 400% 400%;
      animation: fullTimeBG 15s ease infinite;
    }
    @keyframes fullTimeBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    
   
    /* Particles Background */
    #particles-js {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      z-index: 0;
    }
    
    /* Header Section */
    .header-session { position: relative; overflow: hidden; }
    .timeline-advanced {
      position: relative;
      max-width: 1200px;
      margin: auto;
      padding: 2rem 5% 1rem;
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      z-index: 2;
    }
    .timeline-line {
      position: absolute;
      top: 90%;
      left: 5%;
      right: 5%;
      height: 8px;
      border-radius: 4px;
      background: linear-gradient(90deg, #ff8400, #1aff00, rgba(204,0,255,0.74));
      background-size: 200% auto;
      animation: gradientFlow 3s linear infinite, pulseLine 3s ease-in-out infinite;
      z-index: 1;
      margin: 0 5%;
      overflow: hidden;
    }
    @keyframes gradientFlow {
      0% { background-position: 0% center; }
      100% { background-position: 200% center; }
    }
    @keyframes pulseLine {
      0%, 100% { transform: scaleY(1); filter: brightness(1); }
      50% { transform: scaleY(1.2); filter: brightness(1.3); }
    }
    .timeline-line::after {
      content: "";
      position: absolute;
      top: 0;
      left: -50%;
      width: 50%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,0,0,0.8), transparent);
      animation: scanEffect 3s linear infinite;
    }
    @keyframes scanEffect {
      0% { left: -50%; }
      100% { left: 100%; }
    }
    .timeline-advanced .timeline-step {
      position: relative;
      text-align: center;
      flex: 1;
      min-width: 150px;
      margin: 1rem;
      padding: 1rem;
      z-index: 2;
    }
    .step-icon {
      width: 70px;
      height: 70px;
      background: #fff;
      border: 5px solid #ff6600;
      border-radius: 50%;
      margin: 0 auto 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.8rem;
      color: #ff6600;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .step-icon:hover,
    .step-icon.active {
      transform: scale(1.2);
      background: #ff6600;
      color: #fff;
      box-shadow: 0 0 15px rgba(255,102,0,0.5);
    }
    .step-title {
      font-size: 1.1rem;
      font-weight: 700;
      margin-top: 0.5rem;
      color: #333;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    @media (max-width: 576px) {
      .timeline-advanced { display: block; }
      .timeline-line { display: none; }
      .timeline-step { margin-bottom: 2rem; }
    }

    .sidebarnew {
  position: fixed;
  top: 0;
  right: -350px;
  width: 340px;
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
  padding-top:20px;
  margin-top: 65px;
}

.sidebarnew.active {
  right: 0;
}

.sidebarnew .top-section {
  font-size:20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  
}

.sidebarnew .close-btn {
  background: none;
  border: none;
  font-size: 22px;
  color: #555;
  cursor: pointer;
  transition: transform 0.2s;
}

.sidebarnew .close-btn:hover {
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
    
    /* Header Content */
    .header-content {
      text-align: center;
      padding: 2rem 1rem 3rem;
      color: #fff;
      z-index: 2;
      max-width: 800px;
      margin: 0 auto;
    }
    .header-content h2 {
      font-size: 2.8rem;
      font-weight: 700;
      margin-bottom: 1rem;
      color: #ff6600;
    }
    .header-content p {
      font-size: 1.2rem;
      margin-bottom: 1.5rem;
      line-height: 1.6;
      color: #ffe6d0;
    }
    .feature-cards { margin-bottom: 1.5rem; }
    .feature-card {
      position: relative;
      background: linear-gradient(135deg, #ff8400, #ff4d4d);
      border-radius: 25px;
      padding: 1.5rem;
      text-align: center;
      border: 1px solid rgba(255,255,255,0.4);
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      margin-bottom: 1rem;
    }
    .feature-card::before {
      content: "";
      position: absolute;
      top: -100%;
      left: -100%;
      width: 200%;
      height: 200%;
      background: linear-gradient(120deg, transparent 0%, rgba(255,255,255,0.3) 50%, transparent 100%);
      transform: rotate(25deg);
      animation: shimmer 2s infinite;
    }
    @keyframes shimmer {
      0% { transform: translateX(-100%) rotate(25deg); }
      100% { transform: translateX(100%) rotate(25deg); }
    }
    .feature-card:hover {
      transform: translateY(-5px) scale(1.02);
      box-shadow: 0 10px 20px rgba(0,0,0,0.25);
    }
    .feature-card i { font-size: 2.2rem; color: #fff; margin-bottom: 0.6rem; }
    .feature-card h5 {
      font-size: 1.3rem;
      margin-bottom: 0.5rem;
      color: #fff;
      font-weight: 700;
    }
    .feature-card p { font-size: 1rem; color: #fff; margin: 0; }
    .feature-card * { position: relative; z-index: 1; }
    .cta-btn.animated-arrow {
      font-size: 2.5rem;
      color: #ff6600;
      display: inline-block;
      cursor: pointer;
      position: relative;
      animation: pulseArrow 1.5s ease-in-out infinite;
    }
    @keyframes pulseArrow {
      0% { transform: scale(1); opacity: 0.8; }
      50% { transform: scale(1.2); opacity: 1; }
      100% { transform: scale(1); opacity: 0.8; }
    }
    
    /* Card Flip Design */
    .pickup-card {
      perspective: 1000px;
      height: 300px;
      margin-bottom: 1.5rem;
    }
    .pickup-card-inner {
      position: relative;
      width: 100%;
      height: 100%;
      transition: transform 0.8s;
      transform-style: preserve-3d;
    }
    /* Remove hover based flip */
    /* .pickup-card:hover .pickup-card-inner {
      transform: rotateY(180deg);
    } */
    .pickup-card-inner.flipped {
      transform: rotateY(180deg);
    }
    .pickup-card-front,
    .pickup-card-back {
      position: absolute;
      width: 100%;
      height: 100%;
      backface-visibility: hidden;
      border-radius: 20px;
      overflow: hidden;
      padding: 1.5rem;
    }
    /* Front Side */
    .pickup-card-front {
      background: linear-gradient(135deg, #fff,rgb(247, 234, 234));
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      color: #333;
    }
    .pickup-card-front .card-title {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 0.75rem;
      color:rgb(46, 45, 45);
    }
    .pickup-card-front .detail-item {
      display: flex;
      align-items: center;
      font-size: 0.95rem;
      color: #555;
      margin-bottom: 0.5rem;
    }
    .pickup-card-front .detail-item i {
      color: #ff6600;
      margin-right: 0.75rem;
    }
    .pickup-card-front .in-progress {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 1rem;
    }
    .pickup-card-front .in-progress .spinner {
      position: relative;
      width: 75px;
      height: 75px;
      border: 5px solid rgb(255, 0, 0);
      border-top: 5px solid rgb(255, 0, 0);
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }
    .pickup-card-front .in-progress .spinner i {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 30px;
      color: rgb(255, 0, 0);
      animation: spinWrench 2.5s linear infinite;
    }
    @keyframes spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }
    @keyframes spinWrench {
      from { transform: translate(-50%, -50%) rotate(0deg); }
      to { transform: translate(-50%, -50%) rotate(360deg); }
    }
    .pickup-card-front .in-progress .progress-text {
      margin-top: 2rem;
      font-weight: 600;
      color:rgb(255, 123, 0);
      font-size: 1.3rem;
    }
    .pickup-card-front .completed {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 1rem;
    }
    .pickup-card-front .completed .check-icon {
      font-size: 65px;
      color: #28a745;
    }
    .pickup-card-front .completed .completed-text {
      margin-top: 0.5rem;
      font-weight: 600;
      color: #28a745;
      font-size: 1.25rem;
    }
    /* Back Side */
    .pickup-card-back {
      background: #ff6600;
      color: #fff;
      transform: rotateY(180deg);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
    }
    .pickup-card-back h5 {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 1rem;
    }
    .pickup-card-back p {
      font-size: 1rem;
      margin-bottom: 1.5rem;
    }
    .pickup-card-back a {
      font-weight: 600;
      color: #fff;
      border: 2px solid #fff;
      padding: 0.5rem 1rem;
      border-radius: 30px;
      transition: background 0.3s, color 0.3s;
    }
    .pickup-card-back a:hover {
      background: #fff;
      color: #ff6600;
    }
    
    .alert { border-left: 5px solid #ff6600; }
    footer {
  background: linear-gradient(45deg, #ff6600,rgb(247, 99, 0));
  color: #fff;
  text-align: center;
  padding: .8rem 0;
  margin-top: 3rem;
  position: relative;
  overflow: hidden;
}

footer::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url('https://via.placeholder.com/1500x500?text=Texture') no-repeat center/cover;
  opacity: 0.1;
  z-index: 0;
}

footer .footer-content {
  position: relative;
  z-index: 1;
}
.pickup-card-front .assistance-notice {
  position: absolute;
  bottom: 1.5rem;
  left: 0;
  width: 100%;
  text-align: center;
  font-weight: 700;
  color:rgb(106, 255, 0);
  background-color: rgb(53, 224, 31);
  padding: 2rem;
  border-top: 2px solidrgb(77, 255, 0);
  border-bottom-left-radius: 20px;
  border-bottom-right-radius: 20px;
}


footer p {
  font-size: 1.1rem;
  font-weight: 600;
  margin: 0 0 1rem;
}

footer .social-icons a {
  color: #fff;
  font-size: 1.2rem;
  margin: 0 10px;
  transition: transform 0.3s, color 0.3s;
}

footer .social-icons a:hover {
  transform: scale(1.1);
  color: #333;
}

    /* Flip Button Style */
    .flip-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      background: transparent;
      border: none;
      font-size: 1.2rem;
      /* Set the eye icon color to orange */
      color:rgb(255, 68, 0);
      z-index: 2;
      cursor: pointer;
    }
    .flip-btn:focus { outline: none; }

    /* Custom Container for Pickup Cards */
    .pickups-container {
      min-height: 510px; /* Adjust the value as needed */
    }
  </style>
</head>
<body>
  <!-- Navigation -->
  <header>
    <nav>
      <div class="navbar-logo">Xfinity</div>
      <div class="nav-links">
        <a href="#ai-features">AI Features</a>
        <a href="#schedule-pickup">Schedule Pickup</a>
        <a href="#ai-diagnosis">AI Diagnosis</a>
        <a href="#track-status">Track Status</a>
      </div>
      <?php if ($this->session->userdata('name')): ?>
        <div class="user-info" style="cursor:pointer;" onclick="toggleSidebar()">
      <i class="fa-solid fa-user-astronaut" style="color:white;font-size:29px;padding-right:10px;"></i>
        <span class="username" style="font-size:19.5px;"><?php echo html_escape($this->session->userdata('name')); ?></span>
        
       
      </div>
      <?php else: ?>
        <a href="<?php echo site_url('login'); ?>" class="button" style="margin-right:30px; color:#fff; font-size:20px; padding:10px 30px;">Login</a>
      <?php endif; ?>
    </nav>
    
  </header>

  

  
  <!-- Header Session -->
  <section class="header-session animated-bg">
    <!-- Particles Background -->
    <div id="particles-js"></div>
    <!-- Timeline -->
    <div class="timeline-advanced">
      <div class="timeline-line"></div>
      <div class="timeline-step">
        <div class="step-icon" id="step-1">
          <i class="fas fa-calendar-alt"></i>
        </div>
        <div class="step-title">Scheduled</div>
      </div>
      <div class="timeline-step">
        <div class="step-icon" id="step-2">
          <i class="fas fa-check"></i>
        </div>
        <div class="step-title">Pickup</div>
      </div>
      <div class="timeline-step">
        <div class="step-icon" id="step-3">
          <i class="fas fa-tools"></i>
        </div>
        <div class="step-title">In Service</div>
      </div>
      <div class="timeline-step">
        <div class="step-icon" id="step-4">
          <i class="fas fa-check-circle"></i>
        </div>
        <div class="step-title">Completed</div>
      </div>
      <div class="timeline-step">
        <div class="step-icon" id="step-5">
          <i class="fas fa-truck"></i>
        </div>
        <div class="step-title">Delivered</div>
      </div>
    </div>
    <!-- Header Content -->
    <div class="header-content">
      <div class="container">
        <div class="row feature-cards">
          <div class="col-md-4">
            <div class="feature-card">
              <i class="fas fa-info-circle"></i>
              <h5>Real-time Updates</h5>
              <p>Get instant alerts on progress.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="feature-card">
              <i class="fas fa-map-marker-alt"></i>
              <h5>Location Tracking</h5>
              <p>Monitor service location at every step.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="feature-card">
              <i class="fas fa-calendar-check"></i>
              <h5>Timely Milestones</h5>
              <p>Never miss an important update.</p>
            </div>
          </div>
        </div>
        <div class="text-center my-4">
          <h3 style="color:#ff6600; font-size:2rem;font-weight:700;">Drive with Confidence, Track with Ease</h3>
          <p style="font-size:1.2rem; color:#444;"></p>
        </div>
      </div>
      <!-- Animated Scroll Arrow -->
      <a href="#" id="scrollToBottom" class="cta-btn animated-arrow">
        <i class="fas fa-angle-double-down"></i>
      </a>
    </div>
  </section>
  
  <!-- Main Content: Pickup Cards -->
  <main class="container my-5 pickups-container">
    <?php if (!empty($pickup_ids)): ?>
      <div class="row g-4">
        <?php foreach($pickup_ids as $pickup): ?>
          <div class="col-md-4">
            <!-- Card Flip Container -->
            <div class="pickup-card">
              <div class="pickup-card-inner">
                <!-- Front Side -->
                <div class="pickup-card-front">
                  <!-- Eye icon for flip action -->
                  <button class="flip-btn"><i class="fas fa-eye"></i></button>
                  <h5 class="card-title">Pickup ID: <?php echo htmlspecialchars($pickup->pickup_id, ENT_QUOTES, 'UTF-8'); ?></h5>
                  <div class="detail-item">
                    <i class="fas fa-car"></i>
                    <span> 
                    Vehicle Info: <?php 
  echo isset($pickup->brand) ? htmlspecialchars($pickup->brand, ENT_QUOTES, 'UTF-8') . ' ' : ''; 
  echo isset($pickup->model) ? htmlspecialchars($pickup->model, ENT_QUOTES, 'UTF-8') : 'N/A'; 
?>

                     
                    </span>
                  </div>
                  <div class="detail-item">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Created At: <?php echo isset($pickup->created_at) ? htmlspecialchars($pickup->created_at, ENT_QUOTES, 'UTF-8') : 'N/A'; ?></span>
                  </div>
                  <?php if (isset($pickup->service_type) && strtolower($pickup->status) != 'delivered'): ?>
                    <div class="in-progress">
                      <div class="spinner">
                        <i class="fa fa-wrench"></i>
                      </div>
                      <div class="progress-text" style="margin: 0 0.5em;">In Progress
                        <?php if (isset($pickup->service_type) && strtolower($pickup->service_type) == 'express'): ?>
      
                          <i class="fa-solid fa-bolt-lightning" style="color:red;padding-left:5px;"></i>
     
    <?php endif; ?>
  </div>

    <!-- only show car if total_amount ≠ 'force pickup' -->
    
  </div>
                  <?php else: ?>
                    <div class="completed">
                      <div class="check-icon"><i class="fa fa-check-circle"></i></div>
                      <div class="completed-text">Completed</div>
                    </div>
                  <?php endif; ?>
                  
                </div>
                <!-- Back Side -->
                <div class="pickup-card-back">
                  <h5>Tracking Made Simple!</h5>
                  <p>Hit below to know the status of your vehicle</p>
                  <a href="<?php echo site_url('tracking/details/' . urlencode($pickup->pickup_id)); ?>">Get Tracking Details <i class="fas fa-arrow-right"></i></a>
                  <div class="assistance-notice">
    <strong></strong>
  </div>
                </div>

              
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="alert alert-info" role="alert">
        No pickup entries found for your account.
      </div>
    <?php endif; ?>
  </main>
  <div class="sidebarnew" id="sidebar">
  <div class="top-section">
  <h3  style="font-size:19px;font-weight:500;color:black;">Hello, <?php echo html_escape($this->session->userdata('name')); ?></h3>
    

    <button class="close-btn" onclick="toggleSidebar()"><i class="fas fa-times"></i></button>
  </div>

  <div class="profile-section">
    <img src="<?= html_escape( $this->session->userdata('avatar') ) ?>" class="profile-pic" alt="Profile Picture">
    <p style="margin-top: 10px; font-weight: 500;"><?php echo html_escape($this->session->userdata('membership')); ?></p>
  </div>

  <div class="avatar-options">
    <p style="margin-left:65px;">Choose Your Avatar</p>
    <div class="avatar-list" id="avatar-list"></div>
  </div>

  <div class="menu">
    <a href="<?= site_url('home/profile') ?>"><i class="fas fa-user-circle"></i> Profile</a>
    <a href="<?= site_url('advanced') ?>"><i class="fas fa-house-user"></i> Home</a>
    <a href="<?= site_url('home/support') ?>"><i class="fas fa-headset"></i> Support</a>
  </div>

  <a href="<?php echo site_url('home/logout'); ?>">
    <button class="logout-btn">Logout</button>
  </a>
</div>
  
  <!-- Footer -->
  <!-- Footer -->
<footer>
  <div class="container">
    <div class="footer-content">
      <p>&copy; <?php echo date("Y"); ?> Xfinity.In. All rights reserved</p>
      <div class="social-icons">
        <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </div>
</footer>

  <!-- Scripts: Timeline Animation, Smooth Scroll, & Flip Functionality -->
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
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const totalDuration = 5000;
      const steps = 5;
      const interval = totalDuration / steps;
      const stepIds = ["step-1", "step-2", "step-3", "step-4", "step-5"];
      let currentStep = 0;
      
      setInterval(() => {
        stepIds.forEach(id => document.getElementById(id).classList.remove("active"));
        document.getElementById(stepIds[currentStep]).classList.add("active");
        currentStep = (currentStep + 1) % steps;
      }, interval);

      document.getElementById("scrollToBottom").addEventListener("click", function(e) {
        e.preventDefault();
        window.scrollTo({ top: document.body.scrollHeight, behavior: "smooth" });
      });
      
      // Flip functionality for pickup cards on button click
      const flipButtons = document.querySelectorAll('.flip-btn');
      flipButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
          e.stopPropagation();
          const cardInner = this.closest('.pickup-card').querySelector('.pickup-card-inner');
          cardInner.classList.toggle('flipped');
        });
      });
      
      // Automatically flip back to front when mouse leaves the card
      const pickupCards = document.querySelectorAll('.pickup-card');
      pickupCards.forEach(card => {
        card.addEventListener('mouseleave', function() {
          const cardInner = card.querySelector('.pickup-card-inner');
          cardInner.classList.remove('flipped');
        });
      });
    });
  </script>
  
  <!-- Particles.js Library & Config -->
  <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
  <script>
    particlesJS("particles-js", {
      "particles": {
        "number": { "value": 50, "density": { "enable": true, "value_area": 800 } },
        "color": { "value": "#ffffff" },
        "shape": { "type": "circle" },
        "opacity": { "value": 0.5, "random": false },
        "size": { "value": 3, "random": true },
        "move": { "enable": true, "speed": 1, "direction": "none", "random": true, "straight": false, "out_mode": "out" }
      },
      "interactivity": {
        "detect_on": "canvas",
        "events": { "onhover": { "enable": false }, "onclick": { "enable": false } }
      },
      "retina_detect": true
    });
  </script>
  
  <!-- Bootstrap 5 JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
