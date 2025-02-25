<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI-based Fault Prediction</title>
    <!-- SEO Meta Tags -->
    <meta name="description" content="AI-based fault prediction system for automobiles to predict and prevent vehicle failures before they happen.">
    <meta name="keywords" content="AI, fault prediction, automobile, maintenance, data science">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Raleway:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>" type="text/css">
</head>
<body>
   <!-- Navbar -->
   <header>
       <div class="logo">
           <img src="<?php echo base_url('assets/images/creative ai (2).png'); ?>" alt="Logo" class="logo-img">
       </div>
       <nav>
           <ul>
               <li><a href="#home">Home</a></li>
               <li><a href="#features">Features</a></li>
               <li><a href="#about-us">About</a></li>
               <li><a href="#contact-us">Contact</a></li>
               <li><a href="#login">Login</a></li>
           </ul>
       </nav>
   </header>

   <!-- Hero Section -->
   <section class="hero-section" id="home">
       <video autoplay muted loop class="hero-video">
           <source src="<?php echo base_url('assets/videos/12433560_3840_2160_25fps.mp4'); ?>" type="video/mp4">
           Your browser does not support the video tag.
       </video>
       <div class="hero-content">
           <h1>INNOVATION THROUGH AI</h1>
           <p>Your trusted partner for intelligent car diagnostics and repair</p>
           <a href="#features" class="btn">Learn More</a>
       </div>
   </section>

   <!-- Features Section -->
   <section id="features" class="features">
       <div class="feature-card">
           <img src="https://images.pexels.com/photos/6153354/pexels-photo-6153354.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Advanced Diagnostics">
           <h3>Advanced AI</h3>
           <p>Utilizing cutting-edge AI to predict faults before they happen, enhancing vehicle performance.</p>
       </div>
       <div class="feature-card">
           <img src="https://images.pexels.com/photos/6153068/pexels-photo-6153068.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Real-Time Monitoring">
           <h3>Real-Time Monitoring</h3>
           <p>Keep your vehicle in optimal condition with real-time health checks and data analysis.</p>
       </div>
       <div class="feature-card">
           <img src="https://images.pexels.com/photos/6153351/pexels-photo-6153351.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Maintenance Alerts">
           <h3>Maintenance Alerts</h3>
           <p>Receive alerts for needed repairs, ensuring your vehicle remains in top working condition.</p>
       </div>
   </section>

   <!-- About Us Section -->
   <section id="about-us" class="about-us">
       <h2>About Us</h2>
       <p>We are at the forefront of AI innovation for the automobile industry, helping drivers stay safe and save costs with predictive maintenance solutions.</p>
       <img src="https://images.pexels.com/photos/6153739/pexels-photo-6153739.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load" alt="About Us">
   </section>

   <!-- Contact Us Section -->
   <section id="contact-us" class="contact-us">
       <h2>Contact Us</h2>
       <form method="POST" action="<?php echo site_url('home/contact_us'); ?>">
           <label for="name">Name</label>
           <input type="text" id="name" name="name" required>
           <label for="email">Email</label>
           <input type="email" id="email" name="email" required>
           <label for="message">Message</label>
           <textarea id="message" name="message" rows="4" required></textarea>
           <button type="submit">Send Message</button>
       </form>
   </section>

   <!-- Login Section -->
   <section id="login" class="login-section">
       <div class="login-video-wrapper">
           <video autoplay muted loop class="login-video">
               <source src="<?php echo base_url('assets/videos/12432621_1920_1080_30fps.mp4'); ?>" type="video/mp4">
               Your browser does not support the video tag.
           </video>
       </div>

       <div class="login-container">
           <h2>Login</h2>
           <!-- Container for AJAX error messages -->
           <p id="ajax-error-message" class="error-message" style="color: red;"></p>

           <form action="<?php echo site_url('home/login'); ?>" method="POST" id="loginForm">
               <input type="text" name="username" id="username" placeholder="Username" required>
               <input type="password" name="password" id="password" placeholder="Password" required>
               <button type="submit">Login</button>
           </form>

           <p>Don't have an account? <a href="<?php echo site_url('register'); ?>">Create an Account</a></p>
       </div>
   </section>

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
