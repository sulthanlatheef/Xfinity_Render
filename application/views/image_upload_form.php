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
  <!-- jsPDF and html2pdf -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <!-- Google Maps API: Replace YOUR_API_KEY with your actual key -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyNnYX9lxpsHAWG4cC2YBPYA66QoOR2ao"></script>
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  
  <style>
    /* Global Styles */
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
      padding: 4px 0;
      position: sticky;
      top: 0;
      z-index: 10;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: nowrap;
    }
    .navbar-logo {
      font-size: 28px;
      color: #fff;
      font-weight: 1000;
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
      justify-content: center;
      gap: 20px;
      flex-wrap: nowrap;
    }
    nav a {
      color: #fff;
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
    }
    .user-info .username {
      font-size: 18px;
      color: #fff;
      font-weight: 600;
      margin-right: 15px;
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
      .navbar-logo { font-size: 20px; margin-left: 15px; }
      nav a { padding: 10px 20px; font-size: 18px; }
      .user-info .username { font-size: 16px; }
    }

    /* Main Layout */
    .wrapper {
      display: flex;
      max-width: 1350px;
      margin: 25px auto;
      background: #fff;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      border-radius: 20px;
      overflow: hidden;
    }
    .sidebar {
      background: #ff6600;
      width: 250px;
      padding: 30px 20px;
      color: #fff;
      display: flex;
      flex-direction: column;
      gap: 29px;
    }
    .sidebar h2 {
      font-size: 20px;
      text-align: center;
      margin-bottom: 15px;
      border-bottom: 1px solid rgba(255,255,255,0.4);
      padding-bottom: 10px;
    }
    .step {
      display: flex;
      align-items: center;
      gap: 15px;
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
    .step span { font-size: 16px; }
    
    .content {
      flex: 1;
      padding: 40px;
    }
    .card {
      background: #fdfdfd;
      border-radius: 8px;
      padding: 30px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      margin-bottom: 30px;
    }
    .card h3 {
      margin-bottom: 20px;
      color: #333;
    }
    .preview-info {
      background: #ffecec;
      border-left: 4px solid #2196F3;
      padding: 10px 15px;
      margin-bottom: 20px;
      font-size: 19px;
      color:rgb(255, 32, 32);
      border-radius: 4px;
    }

    #savedAddrSuccess {
  display: none;
  position: relative;
  background: #e6ffed;           /* light green */
  color: #2a7a2e;                /* dark green */
  padding: 5px 14px;
  border-left: 4px solid #2a7a2e;
  border-radius: 6px;
  margin-bottom: 12px;
  font-size: 0.95rem;
  animation: slideDown 0.4s ease-out;
}

/* Edit card styling */
#savedAddrEdit {
  background: #fff;
  border: 1px solid #ddd;
  box-shadow: 0 4px 12px rgba(0,0,0,0.05);
  border-radius: 8px;
  padding: 0px;
  display: none;
  height:60px;
}

/* Buttons inside edit */
#savedAddrEdit .btn {
  background: linear-gradient(90deg, #ff8c42, #ff5722);
  color: #fff;
  border: none;
  border-radius: 6px;
  padding: 8px 14px;
  font-size: 0.9rem;
  cursor: pointer;
  transition: transform 0.2s;
}
#savedAddrEdit .btn:hover {
  transform: translateY(-2px);
}

/* Slide-down keyframes */
@keyframes slideDown {
  from { opacity: 0; transform: translateY(-10px); }
  to   { opacity: 1; transform: translateY(0); }
}

.sidebarnew {
  position: fixed;
  top: 0;
  right: -350px;
  width: 330px;
  height: 100%;
  background: linear-gradient(135deg,rgba(225, 220, 215, 0.84),rgba(255, 255, 255, 0.8));
  backdrop-filter: blur(12px);
  border-left: 2px solid #ffffff40;
  border-top: 2px solid #ffffff30;
  border-radius: 20px 0 0 20px;
  box-shadow: -10px 0 30px rgba(0, 0, 0, 0.1);
  transition: right 0.4s ease-in-out;
  z-index: 2000;
  padding: 25px;
  padding-top:20px;
  margin-top: 61px;
}

.sidebarnew.active {
  right: 0;
}

.sidebarnew .top-section {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.sidebarnew .close-btn {
  background: none;
  border: none;
  font-size: 22px;
  color: #555;
  cursor: pointer;
  transition: transform 0.2s;
}

.sidebarnew .close-btn:hover {
  transform: rotate(90deg);
}

.profile-section {
  text-align: center;
  margin: 30px 0;
}

.profile-pic {
  width: 120px;
  height: 120px;
  object-fit: cover;
  border-radius: 20%;
  border: 4px solid #eee;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  transition: transform 0.3s;
}

.profile-pic:hover {
  transform: scale(1.05);
}

.avatar-options p {
  font-size: 15px;
  color: #666;
  margin-bottom: 10px;
}
.avatar-options p.upgrade {
  color: red;
  font-size:14.5px;
  margin-left:12px !important;
  display:inline-block;
}


.avatar-list {
  display: flex;
  justify-content: center;
  gap: 12px;
  flex-wrap: wrap;
}

.avatar {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  cursor: pointer;
  transition: transform 0.3s, box-shadow 0.3s;
  border: 2px solid transparent;
}

.avatar:hover {
  transform: scale(1.15);
  border-color: #ff6600;
  box-shadow: 0 4px 10px rgba(255, 102, 0, 0.3);
}

.menu {
  margin-top: 30px;
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.menu a {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 12px;
  border-radius: 12px;
  font-size: 16px;
  color: #333;
  background: #fff;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
  transition: all 0.3s ease;
}

.menu a i {
  transition: transform 0.3s ease;
}

.menu a:hover {
  background-color: #ff6600;
  color: white;
}

.menu a:hover i {
  transform: scale(1.2);
}

.logout-btn {
  margin-top: 20px;
  padding: 12px 20px;
  width: 100%;
  background: linear-gradient(135deg, #ff4d4d, #cc0000);
  border: none;
  border-radius: 30px;
  color: white;
  font-weight: 600;
  cursor: pointer;
  transition: transform 0.3s, box-shadow 0.3s;
}

.logout-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 15px rgba(204, 0, 0, 0.4);
}


    /* File Upload */
    .upload-box {
      text-align: center;
      padding: 40px 20px;
      border: 2px dashed #ff6600;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s, border-color 0.3s;
    }
    .upload-box.hover { background: #fff3e6; border-color: #ff944d; }
    .upload-box input[type="file"] { display: none; }
    .upload-box i { font-size: 40px; color: #ff6600; margin-bottom: 10px; }
    .upload-box p { font-size: 18px; color: #666; }
    
    /* File Status / Preview Icon */
    .file-status {
      text-align: center;
      font-size: 16px;
      color: #888;
      margin-top: 10px;
    }
    .file-status .preview-icon {
      cursor: pointer;
      font-size: 20px;
      color: #ff6600;
    }
    
    /* Prediction List Styles */
    .prediction-list {
      list-style: none;
      padding-left: 0;
    }
    .prediction-card {
      background: linear-gradient(135deg, #ffffff, #f7f7f7);
      border: 1px solid #e0e0e0;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }
    .prediction-card .diagnosed-box {
      background: #ffecec;
      border: 1px solid #ffcccc;
      border-radius: 6px;
      padding: 10px 15px;
      margin-bottom: 10px;
    }
    .prediction-card .diagnosed-box h4 {
      font-size: 20px;
      display: inline;
    }
    .prediction-card .diagnosed-box span.value {
      color: red;
      font-weight: bold;
      margin-left: 5px;
    }
    .prediction-card .explanation-box {
      background: #e9f7ef;
      border: 1px solid #c8e6c9;
      border-radius: 6px;
      padding: 10px 15px;
    }
    .prediction-card .explanation-box h4 {
      font-size: 17.5px;
      margin-bottom: 5px;
    }
    .prediction-card .explanation-box p {
      font-size: 17px;
      margin: 0;
    }
    
    /* Buttons */
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
    .btn:hover { transform: translateY(-3px); box-shadow: 0 6px 12px rgba(0,0,0,0.15); }
    
    .pickup-header {
      text-align: center;
      margin-bottom: 5px;
      padding-bottom: 10px;
      border-bottom: 1px solid #eee;
      animation: slideDown 0.6s ease;
    }
    @keyframes slideDown {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .pickup-header i {
      font-size: 42px;
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
.locate-me i {
  margin-right: 11px; /* adjust the value as needed */
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
    
    /* Invoice Modal (Restored as provided) */
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
    
    /* Analysis Result Styles */
    .analysis-box {
      margin-top: 15px;
      padding: 20px;
      background: linear-gradient(135deg, #fff, #f9f9f9);
      border-left: 5px solid #ff6600;
      border-radius: 4px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .analysis-box h4 {
      font-size: 20px;
      margin-bottom: 8px;
      color: #333;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .analysis-box h4 i {
      color: #ff6600;
    }
    .analysis-box p {
      font-size: 15px;
      color: #555;
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
    


   
    /* Spinning Animation */
    @keyframes spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }
    .spinning { animation: spin 3s linear; }
    
    /* Vehicle Details */
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
    
    /* Schedule Pickup Form */
    .pickup-form input, .pickup-form select {
      width: 100%;
      padding: 10px;
      margin: 10px 0 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
    }
    
    /* Responsive */
    @media(max-width: 768px) {
      .wrapper { flex-direction: column; }
      .sidebar { width: 100%; flex-direction: row; justify-content: space-around; }
      .sidebar h2 { display: none; }
      .step span { font-size: 14px; }
      .vehicle-details input { width: 100%; }
      .pickup-buttons { flex-direction: column; }
    }
  </style>
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
 .modal1 {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.6);
  align-items: center;
  justify-content: center;
  z-index: 1000;
  padding: 1rem;
  
}
.modal1.show {
  display: flex;
}

  .modal1-content{
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
  .modal1-header {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1.5rem;
    background: linear-gradient(135deg, var(--orange-light), var(--orange-dark));
    color: var(--white);
    font-family: var(--font-heading);
  }
  .modal1-header h3 {
    margin: 0;
    font-size: clamp(1.5rem, 4vw, 2rem);
    flex: 1;
  }
  .modal1-header lottie-player {
    width: clamp(50px, 10vw, 80px);
    height: clamp(50px, 10vw, 80px);
    margin-right: 1rem;
  }
  .modal1-header .close {
    background: none;
    border: none;
    color: var(--white);
    font-size: clamp(1.5rem, 4vw, 2rem);
    cursor: pointer;
    transition: transform var(--transition);
    z-index: 1;
  }
  .modal1-header .close:hover { transform: rotate(90deg); }

  /* Body & typography */
  .modal1-body {
    background: var(--gray-bg);
    padding: 1.5rem;
    font-family: var(--font-body);
    color: #333;
    font-size: clamp(0.9rem, 2.5vw, 1rem);
  }
  .modal1-body p { margin-bottom: 1rem; }

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
  .modal1-footer {
    padding: 1rem 1.5rem;
    background: var(--white);
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
  }
  .btnn {
    
   
   
    border-radius:30px;
  
    font-size: 25px;
    cursor: pointer;
    transition: transform var(--transition), box-shadow var(--transition);
  }
  .btnn-primary {
   
    color: red;
  }
  .btnn-secondary {
     background: var(--orange);
    color: var(--white);
  }
  .btnn-primary:hover,
  .btnn-secondary:hover {
    transform: translateY(-2px);
   
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
</head>
<body>
  <!-- Header -->
  <nav>
    <div class="navbar-logo" style="animation:none;"><i class="fa-solid fa-bolt" style="margin-right:5px;"></i>Xpress Fix</div>
    <div class="nav-links">
      <a href="#ai-features">AI Features</a>
      <a href="#schedule-pickup">Schedule Pickup</a>
      <a href="#ai-diagnosis">AI Diagnosis</a>
      <a href="#track-status">Track Status</a>
       
    </div>
    <?php if ($this->session->userdata('name')): ?>
     
      <div class="user-info" style="cursor:pointer;" onclick="toggleSidebar()">
      <i class="fa-solid fa-user-astronaut" style="color:white;font-size:29px;padding-right:10px;"></i>
        <span class="username" style="font-size:19.5px;"><?php echo html_escape($this->session->userdata('name')); ?></span>
        
       
      </div>
    <?php else: ?>
      <a href="<?php echo site_url('login'); ?>" class="button" style="margin-right:30px; color:#fff; font-size:20px; padding:10px 30px;">Login</a>
    <?php endif; ?>
  </nav>

  <!-- Modals -->
  <!-- Xpress Fix Modal -->
<div id="express-modal" class="modal1">
  <div class="modal1-content">
    <div class="modal1-header">
      <!-- Lottie animation could be a spinning wrench, car, etc. -->
      <lottie-player
        src="https://lottie.host/cc511c6e-fdc7-4363-928c-fc000569571f/K7WvuW62T9.json"
        background="transparent" speed="1" loop autoplay >
      </lottie-player>
      <h3>Xpress Fix</h3>
      <button class="close" data-target="express-modal">&times;</button>
    </div>
    <div class="modal1-body">
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
    <div class="modal1-footer">
      <button class="btn btn-secondary" data-target="express-modal">Close</button>
      
    </div>
  </div>
</div>

  <div class="sidebarnew" id="sidebar">
  <div class="top-section">
  <h3>Hello, <?php echo html_escape($this->session->userdata('name')); ?></h3>

    <button class="close-btn" onclick="toggleSidebar()"><i class="fas fa-times"></i></button>
  </div>

  <div class="profile-section">
    <img src="<?= html_escape( $this->session->userdata('avatar') ) ?>" class="profile-pic" alt="Profile Picture">
    <p style="margin-top: 10px; font-weight: 500;"><?php echo html_escape($this->session->userdata('membership')); ?></p>
  </div>

  <div class="avatar-options">
    <p style="margin-left:65px;">Choose Your Avatar</p>
    <div class="avatar-list" id="avatar-list"></div>
  </div>

  <div class="menu">
    <a href="<?= site_url('home/profile') ?>"><i class="fas fa-user-circle"></i> Profile</a>
    <a href="<?= site_url('advanced') ?>"><i class="fas fa-house-user"></i> Home</a>
    <a href="<?= site_url('home/support') ?>"><i class="fas fa-headset"></i> Support</a>
  </div>

  <a href="<?php echo site_url('home/logout'); ?>">
    <button class="logout-btn">Logout</button>
  </a>
</div>

  <!-- Main Wrapper -->
  <div class="wrapper">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>Steps</h2>
      <div class="step active" data-step="upload">
        <i class="fas fa-cloud-upload-alt"></i>
        <span>Upload Image</span>
      </div>
      <div class="step" data-step="predict">
        <i class="fas fa-eye"></i>
        <span>View Predictions</span>
      </div>
      <div class="step" data-step="vehicle">
        <i class="fas fa-car"></i>
        <span>Vehicle Details</span>
      </div>
      <div class="step" data-step="invoice">
        <i class="fas fa-file-invoice-dollar"></i>
        <span>Invoice Preview</span>
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
      <!-- Step 1: Upload Image -->
      <section id="step-upload" class="card step-section">
        <h3>Step 1: Upload Fault Image <i class="fa-solid fa-circle-info" style="transform:translateY(2px);color: #ff6a00;;font-size:20px;margin-left:2px; cursor:pointer;"
     data-open="express-modal"></i></h3>
        <form id="upload-form" enctype="multipart/form-data">
          <div class="upload-box" id="upload-box">
            <i class="fas fa-upload"></i>
            <p>Drag & Drop your image here or click to select</p>
            <input type="file" id="image" name="image" required>
          </div>
          <!-- File status element (initially displays "No file uploaded") -->
          <div class="file-status" id="file-status">No file uploaded</div>
          <button type="submit" class="btn"><i class="fas fa-cogs"></i> Analyze Image </button>
           
    
  
         <div id="error-message" style="color:#e74c3c;margin-top:15px;display:none;"></div>
        </form>
      </section>

      <!-- Step 2: Predictions -->
      <section id="step-predict" class="card step-section" style="display:none;">
        <h3>Step 2: Predictions</h3>
        <ul class="prediction-list" id="prediction-list"></ul>
        <!-- Next button will only show when appropriate -->
        <button id="to-vehicle-btn" class="btn">Next: Vehicle Details</button>
      </section>

      <!-- Step 3: Vehicle Details -->
      <section id="step-vehicle" class="card step-section" style="display:none;">
        <h3>Step 3: Enter Vehicle Details</h3>
        <div class="vehicle-details">
          <input type="text" id="vehicle-brand" placeholder="Vehicle Brand" autocomplete="off">
          <input type="text" id="vehicle-model" placeholder="Vehicle Model" autocomplete="off">
          <input type="text" id="vehicle-reg" placeholder="Vehicle Registration No" autocomplete="off">
        </div>
        <button id="show-price-button" class="btn">Get Price Estimate</button>
      </section>

      <!-- Step 4: Invoice Preview -->
      <section id="step-invoice" class="card step-section" style="display:none;">
        <h3>Step 4: Invoice Preview</h3>
        <div class="preview-info">
        This detailed repair estimate is generated based on our advanced AI damage detection system. Prices are calculated considering the severity of the damage and your  selected vehicle model. For any inquiries or assistance, feel free to contact our support team.  We ensure transparent and accurate pricing for your vehicle's best care.
        </div>
        <div id="invoice-modal" title="XFINITY INVOICE">
          <div class="modal-content">
            <div class="invoice-header">
              <div class="invoice-logo">
                <img src="/XFINITY/assets/images/creative ai (2).png" alt="XFINITY Logo">
              </div>
              <div class="invoice-title">
                <h2>XFINITY INVOICE</h2>
                <p>123 Demo Street, City, State - PIN</p>
              </div>
            </div>
            <div class="invoice-info">
              <div class="number-label">Estimate #: <span id="invoice-number"></span></div>
              <div>Date: <span id="invoice-date"></span></div>
            </div>
            <hr>
            <div class="invoice-billing">
              <h3>Bill To: <span id="invoice-bill-to"><?php echo html_escape($this->session->userdata('name')); ?></span></h3>
            </div>
            <table class="invoice-table">
              <thead>
                <tr>
                  <th>Description</th>
                  <th>Qty</th>
                  <th>Unit Price</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
                <!-- Invoice items inserted dynamically -->
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="3">Subtotal</td>
                  <td id="invoice-subtotal"></td>
                </tr>
                <tr>
                  <td colspan="3">CGST (9%)</td>
                  <td id="invoice-cgst"></td>
                </tr>
                <tr>
                  <td colspan="3">SGST (9%)</td>
                  <td id="invoice-sgst"></td>
                </tr>
                <tr>
                  <td colspan="3">Total</td>
                  <td id="invoice-total"></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <button id="view-invoice-btn" class="btn">View Invoice</button>
      </section>

      <!-- Step 5: Pickup Location -->
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

      <!-- Step 6: Schedule Pickup -->
      <section id="step-schedule" class="card step-section" style="display:none;">
  <h3>Schedule Pickup</h3>
  <form id="schedule-form">
    <div class="pickup-form">
      <label for="pickup-date">Pickup Date:</label>
      <input type="date" id="pickup-date" name="pickup_date" required>
      <label for="pickup-time">Pickup Time:</label>
      <input type="time" id="pickup-time" name="pickup_time" required>
    </div>

    <!-- Saved Address with Edit -->
    <!-- Saved Address with Edit & Confirmation -->
<div class="form-group" style="margin: 16px 0; position: relative;">
  <label style="font-weight:600;">Your Saved Delivery Address</label>
  <i id="toggleSavedAddr"
     class="fas fa-eye"
     style="cursor:pointer; margin-left:8px;"
     title="Show / Hide"></i>

  <div id="savedAddrContainer" style="margin-top:8px;">
    <!-- Confirmation banner -->
   
    <div id="savedAddrSuccess">  
      <i class="fas fa-check-circle" style="margin-right:6px;"></i>
      Address updated!
   
    </div>

    <!-- View mode -->
    <div id="savedAddrView" style="padding:8px; background:#fafafa; border:1px solid #ddd; border-radius:6px; position:relative;">
      <span id="savedAddrText"><?= html_escape($user['delivery_address']) ?></span>
      <i id="editSavedAddr" class="fas fa-edit"
         style="position:absolute; top:8px; right:8px; cursor:pointer;"
         title="Edit Address"></i>
    </div>

    <!-- Edit mode (modern card) -->
    <div id="savedAddrEdit">
      <textarea id="savedAddrInput"
                style="width:100%;height:60px; border-radius:4px; font-weight:300;font-size:16px;padding:8px; resize: vertical;"
                rows="2"><?= html_escape($user['delivery_address']) ?></textarea>
      <div style="margin-top:12px; text-align:right;">
        <button type="button" id="cancelSavedAddr" class="btn" 
                style="background:#ccc; color:#333; margin-right:8px;">Cancel</button>
        <button type="button" id="saveSavedAddr" class="btn">Save </button>
       
      </div>
    </div>
  </div>
</div>


    <button type="submit" class="btn">Confirm &amp; Schedule Pickup </button>
   
  </form>
</section>
    </main>
  </div>
  

  <!-- Preview Modal for Uploaded Image -->
  
  <div id="preview-modal" title="Image Preview" style="display:none; text-align:center;">
    <img id="preview-image" src="" alt="Uploaded Image Preview" style="max-width:100%; height:auto;">
  </div>

  <!-- JavaScript -->
    <script>
    document.querySelectorAll('.close, .btn-secondary').forEach(el => {
      el.addEventListener('click', e => {
        const tgt = e.target.dataset.target;
        if (tgt) document.getElementById(tgt).classList.remove('show');
      });
    });
   document.querySelectorAll('[data-open]').forEach(btn => {
  btn.addEventListener('click', e => {
    const modalId = btn.dataset.open;
    const modal = document.getElementById(modalId);
    if (modal) modal.classList.add('show');
  });
});

  </script>
  <script>
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('active');
  }

  function createRandomAvatar() {
    const seed = Math.random().toString(36).substring(2, 10);
    return `https://api.dicebear.com/9.x/bottts/svg?seed=${seed}`;
  }

  function populateAvatars(count = 4) {
    const container = document.getElementById('avatar-list');
    container.innerHTML = '';
    for (let i = 0; i < count; i++) {
      const img = document.createElement('img');
      img.src = createRandomAvatar();
      img.className = 'avatar';
      img.onclick = () => selectAvatar(img.src);
      container.appendChild(img);
    }
  }

  function selectAvatar(src) {
    if (membership.toLowerCase() !== 'gold membership') {
    const promptEl = document.querySelector('.avatar-options p');
    promptEl.textContent = 'Please upgrade to GOLD for Avatars';
    promptEl.classList.add('upgrade');
    return;
  }
    document.querySelector('.profile-pic').src = src;
    fetch('<?= site_url("home/update_avatar") ?>', {
      method: 'POST',
      credentials: 'same-origin',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ avatar_url: src })
    });
  }

  setInterval(() => populateAvatars(), 10000);
  populateAvatars();
</script>

  <script>
document.addEventListener('DOMContentLoaded', () => {
  const eye        = document.getElementById('toggleSavedAddr');
  const viewPane   = document.getElementById('savedAddrView');
  const editPane   = document.getElementById('savedAddrEdit');
  const addrText   = document.getElementById('savedAddrText');
  const editBtn    = document.getElementById('editSavedAddr');
  const cancelBtn  = document.getElementById('cancelSavedAddr');
  const saveBtn    = document.getElementById('saveSavedAddr');
  const inputField = document.getElementById('savedAddrInput');
  const successMsg = document.getElementById('savedAddrSuccess');

  // Toggle show/hide
  eye.addEventListener('click', () => {
    if (viewPane.style.display === 'none') {
      viewPane.style.display = 'block';
      eye.classList.replace('fa-eye-slash', 'fa-eye');
    } else {
      viewPane.style.display = 'none';
      editPane.style.display = 'none';
      eye.classList.replace('fa-eye', 'fa-eye-slash');
    }
  });

  // Enter edit
  editBtn.addEventListener('click', () => {
    viewPane.style.display = 'none';
    editPane.style.display = 'block';
    inputField.focus();
  });

  // Cancel edit
  cancelBtn.addEventListener('click', () => {
    editPane.style.display = 'none';
    viewPane.style.display = 'block';
    inputField.value = addrText.textContent.trim();
  });

  // Save via AJAX
  saveBtn.addEventListener('click', () => {
    const newAddr = inputField.value.trim();
    if (!newAddr) {
      alert('Address cannot be empty.');
      return;
    }
    fetch('<?= site_url("advanced/update_address") ?>', {
      method: 'POST',
      credentials: 'same-origin',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'delivery_address=' + encodeURIComponent(newAddr)
    })
    .then(res => {
      if (!res.ok) throw new Error('Network error');
      return res.text();
    })
    .then(() => {
      // Update UI
      addrText.textContent = newAddr;
      editPane.style.display = 'none';
      viewPane.style.display = 'block';

      // Show & auto-hide success banner
      successMsg.style.display = 'block';
      setTimeout(() => successMsg.style.display = 'none', 3000);
    })
    .catch(err => {
      console.error(err);
      alert('⚠️ Failed to update address. Please try again.');
    });
  });
});
</script>
<script>
    var dentCost = undefined;
    var membership = <?= json_encode($this->session->userdata('membership')) ?>;


    function filterAccessory(prediction) {
      if (typeof prediction !== "string") return "";
      let filtered = prediction.replace(/-/g, ' ').replace(/damage/gi, '').trim();
      return filtered.split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
    }

    function lookupAccessoryPrice() {
      var brandId = $("#vehicle-brand").data("brand-id");
      var brandName = $("#vehicle-brand").data("brand-name");
      var model = $("#vehicle-model").data("model");
      // Extract the accessory name from the diagnosed issue value in the first prediction card.
      var accessoryName = $("#prediction-list .prediction-card").first().find(".diagnosed-box span.value").text().trim();
      accessoryName = filterAccessory(accessoryName);
      console.log("Looking up price for:", brandName, model, accessoryName);

      var invoiceData = {
        brandName: brandName || "N/A",
        model: model || "N/A",
        accessory: accessoryName,
        price: null
      };

      if (accessoryName.toLowerCase().indexOf("scratch") !== -1) {
        invoiceData.accessory = "Scratch Repair";
        invoiceData.price = 1000;
        openInvoiceModal(invoiceData);
      } else if (accessoryName.toLowerCase().indexOf("dent") !== -1) {
        invoiceData.accessory = "Dent Repair";
        invoiceData.price = (dentCost !== undefined) ? dentCost : 2000;
        openInvoiceModal(invoiceData);
      } else if (brandId && model && accessoryName) {
        $.ajax({
          url: "<?php echo site_url('imageUpload/get_accessory_price'); ?>",
          dataType: "json",
          data: { brand_id: brandId, model: model, accessory: accessoryName },
          success: function(data) {
            invoiceData.price = data.price;
            openInvoiceModal(invoiceData);
          }
        });
      } else {
        alert("Please select both brand and model before checking the price.");
      }
    }

  function openInvoiceModal(data) {
  var price        = data.price ? parseFloat(data.price) : 0;
  var laborCharge  = 200;
  var serviceDesc  = data.accessory + " for " + data.brandName + " " + data.model;
  var subtotal     = price + laborCharge;
  var cgst         = subtotal * 0.09;
  var sgst         = subtotal * 0.09;
  var total        = subtotal + cgst + sgst;

  // SESSION‐DRIVEN DISCOUNT
  var discount     = (membership === 'Gold Membership') ? 500 : 0;
  var hasDiscount  = discount > 0;
  if (hasDiscount) { total -= discount; }

  // invoice header
  var today        = new Date().toLocaleDateString();
  var invNumber    = "EST-" + Math.floor(Math.random() * 9000 + 1000);
  $("#invoice-number").text(invNumber);
  $("#invoice-date").text(today);

  // line items
  var rows = [
    `<tr>
       <td>${serviceDesc}</td>
       <td>1</td>
       <td>₹${price.toFixed(2)}</td>
       <td>₹${price.toFixed(2)}</td>
     </tr>`,
    `<tr>
       <td>Labor Charge</td>
       <td>1</td>
       <td>₹${laborCharge.toFixed(2)}</td>
       <td>₹${laborCharge.toFixed(2)}</td>
     </tr>`
  ];

  if (hasDiscount) {
    rows.push(
      `<tr>
         <td style="color:green;">Free Car Wash ( worth ₹500) for GOLD membership</td>
         <td style="color:green;">1</td>
         <td style="color:green;">₹${discount.toFixed(2)}</td>
         <td style="color:green;">FREE</td>
       </tr>`
    );
  }

  $("#invoice-modal .invoice-table tbody").html(rows.join(''));

  // totals & taxes
  $("#invoice-subtotal").text("₹" + subtotal.toFixed(2));
  $("#invoice-cgst").text("₹" + cgst.toFixed(2));
  $("#invoice-sgst").text("₹" + sgst.toFixed(2));

  // optional discount banner
  

  $("#invoice-total").text("₹" + total.toFixed(2));

  // show the invoice
  $(".step").removeClass("active");
  $('.step[data-step="invoice"]').addClass("active");
  $(".step-section").hide();
  $("#step-invoice").fadeIn();
}



    $(document).ready(function(){
      $("#to-vehicle-btn").hide();

      $("#invoice-modal").dialog({
        autoOpen: false,
        modal: true,
        width: 650,
        buttons: {
          "Schedule Pickup": function() {
            var $clone = $("#invoice-modal .modal-content").clone();
            $clone.find(".number-label").html(function(i, oldText) {
              return oldText.replace("Estimate #", "invoice number");
            });
            var invoiceNum = $clone.find("#invoice-number").text();
            var modifiedNum = invoiceNum.replace("EST-", "INV-");
            $clone.find("#invoice-number").text(modifiedNum);
            
            var opt = {
              margin: 0.5,
              filename: modifiedNum + ".pdf",
              image: { type: 'jpeg', quality: 0.98 },
              html2canvas: { scale: 2 },
              jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().set(opt).from($clone[0]).outputPdf('blob').then(function(pdfBlob){
              var formData = new FormData();
              formData.append('invoice', pdfBlob, modifiedNum + ".pdf");
              $.ajax({
                url: '<?php echo site_url("invoice/save_invoice"); ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response){
                  $("#invoice-modal").dialog("close");
                  $(".step").removeClass("active");
                  $('.step[data-step="pickup-location"]').addClass("active");
                  $(".step-section").hide();
                  $("#step-pickup-location").fadeIn();
                },
                error: function(xhr, status, error){
                  console.error("Error saving invoice: " + error);
                }
              });
            });
          },
          "Close": function() { $(this).dialog("close"); }
        }
      });

      // Setup the preview modal with smooth fade animations
      $("#preview-modal").dialog({
        autoOpen: false,
        modal: true,
        width: 600,
        show: { effect: "fade", duration: 300 },
        hide: { effect: "fade", duration: 300 }
      });

      // Bind click event for "View Invoice" button
      $("#view-invoice-btn").click(function(){
        console.log("View Invoice button clicked");
        $("#invoice-modal").dialog("open");
      });

      // Trigger file input when clicking the upload box
      document.getElementById("upload-box").addEventListener("click", function(){
        document.getElementById("image").click();
      });

      $("#upload-box").on("dragenter dragover", function(e) {
        e.preventDefault(); 
        e.stopPropagation(); 
        $(this).addClass("hover");
      });
      $("#upload-box").on("dragleave drop", function(e) {
        e.preventDefault(); 
        e.stopPropagation(); 
        $(this).removeClass("hover");
      });
      $("#upload-box").on("drop", function(e) {
        var files = e.originalEvent.dataTransfer.files;
        if (files.length > 0) {
          document.getElementById("image").files = files;
          // Update the upload box text with the file name
          $(".upload-box p").text(files[0].name);
          // Replace the "No file uploaded" message with a preview (eye) icon
          $("#file-status").html('<i class="fas fa-eye preview-icon" title="Preview Image"></i>');
          bindPreviewEvent();
          // Read the file and store as a data URL for preview
          readImageFile(files[0]);
        }
      });

      // Update the upload box text when a file is selected via input
      $("#image").on("change", function(){
        var file = this.files[0];
        var fileName = file ? file.name : "";
        $(".upload-box p").text(fileName || "Drag & Drop your image here or click to select");
        if(fileName) {
          $("#file-status").html('<i class="fas fa-eye preview-icon" title="Preview Image"></i>');
          bindPreviewEvent();
          readImageFile(file);
        }
      });
      
      function bindPreviewEvent(){
        // Bind click event to the preview icon to open the modal
        $(".preview-icon").on("click", function(){
          $("#preview-modal").dialog("open");
        });
      }

      function readImageFile(file){
        var reader = new FileReader();
        reader.onload = function(e){
          $("#preview-image").attr("src", e.target.result);
        }
        reader.readAsDataURL(file);
      }
      
      $("#upload-form").submit(function(event){
        event.preventDefault();
        var formData = new FormData();
        var imageFile = $("#image")[0].files[0];
        if (!imageFile) { 
          $("#error-message").text("Please select an image.").show(); 
          return; 
        }
        formData.append("image", imageFile);

        var $icon = $(this).find("button.btn i.fa-cogs");
        $icon.addClass("spinning");

        setTimeout(function(){
          $icon.removeClass("spinning");
          $.ajax({
            url: "<?php echo site_url('imageUpload/predict'); ?>",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
              $("#error-message").hide();
              $("#prediction-list").empty();
              if (response.predictions && response.predictions.length > 0) {
                if(response.predictions.length > 1) {
                  $("#prediction-list").append("<li style='color:red;font-weight:bold;'>Multiple issues. Not supported</li>");
                  $("#to-vehicle-btn").hide();
                  if($("#force-pickup-btn").length === 0) {
                    var forcePickupBtn = $("<button id='force-pickup-btn' class='btn'>Force Pickup</button>");
                    forcePickupBtn.on("click", function(){ window.location.href = '<?php echo site_url("forcepickup"); ?>'; });
                    $("#step-predict").append(forcePickupBtn);
                  }
                } else {
                  response.predictions.forEach(function(pred){
                    var y = pred.original;
                    var filtered = y
  .replace(/-/g, ' ')                  // Replace all hyphens with spaces
  .split(' ')                         // Split the string into words
  .map(function(word) {               // Capitalize the first letter of each word
    return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
  })
  .join(' ');  
  console.log(filtered);         
                    var card = $("<div class='prediction-card'></div>");
                    // Diagnosed Issue: header and value on the same line
                    var diagBox = $("<div class='diagnosed-box'></div>");
                    diagBox.html("<h4>Diagnosed Issue: <span class='value'>" + filtered + "</span></h4>");
                    // Explanation in its own box
                    var explBox = $("<div class='explanation-box'></div>");
                    explBox.html("<h4>Explanation:</h4><p>" + pred.custom + "</p>");
                    card.append(diagBox);
                    card.append(explBox);
                    
                    if (pred.original.toLowerCase().includes("dent")) {
                      var analyzeBtn = $("<button class='btn analyze-dent'>Analyze Severity</button>");
                      analyzeBtn.on("click", function(){
                        var severity = "";
                        var descriptiveInfo = "";
                        var confidencePercent = (pred.confidence * 100).toFixed(2);
                        if (confidencePercent >= 20 && confidencePercent <= 50) {
                          severity = "Moderate Dent";
                          dentCost = 2000;
                          descriptiveInfo = "The dent is moderate. Standard repair procedures will restore the appearance.";
                        } else if (confidencePercent > 50) {
                          severity = "Severe Dent";
                          dentCost = 4000;
                          descriptiveInfo = "The dent is severe. Extensive repair work may be needed for restoration.";
                        } else {
                          severity = "Minor Dent";
                          dentCost = 0;
                          descriptiveInfo = "The dent is minor and may not need repair.";
                        }
                        var analysisBox = $("<div class='analysis-box'></div>");
                        analysisBox.append("<h4><i class='fas fa-tools'></i> " + severity + "</h4>");
                        analysisBox.append("<p>" + descriptiveInfo + "</p>");
                        if ($(this).siblings(".analysis-box").length === 0) {
                          $(this).after(analysisBox);
                        } else {
                          $(this).siblings(".analysis-box").html("<h4><i class='fas fa-tools'></i> " + severity + "</h4><p>" + descriptiveInfo + "</p>");
                        }
                        $("#to-vehicle-btn").fadeIn();
                        $(this).hide();
                      });
                      card.append(analyzeBtn);
                      $("#to-vehicle-btn").hide();
                    } else {
                      $("#to-vehicle-btn").fadeIn();
                    }
                    $("#prediction-list").append(card);
                  });
                }
                $(".step").removeClass("active");
                $('.step[data-step="predict"]').addClass("active");
                $(".step-section").hide();
                $("#step-predict").fadeIn();
              } else if (response.error) {
                $("#error-message").text("Error: " + response.error).show();
              } else {
                $("#prediction-list").html("<li>Unable to get response from the server.</li>");
              }
            },
            error: function(xhr, status, error){
              $("#error-message").text("Error: " + xhr.responseText).show();
            }
          });
        }, 3000);
      });
      
      $("#to-vehicle-btn").click(function(){
        $(".step").removeClass("active");
        $('.step[data-step="vehicle"]').addClass("active");
        $(".step-section").hide();
        $("#step-vehicle").fadeIn();
      });
      
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
      
      // Updated schedule form submit: extract diagnosed issue from the card.
      $("#schedule-form").submit(function(e){
        e.preventDefault();
        var pickupDate = $("#pickup-date").val();
        var pickupTime = $("#pickup-time").val();
        var pickupAddress = $("#pickup-address").val();
        var pickupCity = $("#pickup-city").val();
        var pickupState = $("#pickup-state").val();
        var pickupZip = $("#pickup-zip").val();
        var delivery = $("#savedAddrText").text();
        

        // Extract diagnosed issue text from the first prediction card diagnosed box value.
        var originalPrediction = $("#prediction-list .prediction-card").first().find(".diagnosed-box span.value").text().trim();
        
        $.ajax({
          url: '<?php echo site_url("ImageUpload/save_pickupdata"); ?>',
          type: 'POST',
          data: {
            pickup_date: pickupDate,
            pickup_time: pickupTime,
            pickup_address: pickupAddress,
            pickup_city: pickupCity,
            delivery_addr: delivery,
            pickup_state: pickupState,
            pickup_zip: pickupZip,
            brand: $("#vehicle-brand").val(),
            model: $("#vehicle-model").val(),
            vehicle_reg: $("#vehicle-reg").val(),
            originalPrediction: originalPrediction,
            invoiceNumber: $("#invoice-number").html().replace("EST-", "INV-"),
            totalAmount: $("#invoice-total").text().replace("₹", "")
          },
          success: function(response){ window.location.href = '<?php echo site_url("Pickup/confirm"); ?>'; },
          error: function(xhr, status, error){ console.error("Error scheduling pickup: " + error); }
        });
      });
      
      // Delegated binding for the Next: Schedule Pickup button (Step 5)
      $(document).on("click", "#to-schedule-btn", function(){
        if($("#pickup-address").val().trim() === "" ||
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
      
      // Bind click event for "Get Price Estimate" button
      $("#show-price-button").click(function(){
        lookupAccessoryPrice();
      });
      
      // Locate Me button: auto-fill pickup location fields using geolocation & geocoding
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
    $(this).attr("placeholder", "Retrieving Exact Address").fadeIn(300);
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
              var selectedResult = null;
              for (var i = 0; i < results.length; i++) {
                if (results[i].formatted_address.indexOf('+') === -1) {
                  selectedResult = results[i];
                  break;
                }
              }
              if (!selectedResult) {
                selectedResult = results[0];
              }
              $("#pickup-address").val(selectedResult.formatted_address);
              var city = "", state = "", zip = "";
              selectedResult.address_components.forEach(function(component) {
                if (component.types.indexOf("locality") > -1) {
                  city = component.long_name;
                }
                if (!city && component.types.indexOf("postal_town") > -1) {
                  city = component.long_name;
                }
                if (component.types.indexOf("administrative_area_level_1") > -1) {
                  state = component.long_name;
                }
                if (component.types.indexOf("postal_code") > -1) {
                  zip = component.long_name;
                }
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
    });
  </script>
</body>
</html>
