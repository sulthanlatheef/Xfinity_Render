<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Image Upload and YOLOv5 Prediction</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    /* Global Styles */
    * {
      box-sizing: border-box;
    }
    body {
      font-family: "Poppins", sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
      color: #333;
      overflow-x: hidden;
    }
    a { text-decoration: none; }
    h1, h2, p { margin: 0; padding: 0; }
    
    /* Navigation Bar */
    nav {
      background-color: #ff6600;
      padding: 8px 0;
      position: sticky;
      top: 0;
      z-index: 10;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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
      white-space: nowrap;
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
    
    /* Main Content Styles */
    .container {
      max-width: 600px;
      margin: 60px auto;
      background: white;
      border-radius: 8px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      padding: 40px 30px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }
    .container::before {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle at center, rgba(255,255,255,0.15), transparent);
      animation: rotateBg 15s linear infinite;
      z-index: 0;
    }
    @keyframes rotateBg {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    .container > * { position: relative; z-index: 1; }
    .container h1 {
      margin-bottom: 20px;
      font-size: 28px;
      color: #333;
    }
    #error-message {
      color: #d9534f;
      margin-bottom: 15px;
      display: none;
      font-weight: 500;
    }
    
    /* Advanced Custom File Input */
    .custom-file-input {
      position: relative;
      display: inline-block;
      overflow: hidden;
      cursor: pointer;
      border: 2px solid #ff6600;
      border-radius: 30px;
      padding: 10px 20px;
      background: linear-gradient(135deg, #ff6600, #ff944d);
      color: white;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      font-size: 16px;
      margin-bottom: 20px;
    }
    .custom-file-input:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    .custom-file-input input[type="file"] {
      position: absolute;
      left: 0;
      top: 0;
      opacity: 0;
      cursor: pointer;
      height: 100%;
      width: 100%;
    }
    .file-name {
      margin-top: 10px;
      font-size: 14px;
      color: #555;
    }
    
    /* Submit Button */
    button[type="submit"] {
      background: linear-gradient(135deg, #ff6600, #ff944d);
      border: none;
      padding: 12px 30px;
      color: white;
      font-size: 18px;
      border-radius: 30px;
      cursor: pointer;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    button[type="submit"]:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    
    /* Predictions Section */
    #predictions {
      margin-top: 30px;
      text-align: left;
    }
    #predictions h3 {
      color: #333;
      margin-bottom: 15px;
    }
    #prediction-list {
      list-style: none;
      padding: 0;
    }
    #prediction-list li {
      background: #f8f9fa;
      padding: 10px 15px;
      margin: 5px 0;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    #prediction-list li:hover {
      background: #e2e6ea;
    }
  </style>
</head>
<body>
  <!-- Navigation Bar -->
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
      <a href="<?php echo site_url('login'); ?>" class="button" style="margin-right:30px; color:white; font-size:20px; padding:10px 30px;">Login</a>
    <?php endif; ?>
  </nav>

  <!-- Main Content -->
  <div class="container">
    <h1>Upload an Image for YOLOv5 Prediction</h1>
    <!-- Error Message -->
    <div id="error-message"></div>
    
    <!-- Upload Form -->
    <form id="upload-form" enctype="multipart/form-data">
      <label class="custom-file-input">
        Choose File
        <input type="file" id="image" name="image" required>
      </label>
      <div class="file-name" id="file-name">No file selected</div>
      <br>
      <button type="submit">Upload & Predict</button>
    </form>

    <!-- Prediction Results -->
    <div id="predictions">
      <h3>Predictions:</h3>
      <ul id="prediction-list"></ul>
    </div>
  </div>

  <script>
    $(document).ready(function () {
      // Update file name on file selection
      $("#image").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $("#file-name").text(fileName || "No file selected");
      });

      $("#upload-form").submit(function (event) {
        event.preventDefault();
        var formData = new FormData();
        var imageFile = $("#image")[0].files[0];

        if (!imageFile) {
          $("#error-message").text("Please select an image to upload.").show();
          return;
        }

        formData.append("image", imageFile);

        $.ajax({
          url: "<?php echo site_url('imageUpload/predict'); ?>",
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            console.log("✅ API Response:", response);
            $("#error-message").hide();
            $("#predictions").show();
            $("#prediction-list").empty();

            if (response.predictions && response.predictions.length > 0) {
              response.predictions.forEach(function (pred) {
                $("#prediction-list").append("<li><strong>Custom:</strong> " + pred.custom + " <br> <strong>Original:</strong> " + pred.original + "</li>");
              });
            } else if (response.error) {
              $("#error-message").text("Error: " + response.error).show();
            } else {
              $("#prediction-list").append("<li>FAILED TO COMMUNICATE WITH FLASK SERVER.</li>");
            }
          },
          error: function (xhr, status, error) {
            console.error("❌ AJAX Error:", error);
            console.error("❌ Server Response:", xhr.responseText);
            $("#error-message").text("Error: " + xhr.responseText).show();
          }
        });
      });
    });
  </script>
</body>
</html>
