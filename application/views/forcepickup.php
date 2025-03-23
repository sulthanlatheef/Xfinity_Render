<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Xfinity Fault Detector & Estimate</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet" />
  <!-- jQuery & jQuery UI -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <!-- Google Maps API: Replace YOUR_API_KEY with your actual key -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyNnYX9lxpsHAWG4cC2YBPYA66QoOR2ao"></script>
  
  <style>
    /* Global Reset & Base Styles */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Poppins', sans-serif;
      background: #f0f4f8;
      color: #444;
      line-height: 1.6;
    }
    a { text-decoration: none; color: inherit; }

    /* Header */
    nav {
      background-color: #ff6600;
      padding: 8px 20px;
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
    @media (max-width: 768px) {
      .navbar-logo { font-size: 20px; }
      nav a { padding: 10px 15px; font-size: 18px; }
      .user-info .username { font-size: 16px; }
    }
    
    /* Main Layout */
    .wrapper {
      display: flex;
      max-width: 1300px;
      margin: 21px auto;
      background: #fff;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    .sidebar {
      background: #ff6600;
      width: 250px;
      padding: 30px 20px;
      color: #fff;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }
    .sidebar h2 {
      font-size: 22px;
      text-align: center;
      margin-bottom: 15px;
      border-bottom: 1px solid rgba(255,255,255,0.4);
      padding-bottom: 10px;
    }
    .step {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px;
      border-radius: 4px;
      cursor: pointer;
      transition: background 0.3s, transform 0.3s;
    }
    .step.active, .step:hover {
      background: rgba(255,255,255,0.2);
      transform: translateX(5px);
    }
    .step i { font-size: 20px; }
    .step span { font-size: 18px; }
    
    .content {
      flex: 1;
      padding: 40px;
    }
    .card {
      background: #fdfdfd;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 30px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes borderRainbow {
  0% {
    border-color: #ff0000;
    box-shadow: 0 0 5px #ff0000;
  }
  20% {
    border-color:rgb(255, 102, 0);
    box-shadow: 0 0 10pxrgb(255, 132, 0);
  }
  40% {
    border-color:rgb(255, 0, 0);
    box-shadow: 0 0 15pxrgb(255, 0, 0);
  }
  60% {
    border-color:rgb(255, 94, 0);
    box-shadow: 0 0 10pxrgb(255, 132, 0);
  }
  80% {
    border-color:rgb(255, 0, 0);
    box-shadow: 0 0 15pxrgb(255, 115, 0);
  }
  100% {
    border-color:rgb(255, 60, 0);
    box-shadow: 0 0 5pxrgb(255, 72, 0);
  }
}

.animate-border {
  animation: borderRainbow 9s ease-in-out;
  /* Optionally add a transition to smooth out the return state */
  transition: border-color 0.3s, box-shadow 0.3s;
}



    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .card h3 {
      margin-bottom: 20px;
      color: #333;
      font-size: 24px;
    }
    
    /* Vehicle Details */
    .vehicle-details-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
    }
    .vehicle-details {
      flex: 1;
      min-width: 250px;
    }
    .vehicle-details input {
      width: calc(50% - 10px);
      padding: 10px;
      margin: 10px 5px 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
      transition: border-color 0.3s, box-shadow 0.3s;
    }
    .vehicle-details input:focus {
      border-color: #ff6600;
      box-shadow: 0 0 5px rgba(255,102,0,0.4);
      outline: none;
    }
    .vehicle-logo img {
      max-width: 420px;
      width: 100%;
      height: auto;
      transform: translateX(-115px);
    }
    
    /* Issue Details */
    .issue-details label {
      display: block;
      margin: 12px 0 5px;
      font-weight: 500;
      color: #333;
    }
    .issue-details textarea {
      width: 100%;
      padding: 12px;
      border: 2px solid #f0f0f0;
      border-radius: 8px;
      font-size: 18px;
      resize: vertical;
      min-height: 275px;
      transition: border-color 0.3s, box-shadow 0.3s;
    }
    .issue-details textarea:focus {
      border-color: #ff6600;
      box-shadow: 0 0 8px rgba(255,140,0,0.5);
      outline: none;
    }
    
    /* Enhanced Pickup Location Form */
    .pickup-header {
      text-align: center;
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 1px solid #eee;
      animation: slideDown 0.6s ease;
    }
    @keyframes slideDown {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .pickup-header i {
      font-size: 45px;
      color: #ff6600;
      margin-bottom: 5px;
      animation: pulse 1.5s infinite;
    }
    @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.1); }
      100% { transform: scale(1); }
    }
    .pickup-header h3 {
      font-size: 28px;
      color: #333;
      margin-bottom: 5px;
    }
    .pickup-header p {
      font-size: 16px;
      color: #777;
    }
    .pickup-location-form {
      background: linear-gradient(135deg, #ffffff, #fdfdfd);
      padding: 14px;
      border-radius: 14px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.1);
      /* Removed hover scale effect */
    }
    .pickup-location-form .form-row {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }
    .pickup-location-form .form-group {
      flex: 1;
      min-width: 220px;
    }
    .pickup-location-form label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #555;
    }
    .pickup-location-form input[type="text"] {
      width: 100%;
      padding: 14px;
      border: 2px solid #eaeaea;
      border-radius: 8px;
      font-size: 16px;
      transition: border-color 0.3s, box-shadow 0.3s;
    }
    .pickup-location-form input[type="text"]:focus {
      border-color: #ff6600;
      box-shadow: 0 0 10px rgba(255,140,0,0.5);
      outline: none;
    }
    .pickup-buttons {
      display: flex;
      gap: 30px;
      justify-content: center;
      margin-top: 30px;
    }
    .pickup-buttons .btn {
      padding: 14px 35px;
      font-size: 18px;
      border-radius: 30px;
      border: none;
      cursor: pointer;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .rotating {
  animation: rotation 1s infinite linear;
}

@keyframes rotation {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

@keyframes fadePlaceholder {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: 0.3;
  }
}

/* Apply the animation to the placeholder text */
.animate-placeholder::placeholder {
  animation: fadePlaceholder 3s ease-in-out infinite;
}

.locate-me i {
  margin-right: 10px; /* adjust the value as needed */
}

    .pickup-buttons .locate-me {
      background: red;
      color: #fff;
    }
    .pickup-buttons .next-btn {
      background: linear-gradient(90deg, #ff6600, #ff944d);
      color: #fff;
    }
    .pickup-buttons .btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }
    
    /* Schedule Pickup Form */
    .pickup-form input, .pickup-form select {
      width: 100%;
      padding: 10px;
      margin: 10px 0 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
    }
    
    /* General Button Styling */
    .btn {
      display: inline-block;
      padding: 12px 30px;
      background: linear-gradient(90deg, #ff6600, #ff944d);
      color: #fff;
      border: none;
      border-radius: 30px;
      font-size: 18px;
      cursor: pointer;
      margin-top: 20px;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 12px rgba(0,0,0,0.15);
    }
    
    /* Invoice Modal */
    #invoice-modal { display: none; font-size: 14px; }
    #invoice-modal .modal-content {
      padding: 20px;
      background: #fff;
      border-radius: 8px;
    }
    .invoice-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .invoice-logo img { max-width: 100px; }
    .invoice-title h2 {
      margin: 0;
      color: #ff6600;
      font-size: 24px;
    }
    .invoice-info {
      background: #f9f9f9;
      padding: 10px 20px;
      border: 1px solid #ddd;
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      font-weight: 600;
    }
    .invoice-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    .invoice-table th, .invoice-table td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: left;
    }
    .invoice-table th { background: #f9f9f9; }
    .invoice-table tfoot td { font-weight: 600; }
    
    /* Responsive Adjustments */
    @media(max-width: 768px) {
      .wrapper { flex-direction: column; }
      .sidebar { width: 100%; flex-direction: row; justify-content: space-around; }
      .sidebar h2 { display: none; }
      .step span { font-size: 14px; }
      .pickup-buttons { flex-direction: column; }
      .vehicle-details-container { flex-direction: column; align-items: flex-start; }
      .vehicle-logo img { margin: 20px 0 0 0; }
      .pickup-location-form .form-row { flex-direction: column; }
    }
  </style>
</head>
<body>
  <!-- Header -->
  <nav>
    <div class="navbar-logo">Xfinity</div>
    <div class="nav-links">
      <a href="#vehicle-details">Vehicle Details</a>
      <a href="#issue-details">Issue Details</a>
      <a href="#pickup-location">Pickup Location</a>
      <a href="#schedule">Schedule Pickup</a>
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

  <!-- Main Wrapper -->
  <div class="wrapper">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>Steps</h2>
      <div class="step active" data-step="vehicle">
        <i class="fas fa-car"></i>
        <span>Vehicle Details</span>
      </div>
      <div class="step" data-step="issue-details">
        <i class="fas fa-exclamation-triangle"></i>
        <span>Issue Details</span>
      </div>
      <div class="step" data-step="pickup-location">
        <i class="fas fa-map-marker-alt"></i>
        <span>Pickup Location</span>
      </div>
      <div class="step" data-step="schedule">
        <i class="fas fa-calendar-check"></i>
        <span>Schedule Pickup</span>
      </div>
    </aside>

    <!-- Content Section -->
    <main class="content">
      <!-- Step 1: Vehicle Details -->
      <section id="step-vehicle" class="card step-section">
        <h3>Vehicle Details</h3>
        <div class="vehicle-details-container">
          <div class="vehicle-details">
            <input type="text" id="vehicle-brand" placeholder="Vehicle Brand" autocomplete="off">
            <input type="text" id="vehicle-model" placeholder="Vehicle Model" autocomplete="off">
            <input type="text" id="vehicle-reg" placeholder="Vehicle Registration No" autocomplete="off">
            <input type="text" id="vehicle-typ" placeholder="Gasoline type" autocomplete="off">
          </div>
          <div class="vehicle-logo">
            <img src="/XFINITY/assets/images/_storage_emulated_0_DCIM_.convert_security_files_1742575758602.jpg" alt="Logo">
          </div>
        </div>
        <button id="to-issue-btn" class="btn">Next: Issue Details</button>
      </section>

      <!-- Step 2: Issue Details -->
      <section id="step-issue-details" class="card step-section" style="display:none;">
        <h3>Issue Details</h3>
        <div class="issue-details">
          <label for="vehicle-issue"></label>
          <textarea id="vehicle-issue" placeholder="Describe the issue with your vehicle in detail" required></textarea>
        </div>
        <button id="to-pickup-btn" class="btn">Next: Pickup Location</button>
      </section>

      <!-- Step 3: Pickup Location -->
      <section id="step-pickup-location" class="card step-section" style="display:none;">
        <div class="pickup-header">
          <i class="fas fa-map-marked-alt"></i>
          <h3>Where Should We Pick You Up?</h3>
          <p>Enter your location details below and let us handle the rest.</p>
        </div>
        <form id="pickup-location-form" class="pickup-location-form">
          <div class="form-row">
            <div class="form-group">
              <label for="pickup-address">Street Address</label>
              <input type="text" id="pickup-address" name="pickup_address" placeholder="123 Main St" required>
            </div>
            <div class="form-group">
              <label for="pickup-city">City</label>
              <input type="text" id="pickup-city" name="pickup_city" placeholder="Your City" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="pickup-state">State</label>
              <input type="text" id="pickup-state" name="pickup_state" placeholder="Your State" required>
            </div>
            <div class="form-group">
              <label for="pickup-zip">ZIP Code</label>
              <input type="text" id="pickup-zip" name="pickup_zip" placeholder="ZIP Code" required>
            </div>
          </div>
          <!-- Hidden fields for latitude and longitude -->
          <input type="hidden" id="latitude" name="latitude">
          <input type="hidden" id="longitude" name="longitude">
          
          <div class="pickup-buttons">
            <button type="button" id="locateMeBtn" class="btn locate-me"><i class="fas fa-map-pin"></i> Locate Me</button>
            <button type="button" id="to-schedule-btn" class="btn next-btn">Next: Schedule Pickup</button>
          </div>
        </form>
      </section>

      <!-- Step 4: Schedule Pickup -->
      <section id="step-schedule" class="card step-section" style="display:none;">
        <h3>Schedule Pickup</h3>
        <form id="schedule-form">
          <div class="pickup-form">
            <label for="pickup-date">Pickup Date:</label>
            <input type="date" id="pickup-date" name="pickup_date" required>
            <label for="pickup-time">Pickup Time:</label>
            <input type="time" id="pickup-time" name="pickup_time" required>
          </div>
          <button type="submit" class="btn">Confirm & Schedule Pickup</button>
        </form>
      </section>
    </main>
  </div>

  <script>
    $(document).ready(function(){
      // Navigation between steps
      $("#to-issue-btn").click(function(){
        $(".step").removeClass("active");
        $('.step[data-step="issue-details"]').addClass("active");
        $(".step-section").hide();
        $("#step-issue-details").fadeIn();
      });
      
      $("#to-pickup-btn").click(function(){
        $(".step").removeClass("active");
        $('.step[data-step="pickup-location"]').addClass("active");
        $(".step-section").hide();
        $("#step-pickup-location").fadeIn();
      });
      
      $(document).on("click", "#to-schedule-btn", function(){
        if ($("#pickup-address").val().trim() === "" ||
            $("#pickup-city").val().trim() === "" ||
            $("#pickup-state").val().trim() === "" ||
            $("#pickup-zip").val().trim() === "") {
          alert("Please fill in all the pickup location fields.");
          return;
        }
        $(".step").removeClass("active");
        $('.step[data-step="schedule"]').addClass("active");
        $(".step-section").hide();
        $("#step-schedule").fadeIn();
      });
      
      // Autocomplete for Vehicle Brand & Model
      $("#vehicle-brand").autocomplete({
        source: function(request, response) {
          $.ajax({
            url: "<?php echo site_url('imageUpload/get_brands'); ?>",
            dataType: "json",
            data: { term: request.term },
            success: function(data) {
              response($.map(data, function(item) {
                return { label: item.name, value: item.name, id: item.id };
              }));
            }
          });
        },
        minLength: 1,
        select: function(event, ui) {
          $("#vehicle-brand").data("brand-id", ui.item.id);
          $("#vehicle-brand").data("brand-name", ui.item.value);
          $("#vehicle-model").val('');
        }
      });
      
      $("#vehicle-model").autocomplete({
        source: function(request, response) {
          var brandId = $("#vehicle-brand").data("brand-id");
          if (!brandId) { response([]); return; }
          $.ajax({
            url: "<?php echo site_url('imageUpload/get_models'); ?>",
            dataType: "json",
            data: { term: request.term, brand_id: brandId },
            success: function(data) {
              response($.map(data, function(item) {
                return { label: item.name, value: item.name, id: item.id };
              }));
            }
          });
        },
        minLength: 1,
        select: function(event, ui) {
          $("#vehicle-model").data("model", ui.item.value);
        }
      });
      
      // Locate Me functionality using Geolocation & Google Geocoder
      $("#locateMeBtn").click(function(){
  // Start icon rotation
  $(this).find("i.fa-map-pin").addClass("rotating");
  

  // Save original placeholders for later restoration
  var originalPlaceholders = {
    address: $("#pickup-address").attr("placeholder"),
    city: $("#pickup-city").attr("placeholder"),
    state: $("#pickup-state").attr("placeholder"),
    zip: $("#pickup-zip").attr("placeholder")
  };

  // Immediately update placeholders and add fade animation class to all four fields
  $("#pickup-address").fadeOut(300, function(){
    $(this).attr("placeholder", "Locating Your Address").fadeIn(300);
  });
  $("#pickup-city").fadeOut(300, function(){
    $(this).attr("placeholder", "Finding Your City").fadeIn(300);
  });
  $("#pickup-state").fadeOut(300, function(){
    $(this).attr("placeholder", "Determining Your State").fadeIn(300);
  });
  $("#pickup-zip").fadeOut(300, function(){
    $(this).attr("placeholder", "Fetching ZIP Code").fadeIn(300);
  });

  // Apply rainbow border animation if desired
  setTimeout(function(){
  $("#pickup-address, #pickup-city, #pickup-state, #pickup-zip").addClass("animate-border");
}, 300);

  // After 1.5 seconds, update the placeholder text to "connecting with google"
  setTimeout(function(){
    $("#pickup-address, #pickup-city, #pickup-state, #pickup-zip").attr("placeholder", "Connecting With Google Maps");
  }, 3000);

  setTimeout(function(){
    $("#pickup-address").fadeOut(300, function(){
    $(this).attr("placeholder", "Retrieving Exact Adress").fadeIn(300);
  });
  $("#pickup-city").fadeOut(300, function(){
    $(this).attr("placeholder", "Retrieving Your City").fadeIn(300);
  });
  $("#pickup-state").fadeOut(300, function(){
    $(this).attr("placeholder", "Retrieving Exact State").fadeIn(300);
  });
  $("#pickup-zip").fadeOut(300, function(){
    $(this).attr("placeholder", "Retrieving Your Zip Code").fadeIn(300);
  });
  }, 6000);

  // After a total of 3 seconds, remove animations and restore original placeholders
  setTimeout(function(){
    // Stop icon rotation and remove animations
    $("#locateMeBtn").find("i.fa-map-pin").removeClass("rotating");
    $("#pickup-address, #pickup-city, #pickup-state, #pickup-zip")
      .removeClass("animate-border animate-placeholder");

    // Restore original placeholders
    //$("#pickup-address").attr("placeholder", originalPlaceholders.address);
    //$("#pickup-city").attr("placeholder", originalPlaceholders.city);
    //$("#pickup-state").attr("placeholder", originalPlaceholders.state);
    //$("#pickup-zip").attr("placeholder", originalPlaceholders.zip);

    // Proceed with geolocation logic
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    } else {
      alert("Geolocation is not supported by your browser.");
    }
  }, 9000);
});



      
      function successCallback(position) {
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        $("#latitude").val(lat);
        $("#longitude").val(lng);
        var latlng = { lat: parseFloat(lat), lng: parseFloat(lng) };
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'location': latlng }, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              var selectedResult = results.find(function(r) {
                return r.formatted_address.indexOf('+') === -1;
              }) || results[0];
              $("#pickup-address").val(selectedResult.formatted_address);
              var city = "", state = "", zip = "";
              selectedResult.address_components.forEach(function(component) {
                if (component.types.indexOf("locality") > -1) city = component.long_name;
                if (!city && component.types.indexOf("postal_town") > -1) city = component.long_name;
                if (component.types.indexOf("administrative_area_level_1") > -1) state = component.long_name;
                if (component.types.indexOf("postal_code") > -1) zip = component.long_name;
              });
              $("#pickup-city").val(city);
              $("#pickup-state").val(state);
              $("#pickup-zip").val(zip);
            } else {
              alert("No results found.");
            }
          } else {
            alert("Geocoder failed due to: " + status);
          }
        });
      }
      
      function errorCallback(error) {
        switch(error.code) {
          case error.PERMISSION_DENIED:
            alert("Permission denied. Please allow location access.");
            break;
          case error.POSITION_UNAVAILABLE:
            alert("Location information is unavailable.");
            break;
          case error.TIMEOUT:
            alert("The request to get your location timed out.");
            break;
          default:
            alert("An unknown error occurred.");
            break;
        }
      }
      
      // Schedule Pickup form submission via AJAX
      $("#schedule-form").submit(function(e){
        e.preventDefault();
        var pickupDate = $("#pickup-date").val();
        var pickupTime = $("#pickup-time").val();
        var pickupAddress = $("#pickup-address").val();
        var pickupCity = $("#pickup-city").val();
        var pickupState = $("#pickup-state").val();
        var pickupZip = $("#pickup-zip").val();
        var vehicleBrand = $("#vehicle-brand").val();
        var vehicleModel = $("#vehicle-model").val();
        var vehicleIssue = $("#vehicle-issue").val();
        var vehiclereg = $("#vehicle-reg").val();
        $.ajax({
          url: '<?php echo site_url("ImageUpload/save_pickupdata"); ?>',
          type: 'POST',
          data: {
            pickup_date: pickupDate,
            pickup_time: pickupTime,
            pickup_address: pickupAddress,
            pickup_city: pickupCity,
            pickup_state: pickupState,
            pickup_zip: pickupZip,
            brand: vehicleBrand,
            model: vehicleModel,
            vehicle_reg: vehiclereg,
            originalPrediction: vehicleIssue
          },
          success: function(response){
            window.location.href = '<?php echo site_url("pickup/confirm"); ?>';
          },
          error: function(xhr, status, error){
            console.error("Error scheduling pickup: " + error);
          }
        });
      });
    });
  </script>
</body>
</html>
