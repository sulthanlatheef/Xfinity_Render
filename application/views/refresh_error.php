<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>XFINITY – Google Sign-Up Error</title>

  <!-- Font Awesome for icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <!-- Particles.js -->
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js" defer></script>
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
    #particles-js { position: absolute; inset: 0; z-index: 1; }

    /* Navbar */
    .navbar {
      position: fixed; top: 0; left: 0; right: 0; z-index: 2;
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
      margin-left: 1.5rem; color: #fff; text-decoration: none;
      transition: color var(--transition);
    }
    .nav-links a:hover { color: var(--gradient-start); }

    /* Container & Card */
    .container {
      position: relative; z-index: 2;
      display: flex; justify-content: center; align-items: center;
      padding: 120px 1rem 2rem; min-height: 100vh;
    }
    .register-card {
      width: 100%; max-width: 600px;
      background: var(--card-bg);
      border-radius: var(--radius);
      padding: 2rem;
      box-shadow: 0 8px 24px rgba(0,0,0,0.6);
      backdrop-filter: blur(15px);
      transition: transform var(--transition);
      text-align: center;
    }
    .register-card:hover { transform: translateY(0px); }

    /* Error Message */
    .error-heading {
      font-size: 1.8rem; margin-bottom: 0.5rem;
      background: linear-gradient(45deg, var(--gradient-start), var(--gradient-end));
      -webkit-background-clip: text; color: transparent;
    }
    .error-text {
      font-size: 1rem; color: #FF4949; margin-top: 1rem;
      line-height: 1.5;
    }
    .back-button {
      display: inline-flex; align-items: center;
      margin-top: 1.5rem;
      padding: 0.6rem 1.4rem; border-radius: var(--radius);
      background: linear-gradient(45deg, var(--gradient-start), var(--gradient-end));
      color: #fff; border: none; cursor: pointer;
      transition: background var(--transition);
      font-size: 1rem;
    }
    .back-button:hover {
      background: linear-gradient(45deg, var(--gradient-end), var(--gradient-start));
    }
    .back-button i {
      margin-right: 0.5rem;
    }
  </style>
</head>

<body>
  <div id="particles-js"></div>

  <nav class="navbar">
    <div class="logo">XFINITY</div>
    <div class="nav-links">
      <a href="#">Home</a>
      <a href="#">Services</a>
      <a href="#">About</a>
      <a href="#">Contact</a>
    </div>
  </nav>

  <div class="container">
    <div class="register-card">
      <div class="error-heading">Oops!</div>
      <p class="error-text">
        Looks like you refreshed the page during Google Sign-Up.<br/>
        Please go back and try signing up with Google again.
       
      </p>
      <button class="back-button" onclick="window.history.back();">
        <i class="fas fa-arrow-left"></i>Go Back
      </button>
    </div>
  </div>

  <!-- Particles.js initialization -->
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
    });
  </script>
</body>
</html>
