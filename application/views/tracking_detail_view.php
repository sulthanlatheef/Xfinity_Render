<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Service Tracking - Xfinity</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- particles.js for background effect -->
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Google Fonts for modern typography -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: rgb(255, 98, 0);
      --secondary: rgb(255, 128, 0);
      --accent: rgb(255, 114, 71);
      --light: rgb(255, 0, 0);
      --dark: #2D2D2D;
      --timeline-bg: #ffeedd;
    }
    /* Particle Background */
    #particles-js {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -2;
    }
    /* Animated Gradient Background */
    body {
      background: linear-gradient(-45deg, rgb(2, 185, 246), rgb(137, 250, 250), rgb(148, 208, 240), rgb(226, 220, 143));
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      color: var(--dark);
    }
    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    /* Navbar Styles */
    nav {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1000;
      background-color: #ff6600;
      padding: 7px 0;
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
    /* Main Service Tracking Container */
    .tracking-container {
      margin: 80px auto 1.5rem auto;
      display: flex;
      justify-content: center;
      padding: 0 10px;
    }
    .tracking-card {
      background: rgba(255, 255, 255, 0.25);
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 255, 255, 0.3);
      border-radius: 1rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      padding: 2.5rem;
      max-width: 950px;
      width: 100%;
      font-weight: 500;
      letter-spacing: 0.5px;
    }
    /* Heading Styles */
    .tracking-card h2 {
      font-size: 2.1rem;
      text-align: center;
      color: rgba(255, 116, 3, 0.98);
      font-weight: 700;
      margin-bottom: .1rem;
      letter-spacing: 1px;
    }
    .tracking-card h2 i {
      color: rgb(255, 128, 0);
      margin-right: 10px;
    }
    /* Timeline Styles */
    .timeline {
      position: relative;
      margin: 1.3rem 0;
      padding: 0 2%;
    }
    .timeline::before {
      content: '';
      position: absolute;
      top: 50%;
      left: 5%;
      width: 90%;
      height: 8px;
      background: var(--timeline-bg);
      border-radius: 4px;
      transform: translateY(-50%);
      box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
      z-index: 1;
    }
    .timeline-progress {
      position: absolute;
      top: 50%;
      left: 3%;
      transform: translateY(-50%);
      height: 8px;
      background: linear-gradient(90deg, red, orange);
      z-index: 2;
      border-radius: 4px;
      animation: progressPulse 2s ease-out;
      transition: width 0.6s ease;
    }
    @keyframes progressPulse {
      0% { transform: translateY(-50%) scaleX(0.8); }
      50% { transform: translateY(-50%) scaleX(1.05); }
      100% { transform: translateY(-50%) scaleX(1); }
    }
    .timeline-step {
      position: relative;
      z-index: 3;
      text-align: center;
      width: 20%;
      float: left;
      transition: transform 0.3s ease;
    }
    .timeline-step:hover {
      transform: translateY(-15px) scale(1.05) rotate(1deg);
    }
    .step-icon {
      width: 60px;
      height: 60px;
      background: rgba(255, 255, 255, 0.8);
      border: 4px solid var(--timeline-bg);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto;
      font-size: 1.8rem;
      color: var(--dark);
      transition: all 0.3s ease;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .timeline-step:hover .step-icon {
      animation: bounce 0.6s;
    }
    @keyframes bounce {
      0%   { transform: translateY(0); }
      30%  { transform: translateY(-8px); }
      50%  { transform: translateY(0); }
      70%  { transform: translateY(-4px); }
      100% { transform: translateY(0); }
    }
    .timeline-step.active .step-icon {
      border-color: var(--primary);
      background: var(--primary);
      color: #fff;
      transform: scale(1.15);
      box-shadow: 0 0 15px rgb(255, 81, 0);
      animation: pulse 1.5s infinite;
    }
    .timeline-step.completed .step-icon {
      border-color: rgb(255, 81, 0);
      background: rgb(255, 98, 0);
      color: #fff;
      box-shadow: 0 0 10px rgb(223, 216, 216);
    }
    .timeline-step .text-muted {
      margin-top: 0.5rem;
      font-size: 0.95rem;
      font-weight: 600;
    }
    @keyframes pulse {
      0% {
        box-shadow: 0 0 0 0 rgba(255,140,0,0.5);
      }
      70% {
        box-shadow: 0 0 0 20px rgba(255,140,0,0);
      }
      100% {
        box-shadow: 0 0 0 0 rgba(255,140,0,0);
      }
    }
    .timeline:after {
      content: "";
      display: table;
      clear: both;
    }
    /* Enhanced Detail Cards */
    .detail-card {
      background: linear-gradient(135deg, rgb(253, 253, 253), rgba(255, 255, 255, 0.9));
      border-radius: 1.5rem;
      padding: 1.5rem 2.5rem;
      margin-bottom: 1rem;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-left: 5px solid var(--primary);
      transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
      font-weight: 600;
      letter-spacing: 0.6px;
      min-height: 201px;
    }
    .detail-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
      background: linear-gradient(135deg, rgb(253, 253, 253), rgba(241,243,245,1));
    }
    .detail-card h5 {
      margin-bottom: 1rem;
      padding-bottom: 0.5rem;
      border-bottom: 2px solid var(--primary);
      font-weight: 700;
      color: var(--primary);
      letter-spacing: 0.5px;
    }
    .detail-card h5 i {
      color: var(--primary);
      margin-right: 5px;
    }
    .detail-card p {
      font-size: 0.95rem;
      line-height: 1.5;
    }
    /* Active Payment Card Additional Styling */
    .active-payment {
      border-left: 5px solid var(--accent);
      background: linear-gradient(135deg, #fff,rgb(255, 255, 255));
      box-shadow: 0 0 15px rgb(252, 29, 4);
    }
    /* Custom Payment Button Style */
    .status-button {
  background: rgb(255, 0, 0);
  color: #fff;
  padding: 0.5rem 1.5rem;
  border-radius: 2rem;
  display: inline-flex;
  align-items: center;
  font-size: 1rem;
  border: none;
  cursor: pointer;
  margin-top: 5.5px; /* 👈 This moves it slightly down */
}

    /* Animated icon for the button */
    .animated-icon {
      margin-left: 0.5rem;
      animation: bounce 2s infinite;
    }
    /* Status Badge */
    .status-badge {
      background: rgb(255, 0, 0);
      color: #fff;
      padding: 0.35rem 1rem;
      border-radius: 2rem;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 1rem;
    }
    .status-display {
      margin-top: 1rem;
      text-align: center;
    }
    /* Spinning animation for the refresh icon */
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    .spin {
      animation: spin 1.5s linear infinite;
    }
    /* Disabled Payment Session Card */
    .disabled-card {
      filter: grayscale(100%);
      pointer-events: none;
    }
    /* Footer */
    footer {
      background: var(--primary);
      color: var(--light);
      text-align: center;
      padding: 1rem 0;
      margin-top: 50px;
    }
    /* Payment Confirmation Animation */
    .payment-confirmation {
      text-align: center;
      padding: 2rem 0;
      font-size: 3.5rem;
      color: var(--primary);
      animation: fadeInContainer 1s ease;
      margin-top: -10px;
    }
    @keyframes fadeInContainer {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }
    /* Container for the circle and check mark */
    .confirmation-icon-container {
      position: relative;
      width: 100px;
      height: 100px;
      margin: -18px auto 1rem auto;
    }
    /* Ensure SVG takes full container dimensions */
    .checkmark-circle {
      width: 100%;
      height: 100%;
      display: block;
    }
    /* Center the check mark icon inside the container */
    .checkmark-icon {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 3rem;
      color: green;
      opacity: 0;
      animation: fadeIn 0.5s ease forwards 1s;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translate(-50%, -50%) scale(0); }
      to { opacity: 1; transform: translate(-50%, -50%) scale(1); }
    }
    /* Payment Processing Overlay */
    #paymentOverlay {
      display: none; /* Initially hidden */
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(7px);
      z-index: 9999;
      align-items: center;
      justify-content: center;
    }
    /* Container for processing animation */
    .processing-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    /* New CSS for two 75% complete concentric circles spinning in opposite directions */
    .outer-circle {
      fill: none;
      stroke: url(#grad);
      stroke-width: 10;
      /* For r = 45, circumference ≈ 282.7, so 75% ≈ 212 visible, gap ≈ 70 */
      stroke-dasharray: 212 70;
      transform-origin: center;
      animation: spinClockwise 1.8s linear infinite;
    }
    .inner-circle {
      fill: none;
      stroke: url(#grad);
      stroke-width: 8;
      /* For r = 35, circumference ≈ 219.9, so 75% ≈ 165 visible, gap ≈ 55 */
      stroke-dasharray: 165 55;
      transform-origin: center;
      animation: spinCounterClockwise 1.8s linear infinite;
    }
    @keyframes spinClockwise {
      from { transform: rotate(0deg); }
      to { transform: rotate(1080deg); }
    }
    @keyframes spinCounterClockwise {
      from { transform: rotate(0deg); }
      to { transform: rotate(-1080deg); }
    }
    /* Updated Processing Text */
    .processing-text {
      margin-top: 15px;  /* moved down */
      font-size: 23px;   /* increased size */
      color: #fff;       /* white color */
      //animation: popText 2s ease-in-out infinite;
    }
    @keyframes popText {
      100%, 100% { transform: translateY(0) scale(1); opacity: 1; }
      997% { transform: translateY(10px) scale(1.1); opacity: 0.8; }
    }
    .footer{
      text-align:center;
      color:white;
      height:80px;
      font-weight:550;
      font-size:17px;
     
    
  }
  .footer i{
    font-size:30px;
    padding:7.5px;
    transition:all 0.3s ease-in;
  }
  .footer i:hover{
    color: rgb(0, 255, 128);
    transform:translate(0px,-5px);
    cursor:pointer;
  }

  .fanimate{

   display:inline-block;
   cursor:pointer;

  }
  .fanimate:hover{
    color: rgb(0, 255, 128);
    animation:bounce 1s linear infinite;
  }

  @keyframes bounce{
      
    0% {
     transform:translate(0px,0px);
    }
    50%{
      transform:translate(0px,-5px);
    }
    100%{
     transform:translate(0px,0px);
    }
  }
  </style>

  
</head>
<body>
  <!-- Particle Background -->
  <div id="particles-js"></div>

  <!-- Navbar -->
  <nav>
    <div class="navbar-logo">Xfinity</div>
    <div class="nav-links">
      <a href="#ai-features">AI Features</a>
      <a href="#schedule-pickup">Schedule Pickup</a>
      <a href="#ai-diagnosis">AI Diagnosis</a>
      <a href="#track-status">Track Status</a>
    </div>
    <?php if ($this->session->userdata('name')): ?>
      <div class="user-info">
        <span class="username"><?php echo html_escape($this->session->userdata('name')); ?></span>
        <a href="<?php echo site_url('home/logout'); ?>" class="logout-btn">Logout</a>
      </div>
    <?php else: ?>
      <a href="<?php echo site_url('login'); ?>" class="button" style="margin-right:30px; color:#fff; font-size:20px; padding:10px 30px;">Login</a>
    <?php endif; ?>
  </nav>

  <!-- Main Content -->
  <main>
    <div class="container tracking-container">
      <div class="tracking-card">
        <h2>
          <i class="fa fa-cog fa-spin"></i> Hold On ! Service In Progress
        </h2>

        <!-- Animated Timeline -->
        <div class="timeline">
          <div class="timeline-progress" style="width: <?php 
              $statusOrder = [
                'Pickup Scheduled' => 0,
                'Pickup Completed' => 1,
                'In service' => 2,
                'Service Completed' => 3,
                'Delivered' => 4
              ];
              echo (($statusOrder[$pickup_details->status] + 1) * 20);
          ?>%;"></div>
          <?php 
            $steps = [
              ['icon' => 'calendar-check', 'label' => 'Scheduled'],
              ['icon' => 'truck-pickup', 'label' => 'Pickup'],
              ['icon' => 'tools', 'label' => 'In Service'],
              ['icon' => 'check-circle', 'label' => 'Completed'],
              ['icon' => 'home', 'label' => 'Delivered']
            ];
            foreach ($steps as $index => $step) {
              $isCompleted = $statusOrder[$pickup_details->status] > $index;
              $isActive = $statusOrder[$pickup_details->status] == $index;
          ?>
          <div class="timeline-step <?= $isActive ? 'active' : '' ?> <?= $isCompleted ? 'completed' : '' ?>">
            <div class="step-icon">
              <i class="fas fa-<?= $step['icon'] ?>"></i>
            </div>
            <div class="text-muted"><?= $step['label'] ?></div>
          </div>
          <?php } ?>
        </div>

        <!-- Details Section -->
        <div class="row">
          <div class="col-md-6">
            <div class="detail-card">
              <h5><i class="fas fa-info-circle"></i> Pickup Details</h5>
              <p class="mb-1"><strong>TRACKING ID:</strong> <?= $pickup_details->pickup_id ?></p>
              <p class="mb-1"><strong>CREATED AT:</strong> <?= $pickup_details->created_at ?></p>
              <p class="text-muted mt-3">
                <i class="fas fa-lock"></i>  256-bit AES encryption on Data
              </p>
            </div>
            <div class="detail-card" style="padding-bottom:0px;">
              <h5><i class="fas fa-cube" ></i> Vehicle Info</h5>
              <p class="mb-1"><strong>Concern:</strong> <span style= "color:red; font-size:16px;"><?= $pickup_details->issue?></span></p>
              <p class="mb-1"><strong>Manufacturer:</strong> <?= $pickup_details->brand ?></p>
              <p class="mb-1"><strong>Model:</strong> <?= $pickup_details->model ?></p>
             
              <p class="mb-1"><strong>Reg NO:</strong> <?= $pickup_details->registration_no ?></p>
            </div>
          </div>
          <div class="col-md-6">
            <?php
              // Payment flags
              $isPaid = !empty($pickup_details->is_paid);
              $isPaymentActive = (!$isPaid && $pickup_details->status==='Service Completed' );
              $paymentCardClass = $isPaid?
                'detail-card active-payment':
                ($isPaymentActive?
                  'detail-card active-payment':'detail-card disabled-card'
                );
              // Compute estimated completion
              $pickupTimestamp = strtotime($pickup_details->pickup_date.' '.$pickup_details->pickup_time);
              $estimatedTimestamp = ($pickup_details->service_type==='Regular')?
                strtotime('+7 days',$pickupTimestamp):strtotime('+24 hours',$pickupTimestamp);
              $estimatedCompletion = date('M d, \a\t g:i A',$estimatedTimestamp);
            ?>
            <div id="paymentCard" class="<?= $paymentCardClass?>" style="min-height:199px;box-shadow:none;margin-top:2px; ">
              <?php if ($isPaid): ?>
                <div class="payment-confirmation" style="padding-bottom:10px; padding-top:15px;">
                  <div class="confirmation-icon-container">
                    <svg class="checkmark-circle" viewBox="0 0 100 100">
                      <circle cx="50" cy="50" r="40" fill="none" stroke="#4CAF50" stroke-width="8"/>
                    </svg>
                    <i class="fas fa-check checkmark-icon"></i>
                  </div>
                  <p style="font-size:20px;color:#4CAF50;margin-top:-15px;">Payment Confirmed !</p>
                  <p style="font-size:15px;margin-top:-5px;margin-bottom:-12px;color:#4CAF50;"> <strong>Transaction ID:</strong> <span style="color:red; font-size:17px;"><?= $pickup_details->payment_id ?></span></p>
                </div>

              <?php elseif ($isPaymentActive): ?>
                <h5><i class="fas fa-credit-card"></i> Payment Session</h5>
                <div class="mb-2 text-center">
                  <button id="pay_now" class="status-button">Proceed to Payment</button>
                </div>
                <p class="text-muted" style="margin-top:21px;"><i class="fas fa-shield-alt"></i> 256-bit AES & SSL Secured Connection</p>

              <?php else: ?>
                <h5><i class="fas fa-credit-card"></i> Payment Session</h5>
                <p class="text-muted mb-2">Payment option will be available once service is completed</p>
                <p class="text-muted"><i class="fas fa-shield-alt"></i> 256-bit AES & SSL Secured Connection</p>
              <?php endif; ?>
            </div>

            <div id="currentStatusCard" class="detail-card">
              <h5><i class="fas fa-clock"></i> Current Status</h5>
              <div class="status-display">
                <span class="status-badge">
                  <i class="fas fa-<?php echo ($pickup_details->status==='Delivered')?'check':'sync-alt'; ?> <?php echo ($pickup_details->status!=='Delivered')?'spin':''; ?>"></i>
                  <?= $pickup_details->status?>
                </span>
              </div>
              <p class="mt-4 text-muted text-center">Estimated completion: <?= $estimatedCompletion?></p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Payment Processing Overlay with Two Concentric Spinning Circles -->
  <div id="paymentOverlay">
    <div class="processing-container">
      <svg class="spinning-circles" width="150" height="150" viewBox="0 0 100 100">
        <defs>
          <linearGradient id="grad" x1="0%" y1="0%" x2="100%" y2="0%">
            <stop offset="0%" style="stop-color:#F37254;stop-opacity:1" />
            <stop offset="100%" style="stop-color:#FF8C00;stop-opacity:1" />
          </linearGradient>
        </defs>
        <!-- Outer circle (75% arc, radius = 45) spins clockwise -->
        <circle class="outer-circle" cx="50" cy="50" r="45" />
        <!-- Inner circle (75% arc, radius = 35) spins counter-clockwise -->
        <circle class="inner-circle" cx="50" cy="50" r="30" />
      </svg>
      <div class="processing-text animate__animated animate__headShake animate__infinite animate__slow">
  Connecting To Razorpay...
  
</div>



    </div>
    
  </div>


  
  <!-- Footer -->
  <footer>
    <div class="footer">
      <p>&copy; <?= date('Y'); ?> Xfinity.In All rights reserved !</p>
      <P> <span class="fanimate"></span>
      <i class="fa-brands fa-themeisle"></i>
      <i class="fa-brands fa-facebook"></i>
      <i class="fa-brands fa-youtube"></i>
      <i class="fa-brands fa-instagram"></i>
      <i class="fa-brands fa-facebook-messenger"></i>
      <i class="fa-brands fa-threads"></i>
      
      </P>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Razorpay Checkout Script -->
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <!-- Initialize particles.js -->
  <script>
    particlesJS("particles-js", {
      "particles": {
        "number": {
          "value": 50,
          "density": { "enable": true, "value_area": 800 }
        },
        "color": { "value": "#FF8C00" },
        "shape": {
          "type": "circle",
          "stroke": { "width": 0, "color": "#000000" }
        },
        "opacity": {
          "value": 0.3,
          "random": true
        },
        "size": {
          "value": 3,
          "random": true
        },
        "line_linked": { "enable": false },
        "move": {
          "enable": true,
          "speed": 1,
          "direction": "none",
          "random": true,
          "out_mode": "out"
        }
      },
      "interactivity": {
        "detect_on": "canvas",
        "events": {
          "onhover": { "enable": false },
          "onclick": { "enable": false },
          "resize": true
        }
      },
      "retina_detect": true
    });

    // Razorpay Payment Integration
    console.log("Payment view loaded.");

  $('#pay_now').click(function(e) {
    e.preventDefault();
    
    // Show the overlay as flex
    $('#paymentOverlay').css('display', 'flex').hide().fadeIn();

    // Delay the payment process for 7 seconds
    setTimeout(function() {
      $.ajax({
        url: "<?php echo site_url('payment/create_order'); ?>",
        type: "GET",
        dataType: "json",
        success: function(result) {
          if(result.status === 'success') {
            var orderData = result.data;
            var options = {
              "key": orderData.key_id,
              "amount": orderData.amount,
              "currency": "INR",
              "name": "XFINITY",
              "description": "Test Transaction",
              "order_id": orderData.order_id,
              "handler": function (response) {
                $.ajax({
                  url: "<?php echo site_url('payment/verify_payment'); ?>",
                  type: "POST",
                  dataType: "json",
                  contentType: "application/json",
                  data: JSON.stringify({
                    razorpay_payment_id: response.razorpay_payment_id,
                    razorpay_order_id: response.razorpay_order_id,
                    razorpay_signature: response.razorpay_signature
                  }),
                  success: function(verifyResult) {
                    $('#paymentOverlay .processing-text').text("Authenticating Transaction...");
$('#paymentOverlay').css('display', 'flex').show(); // Instantly shows it as flex container

setTimeout(function() {
  $('#paymentOverlay').fadeOut();
  var paymentCard = $('#paymentCard');
  var cardHeight = paymentCard.height();
  paymentCard.css('height', cardHeight + 'px');
  paymentCard.empty();

  if (verifyResult.message !== "Payment Processed Successfully!") {
    // Display error message with red circle and cross icon
    paymentCard.append(
      '<div class="payment-confirmation">' +
        '<div class="confirmation-icon-container" style="position: relative; display: inline-block;">' +
          '<svg class="cross-circle" viewBox="0 0 100 100" style="display: block;">' +
            '<circle cx="50" cy="50" r="40" fill="none" stroke="#f44336" stroke-width="8" />' +
          '</svg>' +
          '<i class="fas fa-times" style="color: #f44336; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>' +
        '</div>' +
        '<p style="font-size: 19px; color: #f44336; margin-top: -20px;">Server verification failed!</p>' +
      '</div>'
    );
  } else {
    // Display success message with green circle and check mark icon
    paymentCard.append(
      '<div class="payment-confirmation">' +
    '<div class="confirmation-icon-container">' +
      '<svg class="checkmark-circle" viewBox="0 0 100 100">' +
        '<circle cx="50" cy="50" r="40" fill="none" stroke="#4CAF50" stroke-width="8" />' +
      '</svg>' +
      '<i class="fas fa-check checkmark-icon"></i>' +
    '</div>' +
    '<p style="font-size: 19px;color : #4CAF50; margin-top: -7px;">' + verifyResult.message + '</p>' +
    '<p style="font-size: 15px; margin-top: -10px; color : #4CAF50";">E-receipt sent to inbox!</p>' +
  '</div>'
    );
  }
}, 3000);

                  },
                  error: function(xhr, status, error) {
                    alert('Verification error: ' + error);
                  }
                });
              },
              "prefill": {
                "name": "XFINITY",
                "email": "test@example.com",
                "contact": "7585756479"
              },
              "theme": {
                "color": "rgb(10, 225, 249)"
              },
              // New modal dismiss callback
              "modal": {
                "ondismiss": function() {
                  // First, show the overlay if not already showing
                  $('#paymentOverlay .processing-text').text("Authenticating Transaction...");
                $('#paymentOverlay').css('display', 'flex').show(); 


                  // Wait for 3 seconds before proceeding with the status check
                  setTimeout(function() {
                    $.ajax({
                      url: "<?php echo site_url('payment/check_status'); ?>",
                      type: "GET",
                      dataType: "json",
                      data: {
                        c_pickup_id: "<?php echo $this->session->userdata('c_pickup_id'); ?>",
                        user_id: "<?php echo $this->session->userdata('user_id'); ?>"
                      },
                      success: function(result) {
                        var paymentCard = $('#paymentCard');
                        var cardHeight = paymentCard.height();
                        paymentCard.css('height', cardHeight + 'px');
                        paymentCard.empty();
                        
                        if(result.status === 'paid') {
                          // Simulate transaction confirmation with check icon
                          paymentCard.append(
                            '<div class="payment-confirmation">' +
                              '<div class="confirmation-icon-container">' +
                                '<svg class="checkmark-circle" viewBox="0 0 100 100">' +
                                  '<circle cx="50" cy="50" r="40" fill="none" stroke="#4CAF50" stroke-width="8" />' +
                                '</svg>' +
                                '<i class="fas fa-check checkmark-icon"></i>' +
                              '</div>' +
                              '<p style="font-size: 19px;">Transaction complete</p>' +
                            '</div>'
                          );
                        } else {
                          // Show a warning for an aborted/incomplete transaction.
                          // The green confirmation circle is removed and replaced with a larger red warning icon.
                          paymentCard.append(
                            '<div class="payment-confirmation">' +
                              '<div class="confirmation-icon-container animate__animated animate__swing animate__infinite animate_slow" style="font-size: 5.5rem; color: rgb(255, 0, 0); margin-top: -35px;">' +
                                '<i class="fas fa-exclamation-triangle"></i>' +
                              '</div>' +
                              '<p style="font-size: 19px; margin-top: 25px; color: rgb(255, 0, 0);">Transaction Incomplete. Retry!</p>' +
                            '</div>'
                          );
                        }
                        // Fade out the overlay after updating the UI
                        $('#paymentOverlay').fadeOut();
                      },
                      error: function(xhr, status, error) {
                        alert('Error checking payment status: ' + error);
                        // In case of AJAX error, fade out the overlay after 3 seconds.
                        $('#paymentOverlay').fadeOut();
                      }
                    });
                  }, 3000); // 3-second delay
                }
              }
            };

            var rzp1 = new Razorpay(options);
            rzp1.open();
          } else {
            alert("Error creating order: " + result.message);
          }
        },
        error: function(xhr, status, error) {
          alert("AJAX error: " + error);
        }
      });

      // Hide the overlay after 7 seconds from initial payment click (if not already hidden)
      setTimeout(function() {
        $('#paymentOverlay').fadeOut();
      }, 3000);
    }, 3000); // Adjust delay if needed
  });
  </script>
</body>
</html>
