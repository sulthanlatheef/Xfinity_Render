<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AI Powered Automobile Workshop</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap"
    rel="stylesheet"
  />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
  />
  <style>
    /* Global Styles */
    body {
      font-family: "Poppins", sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f7f6;
      color: #333;
      box-sizing: border-box;
    }
    a {
      text-decoration: none;
    }
    h1, h2, p {
      margin: 0;
      padding: 0;
    }
    /* Navigation Bar */
    nav {
      background-color: #ff6600;
      padding: 8px 0;
      position: sticky;
      top: 0;
      z-index: 10;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      transition: background-color 0.3s, transform 0.3s;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: nowrap;
    }
    .navbar-logo {
      font-size: 25px;
      color: white;
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
      flex-direction: row;
      align-items: center;
      justify-content: center;
      gap: 20px;
      flex-wrap: nowrap;
    }
    nav a {
      color: white;
      font-size: 20px;
      padding: 10px 30px;
      border-radius: 4px;
      transition: background-color 0.3s, transform 0.3s;
      white-space: nowrap;
    }
    nav a:hover {
      background-color: #ff944d;
      transform: translateY(-3px);
    }
    .user-info {
      display: flex;
      align-items: center;
      margin-right: 30px;
      flex-wrap: nowrap;
    }
    .user-info .username {
      font-size: 18px;
      color: white;
      font-weight: 600;
      margin-right: 15px;
      white-space: nowrap;
    }
    .user-info .logout-btn {
      background: red;
      color: #fff;
      padding: 8px 16px;
      border: none;
      border-radius: 30px;
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      white-space: nowrap;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .user-info .logout-btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    @media (max-width: 768px) {
      .navbar-logo { font-size: 20px; margin-left: 15px; }
      nav a { padding: 10px 20px; font-size: 18px; }
      .user-info .username { font-size: 16px; }
      .user-info { margin-right: 15px; }
    }
    
    /* Chat Button Container */
    .chat-container {
      position: fixed;
      bottom: 20px;
      right: 20px;
      display: flex;
      align-items: center;
      gap: 12px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      padding: 12px 20px;
      border-radius: 50px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 0 15px rgba(0, 123, 255, 0.3);
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease, opacity 0.3s ease;
      animation: float 3s infinite ease-in-out;
      /* Start hidden by default */
      opacity: 0;
      pointer-events: none;
    }
    .chat-container.hidden {
      opacity: 0;
      pointer-events: none;
    }
    .chat-container:not(.hidden) {
      opacity: 1;
      pointer-events: auto;
    }
    .chat-container:hover {
      transform: translateY(-5px) scale(1.05);
      box-shadow: 0 0 50px rgba(9, 128, 255, 0.76);
      background: rgba(211, 203, 203, 0.3);
    }
    .chat-caption {
      font-size: 14px;
      font-weight: bold;
      color: rgba(255, 0, 0, 0.99);
      transition: color 0.3s ease;
    }
    .chat-container:hover .chat-caption {
      color: #00d4ff;
    }
    .chat-icon {
      font-size: 24px;
      color: #fff;
      background: linear-gradient(135deg, #007bff, #00d4ff);
      padding: 12px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 0 20px rgba(0, 123, 255, 0.5);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .chat-icon:hover {
      transform: scale(1.2) rotate(15deg);
      box-shadow: 0 0 30px rgba(0, 123, 255, 0.8);
    }
    @keyframes float {
      0% { transform: translateY(0); }
      50% { transform: translateY(-5px); }
      100% { transform: translateY(0); }
    }
    
    /* Hero Section */
    header {
      position: relative;
      overflow: hidden;
      height: 100vh;
      color: orange;
      text-align: center;
      margin-bottom: 1px;
    }
    #background-video {
      position: absolute;
      top: 20;
      left: 50%;
      transform: translateX(-50%);
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1;
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
    header h1 {
      font-size: 44px;
      font-weight: 700;
      margin-bottom: 452px;
      z-index: 1;
      white-space: nowrap;
      overflow: hidden;
      display: inline-block;
    }
    header p {
      font-size: 24px;
      font-weight: 300;
      margin-bottom: 25px;
      z-index: 1;
    }
    .cta-button {
      background-color: red;
      color: white;
      padding: 15px 30px;
      font-size: 18px;
      font-weight: 600;
      border-radius: 50px;
      text-transform: uppercase;
      letter-spacing: 2px;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.3s;
      z-index: 1;
    }
    .cta-button:hover {
      background-color: #3498db;
      transform: translateY(-2px);
    }
    
    /* AI Features Section Styles */
    #ai-features {
      background-color: #fff;
      padding: 105px 20px;
      text-align: center;
    }
    #ai-features h2 {
      font-size: 36px;
      color: #ff6600;
      font-weight: 600;
      margin-bottom: 20px;
    }
    #ai-features p {
      font-size: 18px;
      color: #555;
      line-height: 1.6;
      margin-bottom: 50px;
      max-width: 900px;
      margin-left: auto;
      margin-right: auto;
    }
    .ai-features-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
    }
    .feature-card {
      background: linear-gradient(145deg, #ffffff, #f0f0f0);
      border-radius: 10px;
      padding: 20px 15px;
      width: 280px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s, box-shadow 0.3s;
      text-align: center;
      flex-shrink: 0;
      margin-bottom: 40px;
    }
    .feature-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }
    .feature-card i {
      color: #ff6600;
      margin-bottom: 15px;
      font-size: 3rem;
    }
    .feature-card h3 {
      font-size: 20px;
      color: #ff6600;
      margin-bottom: 10px;
      font-weight: 600;
    }
    .feature-card p {
      font-size: 15px;
      color: #555;
      line-height: 1.4;
      margin-bottom: 15px;
    }
    .feature-card a.cta-button {
      background-color: rgb(255, 17, 0);
      color: white;
      padding: 10px 15px;
      font-size: 20px;
      font-weight: 600;
      border-radius: 35px;
      text-transform: uppercase;
      letter-spacing: 1px;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.3s;
      display: inline-block;
    }
    .feature-card a.cta-button:hover {
      background-color: #3498db;
      transform: translateY(-2px);
    }
    .feature-card img.card-img {
      width: 100%;
      height: auto;
      margin-bottom: 15px;
      border-radius: 8px;
    }
    .cta-text {
      font-size: 18px;
      color: #555;
      margin-top: 40px;
      animation: textPulse 2s ease-in-out infinite, fadeInUp 1s forwards;
      opacity: 0;
    }
    .cta-text a.cta-button {
      background-color: #ff6600;
      color: white;
      padding: 13px 5px;
      font-size: 20px;
      font-weight: 600;
      border-radius: 35px;
      text-transform: uppercase;
      letter-spacing: 2px;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
      text-decoration: none;
    }
    .cta-text a.cta-button:hover {
      background-color: #3498db;
      transform: scale(1.1);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    @keyframes fadeInUp {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    @keyframes textPulse {
      0%, 100% { transform: scale(1); color: #3498db; }
      50% { transform: scale(1.05); color: red; }
    }
    @keyframes buttonPulse {
      0%, 100% { transform: scale(1); background-color: #ff6600; }
      50% { transform: scale(1.05); background-color: #3498db; }
    }
    
    /* Footer Section */
    footer {
  background: linear-gradient(135deg, #2c3e50, #34495e);
  color: #fff;
  padding: 3px 20px;
  text-align: center;
  position: relative;
  box-shadow: 0 -3px 10px rgba(0, 0, 0, 0.2);
}

footer p {
  font-size: 16px;
  margin-bottom: 20px;
}

footer a {
  color: #ecf0f1;
  text-decoration: none;
  transition: color 0.3s, transform 0.3s;
}

footer a:hover {
  color: #3498db;
  transform: scale(1.1);
}

footer .social-icons i {
  font-size: 24px;
  margin: 0 12px;
  transition: color 0.3s, transform 0.3s;
}

footer .social-icons i:hover {
  color: #3498db;
  transform: translateY(-5px);
}

@media screen and (max-width: 768px) {
  footer {
    padding: 40px 10px;
  }
  footer p {
    font-size: 14px;
  }
  footer .social-icons i {
    font-size: 20px;
    margin: 0 8px;
  }
}


  </style>
</head>
<body>
  <!-- Navigation Bar -->
  <nav>
    <div class="navbar-logo">Xfinity</div>
    <a href="#ai-features">AI Features</a>
    <a href="#schedule-pickup">Schedule Pickup</a>
    <a href="#schedule-pickup">AI Diagnosis</a>
    <a href="#schedule-pickup">Track Status</a>
    <?php if ($isLoggedIn): ?>
      <div class="user-info">
        <span class="username"><?php echo html_escape($userName); ?></span>
        <a href="<?php echo site_url('home/logout'); ?>" class="logout-btn">Logout</a>
      </div>
    <?php else: ?>
      <a href="<?php echo site_url('login'); ?>" class="button">Login</a>
    <?php endif; ?>
  </nav>
  <!-- Hero Section -->
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
  <!-- AI Features Section -->
  <div class="section" id="ai-features">
    <h2>Next-Gen Car Services</h2>
    <p>
      Experience cutting-edge auto care with AI-powered diagnostics, seamless booking,
      real-time tracking, and expert service—making car maintenance faster, smarter, and
      hassle-free.
    </p>
    <div class="ai-features-container">
      <!-- Intelligent Diagnostics Card -->
      <div class="feature-card">
        <i class="fas fa-brain"></i>
        <h3>Intelligent Diagnostics</h3>
        <p>
          Upload a photo, and our AI will instantly detect damages, assess severity, and
          suggest the best repair solutions—making car care smarter and easier than ever.
        </p>
      </div>
      <!-- Automated Repair Suggestions Card -->
      <div class="feature-card">
        <i class="fas fa-calendar-check"></i>
        <h3>Seamless Booking</h3>
        <p>
          Schedule your car service in just a few clicks with our advanced booking system.
          Select your preferred service, pick a date, and confirm your appointment hassle-free.
        </p>
      </div>
      <!-- Performance Optimization Card -->
      <div class="feature-card">
        <i class="fas fa-map-marker-alt"></i>
        <h3>Real-Time Tracking</h3>
        <p>
          Track your vehicle’s service progress in real time with live updates. Get notified
          about ongoing repairs, estimated completion time, and stay informed every second.
        </p>
      </div>
      <!-- Predictive Maintenance Card -->
      <div class="feature-card">
        <i class="fas fa-tools"></i>
        <h3>Genuine Parts guaranteed</h3>
        <p>
          We use only high-quality, genuine parts to ensure top performance and durability.
          Our skilled technicians provide expert care to keep your car in optimal condition.
        </p>
      </div>
      <!-- Generate Estimate Card with Image -->
      <div class="feature-card">
        <img src="<?php echo base_url('assets/images/image-250x150 (5).jpg'); ?>" alt="Generate Estimate" class="card-img" />
        <h3>Generate Estimate</h3>
        <p>
          Get an instant repair estimate using our AI-powered models  specially tailored to meet your vehicle's repair needs in an efficient manner
        </p>
        <a href="<?php echo site_url('schedule_pickup'); ?>" class="cta-button">Generate Estimate</a>
      </div>
      <!-- Schedule Pickup Card -->
      <div class="feature-card" id="schedule-pickup">
        <img src="<?php echo base_url('assets/images/image-250x150.jpg'); ?>" alt="Schedule Pickup" class="card-img" />
        <h3>Schedule Pickup</h3>
        <p>
          Request a pickup for your vehicle and let us take care of the rest. We'll collect your car, diagnose it, and recommend repairs.
        </p>
        <a href="<?php echo site_url('schedule_pickup'); ?>" class="cta-button">Schedule Pickup</a>
      </div>
      <!-- Track Status Card -->
      <div class="feature-card">
        <img src="<?php echo base_url('assets/images/image-250x150 (13).jpg'); ?>" alt="Track Status" class="card-img" />
        <h3>Track Your Vehicle</h3>
        <p>
          Stay informed! Track the progress of your vehicle’s repair in real time, from pickup to each and every process untill completion.
        </p>
        <a href="<?php echo site_url('track_status'); ?>" class="cta-button">Track Status</a>
      </div>
      <!-- Locate Ventures Card -->
      <div class="feature-card">
        <img src="<?php echo base_url('assets/images/image-250x150 (4).JPG'); ?>" alt="Locate Ventures" class="card-img" />
        <h3>Locate Ventures</h3>
        <p>
          Need assistance locating a nearby venture? Our AI will guide you to the nearest workshop, service center, or partner.
        </p>
        <a href="<?php echo site_url('locate_ventures'); ?>" class="cta-button">Locate Ventures</a>
      </div>
    </div>
    <!-- Chat Button Container (hidden by default) -->
    <div class="chat-container hidden">
      <span class="chat-caption">Need Help? Let's Chat!</span>
      <a href="<?php echo site_url('chatbot'); ?>" class="chat-icon">
        <i class="fas fa-comment-alt"></i>
      </a>
    </div>
  </div>
  <!-- Footer Section -->
  <footer>
    <p>&copy; 2024 AI Powered Automobile Workshop. All rights reserved.</p>
    <p>
      Follow us on:
      <span class="social-icons">
        <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
      </span>
    </p>
  </footer>

  <!-- Smooth Scrolling Script -->
  <script>
    document.getElementById("explore-now-btn").addEventListener("click", function (event) {
      event.preventDefault();
      document.getElementById("ai-features").scrollIntoView({ behavior: "smooth" });
    });
  </script>

  <!-- Optimized Chat Button Toggle -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const chatContainer = document.querySelector(".chat-container");
      const hero = document.querySelector("header");
      let ticking = false;

      function toggleChatButton() {
        // Get the hero section's bounding rectangle.
        const heroRect = hero.getBoundingClientRect();
        // Calculate the visible height of the hero section in the viewport.
        const visibleHeight = Math.max(0, Math.min(heroRect.bottom, window.innerHeight) - Math.max(heroRect.top, 0));
        const heroHeight = heroRect.height;
        const visibleRatio = visibleHeight / heroHeight;
        
        // If 30% or more of the hero is visible, hide the chat button.
        if (visibleRatio >= 0.65) {
          chatContainer.classList.add("hidden");
        } else {
          chatContainer.classList.remove("hidden");
        }
        ticking = false;
      }

      function onScroll() {
        if (!ticking) {
          window.requestAnimationFrame(toggleChatButton);
          ticking = true;
        }
      }
      
      window.addEventListener("scroll", onScroll);
      // Initial check on load
      toggleChatButton();
    });
  </script>
</body>
</html>
