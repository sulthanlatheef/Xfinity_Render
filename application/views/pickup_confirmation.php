<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pickup Confirmation | Premium Auto Care</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Google Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <style>
    :root {
      --primary: #FF7F50;
      --secondary: #FF8C00;
      --accent: #FFD700;
      --bg-dark: #2C2C2C;
      --glass-bg: rgba(255, 255, 255, 0.08);
      --border-glass: rgba(255, 255, 255, 0.15);
      --gradient-bg: linear-gradient(135deg, rgb(87, 59, 20), rgb(80, 42, 10), #FF8C00);
      --card-gradient: linear-gradient(135deg, rgba(255,127,80,0.1), rgba(255,140,0,0.1));
    }
    
    *, *::before, *::after {
      box-sizing: border-box;
    }
    
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: var(--gradient-bg);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #fff;
      overflow: hidden;
      position: relative;
    }
    
    /* Particle Background */
    #particles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
      opacity: 0.5;
    }
    
    /* Main Container */
    .container {
      position: relative;
      z-index: 1;
      width: 90%;
      max-width: 800px;
      background: var(--glass-bg);
      border: 1px solid var(--border-glass);
      backdrop-filter: blur(12px);
      border-radius: 20px;
      padding: 2rem;
      box-shadow: 0 12px 32px rgba(0, 0, 0, 0.5);
      animation: fadeInUp 1s ease forwards;
    }
    
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    header {
      text-align: center;
      margin-bottom: 2rem;
    }
    
    header h1 {
      font-size: 2rem;
      font-weight: 700;
      background: linear-gradient(90deg, var(--secondary), var(--accent));
      background-clip: text;
      -webkit-background-clip: text;
      color: transparent;
      letter-spacing: 2px;
      animation: textShine 2s ease-in-out infinite;
      margin: 0;
      line-height: 1.2;
    }
    
    @keyframes textShine {
      0%, 100% { opacity: 0.8; }
      50% { opacity: 1; }
    }
    
    .tick-wrapper {
      position: relative;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 60px;
      height: 60px;
      margin-bottom: 1rem;
    }
    
    .tick {
      font-size: 2.5rem;
      color: var(--accent);
      animation: popIn 0.5s ease-out forwards 0.2s;
    }
    
    @keyframes popIn {
      0% { transform: scale(0); opacity: 0; }
      60% { transform: scale(1.3); opacity: 1; }
      100% { transform: scale(1); }
    }
    
    .tick-wrapper svg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      transform: rotate(-90deg);
    }
    
    .tick-wrapper circle {
      fill: none;
      stroke: var(--accent);
      stroke-width: 4;
      stroke-dasharray: 190;
      stroke-dashoffset: 190;
      animation: drawCircle 1s ease-out forwards 0.7s;
    }
    
    @keyframes drawCircle {
      to { stroke-dashoffset: 0; }
    }
    
    .timeline {
      position: relative;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin: 2rem 0;
      padding: 0 10px;
    }
    
    .timeline::before {
      content: "";
      position: absolute;
      top: 50%;
      left: 10%;
      right: 10%;
      height: 4px;
      border-radius: 2px;
      background: linear-gradient(90deg, transparent, var(--accent), transparent);
      background-size: 200% auto;
      animation: progressLine 3s ease-in-out infinite;
      z-index: 0;
    }
    
    @keyframes progressLine {
      0% { background-position: 200% center; }
      50% { background-position: 0% center; }
      100% { background-position: 200% center; }
    }
    
    .timeline-item {
      position: relative;
      z-index: 1;
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      transition: transform 0.3s ease;
    }
    
    .timeline-item:hover {
      transform: translateY(-3px);
    }
    
    .icon-wrapper {
      background: var(--bg-dark);
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 3px solid rgba(255, 255, 255, 0.2);
      transition: border 0.3s ease, background 0.3s ease;
      margin-bottom: 0.5rem;
    }
    
    .timeline-item.active .icon-wrapper {
      background: var(--secondary);
      border: 3px solid var(--accent);
      animation: pulseIcon 1.5s infinite;
    }
    
    @keyframes pulseIcon {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.1); }
    }
    
    .icon-wrapper i {
      font-size: 1.4rem;
      color: var(--accent);
    }
    
    .label {
      font-size: 0.85rem;
      font-weight: 500;
    }
    
    .details {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }
    
    .detail {
      background: var(--card-gradient);
      padding: 1.5rem;
      border-radius: 12px;
      border: 2px solid transparent;
      transition: transform 0.3s ease, border 0.3s ease;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      position: relative;
    }
    
    .detail:hover { 
      transform: translateY(-5px);
      border: 2px solid var(--accent);
    }
    
    .detail i {
      font-size: 1.8rem;
      margin-bottom: 0.5rem;
      color: var(--secondary);
    }
    
    .detail h3 {
      font-size: 1rem;
      margin-bottom: 0.3rem;
      text-transform: uppercase;
    }
    
    .detail p { 
      font-size: 0.9rem; 
      margin: 0; 
    }
    
    .pickup-id {
      color: rgb(9, 255, 0);
      font-size: 1.05rem !important;
    }
    
    .detail .small-btn {
      margin-top: 8px;
      padding: 0.4rem 0.8rem;
      font-size: 0.8rem;
      font-weight: 600;
      border: none;
      border-radius: 20px;
      cursor: pointer;
      background: linear-gradient(45deg, var(--primary), var(--secondary));
      color: #fff;
      transition: transform 0.3s ease;
    }
    
    .detail .small-btn:hover {
      transform: translateY(-2px);
    }
    
    .copy-msg {
      position: absolute;
      bottom: 8px;
      font-size: 0.75rem;
      color: var(--accent);
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    
    .confirmation {
      position: relative;
      overflow: hidden;
      display: flex;
      align-items: center;
      gap: 1rem;
      background: linear-gradient(90deg, var(--primary), var(--secondary));
      padding: 1.2rem;
      border-radius: 10px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
      animation: confirmationAnim 1.2s ease-out forwards;
    }
    
    @keyframes confirmationAnim {
      0% { transform: translateY(20px) scale(0.95); opacity: 0; }
      60% { transform: translateY(0) scale(1.05); opacity: 1; }
      100% { transform: translateY(0) scale(1); }
    }
    
    .confirmation::before {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle at center, rgba(255,255,255,0.1), transparent 60%);
      animation: rotateBg 5s linear infinite;
      z-index: 0;
    }
    
    @keyframes rotateBg {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }
    
    .confirmation i {
      font-size: 2.2rem;
      z-index: 1;
    }
    
    .confirmation div {
      z-index: 1;
    }
    
    .confirmation h3 {
      font-size: 1.1rem;
      margin: 0;
    }
    
    .confirmation p {
      font-size: 0.85rem;
      margin: 0;
    }
    
    .btn-wrapper { 
      text-align: center; 
      margin-top: 2.5rem;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 10px;
    }
    
    .btn-track, .btn-home {
      background: linear-gradient(45deg, var(--primary), var(--secondary));
      color: #fff;
      padding: 1rem 2.5rem;
      border: none;
      border-radius: 50px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
      position: relative;
      overflow: hidden;
    }
    
    .btn-track::after, .btn-home::after {
      content: "";
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: rgba(255,255,255,0.2);
      transform: skewX(-45deg);
      transition: all 0.5s ease;
    }
    
    .btn-track:hover::after, .btn-home:hover::after {
      left: 100%;
    }
    
    .btn-track:hover, .btn-home:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }
    
    .btn-home {
      background: linear-gradient(45deg, var(--secondary), var(--primary));
    }
    
    @media (max-width: 600px) {
      .container { padding: 1.5rem; }
      header h1 { font-size: 1.5rem; }
      .btn-wrapper { flex-direction: column; }
    }
  </style>
</head>
<body>
  <!-- Particle Background -->
  <canvas id="particles"></canvas>
  
  <main class="container">
    <header>
      <div class="tick-wrapper">
        <span class="tick"><i class="fas fa-check"></i></span>
        <svg viewBox="0 0 70 70">
          <circle cx="35" cy="35" r="30"></circle>
        </svg>
      </div>
      <h1>
        <?php
          $full_name = $this->session->userdata('name');
          $first_name = explode(" ", $full_name)[0];
          echo "We're On It, " . html_escape($first_name) . "!";
        ?>
      </h1>
    </header>
    
    <section class="timeline">
      <div class="timeline-item active">
        <div class="icon-wrapper">
          <i class="fas fa-calendar-check"></i>
        </div>
        <div class="label">Scheduled</div>
      </div>
      <div class="timeline-item">
        <div class="icon-wrapper">
          <i class="fas fa-truck"></i>
        </div>
        <div class="label">Pickup</div>
      </div>
      <div class="timeline-item">
        <div class="icon-wrapper">
          <i class="fas fa-tools"></i>
        </div>
        <div class="label">In Service</div>
      </div>
      <div class="timeline-item">
        <div class="icon-wrapper">
          <i class="fas fa-check-double"></i>
        </div>
        <div class="label">Completed</div>
      </div>
    </section>
    
    <section class="details">
      <article class="detail animate__animated animate__fadeInLeft">
        <i class="fas fa-id-badge"></i>
        <h3>Service ID</h3>
        <p class="pickup-id"><?php echo $pickup_id; ?></p>
        <button class="small-btn" id="copyServiceId">Copy</button>
        <span class="copy-msg" id="copyMsg">Copied!</span>
      </article>
      <article class="detail animate__animated animate__fadeInUp">
        <i class="fas fa-clock"></i>
        <h3>Estimated Completion</h3>
        <p>
  <?php
    $vehicletyp = $this->session->userdata('vehicletyp');
    if (empty($vehicletyp)) {
      $pickup_date = $this->session->userdata('pickupdate');
      $pickup_time = $this->session->userdata('pickuptime');
      $pickup_datetime = new DateTime("$pickup_date $pickup_time");
      $pickup_datetime->modify('+24 hours');
      echo $pickup_datetime->format('g:i A, F j');
    } else {
      echo '<span style="color:orange;">Will be informed!</span>';
    }
  ?>
</p>

      </article>
      <article class="detail animate__animated animate__fadeInRight">
        <i class="fas fa-headset"></i>
        <h3>Support</h3>
        <p>24/7 Service Hotline</p>
        <button class="small-btn" id="chatNow">Chat Now</button>
      </article>
    </section>
    
    <section class="confirmation">
      <i class="fas fa-envelope"></i>
      <div>
        <h3>Your Confirmation is on its Way!</h3>
        <p>We've dispatched an email with all the essential details and next steps.</p>
      </div>
    </section>
    
    <div class="btn-wrapper">
      <button class="btn-track animate__animated animate__fadeInUp" onclick="window.location.href='<?= site_url('Tracking') ?>'">
        <i class="fas fa-tachometer-alt"></i> Track Service
      </button>
      <button class="btn-home animate__animated animate__fadeInUp" onclick="window.location.href='<?= site_url('Advanced') ?>'">
        <i class="fas fa-home"></i> Back to Home
      </button>
    </div>
  </main>
  
  <!-- Particle Animation Script -->
  <script>
    const canvas = document.getElementById('particles');
    const ctx = canvas.getContext('2d');
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    
    let mouse = {
      x: undefined,
      y: undefined,
      radius: 100
    };
    
    window.addEventListener('mousemove', (event) => {
      mouse.x = event.x;
      mouse.y = event.y;
    });
    
    const particles = [];
    const maxParticles = 150;
    
    class Particle {
      constructor() {
        this.x = Math.random() * canvas.width;
        this.y = Math.random() * canvas.height;
        this.size = Math.random() * 3 + 1;
        this.speedX = Math.random() * 2 - 1;
        this.speedY = Math.random() * 2 - 1;
        this.hue = Math.random() * 360;
      }
      update() {
        let dx = mouse.x - this.x;
        let dy = mouse.y - this.y;
        let distance = Math.sqrt(dx * dx + dy * dy);
        if (distance < mouse.radius) {
          let forceDirectionX = dx / distance;
          let forceDirectionY = dy / distance;
          let maxDistance = mouse.radius;
          let force = (maxDistance - distance) / maxDistance;
          let directionX = forceDirectionX * force * 2;
          let directionY = forceDirectionY * force * 2;
          this.x -= directionX;
          this.y -= directionY;
        }
        this.x += this.speedX;
        this.y += this.speedY;
        if (this.x > canvas.width) this.x = 0;
        if (this.x < 0) this.x = canvas.width;
        if (this.y > canvas.height) this.y = 0;
        if (this.y < 0) this.y = canvas.height;
        this.hue += 0.5;
      }
      draw() {
        let color = `hsla(${this.hue}, 70%, 60%, 0.8)`;
        const gradient = ctx.createRadialGradient(this.x, this.y, 0, this.x, this.y, this.size);
        gradient.addColorStop(0, color);
        gradient.addColorStop(1, 'rgba(0, 0, 0, 0)');
        ctx.fillStyle = gradient;
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        ctx.fill();
      }
    }
    
    function initParticles() {
      for (let i = 0; i < maxParticles; i++) {
        particles.push(new Particle());
      }
    }
    
    function connectParticles() {
      const maxDistance = 100;
      for (let a = 0; a < particles.length; a++) {
        for (let b = a + 1; b < particles.length; b++) {
          let dx = particles[a].x - particles[b].x;
          let dy = particles[a].y - particles[b].y;
          let distance = Math.sqrt(dx * dx + dy * dy);
          if (distance < maxDistance) {
            ctx.strokeStyle = 'rgba(255, 215, 0,' + (1 - distance / maxDistance) + ')';
            ctx.lineWidth = 1;
            ctx.beginPath();
            ctx.moveTo(particles[a].x, particles[a].y);
            ctx.lineTo(particles[b].x, particles[b].y);
            ctx.stroke();
          }
        }
      }
    }
    
    function animateParticles() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      particles.forEach(particle => {
        particle.update();
        particle.draw();
      });
      connectParticles();
      requestAnimationFrame(animateParticles);
    }
    
    initParticles();
    animateParticles();
    
    window.addEventListener('resize', () => {
      canvas.width = window.innerWidth;
      canvas.height = window.innerHeight;
    });
  </script>
  
  <!-- Copy Service ID and Chat Now Script -->
  <script>
    const copyBtn = document.getElementById('copyServiceId');
    const copyMsg = document.getElementById('copyMsg');
    copyBtn.addEventListener('click', () => {
      const serviceId = document.querySelector('.pickup-id').innerText;
      navigator.clipboard.writeText(serviceId).then(() => {
        copyMsg.style.opacity = 1;
        setTimeout(() => {
          copyMsg.style.opacity = 0;
        }, 1500);
      });
    });
    
    const chatBtn = document.getElementById('chatNow');
    chatBtn.addEventListener('click', () => {
      window.open('https://example.com/chat', '_blank');
    });
  </script>
  
  <!-- Browser Console Debug Logs -->
  <script>
    <?php 
      if(isset($debug_logs) && is_array($debug_logs)) {
        foreach ($debug_logs as $log) {
          echo 'console.log(' . json_encode($log) . ');' . "\n";
        }
      }
    ?>
  </script>
</body>
</html>
