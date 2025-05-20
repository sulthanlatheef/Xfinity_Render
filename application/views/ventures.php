<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Our Ventures | Xfinity</title>

  <!-- GOOGLE FONTS & ICONS -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

  <!-- AOS ANIMATIONS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

  <style>
    /* RESET & BASE */
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      display:flex;
      flex-direction:column;
      min-height:100vh;
      
      font-family: 'Poppins', sans-serif;
      background: #fafafa;
      color: #333;
      line-height: 1.5;
      min-height: 100vh;
    }
    a { text-decoration: none; color: inherit; }

    /* THEME COLORS & TRANSITIONS */
    :root {
      --clr-primary: #ff6600;
      --clr-secondary: #ff8533;
      --clr-accent: #333;
      --clr-card-bg: #fff;
      --clr-front-gradient: linear-gradient(135deg, #ffefd5, #ffe6d6);
      --transition: 0.3s ease;
      --radius: 12px;
      --shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    /* HEADER */
    header {
      position: sticky;
      top: 0;
      background: var(--clr-primary);
      color: #fff;
      z-index: 100;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }
     nav {
      background-color: #ff6600;
      padding: 5px 20px;
      position: sticky;
      top: 0;
      z-index: 100;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .navbar-logo {
      font-size: 28px;
      color: #fff;
      font-weight: 600;
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
      padding: 10px 20px;
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
      gap: 10px;
    }
    .user-info .username {
      font-size: 18px;
      color: #fff;
      font-weight: 600;
    }
    .user-info .logout-btn {
      background: red;
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
    /* HERO */
    .hero {
   
      text-align: center;
      padding: 5rem 1rem;
      background: linear-gradient(-45deg,rgb(253, 222, 100),rgb(240, 204, 187),rgb(255, 201, 186), #f8d9da);
      background-size: 400% 400%;
      animation: gradientBG 15s ease infinite;
      color: rgb(255, 89, 0);
      height:315px;
    }
    @keyframes gradientBG {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    .hero h1 { font-size: 3rem; margin-top:-30px; }
    .hero p { font-size: 1.2rem; margin-bottom: 1.5rem; opacity: 0.9;margin-top:20px;}

    .search-hero {
      max-width: 500px;
      margin: auto;
      display: flex;
      background: #fff;
      border-radius: 50px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      margin-top:10px;
    }
    .search-hero input {
      flex: 1;
      padding: 0.8rem 1rem;
      border: none;
      font-size: 1rem;
      outline: none;
    }
    .search-hero button {
      background: var(--clr-primary);
      border: none;
      padding: 0 1.2rem;
      display: flex;
      align-items: center;
      cursor: pointer;
      transition: background var(--transition);
    }
    .search-hero button i { font-size: 1.2rem; color: #fff; }
    .search-hero button:hover { background: var(--clr-secondary); }

    /* MAIN GRID */
    main {
      max-width: 1200px;
      margin: 3rem auto;
      padding: 0 1rem;
    }
    .ventures-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 2rem;
   
    }
    @media (max-width: 1024px) {
      .ventures-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 640px) {
      .ventures-grid { grid-template-columns: 1fr; }
    }

    /* FLIP-CARD */
    .card-flip {
      margin-top:-20px;
      perspective: 1400px;
      height: 300px;
       width: 380px;
      margin-bottom:20px;
      margin-left:-10px;
      margin-right:15px;
      
      transition: transform var(--transition);
    }
    .card-flip:hover { transform: translateY(-8px) scale(1.03); }

    .card-inner {
      position: relative;
      width: 100%; height: 100%;
      transform-style: preserve-3d;
      transition: transform 0.7s cubic-bezier(.4,.2,.2,1);
      border-radius: var(--radius);
    }
   .card-inner.flipped {
  transform: rotateY(180deg);
}

    .card-front, .card-back {
      position: absolute;
      width: 100%; height: 100%;
      backface-visibility: hidden;
      border-radius: 30px;
      overflow: hidden;
      box-shadow: var(--shadow);
      display: flex;
      flex-direction: column;
    }
    .card-front {
      background: var(--clr-front-gradient);
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
      text-align: center;
    }
    .card-front .icon-circle {
      width: 70px; height: 70px;
      background: #fff;
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      font-size: 1.6rem; color: var(--clr-primary);
      margin-bottom: 1rem;
    }
    .card-front h3 {
      font-size: 1.5rem;
      font-weight: 600;
      color: var(--clr-accent);
    }
    .card-back {
      background: var(--clr-card-bg);
      transform: rotateY(180deg);
      padding: 1rem 1.5rem;
      justify-content: space-between;
    }
    .details-list {
      list-style: none;
      flex: 1;
      margin-bottom: 1rem;
      overflow-y: auto;
    }
    .details-list li {
      display: flex;
      align-items: center;
      margin-bottom: 0.8rem;
      font-size: 0.95rem;
      color: #555;
    }
    .details-list li i {
      flex-shrink: 0;
      width: 28px;
      text-align: center;
      margin-right: 0.6rem;
      color: var(--clr-primary);
      font-size: 1.1rem;
    }
   .more-info {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.6rem 1.2rem;
  border: none;
  border-radius: 999px;          /* full pill shape */
  background: rgb(254, 106, 0);
  color: #fff;
  font-weight: 600;
  font-size: 0.95rem;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  cursor: pointer;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
  margin-top:20px;
}

.more-info i {
  font-size: 1.1rem;
}

.more-info:hover {
  transform: translateY(-2px) scale(1.05);
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
}

.more-info:active {
  transform: translateY(0) scale(0.98);
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
}


    .call-btn {
      width: 100%;
      text-align: center;
      padding: 0.75rem 0;
      font-size: 1rem;
      font-weight: 500;
      color: #fff;
      background: var(--clr-primary);
      border-radius: 6px;
      transition: all .5s ease;
    }
    .call-btn:hover { transform:scale(1.05); }

    /* FOOTER */
    footer {
      text-align: center;
      padding: 1rem;
      font-size: 0.85rem;
      color: #777;
    }
  </style>
</head>
<body>
  <!-- HEADER -->
 <nav>
    <div class="navbar-logo">Xfinity</div>
    <div class="nav-links">
      <a href="#vehicle-details">Home</a>
      <a href="#issue-details">Track</a>
      
      <a href="#schedule">Contact Us</a>
    </div>
    <?php if ($this->session->userdata('name')): ?>
      <div class="user-info" style="cursor:pointer;" onclick="toggleSidebar()">
      <i class="fa-solid fa-user-astronaut" style="color:white;font-size:29px;padding-right:0px;"></i>
        <span class="username" style="font-size:19.5px;"><?php echo html_escape($this->session->userdata('name')); ?></span>
        
       
      </div>
    <?php else: ?>
      <a href="<?php echo site_url('login'); ?>" class="button" style="margin-right:30px; color:#fff; font-size:20px; padding:10px 30px;">Login</a>
    <?php endif; ?>
  </nav>

  <!-- HERO + SEARCH -->
  <section class="hero" data-aos="fade-down">
    <h1>Explore Our Ventures</h1>
    <p data-aos="fade-up" data-aos-delay="200">
      Find your nearest service center by ZIP code or browse all locations below.
    </p>
    <div class="search-hero" data-aos="zoom-in" data-aos-delay="400">
      <input type="text" id="zip-search" placeholder="Enter ZIP code..." autocomplete="off" />
      <button id="searchBtn"><i class="fas fa-search"></i></button>
    </div>
  </section>

  <!-- MAIN CONTENT -->
   <div style="display:flex;flex-grow:1;">
  <main>
    <div class="ventures-grid" id="ventures-container">
      <?php if (!empty($ventures)): ?>
        <?php foreach ($ventures as $v): ?>
          <div class="card-flip" data-aos="fade-up">
            <div class="card-inner">
            <div class="card-front">
  <div class="icon-circle"><i class="fas fa-map-marker-alt"></i></div>
  <h3><?= html_escape($v['location']) ?></h3>
  <button class="more-info">
    <i class="fas fa-info-circle"></i>
    <span>More Info</span>
  </button>
</div>

              <div class="card-back">
                <ul class="details-list">
                  <li><i class="fas fa-location-arrow"></i><?= html_escape($v['address']) ?></li>
                  <li><i class="fas fa-phone-alt"></i><a href="tel:<?= html_escape($v['contact_no']) ?>"><?= html_escape($v['contact_no']) ?></a></li>
                  <li><i class="far fa-clock"></i>9:00 AM – 6:00 PM</li>
                   <li><i class="fas fa-envelope"></i>info@xfinity.com</li>
                  <li><i class="fas fa-tools"></i>Consultation &amp; Repairs</li>
                 
                </ul>
                <a href="<?= site_url('chat') ?>" class="call-btn">
  <i class="fas fa-comments"></i> Chat Now
</a>

              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p style="text-align:center; padding:2rem;">No ventures found.</p>
      <?php endif; ?>
    </div>
  </main>
      </div>
  <!-- FOOTER -->
  <footer>&copy; <?= date('Y'); ?> Xfinity Ventures. All rights reserved.</footer>

  <!-- SCRIPTS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    $(document).ready(function() {
  // When “More Info” is clicked…
  $('#ventures-container').on('click', '.more-info', function() {
    const $inner = $(this).closest('.card-inner');
    $inner.addClass('flipped');
  });

  // When “Back” is clicked…
  $('#ventures-container').on('click', '.back-btn', function() {
    const $inner = $(this).closest('.card-inner');
    $inner.removeClass('flipped');
  });
});
$(document).ready(function() {
  // Flip to back on “More Info”
  $('#ventures-container').on('click', '.more-info', function() {
    $(this).closest('.card-inner').addClass('flipped');
  });

  // Flip to front on “Back” button
  $('#ventures-container').on('click', '.back-btn', function() {
    $(this).closest('.card-inner').removeClass('flipped');
  });

  // **NEW**: whenever the mouse leaves the entire .card-flip, reset to front
  $('#ventures-container').on('mouseleave', '.card-flip', function() {
    $(this).find('.card-inner').removeClass('flipped');
  });
});

    AOS.init({ duration: 700, once: true });

    // Debounced ZIP search
    let searchTimeout;
    function performSearch() {
      const zip = $('#zip-search').val().trim();
      $.getJSON('<?= site_url("Ventures/search") ?>', { zip }, data => {
        let tpl = '';
        if (data.length) {
          data.forEach(v => {
            tpl += `
              <div class="card-flip" data-aos="fade-up">
    <div class="card-inner">
      <div class="card-front">
        <div class="icon-circle"><i class="fas fa-map-marker-alt"></i></div>
        <h3>${$('<div/>').text(v.location).html()}</h3>
        <button class="more-info">
          <i class="fas fa-info-circle"></i>
          <span>More Info</span>
        </button>
      </div>
                  <div class="card-back">
                    <ul class="details-list">
                      <li><i class="fas fa-location-arrow"></i>${$('<div/>').text(v.address).html()}</li>
                      <li><i class="fas fa-phone-alt"></i><a href="tel:${$('<div/>').text(v.contact_no).html()}">${$('<div/>').text(v.contact_no).html()}</a></li>
                      <li><i class="far fa-clock"></i>9:00 AM – 6:00 PM</li>
                      <li><i class="fas fa-envelope"></i>info@xfinity.com</li>
                      <li><i class="fas fa-tools"></i>Consultation &amp; Repairs</li>
                    
                    </ul>
                  <a href="<?= site_url('chat') ?>" class="call-btn">
    <i class="fas fa-comments"></i> Chat Now
  </a>
                  </div>
                </div>
              </div>`;
          });
        } else {
          tpl = '<p style="text-align:center; padding:2rem;">No ventures found.</p>';
        }
        $('#ventures-container').html(tpl);
        AOS.refresh();
      });
    }

    $('#searchBtn').click(performSearch);
    $('#zip-search')
      .on('keypress', e => { if (e.which === 13) performSearch(); })
      .on('input', () => { clearTimeout(searchTimeout); searchTimeout = setTimeout(performSearch, 500); });
  </script>
</body>
</html>
