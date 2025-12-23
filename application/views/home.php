<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/technical-service'); ?>">

    <title>Xfinity_Render</title>
    <!-- SEO Meta Tags -->
    <meta name="description" content="AI-based fault prediction system for automobiles to predict and prevent vehicle failures before they happen.">
    <meta name="keywords" content="AI, fault prediction, automobile, maintenance, data science">
    <!-- Google Fonts -->
     <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;800&display=swap" rel="stylesheet">
    <!-- Stylesheets -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>

<style>
  /* Global Styles */
body, html {
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
    color: #333;
    overflow-x: hidden;
    scroll-behavior: smooth;
    height: 100%;
}

/* Navbar Styles */
header {
    background-color: #ff6600;
    color: #fff;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    padding: 20px 0;
    padding-top:20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    width: 100%;
    transition: background 0.3s ease;
}

header .logo {
    position: absolute;
    left: 30px;
    top: 10px;
   
    font-size: 32px;
    font-weight: 800;
    color: #fff;
  
   
}

nav {
    text-align: center;
    
}

nav ul {

    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    
}

nav ul li {
    margin: 0 13px;
    position: relative;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
    font-size: 19px;
    text-transform: uppercase;
    font-weight: 500;
    position: relative;
    display: inline-block;
    padding: 0px 0;
    transition: all 0.3s ease;
}

nav ul li a:hover {
    color: #fff;
    transform: translateY(-5px);
}

nav ul li a::before {
    content: '';
    position: absolute;
    width: 0;
    height: 3px;
    background-color:rgb(246, 243, 240);
    bottom: 0;
    left: 50%;
    transition: width 0.3s ease, left 0.3s ease;
}
 .navbutton{
                     position: absolute; right: 30px; top: 50%; transform: translateY(-50%); display: flex; gap: 12px;
       }
          
       .loginbutton{
        transition:all .5s ease;
        padding: 10px 20px; background: #fff; color: #ff6600; border: none; border-radius: 30px; font-weight: bold; font-size: 14.5px; text-decoration: none; box-shadow: 0 2px 6px rgba(0,0,0,0.15); transition: 0.3s;
       }

       .loginbutton:hover{
        transform:scale(1.06);
       }

       .signupbutton{
        transition:all .5s ease;
        padding: 10px 20px; background: transparent; color: #fff; border: 2px solid #fff; border-radius: 30px; font-weight: bold; font-size: 14.5px; text-decoration: none; transition: 0.3s;
       }
       .signupbutton:hover{
        transform:scale(1.06);
       }

nav ul li a:hover::before {
    width: 100%;
    left: 0;
}

/* Mobile Navbar Styling */
@media (max-width: 768px) {
    nav ul {
        flex-direction: column;
    }

    nav ul li {
        margin: 10px 0;
    }

    .hamburger {
        display: block;
    }
}

/* Hero Section */
.hero-section {
    position: relative;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
    overflow: hidden;
}

.hero-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: -1;
}

.hero-content {
    position: relative;
    z-index: 1;
    color: #fff;
}

.hero-section h1 {
    font-family: 'Orbitron', sans-serif;
    font-size: 3.2rem;
    font-weight: 600;
    margin-bottom: 430px;
    background: linear-gradient(45deg, #ff6347, #ff7f50, #ff4500);
    -webkit-background-clip: text;
    text-shadow: 0 0 15px rgba(255, 99, 71, 0.8), 0 0 25px rgba(255, 99, 71, 1);
    animation: fadeInOut 2.8s infinite ease-in-out;
}

@keyframes fadeInOut {
    0% {
        opacity: 0;
        transform: scale(1.2);
    }
    50% {
        opacity: 1;
        transform: scale(.8);
    }
    100% {
        opacity: 0;
        transform: scale(1);
    }
}

.hero-section p {
    font-family: 'Raleway', sans-serif;
    font-size: 1.5rem;
    margin-bottom: 38px;
    font-weight: 400;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    color: rgba(255, 255, 255, 0.8);
}

.hero-section .btn {
    padding: 15px 30px;
    background-color: #f1c40f;
    color: black;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    border-radius: 50px;
    font-weight: bold;
    transition: background-color 0.3s, transform 0.3s;
}

.hero-section .btn:hover {
    background-color:rgb(255, 204, 0);
    transform: scale(1.08);
}

/* Features Section */
.featuresnew {
    display: flex;
    justify-content: space-between;
    padding: 80px 0;
    background-color: #ffffff;
    text-align: center;
    border-bottom: 1px solid #f0f0f0;
    gap: 30px;
}

.feature-card1 {
    width: 30%;
    background-color: #fff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feature-card1:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.feature-card1 h3 {
    font-size: 1.8rem;
    font-family: 'Montserrat', sans-serif;
    margin-bottom: 5px;
    font-weight: 600;
    color:rgb(19, 19, 19);
}

.feature-card1 p {
    font-size: 1.1rem;
    color: #666;
    font-weight: 400;
}

.feature-card1 img {
    width: 100%;
    height: auto;
    border-radius: 10px;
}

/* About Us Section */
.about-us {
    background: linear-gradient(90deg, #ffffff 0%, #f7f9fb 100%);
    padding: 100px 60px;
    color: #222;
    font-family: 'Montserrat', sans-serif;
    width: 100%;
}

.about-wrapper {
    max-width: 1600px;
    margin: 0 auto;
}

.about-us h2 {
    font-size: 3.6rem;
    font-weight: 800;
    margin-bottom: 10px;
    text-align: left;
    margin-left:120px;
    transform:translateY(-10px);
    background: linear-gradient(90deg,rgb(255, 115, 0),rgb(255, 115, 0));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.about-us .tagline {
    font-size: 1.5rem;
    color: #555;
    margin-bottom: 60px;
    text-align: left;
     margin-left:310px;
    max-width: 900px;
}

.about-flex {
    display: flex;
   flex-direction:row;
   justify-content:space-evenly;
   width:1400px;
    
}

.about-block {
    background: linear-gradient(135deg,rgb(162, 219, 248),rgb(128, 213, 250));
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    width:550px;
}

.about-block:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.08);
}

.about-block h3 {
    font-size: 2rem;
    margin-bottom: 20px;
    color: #111;
    font-weight: 700;
}

.about-block p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #333;
}

.highlight-block {
    background: linear-gradient(135deg, #f7971e, #ffd200);
    color: #111;
}

.highlight-block p {
    color: #111;
    font-weight: 500;
}

.cta {
    margin-top: 20px;
    font-weight: 700;
    font-size: 1.3rem;
}


/* Contact Us Section */
.contact-us {
    background-color: #003366;
    padding: 80px 0;
    text-align: center;
    color: #fff;
}

.contact-us h2 {
    font-size: 2.5rem;
    margin-bottom: 40px;
    font-family: 'Montserrat', sans-serif;
    font-weight: 600;
}

.contact-us form {
    width: 60%;
    margin: 0 auto;
}

.contact-us form label {
    display: block;
    margin-bottom: 10px;
    font-weight: 600;
    font-size: 1.1rem;
}

.contact-us form input,
.contact-us form textarea {
    width: 100%;
    padding: 14px;
    margin-bottom: 25px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
    font-family: 'Lora', serif;
    color: #333;
}

.contact-us form button {
    padding: 14px 30px;
    background-color: #003366;
    color: white;
    border: none;
    font-size: 1.3rem;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.contact-us form button:hover {
    background-color: #f1c40f;
}

/* Ensure the login section is filling the full viewport height */
.login-section {
    position: relative;
    min-height: 100vh; /* Full viewport height */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 0;
}

/* Background video - this stays in the background */
.login-video-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: -1;
}

/* Background video styling */
.login-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover; /* Cover the entire section */
}

/* Login form container */
.login-container {
    position: relative;
    z-index: 1;
    padding: 40px;
    padding-right:70px;
    background-color: rgba(255, 255, 255, 0.92);
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
    border-radius: 10px;
    width: 400px;
    min-height:415px;
    text-align: center;
    max-height: 100%; /* Allow container to grow and shrink with content */
    overflow: auto; /* Allow scroll if content is taller */
}

/* Style the form input fields */
.login-container input {
    width: 100%;
    padding: 15px;
    margin-bottom: 15px;
    border: 1px solid white;
    border-radius: 8px;
    font-size: 1.1rem;
}

/* Button styling */
.login-container button {
    padding: 15px 30px;
    
 
    background-color:rgb(255, 119, 0);
    color: white;
    border: none;
    font-size: 1.3rem;
    font-weight: bold;
    border-radius: 10px;
    cursor: pointer;
    
    transition:  0.3s,all .5s ease;;
}

.login-container button:hover {

    transform:scale(1.02);
}

/* Error message styling */
.error-message {
  margin-left:20px;
    color: red;
    font-weight: bold;
    margin-top: 10px;
}

input:focus{
  outline:2.4px solid rgb(255, 102, 0);
}

/* Link styling */
.login-container a {
    color:rgb(255, 77, 0);
    text-decoration: none;
    font-weight: bold;
}

.login-container a:hover {
    color:rgb(241, 102, 15);
    text-decoration: underline;
}
.password-wrapper {
  position: relative;
}

.password-wrapper input {
  width: 100%;
  padding-right: 15px; /* space for eye icon */
}

.toggle-password {
  position: absolute;
  right: -15px;
  top: 26px;
  transform: translateY(-50%);
  cursor: pointer;
  font-size: 20px;
  color: #555;
}

    

  </style>
  <style>
    
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
      text-align: justify;
      font-size: 15px;
      color: #555;
      line-height: 1.4;
      margin-bottom: 15px;
    }
    .feature-card a.cta-button {
      background-color: rgb(255, 17, 0);
      color: white;
      min-width:280px;
      height:50px;
      padding:10px;
      padding-top:10px;
      padding-bottom:10px;
      font-size: 20px;
      font-weight: 600;
      border-radius: 40px;
      text-transform: uppercase;
      box-sizing:border-box;
     
      cursor: pointer;
      transition: background-color 0.3s, transform 0.3s;
      display: inline-block;
    }
    .feature-cardb {
      background-color: rgb(255, 17, 0);
      color: white;
      min-width:280px;
      height:50px;
      padding:10px;
      padding-right:5px;
      padding-top:10px;
      padding-bottom:10px;
      font-size: 20px;
      font-weight: 600;
      border-radius: 40px;
      text-transform: uppercase;
      box-sizing:border-box;
     border:1px solid red;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-block;
    }
    .feature-card a.cta-button:hover {
      background-color: #3498db;
      transform: translateY(0px);
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
    </style>
<style>
  :root {
    --primary: #FF5722;
    --secondary: #3F51B5;
    --bg: #f9fbfd;
    --card-radius: 26px;
    --shadow: rgba(0,0,0,0.15);
    --transition-fast: 0.3s;
    --transition-medium: 0.5s;
  }

  .service-modes { position: relative; background: var(--bg); overflow: hidden; }
  .wave { position: absolute; width: 100%; left: 0; }
  .wave-top { top: 0; transform: translateY(-1px); }
  .wave-bottom { bottom: 0; transform: translateY(8px); }
  .wave svg { display: block; width: 100%; height: 100px; }

  .container { padding: 6rem 1rem; max-width: 1200px; margin: 0 auto; height:800px; }
  .section-title {
    font-size: 3rem; font-weight: 800; text-align: center; margin-bottom: 4rem;margin-top:-5px;
    background: linear-gradient(90deg, var(--primary), var(--secondary)); -webkit-background-clip: text; color: transparent;
  }

 .service-layout {
  display: grid;
  grid-template-columns: repeat(auto-fit, 550px); /* fixed column size */
  justify-content: center; /* center grid in container */
  gap: 4rem;
}

.service-layout > div {
  height: 250px; /* fixed height */
}

  .card-inner {
    background: #fff;
    border-radius: var(--card-radius);
    padding: 2.5rem;
    position: relative;
    box-shadow: 0 12px 40px var(--shadow);
    transition: transform var(--transition-medium) ease-out, box-shadow var(--transition-medium) ease-out;
    overflow: hidden;
  }
  .service-card:hover .card-inner,
  .service-card:focus .card-inner {
    transform: translateY(-20px) scale(1.02);
    box-shadow: 0 30px 70px var(--shadow);
  }

  .ribbon {
    position: absolute; top: 1rem; left: -2rem;
    background: var(--primary);
    color: #fff;
    padding: 0.25rem 2rem;
    font-size: 0.75rem;
    font-weight: 600;
    transform: rotate(-45deg);
    box-shadow: 0 2px 6px var(--shadow);
    transition: background var(--transition-fast) ease;
  }
  .ribbon.secondary { background: var(--secondary); }

  .service-card:hover .ribbon { background: red; }

  .icon-bg {
    position: absolute;
    width: 200%; height: 200%;
    background: linear-gradient(135deg, var(--primary) 25%, transparent 25%) center/20px 20px;
    top: -50%; left: -50%;
    transform: rotate(45deg);
    opacity: 0.04;
  }

  .icon-wrapper {
    width: 130px; height: 130px;
    background: #fff;
    border-radius: 50%;
    margin: 0 auto 1.5rem;
    display: flex; align-items: center; justify-content: center;
    position: relative; z-index: 1;
    transition: transform var(--transition-medium) ease;
  }
  .service-card:hover .icon-wrapper {
    transform: rotate(360deg) scale(1.2);
    transition-duration: var(--transition-fast);
  }

  .card-inner h3 {text-align: justify; font-size: 1.75rem; margin: 1rem 0 0.5rem; font-weight: 700; }
  .tagline { text-align: justify;font-size: 1rem; color: #555; margin-bottom: 1rem; }
  .detail {text-align: justify; font-size: 0.9rem; color: #666; margin-bottom: 1.25rem; line-height: 1.5; }

  .features-list {
    list-style: none; padding: 0; margin-bottom: 2rem;
    transition: transform var(--transition-fast) ease;
    text-align: justify;
  }
  .service-card:hover .features-list { transform: translateX(5px); }
  .features-list li {text-align: justify; font-size: 0.95rem; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem; }

  .btn {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    position: relative; z-index: 1;
    transition: transform var(--transition-fast) ease, box-shadow var(--transition-fast) ease;
  }
  .btn-primary { background: var(--primary); color: #fff; }
  .btn-secondary { background: var(--secondary); color: #fff; }
  .btn:hover { transform: translateY(-4px) scale(1.07); box-shadow: 0 12px 30px var(--shadow); }

  @media (max-width: 576px) {
    .container { padding: 4rem 1rem; }
    .section-title { font-size: 2.5rem; }
  }
</style>
<svg style="display: none;">
  <symbol id="icon-dent" viewBox="0 0 24 24">
    <!-- placeholder: replace with your dent icon path -->
    <path d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 2a8 8 0 110 16 8 8 0 010-16z"/>
  </symbol>
  <symbol id="icon-windscreen" viewBox="0 0 24 24">
    <!-- placeholder -->
    <path d="M3 3h18v4H3V3zm0 6h18v2H3V9z"/>
  </symbol>
  <!-- add more symbols: icon-headlight, icon-mirror, icon-door, etc. -->
</svg>
<style>
  :root {
    --orange: #ff6a00;
    --orange-light: #ff8a33;
    --orange-dark: #cc4e00;
    --gray-bg: #fafafa;
    --white: #ffffff;
    --shadow: rgba(0, 0, 0, 0.1);
    --radius: 1rem;
    --font-heading: 'Helvetica Neue', Arial, sans-serif;
    --font-body: 'Roboto', sans-serif;
    --transition: 0.3s;
  }

  /* base modal styles */
 .modal {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.6);
  align-items: center;
  justify-content: center;
  z-index: 1000;
  padding: 1rem;
  
}
.modal.show {
  display: flex;
}

  .modal-content {
    background: var(--white);
    width: 900px;
   
    border-radius: var(--radius);
    box-shadow: 0 8px 24px var(--shadow);
    overflow: hidden;
    transform: scale(0.9);
    opacity: 0;
    animation: zoomIn var(--transition) ease-out forwards;
  }
  @keyframes zoomIn {
    to { transform: scale(1); opacity: 1; }
  }

  /* Header with gradient + Lottie */
  .modal-header {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1.5rem;
    background: linear-gradient(135deg, var(--orange-light), var(--orange-dark));
    color: var(--white);
    font-family: var(--font-heading);
  }
  .modal-header h3 {
    margin: 0;
    font-size: clamp(1.5rem, 4vw, 2rem);
    flex: 1;
  }
  .modal-header lottie-player {
    width: clamp(50px, 10vw, 80px);
    height: clamp(50px, 10vw, 80px);
    margin-right: 1rem;
  }
  .modal-header .close {
    background: none;
    border: none;
    color: var(--white);
    font-size: clamp(1.5rem, 4vw, 2rem);
    cursor: pointer;
    transition: transform var(--transition);
    z-index: 1;
  }
  .modal-header .close:hover { transform: rotate(90deg); }

  /* Body & typography */
  .modal-body {
    background: var(--gray-bg);
    padding: 1.5rem;
    font-family: var(--font-body);
    color: #333;
    font-size: clamp(0.9rem, 2.5vw, 1rem);
  }
  .modal-body p { margin-bottom: 1rem; }

  .label {
    display: inline;
    margin: 1rem 0 0.5rem;
    font-weight: bold;
    font-size: clamp(1rem, 2.5vw, 1.1rem);
  }

  /* Issues list with SVG icons */
  .issues-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
    gap: 0.75rem;
    list-style: none;
    padding: 0;
    margin: 0.5rem 0 1rem;
  }
  .issues-list li {
    background: var(--white);
    padding: 0.75rem;
    border-radius: var(--radius);
    box-shadow: 0 2px 8px var(--shadow);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: transform var(--transition), box-shadow var(--transition);
    font-size: clamp(0.9rem, 2.5vw, 1rem);
  }
  .issues-list li:hover {
    transform: translateY(-4px);
    box-shadow: 0 4px 16px var(--shadow);
  }
  .issues-list li svg {
    width: 1.2em;
    height: 1.2em;
    fill: var(--orange);
    flex-shrink: 0;
  }

  /* Footer & buttons */
  .modal-footer {
    padding: 1rem 1.5rem;
    background: var(--white);
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
  }
  .btn {
    padding: 0.6rem 1.2rem;
    border-radius: var(--radius);
    border: none;
    font-family: var(--font-heading);
    font-size: clamp(0.9rem, 2.5vw, 1rem);
    cursor: pointer;
    transition: transform var(--transition), box-shadow var(--transition);
  }
  .btn-primary {
    background: var(--orange);
    color: var(--white);
  }
  .btn-secondary {
     background: var(--orange);
    color: var(--white);
  }
  .btn-primary:hover,
  .btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px var(--shadow);
  }
</style>

<style>
/* Gold Membership Split-Screen Section */

/* Gold Membership Split-Screen Section */
.gold-section {
  display: flex;
  height: 900px;
  background: linear-gradient(120deg, #fff9e6 0%, #fff3cc 100%);
  overflow: hidden;
  box-sizing:border-box;
}
.gold-wrapper {
  display: flex;
  width: 100%;
}
.gold-image {
  flex: 0.45;
  overflow: hidden;
}
.gold-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  max-width: 700px;
  margin: 0 auto;
 
  border-radius: 0px;
  transition: transform 0.6s ease;
}
.gold-image img:hover {
  transform: scale(1.05) rotate(-1.5deg);
}

.gold-benefits-panel {
  flex: 0.55;
  padding: 4rem 3rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.gold-title {
  margin-top:-350px;
   margin-left:50px;
  font-size: 3.1rem;
  font-weight: 800;
  line-height: 1.2;
  margin-bottom: 1rem;
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
}
.gold-title .highlight {
  background: linear-gradient(90deg, #FFD600, #FF8F00);
  -webkit-background-clip: text;
  color: transparent;
  animation: popIn 0.8s ease-out;
}
@keyframes popIn {
  0% { transform: scale(0.7); opacity: 0; }
  60% { transform: scale(1.3); opacity: 1; }
  100% { transform: scale(1); }
}

.gold-description {
  font-size: 1.125rem;
  color: #555;
  margin-left:180px;
  margin-bottom: 2rem;
  max-width: 500px;
  margin-top:-10px;
}

.gold-benefits {
  list-style: none;
  padding: 0;
  margin: 0;
    
}
.gold-benefits li {
  margin-top:5px;
  display: flex;
   color:rgb(15, 14, 14);

  align-items: center;
  gap: 1rem;
  margin-bottom: 1.25rem;
  transition: background 0.3s ease, padding-left 0.3s ease;
  padding-left: 0;
  border-radius: 8px;
}
.gold-benefits li:hover {
  background: rgba(255, 193, 7, 0.15);
  padding-left: 10px;
}
.gold-benefits i {
  margin-top:-10px;
  font-size: 2rem;
  color:rgb(255, 106, 0);
   margin-left:150px;
  transition: transform 0.4s ease;
}
.gold-benefits li:hover i {
  transform: rotate(15deg) scale(1.2);
}
.gold-benefits strong {
  font-size: 1.26rem;
  font-weight: 600;
  margin-left:40px;
}
.gold-benefits small {
  display: block;
   margin-left:40px;
  font-size: 0.875rem;
  color: #666;
}

@media (max-width: 768px) {
  .gold-section {
    flex-direction: column;
    min-height: auto;
  }
  .gold-image,
  .gold-benefits-panel {
    width: 100%;
  }
  .gold-benefits-panel {
    padding: 2rem;
    text-align: center;
  }
  .gold-benefits li {
    justify-content: center;
  }
  .gold-title {
    justify-content: center;
  }
 
}
</style>

<style>
.xyle-section {
  background: radial-gradient(circle at top left, #fff7f0, #ffffff);
  padding: 100px 20px;
  padding-bottom:30px;
  font-family: 'Segoe UI', sans-serif;
  color: #333;
  position: relative;
  overflow: hidden;
}
.xyle-section::before {
  content: '';
  position: absolute;
  top: -100px;
  left: -100px;
  width: 400px;
  height: 400px;
  background: rgba(255, 157, 0, 0.14);
  border-radius: 50%;
  animation: circlePulse 10s ease-in-out infinite;
}
.xyle-section::after {
  content: '';
  position: absolute;
  bottom: -80px;
  right: -80px;
  width: 300px;
  height: 300px;
  background: rgba(255, 159, 0, 0.1);
  border-radius: 50%;
  animation: circlePulse 12s ease-in-out infinite;
}
@keyframes circlePulse {
  0%, 100% { transform: scale(0.8); opacity: 0.5; }
  50% { transform: scale(1.2); opacity: 0.2; }
}
.xyle-container {
  max-width: 1200px;
  margin: 0 auto;
  text-align: center;
  position: relative;
  z-index: 1;
}
.xyle-title {
  margin-top:-18px;
  font-size: 4rem;
  margin-bottom: 20px;
  line-height: 1.1;
  position: relative;
  display: inline-block;
  color:rgba(2, 2, 2, 0.79);
  animation: shimmer 3s infinite;
}
.xyle-title .xyle-highlight {
  background: linear-gradient(90deg, #ff6600, #ff9f00, #ff6600);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-size: 200% 100%;
}
@keyframes shimmer {
  0% { background-position: -200% 0; }
  100% { background-position: 200% 0; }
}
.xyle-quote {
  font-size: 1.4rem;
  color: #555;
  margin: 0 auto 50px;
  max-width: 800px;
  font-style: italic;
  animation: fadeIn 1.5s ease-out both;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}
.xyle-content {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 70px;
  align-items: flex-start;
  text-align: justify;
}
.xyle-ghost {
  flex: 1 1 400px;
  max-width: 500px;
  filter: drop-shadow(0 15px 30px rgba(0,0,0,0.1));
  transform: perspective(800px) rotateY(-15deg);
  transition: transform 0.6s;
}
.xyle-ghost:hover {
  transform: perspective(800px) rotateY(0deg) scale(1.08);
}
.xyle-description {
  flex: 1 1 350px;
  text-align: left;
  text-align: justify;
  animation: fadeIn 2s ease-out both;
}
.xyle-description p {
  font-size: 1.2rem;
  line-height: 1.6;
  margin-bottom: 20px;
  text-align: justify;
}
.xyle-description ul {
  list-style: none;
  padding: 0;
  margin-bottom: 30px;
}
.xyle-description ul li {
  position: relative;
  padding-left: 28px;
  margin-bottom: 15px;
  font-size: 1.15rem;
}
.xyle-description ul li::before {
  content: '★';
  position: absolute;
  left: 0;
  top: 0;
  color: #ff6600;
  animation: starPulse 1.8s infinite;
}
@keyframes starPulse {
  0%,100% { transform: scale(1); opacity: 0.8; }
  50% { transform: scale(1.2); opacity: 1; }
}
.xyle-tagline {
  font-style: italic;
  color: #ff6600;
  font-weight: 600;
  font-size: 1.1rem;
}

.separator {
  position: relative;
  text-align: center;
  margin: 20px 0;          /* vertical spacing above/below */
  font-size: 14px;         /* or whatever font size you prefer */
  color: #000;             /* text color for “or” */
}

.separator::before,
.separator::after {
  content: "";
  position: absolute;
  top: 50%;                /* vertically center the line */
  width: 40%;              /* length of each line (40% of container) */
  height: 1px;             /* thickness of the line */
  background-color: rgba(0, 0, 0, 0.2); /* light black/gray line */
}

.separator::before {
  left: 0px;                 /* line starts at the left edge */
  transform: translateY(-50%);
}

.separator::after {
  right: 0;                /* line ends at the right edge */
  transform: translateY(-50%);
}

</style>





<body>
   <!-- Navbar -->
   <header>
       <div class="logo">
         Xfinity
       </div>
       <nav>
           <ul>
               <li> <a href="#home">Home</a></li>
               <li><a href="#features">Features</a></li>
               <li><a href="#about-us">About</a></li>
               <li><a href="#xyle">Support</a></li>
           
           </ul>
       </nav>

      

       <!-- Login/Signup Buttons -->
  <div class="navbutton">
    <a href="#login" class="loginbutton">
      Login
    </a>
   <a href="<?php echo site_url('register'); ?>" class="signupbutton">
      Signup
    </a>
  </div>
   </header>

   <!-- Hero Section -->
   <section class="hero-section" id="home">
       <video autoplay muted loop class="hero-video">
        <source src="https://res.cloudinary.com/dyjxrihpj/video/upload/v1749470817/12433560_3840_2160_25fps_1_n5ctu5.mp4" type="video/mp4">
           Your browser does not support the video tag.
       </video>
       <div class="hero-content">
           <h1>INNOVATION THROUGH AI</h1>
           <p>Your trusted partner for intelligent car diagnostics and repair</p>
           <a href="#features" class="btn">Explore More</a>
       </div>
   </section>

   <!-- Features Section -->
   <section id="features">
 <div style="text-align: center; margin-top: 50px;">
  <h2 style="
    font-size: 3.1rem;
    font-family: 'Montserrat', sans-serif;
    color: #ff6600;
    letter-spacing: 2px;
    
    margin: 0;
    font-weight: 700;
  ">
  Beyond All Boundaries, Into <lottie-player src="https://lottie.host/a6e982d9-0714-437d-bb6a-1cbb2832a08a/GsIr2t7dHx.json"background="transparent" speed="1" loop autoplay style="margin-left:0px; transform:translateY(40px);display:inline-block;width: 120px; height:120px;padding-top:20px;margin-top:0px;"></lottie-player> 
  </h2>
 
</div>


<div class="featuresnew" style="margin-top:-35px;">
       <div class="feature-card1">
           <img src="https://images.pexels.com/photos/6153354/pexels-photo-6153354.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Advanced Diagnostics">
           <h3>Advanced AI</h3>
           <p>Utilizing cutting-edge AI to detect cosmetic faults of your vehicles,next gen diagnostics.</p>
       </div>
      
       <div class="feature-card1">
           <img src="https://images.pexels.com/photos/6153351/pexels-photo-6153351.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Real-Time Monitoring">
           <h3>Robotic Assistance</h3>
           <p>We have super advanced robots to assist our mechanics, presenting the next gen service.</p>
       </div>
       <div class="feature-card1">
           <img src=" https://images.pexels.com/photos/6153068/pexels-photo-6153068.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Maintenance Alerts">
           <h3>Real-Time Monitoring</h3>
           <p>Keep your vehicle in optimal condition with real-time health checks and data analysis.</p>
       </div>
</div>

   </section>
   
<section style="height:900px;box-sizing:border-box;">
  
    <!-- AI Features Section -->
  <div class="section" id="ai-features" style="margin-top:-230px;">
    <h2>Next-Gen Car Services <lottie-player src="https://lottie.host/d8278d1d-2b57-4434-891a-fa71c591d5f7/f5jBlB1e4g.json"background="transparent" speed="1" loop autoplay style="margin-left:-10px; transform:translateY(30px);display:inline-block;width: 100px; height:100px;padding-top:20px;margin-top:30px;"></lottie-player></h2>
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

</section>
   <!-- Service Modes Section -->
<!-- Service Modes Section: Ultra-Attractive & Smooth Transitions -->
<!-- Service Modes Section with Detailed Modals -->
<section id="service-modes" class="service-modes">
  <!-- Top SVG Wave Divider -->
  <div class="wave wave-top">
    <svg viewBox="0 0 1440 100" preserveAspectRatio="none">
      <path d="M0,0 C600,100 800,0 1440,100 L1440,0 L0,0 Z" fill="#FF5722" />
    </svg>
  </div>

  <div class="container">
    <h2 class="section-title">Our Service Modes</h2>
    <div class="service-layout">

      <!-- Xpress Fix Card -->
      <article class="service-card express-fix" tabindex="0">
        <div class="card-inner">
          <div class="icon-bg"></div>
          <div class="ribbon">Fast & Furious</div>
          <div class="icon-wrapper">
           <lottie-player
        src="https://lottie.host/cc511c6e-fdc7-4363-928c-fc000569571f/K7WvuW62T9.json"
        background="transparent" speed="1" loop autoplay style="width: 500px; height:500px;">
      </lottie-player>
          </div>
          <h3>Xpress Fix</h3>
          <p class="tagline">Revive. Refresh. Return in <strong>24h</strong>.</p>
          <p class="detail">When time is of the essence, our Xpress Fix gets your device back to peak condition in under 24 hours using AI-driven diagnostics </p>
          <ul class="features-list">
            <li>⏱️ <strong>24-Hour Turnaround</strong> Guarantee</li>
            <li>🤖 <strong>AI-Powered Diagnostics</strong> & Instant Estimates</li>
            <li>💥 <strong>Premium Cosmetic Care</strong> (dents, scratches, glass)</li>
          </ul>
      <button 
    class="btn btn-primary" style="margin-left:165px;"
    data-open="express-modal"
  >
    Learn More
  </button>
        </div>
      </article>

      <!-- PrimeCare Card -->
      <article class="service-card prime-care" tabindex="0">
        <div class="card-inner">
          <div class="icon-bg"></div>
          <div class="ribbon secondary">Deep Dive</div>
          <div class="icon-wrapper">
            <lottie-player
        src="https://lottie.host/c5097afd-3162-43e6-84db-eefa96c0bddd/hqYYC9rPj7.json"
        background="transparent" speed="1" loop autoplay style="width: 500px; height:500px;">
      </lottie-player>
          </div>
          <h3>Prime Care</h3>
          <p class="tagline">Expert Hands. Exceptional Service.</p>
          <p class="detail">Our PrimeCare plan offers comprehensive diagnostics,genuine parts, live updates, detailed repair reports, and premium part replacements.</p>
          <ul class="features-list">
            <li>🔍 <strong>Full-System Check</strong> with Written Report</li>
            <li>👤 <strong>Custom Repair Plan</strong> Based on the issue</li>
            <li>🚚 <strong>Priority Pickup & Drop-off</strong> with Live Tracking</li>
          </ul>
         <button 
    class="btn btn-primary" style="margin-left:165px;"
    data-open="prime-modal"
  >
    Learn More
  </button>
        </div>
      </article>

    </div>
  </div>

  <!-- Bottom SVG Wave Divider (Swapped) -->
  <div class="wave wave-bottom">
    <svg viewBox="0 0 1440 100" preserveAspectRatio="none">
      <path d="M1440,100 C840,0 600,100 0,0 L0,100 L1440,100 Z" fill="#3F51B5" />
    </svg>
  </div>

  <!-- Modals -->
  <!-- Xpress Fix Modal -->
<div id="express-modal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <!-- Lottie animation could be a spinning wrench, car, etc. -->
      <lottie-player
        src="https://lottie.host/cc511c6e-fdc7-4363-928c-fc000569571f/K7WvuW62T9.json"
        background="transparent" speed="1" loop autoplay >
      </lottie-player>
      <h3>Xpress Fix</h3>
      <button class="close" data-target="express-modal">&times;</button>
    </div>
    <div class="modal-body">
      <p>
        <strong>Fast-track repairs</strong> for minor dents & damage. Our AI auto-detects the issue & delivers an instant estimate!
      </p>
      <span class="label">You’re covered for:</span>
      <ul class="issues-list">
        <li><svg><use xlink:href="#icon-dent"/></svg>Bodypanel Dent</li>
        <li><svg><use xlink:href="#icon-dent"/></svg>Front/Rear Windscreen</li>
        <li><svg><use xlink:href="#icon-dent"/></svg>Head light Damage</li>
        <li><svg><use xlink:href="#icon-dent"/></svg>Side Mirror Damage</li>
        <li><svg><use xlink:href="#icon-dent"/></svg>Door pannel damage </li>
        <li><svg><use xlink:href="#icon-dent"/></svg>Bumpers & Pillars</li>
        <li><svg><use xlink:href="#icon-dent"/></svg>Quarter Panel & Roof</li>
        <li><svg><use xlink:href="#icon-dent"/></svg>Tail light damage </li>
         <li><svg><use xlink:href="#icon-dent"/></svg>Bonnet & Boot </li>
         <li><svg><use xlink:href="#icon-dent"/></svg>Fender Damage </li>
      </ul>
      <p><span class="label">⏱️ Turnaround:</span> <strong>Within 24 Hours</strong></p>
      <p><em>Zero downtime—get back on the road fast.</em></p>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-target="express-modal">Close
  
    </div>
  </div>
</div>

<!-- PrimeCare Modal -->
<div id="prime-modal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <lottie-player
        src="https://lottie.host/c5097afd-3162-43e6-84db-eefa96c0bddd/hqYYC9rPj7.json"
        background="transparent" speed="1" loop autoplay>
      </lottie-player>
      <h3>PrimeCare Regular Repair</h3>
      <button class="close" data-target="prime-modal">&times;</button>
    </div>
    <div class="modal-body">
      <p>
        <strong>Comprehensive maintenance</strong> & repair for all other concerns—mechanical, electrical, systems & more.
      </p>
      <span class="label" >Our PrimeCare package includes:</span>
      <ul class="issues-list" style="margin-top:20px;">
        <li><svg><use xlink:href="#icon-dent"/></svg>Engine & Transmission</li>
        <li><svg><use xlink:href="#icon-dent"/></svg>Brake System & Suspension</li>
        <li><svg><use xlink:href="#icon-dent"/></svg>Air Condition Systems</li>
        <li><svg><use xlink:href="#icon-dent"/></svg>Electrical Diagnostics</li>
        <li><svg><use xlink:href="#icon-dent"/></svg>Routine Servicing</li>
      </ul>
      <p><span class="label">🔧 Turnaround:</span> <strong>4–5 Working Days</strong></p>
      <p><span class="label">💰 Starting:</span> ₹1,299 <small>(Diagnostics & Basic Repairs)</small></p>
      <p><em>Final quote after in-depth inspection.</em></p>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" data-target="prime-modal">Close</button>
     
    </div>
  </div>
</div>

</section>
<!-- Gold Membership Section -->
<!-- Gold Membership Section Only -->
<section id="gold-membership" class="gold-section" style="box-sizing:border-box;">
  <div class="gold-wrapper" style="box-sizing:border-box;">
    <!-- LEFT: Reduced-Width Image -->
    <div class="gold-image">
      <img src="<?= base_url('assets/images/goldimg.png') ?>" alt="Gold Membership Illustration" />
    </div>

    <!-- RIGHT: Expanded Benefits Panel -->
    <div class="gold-benefits-panel">
       <div>
         <lottie-player
        src="https://lottie.host/a1b90357-c39a-4b25-82a5-ba3a35b8a793/hSL6ZmPfnO.json"
        background="transparent" speed="1" loop autoplay style="width:140px;height:140px; margin-top:0px;margin-bottom:5px;margin-left:485px;">
      </lottie-player>
</div>
      <h2 class="gold-title" style="margin-top:-30px;">
       
        <span>Unlock</span>
        <span>Exclusive</span>
        <span class="highlight">GOLD</span>
        <span>Perks</span>
      </h2>
      <p class="gold-description">
   Upgrade to GOLD For An Elevated Experience!
      </p>
      <ul class="gold-benefits" >
        <li>
          <i class="fas fa-car"></i>
          <div>
            <strong style="margin-left:36px;">Exterior Wash</strong>
            <small>Free on every visit</small>
          </div>
        </li>
        <li>
          <i class="fas fa-couch"></i>
          <div>
            <strong style="margin-left:31px;">Interior Detail</strong>
            <small>Free on every visit</small>
          </div>
        </li>
        <li>
          <i class="fas fa-headset"></i>
          <div>
            <strong> Prime Support</strong>
            <small>Instant assistance</small>
          </div>
        </li>
        <li>
          <i class="fas fa-bolt"></i>
          <div>
            <strong>  Express Queue</strong>
            <small>Skip the line easily</small>
          </div>
        </li>
        <li>
          <i class="fas fa-user-ninja"></i>
          <div>
            <strong>Unique Avatars</strong>
            <small>Unique profile icons</small>
          </div>

        </li>
        
      </ul>
       <div style="
      display: flex;
      justify-content: flex-start;
      margin-top: 40px;
     margin-left:150px;
      position: relative;
    ">
    <div style="
        background: #FFF8E1;
      
        border: 4px solid #D4AF37;
        border-radius: 8px;
        padding: 20px 50px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.2);
        font-family: 'Segoe UI', sans-serif;
        color: #8C6D1F;
        font-size: 2.2rem;
        font-weight: 800;

        position: relative;
      ">
      <i class="fas fa-gem" style="margin-right: 8px; color: #D4AF37;"></i>
      ₹4999
      <div style="
          font-size: 0.75rem;
          font-weight: 400;
          margin-top: 4px;
          opacity: 0.8;
          margin-left:60px;
        ">/ yearly Renewal</div>
      <!-- Top-left ribbon knot -->
      <div style="
          content: '';
          position: absolute;
          top: -12px;
          left: -12px;
          width: 0;
          height: 0;
          border-top: 12px solid #D4AF37;
          border-right: 12px solid transparent;
        "></div>
      <!-- Bottom-right ribbon tail -->
      <div style="
          content: '';
          position: absolute;
          bottom: -12px;
          right: -12px;
          width: 0;
          height: 0;
          border-bottom: 12px solid #D4AF37;
          border-left: 12px solid transparent;
        "></div>
    </div>
  </div>
    </div>
    
  </div>
  
</section>




   <!-- About Us Section -->
<!-- About Us Section -->
<section id="about-us" class="about-us">
    <div class="about-wrapper">
        <h2>Driving Car Care Beyond Imagination</h2>
        <p class="tagline">Reimagining how car service should feel in the age of AI & Automation.</p>

        <div class="about-flex">
            <div class="about-block">
                <h3 style="">We’re on a mission !</h3>
                
                <p>Xfinity started as a passion project — a bold vision to clear the dusty garage experience with futuristic AI, super  smart automation, and customer—first innovations to meet future</p>
                <p class="cta">Stay connected and be ready to meet the future</p>
              </div>


             <lottie-player src="https://lottie.host/4a985cdd-4943-4d81-9ce8-c8ff4c6492b9/NkYxsKy2eU.json"background="transparent" speed="1" loop autoplay style="margin-left:0px; transform:translateY(0px);display:inline-block;width: 350px; height:350px;padding-top:0px;margin-top:0px;"></lottie-player>

            <div class="about-block highlight-block">
                <h3>Where are we now?</h3>
                <p>In the lab. In the code. In the workshop. Testing. Breaking. Rebuilding. We’re not live yet, but every experiment takes us closer to that next-gen car care experience.</p>
                <p class="cta">Stay tuned. The road to the future is being built.</p>
            </div>

           
        </div>
    </div>
</section>
<section class="xyle-section" id="xyle">
  <div class="xyle-container">
    <h2 class="xyle-title"> Gost In The Garage: <span class="xyle-highlight">XYLE</span></h2>
    <p class="xyle-quote">
      “In the silence between keystrokes, there lives a guardian — one born of data, cloaked in code, and animated by empathy.”
    </p>

    <div class="xyle-content">
      <div class="xyle-ghost">
        <lottie-player 
          src="https://lottie.host/ab0f81d1-f16d-403a-a650-ad923c57a65f/nhW5VCJWAz.json"
          background="transparent" 
          speed="1" 
          loop 
          autoplay
          style="width:560px;display:inline-block;height:560px;transform:translateY(-120px);">
        </lottie-player>
      </div>

      <div class="xyle-description">
        <p>
          From the heart of XFINITY’s neural nexus emerges <strong style="color:rgb(255, 81, 0);;">XYLE</strong>, a spectral oracle guiding you through the digital realm with poise and purpose.
        </p>
        <ul>
          <li><strong>Adaptive Dialogue:</strong> Intuitive, context-rich conversations that feel genuinely human.</li>
          <li><strong>Security Sentinel:</strong> Imbues every transaction with radiant verification and peace of mind.</li>
          <li><strong>Emotive Animations:</strong> Ghostly gestures and expressions that mirror your mood.</li>
         <li><strong>Dual Aura:</strong> XYLE appears in both orange and white forms, adapting  to match the mood of interaction.</li>

        </ul>
        <p class="xyle-tagline">Your unseen ally on the journey—always vigilant, ever present.</p>
      </div>
    </div>
  </div>
</section>
 


  
 



   <!-- Login Section -->
   <section id="login" class="login-section">
       <div class="login-video-wrapper">
           <video autoplay muted loop class="login-video">
              <source src="https://res.cloudinary.com/dyjxrihpj/video/upload/v1749537237/12432621_1920_1080_30fps_tgxwkz.mp4" type="video/mp4">
               Your browser does not support the video tag.
           </video>
       </div>

       <div style="margin-top:65px;"class="login-container">
           <h2 style="font-size:36px;margin-left:20px;"> <lottie-player
        src="https://lottie.host/97e1822f-434c-471b-8696-6c038327a11c/GhOZRTXDjE.json"
        background="transparent" speed="1" loop autoplay style="width:130px;height:130px;margin-bottom:5px; margin-left:126px;margin-top:-90px;transform:translateY(20px);">
      </lottie-player>Login</h2>
           <!-- Container for AJAX error messages -->
           <p id="ajax-error-message" class="error-message" style="color: red;"></p>

           <form action="<?php echo site_url('home/login'); ?>" method="POST" id="loginForm">
               <input type="text" name="username" id="username" placeholder="Username" required>
              <div class="password-wrapper">
      <input type="password" name="password" id="password" placeholder="Password" required>
      <span class="toggle-password" onclick="togglePassword()">
        <i class="fa-solid fa-eye"></i>
      </span>
    </div>

    <div style="display:flex;flex-direction:column;gap:0px;  width: 430px;">
               <button id="nextBtn2" style="margin-top:10px;"type="submit"><i style="margin-right:8px;"class="fa-solid fa-right-to-bracket"></i>Sign In</button>
             <p class="separator">or</p>


                <button style="position:relative;margin-top:0px;" type="button" onclick="window.location.href='<?= site_url('Google_signin/googlecallback') ?>'"> <img style= "padding:2px 2px;background:white;border-radius:7px;width:26px; height:26px;position:absolute;top:12px;left:77px;" src="https://img.icons8.com/color/48/google-logo.png" alt="google-logo"/>Log in with Google</button>
</div>
           </form>

           <p style="margin-bottom:-3.5px;">Don't have an account? <a href="<?php echo site_url('register'); ?>">Create an Account</a></p>

           
           
       </div>
   </section>
 <script>
function togglePassword() {
  const password = document.getElementById("password");
  const toggle = document.querySelector(".toggle-password");
  
  if (password.type === "password") {
    password.type = "text";
  toggle.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';

  } else {
    password.type = "password";
   toggle.innerHTML = '<i class="fa-solid fa-eye"></i>';

  }
}
</script>


   <script>
    document.querySelectorAll('.close, .btn-secondary').forEach(el => {
      el.addEventListener('click', e => {
        const tgt = e.target.dataset.target;
        if (tgt) document.getElementById(tgt).classList.remove('show');
      });
    });
    document.querySelectorAll('[data-open]').forEach(btn => {
      btn.addEventListener('click', e => {
        document.getElementById(e.target.dataset.open).classList.add('show');
      });
    });
  </script>



   <!-- Include jQuery from CDN -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

   <!-- Scroll to Login Section if login error exists (for non-AJAX fallback) -->
   <?php if (isset($login_error) && $login_error): ?>
   <script>
       $(document).ready(function(){
           $('html, body').animate({
               scrollTop: $("#login").offset().top
           }, 1000);
       });
   </script>
   <?php endif; ?>

   <!-- Scroll to Bottom if slide_to_bottom flag is set -->
   <?php if (isset($slide_to_bottom) && $slide_to_bottom): ?>
   <script>
       $(document).ready(function(){
           $('html, body').animate({
               scrollTop: $(document).height()
           }, 1000);
       });
   </script>
   <?php endif; ?>

   <!-- Optimized AJAX Login Script -->
<script>
    $(document).ready(function(){
        // Variable to hold the timeout reference
        let errorTimeout;
        
        $('#loginForm').on('submit', function(e){
            e.preventDefault(); // Prevent the default form submission
            const nextBtn = document.getElementById('nextBtn2');
       nextBtn.disabled = true; // Disable the button immediately
      nextBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Hold On!';
            
            // Stop any ongoing animations and show a clean error container
            $('#ajax-error-message').stop(true, true).text('').show();
            
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if(response.status === 'success'){
                        // Redirect on successful login
                        window.location.href = response.redirect_url;
                    } else {
                       nextBtn.disabled = false; // Disable the button immediately
      nextBtn.innerHTML = '<i style="margin-right:2px;"class="fa-solid fa-right-to-bracket"></i> Sign In';
                        // Display the error message and clear it after 3 seconds
                        $('#ajax-error-message').text(response.message).show();
                        
                        // Clear any previous timeout to avoid conflicts
                        clearTimeout(errorTimeout);
                        
                        errorTimeout = setTimeout(function(){
                            $('#ajax-error-message').fadeOut(600, function(){
                                // Reset text and display property after fadeOut
                                $(this).text('').show();
                            });
                        }, 3000);
                    }
                },
                error: function() {
                    $('#ajax-error-message').text('An error occurred. Please try again.').show();
                    
                    clearTimeout(errorTimeout);
                    errorTimeout = setTimeout(function(){
                        $('#ajax-error-message').fadeOut(600, function(){
                            $(this).text('').show();
                        });
                    }, 3000);
                }
            });
        });
    });
</script>


</body>
</html>
