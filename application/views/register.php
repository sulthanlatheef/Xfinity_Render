<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create an Account</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    .background-video {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1;
    }

    body {
      font-family: 'Arial', sans-serif;
      background: #f4f7fc;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #333;
      overflow: hidden;
      position: relative;
    }

    /* Animated Typing Text with Red Theme */
    .animated-text {
      position: absolute;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      font-size: 2.3rem;
      font-family: 'Courier New', Courier, monospace;
      font-weight: bold;
      letter-spacing: 3px;
      white-space: nowrap;
      text-align: center;
      background-image: linear-gradient(45deg, #FF4500, #DC143C);
      -webkit-background-clip: text;
      color: transparent;
     transition: all 0.3s ease; 
    }

    /* Blinking Cursor */
    .animated-text::after {
      content: '';
      display: inline-block;
      width: 2px;
      height: 1em;
      margin-left: 5px;
      background-color: #FF4500;
      animation: blink 1s infinite;
    }

    @keyframes blink {
      0%, 50% { opacity: 1; }
      51%, 100% { opacity: 0; }
    }

    /* Enhanced Register Container */
    .register-container {
      background: rgba(255, 255, 255, 0.75);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
      padding: 40px;
      width: 100%;
      max-width: 400px;
      text-align: center;
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      opacity: 0;
      animation: fadeInSlide 1s forwards;
    }
    
    /* Remove animation if error or success messages exist */
    .register-container.no-animation {
      animation: none;
      opacity: 1;
      transform: translateY(-50%);
    }

    @keyframes fadeInSlide {
      from {
        opacity: 0;
        transform: translate(50px, -50%);
      }
      to {
        opacity: 1;
        transform: translate(0, -50%);
      }
    }

    h2 {
      margin-bottom: 30px;
      color: #5c6bc0;
      font-size: 24px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px 16px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      border-color: #e74c3c;
      box-shadow: 0 0 8px rgba(231, 76, 60, 0.5);
      outline: none;
    }

    button {
      width: 100%;
      padding: 12px 16px;
      background-color: #5c6bc0;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 18px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    button:hover {
      background-color: #3f51b5;
      transform: translateY(-2px);
    }

    .login-link {
      margin-top: 20px;
      font-size: 14px;
    }

    .login-link a {
      color: #5c6bc0;
      text-decoration: none;
    }

    .login-link a:hover {
      text-decoration: underline;
    }

    .error-message {
      color: white;
      background-color: #d32f2f;
      border-radius: 8px;
      padding: 15px;
      margin-top: 20px;
      font-size: 16px;
      font-weight: bold;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
    }

    .error-message:hover {
      background-color: #b71c1c;
    }

    .success-message {
      color: white;
      background-color: #388e3c;
      border-radius: 8px;
      padding: 15px;
      margin-top: 20px;
      font-size: 16px;
      font-weight: bold;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      display: flex;
      align-items: center;
    }

    .success-message .fa-check-circle {
      font-size: 24px;
      margin-right: 10px;
    }
  </style>
</head>
<body>
  <video class="background-video" autoplay muted loop>
    <source src="<?php echo base_url('assets/videos/8084496-uhd_3840_2160_25fps.mp4'); ?>" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <!-- Animated Typing Text -->
  <div class="animated-text" id="animatedText"></div>

  <!-- Conditionally add the "no-animation" class if there are error or success messages -->
  <div class="register-container <?php echo (!empty($error_message) || !empty($success_message)) ? 'no-animation' : ''; ?>">
    <h2>Create an Account</h2>
    <?php echo form_open('register/submit'); ?>
      <input type="text" name="name" placeholder="Full Name" value="<?php echo set_value('name'); ?>">
      <input type="text" name="username" placeholder="Username" value="<?php echo set_value('username'); ?>">
      <input type="password" name="password" placeholder="Password">
      <button type="submit">Register</button>
    <?php echo form_close(); ?>

    <?php if (!empty($error_message)) : ?>
      <div class="error-message">
        <i class="fa fa-exclamation-circle"></i> <?php echo $error_message; ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($success_message)) : ?>
      <div class="success-message">
        <i class="fa fa-check-circle"></i> <?php echo $success_message; ?>
      </div>
    <?php endif; ?>

    <div class="login-link">
      Already have an account? <a href="<?php echo site_url('home/slide'); ?>">Login here</a>.
    </div>
  </div>

  <script>
    const text = "Exploring The Aesthetics Of Technology";
    const element = document.getElementById("animatedText");

    function typeText(i = 0) {
      if (i < text.length) {
        element.textContent += text.charAt(i);
        let delay = 55 + Math.random() * 100;
        if (",.!?".includes(text.charAt(i))) {
          delay += 250;
        }
        setTimeout(() => typeText(i + 1), delay);
      } else {
        setTimeout(fadeOutText, 1600);
      }
    }

    function fadeOutText() {
      element.style.transition = "opacity 0.5s ease-out";
      element.style.opacity = "0";
      setTimeout(() => {
        element.textContent = "";
        element.style.opacity = "1";
        element.style.transition = "none";
        typeText();
      }, 500);
    }

    window.addEventListener("load", () => {
      typeText();
    });
  </script>
</body>
</html>
