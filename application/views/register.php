<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

        .animated-text {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 2.3rem;
            color: red;
            font-family: 'Courier New', Courier, monospace;
            font-weight: bold;
            letter-spacing: 3px;
            white-space: nowrap;
            text-align: center;
            opacity: 1;
            display: inline-block;
            border-right: 4px solid #ff6347;
            padding-right: 5px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7), 0 0 25px rgba(255, 99, 71, 0.8), 0 0 50px rgba(255, 99, 71, 0.6);
            background-image: linear-gradient(to left, #ff6347, #ff4500);
            -webkit-background-clip: text;
            color: transparent;
            transition: all 0.3s ease;
        }

        .register-container {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
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
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #5c6bc0;
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
        }

        button:hover {
            background-color: #3f51b5;
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
            background-color: #388e3c; /* Green color for success */
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
    <source src="<?php echo base_url('assets/videos/12432621_1920_1080_30fpss.mp4'); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Animated Typing Text -->
    <div class="animated-text" id="animatedText"></div>

    <div class="register-container">
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
    const text = "Welcome to Our Registration Page";
    const element = document.getElementById("animatedText");
    let index = 0;

    function typeText() {
        if (index < text.length) {
            element.innerHTML += text.charAt(index);
            index++;
            setTimeout(typeText, 90);  // Adjust speed of typing
        } else {
            setTimeout(() => {
                element.innerHTML = '';  // Clear the text
                index = 0;  // Reset the index to start typing again
                typeText();  // Restart the typing animation
            }, 1000); // Wait 1 second before restarting
        }
    }

    window.onload = typeText;
</script>


</body>
</html>
