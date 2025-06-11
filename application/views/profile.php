<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Profile</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
   <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <style>
    /* --- Global Reset & Body --- */
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #fff4e6, #ffe7cc);
      display: flex; justify-content: center; align-items: center;
      min-height: 100vh; padding: 20px;
    }

    /* Navbar */
.xfinity-navbar {
  background: linear-gradient(90deg,rgb(255, 98, 0), #ff5722);
  position: fixed;
  top: 0; left: 0; width: 100%;
  z-index: 999;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.nav-container {
  max-width: 1150px;
  margin: 0 auto;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 6px 20px;
}
.brand {
  font-size: 1.8rem;
  font-weight: 800;
  color: #fff;
  text-decoration: none;
}
.nav-links {
  list-style: none;
  display: flex;
  gap: 24px;
}
.nav-links li a {
  color: #fff;
  text-decoration: none;
  font-weight: 500;
  transition: opacity 0.2s;
}
.nav-links li a:hover {
  opacity: 0.8;
}

/* Mobile toggle */
.nav-toggle {
  display: none;
  flex-direction: column;
  gap: 4px;
  background: none;
  border: none;
  cursor: pointer;
}
.nav-toggle span {
  display: block;
  width: 24px; height: 3px;
  background: #fff;
  border-radius: 2px;
}

/* Responsive */
@media (max-width: 768px) {
  .nav-links {
    position: absolute;
    top: 100%; left: 0; right: 0;
    background: linear-gradient(90deg, #ff8c42, #ff5722);
    flex-direction: column;
    align-items: center;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
  }
  .nav-links.open {
    max-height: 240px; /* adjust if you add more links */
  }
  .nav-toggle {
    display: flex;
  }
}

@keyframes fadeIn {
      from { opacity: 0; transform: translate(-50%, -50%) scale(0); }
      to { opacity: 1; transform: translate(-50%, -50%) scale(1); }
    }
    /* Payment Processing Overlay */
    #paymentOverlay {
      display: none; /* Initially hidden */
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(7px);
      z-index: 9999;
      align-items: center;
      justify-content: center;
    }
     #goldOverlay {
      display: none; /* Initially hidden */
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      backdrop-filter: blur(7px);
      z-index: 9999;
      align-items: center;
      justify-content: center;
    }
    /* Container for processing animation */
    .processing-container {
      margin-left:0px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }
    /* New CSS for two 75% complete concentric circles spinning in opposite directions */
    .outer-circle {
      fill: none;
      stroke: url(#grad);
      stroke-width: 10;
      /* For r = 45, circumference ≈ 282.7, so 75% ≈ 212 visible, gap ≈ 70 */
      stroke-dasharray: 212 70;
      transform-origin: center;
      animation: spinClockwise 1.8s linear infinite;
    }
    .inner-circle {
      fill: none;
      stroke: url(#grad);
      stroke-width: 8;
      /* For r = 35, circumference ≈ 219.9, so 75% ≈ 165 visible, gap ≈ 55 */
      stroke-dasharray: 165 55;
      transform-origin: center;
      animation: spinCounterClockwise 1.8s linear infinite;
    }
    @keyframes spinClockwise {
      from { transform: rotate(0deg); }
      to { transform: rotate(1080deg); }
    }
    @keyframes spinCounterClockwise {
      from { transform: rotate(0deg); }
      to { transform: rotate(-1080deg); }
    }
    /* Updated Processing Text */
    .processing-text {
      margin-top: 15px;  /* moved down */
      font-size: 23px;   /* increased size */
      color: #fff;       /* white color */
      //animation: popText 2s ease-in-out infinite;
    }
    @keyframes popText {
      100%, 100% { transform: translateY(0) scale(1); opacity: 1; }
      997% { transform: translateY(10px) scale(1.1); opacity: 0.8; }
    }


    /* --- Main Container --- */
    .profile-container {
      margin-top:46px;
      display: flex; flex-wrap: wrap;
      width: 100%; max-width: 1150px;
   height:650px;
      background: #fff; border-radius: 24px;
      overflow: hidden; box-shadow: 0 12px 30px rgba(0,0,0,0.1);
    }

    /* --- Modern Orange Sidebar --- */
    .profile-sidebar {
      flex: 1 1 300px;
      background: linear-gradient(150deg, #ff8c42, #ff5722);
      color: #fff; text-align: center;
      padding: 60px 20px; display: flex;
      flex-direction: column; align-items: center;justify-content:center;
      position: relative;
    }
    .profile-sidebar::before {
      content: '';
      position: absolute;
      top: 0; left: 0; width: 100%; height: 100%;
      background: url('data:image/svg+xml;utf8,<svg width="200" height="200" xmlns="http://www.w3.org/2000/svg"><circle cx="100" cy="100" r="100" fill="%23ffffff22"/></svg>') no-repeat center/cover;
      opacity: 0.1;
    }
    .profile-sidebar img {
      width: 190px; height: 200px;
      border-radius: 20%; object-fit: cover;
      margin-bottom: 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      border: px solid rgb(249, 243, 239);
      position: relative; z-index: 1;
    }
    .profile-sidebar h2 {
      font-size: 2rem; font-weight: 800;
      margin-bottom: 4px; position: relative; z-index: 1;
    }
    .profile-sidebar p {
      font-size: 1rem; opacity: 0.9;
      letter-spacing: 0.5px; margin-bottom: 20px;
      position: relative; z-index: 1;
    }
    .update-avatar-btn {
      padding: 10px 20px; background: rgba(255,255,255,0.8);
      color: #333; border: none; border-radius: 30px;
      cursor: pointer; font-weight: 600;
      position: relative; z-index: 1;
      transition: background 0.2s, transform 0.2s;
    }
    .update-avatar-btn:hover {
      background: #fff; transform: translateY(-2px);
    }
    /* Address Modal Overrides */
#addressModal .modal-content {
  max-width: 400px;
  padding: 20px 25px;
  text-align: left;
}
#addressModal h3 {
  margin-bottom: 12px;
  font-size: 1.25rem;
  color: #333;
}
#addressModal .success-message {
  display: none;
  background: #d4edda;
  color: #155724;
  padding: 10px;
  border-radius: 6px;
  margin-bottom: 12px;
}
#addressModal textarea {
  width: 100%;
  border: 1px solid #ccc;
  border-radius: 6px;
  padding: 8px;
  resize: vertical;
}
#addressModal .modal-footer {
  margin-top: 15px;
  text-align: right;
}
#addressModal .modal-footer button {
  margin-left: 8px;
}

    
/* ---- Split-Screen Gold Modal ---- */
.gold-split-modal {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.4); /* slightly reduced opacity for better visual with blur */
  backdrop-filter: blur(5px);     /* this adds the blur effect */
  -webkit-backdrop-filter: blur(6px); /* for Safari support */
  z-index: 2000;
  justify-content: center;
  align-items: center;
  animation: fadeIn 0.3s ease-in-out;
}
/* in your existing <style> block */
#payButton.incomplete {
  background:rgb(255, 0, 0) !important;
  border: 0px solid rgb(252, 0, 0) !important;
  color:white;
  cursor: pointer !important;  /* allow retry */
}



.gold-split-content {
  display: flex;
  background: #fff;
  border-radius: 12px;
  overflow: hidden;
  max-width: 800px;
  width: 90%;
  max-height: 90vh;
  box-shadow: 0 20px 40px rgba(0,0,0,0.3);
  position:relative;
}

/* Left Image Panel */
.gold-split-image {
  flex: 1;
  overflow: hidden;
}
.gold-split-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
  transform: scale(1);
  transition: transform 0.5s;
}
.gold-split-image img:hover {
  transform: scale(1.05);
}

/* Right Details Panel */
.gold-split-details {
  flex: 1;
  padding: 30px 25px;
  position: relative;
  display: flex;
  flex-direction: column;
  cursor:grab;
}
.gold-split-details .close-button {
  position: absolute; top: 16px; right: 16px;
  font-size: 24px; background: none; border: none; cursor: pointer;
  color: #888; transition: color 0.2s;
}
.gold-split-details .close-button:hover {
  color: #333;
}

.gold-split-details h2 {
  font-size: 1.75rem;
  margin-bottom: 8px;
  color: #ff5722;
}

.gold-split-details p {
  margin-bottom: 20px;
  color: #555;
  line-height: 1.4;
}

/* Benefit Rows */
.benefit-row {
  display: flex;
  align-items: center;
  margin-bottom: 15px;
  padding: 12px;
  border-radius: 8px;
  background: #fafafa;
  transition: background 0.3s;
}
.benefit-row:hover {
  background: #fff3e0;
}
.benefit-row i {
  font-size: 1.5rem;
  color:rgb(244, 100, 10);
  width: 36px;
}
.benefit-row div {
  margin-left: 12px;
}
.benefit-row strong {
  display: block;
  font-size: 1rem;
  color: #333;
}
.benefit-row span {
  font-size: 0.85rem;
  color: #777;
}

@keyframes fadeOut {
  to { opacity: 0; transform: translateY(-10px); }
}
@keyframes popGold {
  0%   { transform: scale(1); color: inherit; }
  100% { transform: scale(1.4); color: #ffd700; }
}
.gold-title .word.fade {
  animation: fadeOut 0.4s forwards;
}
.gold-title .word.highlight.pop {
  animation: popGold 0.6s forwards;
}


/* Pay Button & Note */
#payButton {
  margin-top: auto;
  padding: 14px;
  font-size: 1rem;
  border-radius: 25px;
  background: linear-gradient(90deg,rgb(238, 130, 63), #ff5722);
  color: #fff;
  border: none;
  cursor: pointer;
  transition: all .3s ease;
}
#payButton:hover {
  transform:scale(1.05);
}
.gold-split-details small {
  text-align: center;
  margin-top: 8px;
  color: #999;
  font-size: 0.8rem;
}

    /* --- GOLD MODAL OVERRIDE --- */
.gold-modal {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.8);
  justify-content: center;
  align-items: center;
  padding: 20px;
  z-index: 2000;

}

.gold-content {
  background: #fff;
  border-radius: 16px;
  width: 100%;
  width: 1400px;
  height: 700px;
  overflow-y: auto;
  box-shadow: 0 24px 48px rgba(0,0,0,0.3);
  position: relative;
  display: flex;
  flex-direction: column;
  padding: 0;
}

/* Close Button */
.gold-content .close-button {
  position: absolute;
  top: 16px; right: 20px;
  font-size: 28px; color: #888;
  transition: color 0.2s;
}
.gold-content .close-button:hover {
  color: #000;
}

/* Header */
.gold-header {
  background: linear-gradient(135deg, #ff8c42, #ff5722);
  color: #fff;
  padding: 40px 30px;
  border-top-left-radius: 16px;
  border-top-right-radius: 16px;
  text-align: center;
}
.gold-header h2 {
  font-size: 2rem; margin-bottom: 8px;
}
.gold-header p {
  font-size: 1rem; opacity: 0.9;
}

/* Benefits Grid */
.benefits-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
  gap: 24px;
  padding: 30px;
}
.benefit-card {
  background: #fafafa;
  border-radius: 12px;
  padding: 20px;
  text-align: center;
  transition: transform 0.2s, box-shadow 0.2s;
}
.benefit-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 24px rgba(0,0,0,0.1);
}
.benefit-card i {
  font-size: 2rem;
  color: #ff5722;
  margin-bottom: 12px;
}
.benefit-card h3 {
  font-size: 1.1rem; margin-bottom: 6px;
}
.benefit-card p {
  font-size: 0.9rem; color: #666;
}

/* Footer */
.gold-footer {
  padding: 20px 30px 30px;
  text-align: center;
}
.gold-footer .promo-button {
  width: 100%;
  max-width: 260px;
  margin-bottom: 12px;
  font-size: 1rem;
}
.gold-footer small {
  display: block;
  color: #888;
  font-size: 0.85rem;
}


    /* --- Details Panel --- */
    .profile-details {
      flex: 2 1 600px;
      padding: 40px;
      display: flex; flex-wrap: wrap;
      gap: 30px 50px; align-content: flex-start;
      background: #fafafa;
    }
    .detail-item {
      display: flex; align-items: center; gap: 18px;
      width: calc(50% - 25px);
      background: #fff; border-radius: 16px;
      padding: 20px 25px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      transition: background 0.3s, transform 0.3s;
    }
    .detail-item:hover {
      background: #ff6600; color: #fff;
      transform: translateY(-4px);
    }
    .detail-item i {
      font-size: 1.5rem; color: #ff6600;
      width: 32px; text-align: center;
      transition: color 0.3s;
    }
    .detail-item:hover i { color: #fff; }
    .detail-text { display: flex; flex-direction: column; }
    .detail-label {
      font-weight: 600; font-size: 1rem;
      margin-bottom: 4px; color: inherit;
    }
    .detail-value {
      font-size: 0.95rem; color: inherit;
      word-break: break-word;
    }
    .detail-item a {
      color: inherit; text-decoration: none; font-weight: 500;
    }
    .detail-item a:hover { text-decoration: underline; }
    

    /* --- Membership Card --- */
    .membership-card {
      flex: 1 1 100%;
      border-radius: 16px;
      padding: 28px 30px;
      background: #fff;
      box-shadow: 0 6px 16px rgba(0,0,0,0.08);
      margin-bottom: 24px;
    }
    .membership-card.gold  { border-left: 6px solid #ffb800; }
    .membership-card.silver{ border-left: 6px solid #a9a9a9; }
    .membership-card h3 {
      font-size: 1.4rem; margin-bottom: 14px;
      font-weight: 700; color: #333;
    }
    .membership-badge {
      display: inline-block; padding: 7px 16px;
      font-weight: 600; font-size: 0.95rem;
      border-radius: 20px; margin-bottom: 18px;
      color: #fff;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
    }
    .membership-card.gold .membership-badge {
      background: linear-gradient(to right, #ffd700, #ffb800);position:relative;
    }
    .membership-card.silver .membership-badge {
      background: linear-gradient(to right, #c0c0c0, #a9a9a9);
    }
    .promo-text { font-size: 1rem; margin-bottom: 16px; color: #555; }
    .promo-button {
      display: inline-block; padding: 10px 24px; font-weight: 600;
      font-size: 0.95rem; border-radius: 24px;
      background: linear-gradient(to right, #ffb800, #ffd700);
      color: #333; text-decoration: none;
      box-shadow: 0 4px 12px rgba(255,184,0,0.3);
      transition: transform 0.2s;
      border : 2px solid yellow;
      cursor:pointer;
    }
    .promo-button:hover { transform: translateY(-2px); }
    .benefits-list { list-style: disc inside; color: #444; line-height: 1.5; }

    /* --- Modern Modal & Select --- */
    .modal {
      display: none;
      position: fixed; inset: 0;
      background: rgba(0,0,0,0.6);
      justify-content: center; align-items: center;
      z-index: 1000; font-family: 'Segoe UI', sans-serif;
    }
    /* LOCK OVERLAY */
    .lock-overlay {
  position: absolute;
  inset: 0;
  background: rgba(255, 255, 255, 0.6);
  backdrop-filter: blur(6px);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 2;
  pointer-events: all;
  animation: fadeInOverlay 0.4s ease-in-out;
}

.lock-content {
  text-align: center;
  animation: popIn 0.5s ease;
  position: relative;
}

.lock-content i {
  font-size: 3.9rem;
  color:rgb(243, 18, 18);
  animation: pulseLock 2s infinite;
}

.lock-content p {
  margin-top: 15px;
  font-size: 1.35rem;
  color: #555;
  font-weight: 600;
}

.close-lock {
  position: absolute;
  top: 12px;
  right: 12px;
  background: none;
  border: none;
  font-size: 2rem;
  color: #999;
  cursor: pointer;
  transition: color 0.3s ease;
  z-index: 3;
}
.close-lock:hover {
  color: #333;
}

/* Animations */
@keyframes pulseLock {
  0%, 100% {
    transform: scale(1);
    opacity: 1;
  }
  50% {
    transform: scale(1.15);
    opacity: 1;
    
  }
}

@keyframes popIn {
  0% {
    transform: scale(0.6);
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}

@keyframes fadeInOverlay {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

.modal-content {
  position: relative;             /* to scope .lock-overlay */
  /* ... your existing styles ... */
}

    .modal-content {
      background: #fff;
      border-radius: 16px;
      padding: 30px;
    
      max-width: 700px; width: 90%;
      box-shadow: 0 20px 40px rgba(0,0,0,0.2);
      position: relative;
      animation: fadeIn 0.3s ease-in-out;
    }
    @keyframes fadeIn {
      from { transform: translateY(-20px); opacity: 0; }
      to   { transform: translateY(0);     opacity: 1; }
    }
    .close-button {
      position: absolute; top: 16px; right: 20px;
      font-size: 24px; cursor: pointer; color: #555;
      transition: color 0.2s;
    }
    .close-button:hover { color: #000; }
    .modal-title {
      margin-top: 0; margin-bottom: 20px;
      font-size: 24px; color: #333;
    }

    .close-buttons {
      background-color:white;

      position: absolute; top: 7px; right: 20px;
      font-size: 24px; cursor: pointer; color: #555;
      transition: color 0.2s;
      border:none;
    }
    .close-buttons:hover { color: red; }
   
    .current-avatar-section {
      text-align: center; margin-bottom: 20px;
    }
    .current-avatar-section img {
      width: 120px; height: 120px;
      border-radius: 20%; margin-bottom: 8px;
      border: 3px solid rgb(0, 217, 255); object-fit: cover;
    }
    .hint {
      font-size: 14px; color: #888;
    }
    .select-label {
      font-weight: bold; margin-bottom: 6px;
      display: block; color: #444;
    }
    .select-wrapper {
      position: relative; margin-bottom: 20px;
    }
    .select-wrapper select {
      appearance: none; -webkit-appearance: none;
      background: #f8f9fa; color: #333;
      border: 1px solid #ccc; border-radius: 8px;
      padding: 10px 40px 10px 15px;
      font-size: 16px; width: 100%; cursor: pointer;
      transition: border-color 0.3s;
    }
    .select-wrapper::after {
      content: '▼'; position: absolute;
      right: 15px; top: 50%; transform: translateY(-50%);
      color: #666; pointer-events: none; font-size: 12px;
    }
    .select-wrapper select:focus {
      outline: none; border-color: #007bff;
    }
    .avatar-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(70px, 1fr));
      gap: 15px; padding-top: 10px;
    }
    .avatar-grid img {
      width: 70px; height: 70px; object-fit: cover;
      border-radius: 20%; cursor: pointer;
      border: 2px solid transparent;
      transition: transform 0.2s, border-color 0.3s;
    }
    .avatar-grid img:hover {
      transform: scale(1.2); border-color:rgb(0, 225, 255);
    }
   /* Container */
.category-buttons {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-bottom: 20px;
}

/* Base button */
.category-btn {
  position: relative;
  padding: 10px 18px;
  border: none;
  border-radius: 50px;
  background: #f0f0f0;
  font-size: 0.95rem;
  font-weight: 500;
  cursor: pointer;
  transition: 
    background 0.3s ease, 
    color 0.3s ease, 
    transform 0.2s ease,
    box-shadow 0.3s ease;
  box-shadow: 0 2px 5px rgba(0,0,0,0.08);
}

/* Hover effect */
.category-btn:hover {
  background: #ffffff;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  transform: translateY(-2px);
}

/* Active state */
.category-btn.active {
  background: linear-gradient(135deg, #ff8c42, #ff5722);
  color: #fff;
  box-shadow: 0 6px 16px rgba(255, 87, 34, 0.3);
}

/* Active “pill” underline animation */


/* Small icon spacing (if you choose to add icons) */
.category-btn i {
  margin-right: 6px;
  vertical-align: middle;
}
#promoCodeInput {
    outline: none; /* Removes the black outline */
  }
#promoCodeInput::placeholder {
    font-size: 15.7px;
     /* Adjust size as needed */
  }
  .red-placeholder::placeholder {
  color: red;
 
  font-weight:400;
}

.banner {
  
    display: inline-block;
    position:absolute;
    bottom:15px;
    left:630px;
    align-items: center;
    justify-content: center;
    padding: 4px 60px; 
    padding-bottom:8px;              /* even slimmer */
    font-family: 'Segoe UI', sans-serif;
    font-weight: 600;
    margin-bottom:10px;
    font-size: 18px;
    color: #fff;
    background: linear-gradient(90deg, #f0c000, #e68a00);
    border-radius: 30px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    transition:all 0.2s ease;
    cursor:grab;
   
  
  }
  
  .banner:hover {
   transform:scale(1.02);
  }
  .banner .label {
    margin-right: 6px;
    
    font-size:20px;
    cursor:grab;
  }

  .rocket {
    display: inline-block;
    font-size:25px;
    animation: bounce 1.5s ease-in-out infinite;
  }

  @keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50%      { transform: translateY(-4px); }
  }
  .banner .highlight {
    color: #fff200;
  }
  .banner .code {
    font-family: monospace;
    background: #fff;
    color: #e68a00;
    padding: 2px 7px;
    border-radius: 3px;
    margin-left: 4px;
    padding-right:0px;
    box-sizing:border-box;
    
  }


@keyframes glow{from{box-shadow:0 0 5px rgba(255,200,0,.6)}to{box-shadow:0 0 10px rgba(255,200,0,1)}}



    /* --- Responsive --- */
    @media (max-width: 800px) {
      .detail-item { width: 100%; }
    }
  </style>
</head>
<body>
<nav class="xfinity-navbar">
    <div class="nav-container">
      <a href="#" class="brand">Xfinity</a>
      <ul class="nav-links">
        <li><a href="<?php echo site_url('Advanced'); ?>">Home</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <button class="nav-toggle" aria-label="Toggle menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </nav>
  <div class="profile-container">

    <!-- Modern Orange Sidebar -->
    <div class="profile-sidebar">
    <img src="<?= html_escape($user['avatar'] ?: 'https://api.dicebear.com/6.x/initials/svg?seed=' . urlencode($user['name'])) ?>" alt="Avatar">

      <button class="update-avatar-btn" onclick="openAvatarModal()">
        <i class="fas fa-pencil-alt" style="margin-right:8px;"></i>Update Avatar
      </button>
      <h2><?= html_escape($user['name']) ?></h2>
      <p>@<?= html_escape($user['username']) ?></p>
      <p style="position:absolute; top:610px; ">© 2025 Xfinity.In All rights reserved.</p>
    </div>

    <!-- Details & Membership -->
    <div class="profile-details">

      <!-- Membership Card -->
      <div class="membership-card <?= strtolower($user['membership_type']) === 'gold membership' ? 'gold' : 'silver' ?>">

        <h3 style="margin-top:-10px;">Know Your Plan</h3>
   
        <span class="membership-badge" style="font-weight:bold;margin-top:-3px;margin-left:5px;">
          <?= html_escape(strtolower($user['membership_type']) === 'gold membership'
             ? '🥇 Gold Member'
             : '🥈 Silver Member') ?>
        </span>
           <?php if (strtolower($user['membership_type']) === 'gold membership'): ?>
        <lottie-player
            src="https://lottie.host/d199c7e1-8720-41af-93e8-f131817a215b/gLdNqhXISz.json"
            background="transparent"
            speed="1"
            style="position:absolute; top:169px;left:810px; width: 90px; height: 90px; transform:translateY(-28px);margin-bottom:-25px;margin-left:-10px;"
            loop
            autoplay>
        </lottie-player>
      <?php else: ?>
       <lottie-player
            src="https://lottie.host/10b43110-f5e8-4c3e-b3fe-159e9ed4b08f/mncWu8dM8x.json"
            background="transparent"
            speed="1"
            style="position:absolute; top:169px;left:815px; width: 90px; height: 90px; transform:translateY(-28px);margin-bottom:-25px;margin-left:-10px;"
            loop
            autoplay>
        </lottie-player>

          <?php endif; ?>

        <?php if (strtolower($user['membership_type']) === 'gold membership'): ?>
         
          
           <p style="margin-top:-8px;margin-bottom:3px;">  Enjoy these exclusive benefits:</p>
          <ul class="benefits-list">
            <li>Free Car Wash On every Service</li>
            <li>Exclusive access to new features</li>
            <li style="margin-bottom:10px;">Free Interior Wash On Every Service</li>
           
          </ul>
          <div id="gold-expiry" style="
     background: linear-gradient(90deg, #FFD700, #FFAA00);
     padding: .8rem;
     border-radius: 50px;
     text-align: center;
     color: #333;
     margin-bottom: -10px;
     animation: glow 1.5s ease-in-out infinite alternate;
     font-family: sans-serif;
   ">
  <strong style="font-size:19.5px;font-weight:700;"> Gold ends on <?= date('M j, Y',strtotime($expiry)) ?> </strong>
  <div id="cd" style="
       font-family: 'Courier New', monospace;
       font-size: 1.48rem;
       font-weight: 1000;
       padding: 0.6rem 1rem;
       border-radius: 30px;
       background: linear-gradient(45deg, rgba(215, 140, 140, 0.2), rgba(255,255,255,0.05));
       box-shadow:
         0 0 8px rgba(255,170,0,0.6),
         inset 0 0 8px rgba(255,255,255,0.5);
       color: white;
       display: inline-block;
       margin-top: 0.5rem;
       margin-left:7px;
       transition: transform 0.3s ease, box-shadow 0.3s ease;
       cursor:pointer;
     "
     onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 0 12px rgba(255,170,0,0.8), inset 0 0 12px rgba(255,255,255,0.7)';"
     onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 0 8px rgba(255,170,0,0.6), inset 0 0 8px rgba(255,255,255,0.5)';"
  >
    --d --h --m --s
  </div>
</div>

          
        <?php else: ?>
          <p class="promo-text">
            You’re on our <strong>Silver (Regular)</strong> plan.<br>
            Upgrade now to unlock the full Gold experience!
          </p>
          <button class="promo-button" onclick="openGoldModal()">Upgrade to Gold</button>

        <?php endif; ?>
      </div>
      <!-- Address Modal -->
<div id="addressModal" class="modal">
  <div class="modal-content">
    <button class="close-button" onclick="closeAddressModal()">&times;</button>
    <h3>Delivery Address</h3>

    <!-- Success confirmation -->
    <div id="addressSuccess" class="success-message">
      <i class="fas fa-check-circle" style="margin-right:6px;"></i>
      Address updated successfully!
    </div>

    <!-- View mode -->
    <div id="addressView">
      <p id="addressText"><?= html_escape($user['delivery_address']) ?></p>
      <div class="modal-footer">
        <button id="editAddressBtn" class="promo-button">Edit</button>
      </div>
    </div>

    <!-- Edit mode -->
    <form id="addressForm" action="<?= site_url('advanced/update_address') ?>" method="post" style="display:none;">
      <textarea name="delivery_address" rows="3"><?= html_escape($user['delivery_address']) ?></textarea>
      <div class="modal-footer">
        <button type="button" onclick="cancelEdit()" class="promo-button">Cancel</button>
        <button type="submit" class="promo-button">Save</button>
      </div>
    </form>
  </div>
</div>



      <!-- Contact Details -->
      <div class="detail-item">
        <i class="fas fa-envelope"></i>
        <div class="detail-text">
          <div class="detail-label">Email</div>
          <div class="detail-value" style="font-size:13.8px;"><?= html_escape($user['email']) ?></div>
        </div>
      </div>
      <div class="detail-item">
        <i class="fas fa-phone"></i>
        <div class="detail-text">
          <div class="detail-label">Contact</div>
          <div class="detail-value"><?= html_escape($user['contact_no']) ?></div>
        </div>
      </div>
      <div class="detail-item">
  <i class="fas fa-map-marker-alt"></i>
  <div class="detail-text">
    <div class="detail-label">Delivery Address</div>
    <div class="detail-value">
      <i id="showAddress" class="fas fa-eye" style="margin-top:8px; margin-left:50px;cursor:pointer;"></i>
    </div>
  </div>
</div>



      <div class="detail-item">
        <i class="fas fa-headset"></i>
        <div class="detail-text">
          <div class="detail-label">Need Help?</div>
          <div class="detail-value"><a href="/contact-us">Contact Us</a></div>
        </div>
      </div>
      <?php if (strtolower($user['membership_type']) !== 'gold membership'): ?>
        <div class="banner" style="margin-left:-13px;">
  <span class="label">
    <span class="rocket">🚀</span> Upgrade to <span class="highlight">GOLD</span> &amp; save 
    <span class="highlight">₹500</span> – use code
    <span class="code" style="margin-right:5px;">
      GOLD500
     
    </span>
    <span onclick="copyToClipboard('GOLD500')" style="cursor: pointer; margin-left: 5px;" title="Copy Code"><i class="fa-solid fa-copy"></i></span>
  </span>
</div>

      <?php endif; ?>

    </div>
  </div>

 <!-- Gold Upgrade Modal -->
<div id="goldModal" class="modal gold-split-modal">
  <div class="gold-split-content">
  <canvas id="modal-confetti-canvas"
        style="
          position: absolute;
          top: 0; left: 0;
          width: 100%; height: 100%;
          pointer-events: none;
          z-index: 1;
        ">
</canvas>


    <!-- LEFT: Hero Image or Illustration -->
    <div class="gold-split-image">
      <!-- You can swap this for any VIP/car-service illustration -->
      <img
        src="<?= base_url('assets/images/gold.png') ?>"
        alt="Xfinity Gold Membership"
      />
    </div>

    <!-- RIGHT: Benefits List + CTA -->
    <div class="gold-split-details">
      <button class="close-buttons" style="margin-top:0px;" onclick="closeGoldModal()">&times;</button>
     <h2 class="gold-title">
  <span class="word">Become</span>
  <span class="word">our</span>
  <span class="word highlight pop" style="font-size:25px;">GOLD</span>
  <span class="word">member ! </span>
</h2>

      <p>Unlock premium advantages designed to make your car service seamless.</p>

      <div class="benefit-row">
        <i class="fas fa-car"></i>
        <div>
          <strong>Exterior Wash</strong>
          <span>Complimentary every visit</span>
        </div>
      </div>
      <div class="benefit-row">
        <i class="fas fa-couch"></i>
        <div>
          <strong>Interior Detail</strong>
          <span>Deep clean & fresh scent</span>
        </div>
      </div>
      <div class="benefit-row">
        <i class="fas fa-headset"></i>
        <div>
          <strong>24/7 VIP Support</strong>
          <span>Dedicated hotline</span>
        </div>
      </div>
      <div class="benefit-row">
        <i class="fas fa-bolt"></i>
        <div>
          <strong>Express Queue</strong>
          <span>Your service jumps ahead</span>
        </div>
      </div>
      <div class="benefit-row">
        <i class="fas fa-user-ninja"></i>
        <div>
          <strong>Exclusive Avatars</strong>
          <span>Access to fun Avatrars</span>
        </div>
      </div>
    


     <!-- Promo toggle link -->
     <div id="promoInputContainer" style="display: none; margin-top: 5px; margin-left:5px;text-align: center;">
  <input
    type="text"
    id="promoCodeInput"
    placeholder="Enter Your promocode"
    style="padding: 12px 14px; border-radius: 8px; border: 2px solid orange; font-weight:400;font-size:17px;width: 72%;"
  >
  <button
    id="applyPromoBtn"
    style="padding: 12px 21px; font-size:16.2px;margin-left: 7px; background:#ff5722; color:white; border:none; border-radius:23px; cursor:pointer;"
  >
    Apply
  </button>
</div>

<!-- Pay‑Now button always here -->
 
<button id="payButton" class="promo-button" style="margin-top: -1px;">
  ₹4,999 / year → Pay Now
</button>



<!-- “Already got promocode?” toggle below the pay button -->
<div id="promoToggleContainer" style="margin-top: 12px; text-align: center;">
  <a href="#" id="togglePromo" style="color:#ff5722; font-weight:bold; text-decoration:none; cursor:pointer;">
  Have a promo code?
  </a>
  </div>
      </div>
    </div>
  </div>

<div id="avatarModal" class="modal">
    <div class="modal-content">
        <!-- LOCK OVERLAY: only visible when !isGold -->
 <!-- LOCK OVERLAY: only visible when !isGold -->
<!-- LOCK OVERLAY: only visible when !isGold -->
<div id="avatarLockOverlay" class="lock-overlay">
  <button class="close-lock" onclick="closeAvatarModal()".style.display='none'>
    &times;
  </button>
  <div class="lock-content">
    <i class="fas fa-lock"></i>
    <p>Go for GOLD and level up your avatar world!</p>
  </div>
</div>


      <span class="close-button" onclick="closeAvatarModal()">&times;</span>
      <h2 class="modal-title">Update Your Avatar</h2>
      <div class="current-avatar-section">
        <img id="currentAvatar" src="" alt="Current Avatar">
        <p class="hint">Click an avatar below to set it</p>
      </div>
      <label class="select-label"  style="margin-left:245px;">Choose Avatar Style</label>
<div id="avatarCategories" class="category-buttons" style="margin-left:15px;margin-top:15px;">
  <button type="button" class="category-btn active" data-cat="adventurer">
  <i class="fas fa-hiking" style="margin-bottom:2px;"> </i>Adventurer
  </button>
  <button type="button" class="category-btn" data-cat="avataaars">
  <i class="fa-solid fa-user-ninja" style="margin-bottom:2px;"></i>Avataaars</button>
  <button type="button" class="category-btn" data-cat="bottts">
  <i class="fas fa-robot" style="margin-bottom:2.8px;"></i>Bottts
  </button>
  <button type="button" class="category-btn" data-cat="lorelei">
  <i class="fa-solid fa-pencil" style="margin-bottom:1px;"></i>Lorelei</button>
  <button type="button" class="category-btn" data-cat="pixel-art">
  <i class="fa-solid fa-palette" style="margin-bottom:1px;"></i></i>Pixel Art</button>
  
  
</div>

      <div id="avatarGrid" class="avatar-grid"></div>
    </div>
  </div>
  <div id="paymentOverlay">
    <div class="processing-container">
       <lottie-player src="https://lottie.host/507a1221-4e48-4e87-b305-bd5e10361bd1/FokzMiOxqc.json"background="transparent" speed="1.8" loop autoplay style=" display:inline-block;width: 300px; height:300px;"></lottie-player>
      <div class="processing-text animate__animated animate__headShake animate__infinite animate__slow">
  Connecting To Razorpay.....
  
</div>
      </div>
      </div>

        <div id="goldOverlay">
    <div class="processing-container">
       <lottie-player src="https://lottie.host/6d35bf79-dd97-4e1f-a266-dc1a263dbfcd/4BElhbmA5r.json"background="transparent" speed="1" loop autoplay style=" display:inline-block;width: 200px; height:200px;"></lottie-player>
      <div class="processing-text animate__animated animate__headShake animate__infinite animate__slow">
 
  
</div>
      </div>
      </div>

<script>
  function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
      
    }, function(err) {
      console.error('Could not copy text: ', err);
    });
  }
</script>




<script>
  const payBtn            = document.getElementById("payButton");
  const togglePromoLink   = document.getElementById("togglePromo");
  const promoInputContainer = document.getElementById("promoInputContainer");
  const promoCodeInput    = document.getElementById("promoCodeInput");
  const applyPromoBtn     = document.getElementById("applyPromoBtn");
  let promoApplied        = false;
  let disco                 = 9999; 

  // Toggle between promo‑entry and pay button
  togglePromoLink.addEventListener("click", function(e) {
    e.preventDefault();
    const showingInput = promoInputContainer.style.display === "block";

    if (!showingInput) {
      // show promo input, hide pay
      promoInputContainer.style.display = "block";
      payBtn.style.display = "none";
      togglePromoLink.style.marginLeft = "-85px";
      togglePromoLink.style.marginTop = "-100px";
      togglePromoLink.style.color = "#ff5722";
      togglePromoLink.textContent = "Skip promo code and pay ?";


    } else {
      // hide promo input, show pay
      promoInputContainer.style.display = "none";
      payBtn.style.display = "inline-block";
      togglePromoLink.style.marginLeft = "0px";
      togglePromoLink.textContent = "Have a promo code?";
      // reset any error styling
      promoCodeInput.classList.remove("red-placeholder");
      promoCodeInput.style.border = "none"; 
      promoCodeInput.style.border = "2px solid orange";
      promoCodeInput.placeholder = "Enter Your Promocode";
    }
  });

  // Handle Apply click
  applyPromoBtn.addEventListener("click", function() {
  const code = promoCodeInput.value.trim().toUpperCase();


  if (code === "") {
    promoCodeInput.style.border = "none"; // Remove existing border
    promoCodeInput.placeholder = "Please enter a promocode";
    promoCodeInput.style.border = "2px solid orange";
    return;
  }

  promoCodeInput.style.border = "";

  $.ajax({
    url: '<?= site_url("payment/promocode") ?>',
    type: 'POST',
    dataType: 'json',
    data: { code: code },
    success: function(response) {
      if (response.status === "success") {
        const discount = response.discount || 2000; // adjust as per actual value
        const originalPrice = 4999;
        disco = originalPrice - discount;


        payBtn.innerHTML =
          `₹<span style="text-decoration:line-through;font-size:17.5px; color: #ccc;">${originalPrice}</span> ` +
          `<span style="color:white; font-weight:bold;font-size:17.5px;">${disco}</span> <span font-size:17.5px;> / year → Pay Now</span>`;

        promoApplied = true;
        promoInputContainer.style.display = "none";
        payBtn.style.display = "inline-block";
        togglePromoLink.style.color = "green";
        togglePromoLink.style.marginLeft = "7px";
        togglePromoLink.style.pointerEvents = 'none'; 
        togglePromoLink.textContent = "Promocode Applied Successfully!🎉";
        runConfetti();
        function runConfetti() {
    const canvas = document.getElementById('modal-confetti-canvas');
    if (!canvas) return;
    const myConfetti = confetti.create(canvas, { resize: true });
    myConfetti({ particleCount: 200, spread: 100 });
  }
      } else {
        promoCodeInput.value = "";
        promoCodeInput.placeholder = response.message || "Invalid Promocode!Try Again";
        promoCodeInput.style.border = "none"; 
        promoCodeInput.style.border = "none";
        promoCodeInput.classList.add("red-placeholder");
        promoCodeInput.style.border = "2px solid orange";
      }
    },
    error: function(xhr, status, error) {
      console.error("AJAX Error:", error);
      promoCodeInput.placeholder = "Server error. Try again";
      promoCodeInput.style.border = "1px solid red";
    }
  });
});


</script>


<script>
    let end=new Date("<?= $expiry ?>T23:59:59"),d=document.getElementById("cd");
    (function u(){let t=end-Date.now(),D=Math.max(0,Math.floor(t/864e5)),h=Math.floor(t%864e5/36e5),
      m=Math.floor(t%36e5/6e4),s=Math.floor(t%6e4/1e3);
      d.textContent=`${D}d ${h}h ${m}m ${s}s`; t>0&&setTimeout(u,1e3);
    })();
  </script>
<script>
  // will be true only for Gold members
  const isGold = <?= json_encode(strtolower($user['membership_type']) === 'gold membership') ?>;
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const addressModal   = document.getElementById('addressModal');
  const addressView    = document.getElementById('addressView');
  const addressForm    = document.getElementById('addressForm');
  const addressText    = document.getElementById('addressText');
  const successBanner  = document.getElementById('addressSuccess');
  const btnShowAddress = document.getElementById('showAddress');
  const btnEdit        = document.getElementById('editAddressBtn');
  const btnClose       = addressModal.querySelector('.close-button');

  // Open modal in view mode
  btnShowAddress.addEventListener('click', () => {
    addressView.style.display   = 'block';
    addressForm.style.display   = 'none';
    successBanner.style.display = 'none';
    addressModal.style.display  = 'flex';
  });

  // Close modal
  btnClose.addEventListener('click', () => {
    addressModal.style.display = 'none';
  });

  // Switch to edit
  btnEdit.addEventListener('click', () => {
    addressView.style.display = 'none';
    addressForm.style.display = 'block';
  });

  // Cancel edit
  addressForm.querySelector('button[type="button"]').addEventListener('click', () => {
    addressForm.style.display = 'none';
    addressView.style.display = 'block';
  });

  // AJAX form submission
  addressForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch(this.action, {
      method: 'POST',
      credentials: 'same-origin',
      body: formData
    })
    .then(res => {
      if (!res.ok) throw new Error('Network error');
      return res.text(); // or JSON if you change controller to return JSON
    })
    .then(() => {
      // Update the view text
      const newAddr = formData.get('delivery_address').trim();
      addressText.textContent = newAddr || '(empty)';
      // Show success, hide form
      successBanner.style.display = 'block';
      addressForm.style.display   = 'none';
      addressView.style.display   = 'block';
    })
    .catch(err => {
      alert('⚠️ Could not save address. Please try again.');
      console.error(err);
    });
  });

  // Click outside to close
  addressModal.addEventListener('click', e => {
    if (e.target === addressModal) addressModal.style.display = 'none';
  });
});
</script>






  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<!-- canvas-confetti -->
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
<script>

  
function startModalConfetti() {
  requestAnimationFrame(() => {
    requestAnimationFrame(() => {
      const box = document.querySelector('.gold-split-content');
      const rect = box.getBoundingClientRect();
      const leftOrigin = {
        x: 0,                          // left edge of *canvas* is x=0
        y: 0.5                         // halfway down the canvas
      };
      const rightOrigin = {
        x: 1,                          // right edge of canvas
        y: 0.5
      };

      setInterval(() => {
        modalConfetti({
          origin: leftOrigin,
          angle: 60,
          spread: 80,
          startVelocity: 45,
          particleCount: 25
        });
        modalConfetti({
          origin: rightOrigin,
          angle: 120,
          spread: 80,
          startVelocity: 45,
          particleCount: 25
        });
      }, 400);
    });
  });
}

  </script>
<script>
  // 1) Grab and size the canvas
const modalCanvas = document.getElementById('modal-confetti-canvas');
// Resize the drawing buffer to match the element’s real size
modalCanvas.width  = modalCanvas.clientWidth;
modalCanvas.height = modalCanvas.clientHeight;

// 2) Create a confetti function that only draws there
const modalConfetti = confetti.create(modalCanvas, {
  resize: true,  // will auto-resize when modal resizes
  useWorker: false
});

  $('#payButton').click(function () {
    $('#paymentOverlay').css('display', 'flex').hide().fadeIn();

   
    let amount = promoApplied ? disco : 4999;


    $.ajax({
      url: '<?= site_url("Payment/subscription") ?>',

      type: 'POST',
      dataType: 'json',
      data: {
    amount: amount
  },
      success: function (res) {
        if (res.status === 'success') {
          var options = {
            key: res.key_id,
            amount: res.amount,
            currency: "INR",
            name: "XFINITY Gold Subscription",
            description: "Premium Plan",
            order_id: res.order_id,
            handler: function (response) {
  $.ajax({
    url: '<?= site_url("Payment/verify") ?>',
    type: 'POST',
    dataType: 'json',
    data: {
      razorpay_order_id:   response.razorpay_order_id,
      razorpay_payment_id: response.razorpay_payment_id,
      razorpay_signature:  response.razorpay_signature
    },
    success: function (res) {
  if (res.status === 'success') {
         
  const lottiePlayer = document.querySelector('#paymentOverlay lottie-player');

    // Remove the old player
    const newPlayer = document.createElement('lottie-player');
    newPlayer.setAttribute('src', 'https://lottie.host/fb191421-3f43-445f-b191-0bbe4bb2e4bc/iQLGxtSM88.json');
    newPlayer.setAttribute('background', 'transparent');
    newPlayer.setAttribute('speed', '1');
    newPlayer.setAttribute('loop', '');
    newPlayer.setAttribute('autoplay', '');
    newPlayer.setAttribute('style', 'display:inline-block;width: 350px; height:350px;');

    // Replace the old one
    lottiePlayer.parentNode.replaceChild(newPlayer, lottiePlayer);

    // Update the processing text
    const textElement = document.querySelector('#paymentOverlay .processing-text');
    textElement.textContent = "Authenticating Transaction...";
    textElement.style.marginTop = '-30px'; // ✅ This line sets the margin

    // Show the overlay
    $('#paymentOverlay').css('display', 'flex').show();
setTimeout(function() {
    $('#paymentOverlay').fadeOut('fast');
    openGoldModal();
    startModalConfetti(); 
  

// Instantly shows it as flex container
    // 1) Make sure the gold modal is open (in case it was closed)
    // 1) Make sure the modal is visible





 
const title = document.querySelector('.gold-title');
    title.innerHTML = 'Welcome to <span class="word highlight pop" style="font-size:26px">GOLD</span> franchise!';   
    
    var $btn = $('#payButton');
          $btn
           .html('<i class="fa-solid fa-circle-check" style="padding-right:2px;font-size:17px;"></i> Payment Completed')
            .removeClass('incomplete')
            .prop('disabled', true)   
           

            togglePromoLink.textContent = "Your subscription is now active"; 
            togglePromoLink.style.color = "green";                  
togglePromoLink.style.pointerEvents = 'none';    // make it non-clickable
togglePromoLink.style.opacity = '1';    
}, 8000);         // optionally hide it completely

// 2) Animate “Become Our Gold Member” and disable the button
// 2) Animate “Become Our Gold Member” and disable the button
// Inside your AJAX success → res.status === 'success' block, replace the existing
// “setTimeout(() => { … title.innerHTML = … })” with this:

// 2) Animate out the old word(s)





// 3) Wait for two animation frames so the modal is actually laid out
requestAnimationFrame(() => {
  requestAnimationFrame(() => {
    // 4) Now measure the modal’s box
    const box = document.querySelector('.gold-split-content');
    const rect = box.getBoundingClientRect();
    const leftOrigin = {
      x: rect.left / window.innerWidth,
      y: (rect.top + rect.height / 2) / window.innerHeight
    };
    const rightOrigin = {
      x: rect.right / window.innerWidth,
      y: leftOrigin.y
    };

    // 5) Fire confetti infinitely from those two points
   
  });
});


  } else {
    alert('⚠️ Verification failed: ' + res.message);
  }
},

    error: function () {
      alert('⚠️ Server error during verification.');
    }
  });
},



prefill: {
    name: "User Name",
    email: "user@example.com"
  },
  theme: {
    color: "#ff5722"
  },
  modal: {
    // This is called when the user clicks the “×” or presses Esc
    ondismiss: function () {
      // re-verify membership
      $.ajax({
        url: '<?= site_url("payment/verify_sub") ?>',
        type: 'POST',
        dataType: 'json'
      }).done(function(subRes) {
        if (subRes.membership_type !== 'Gold Membership') {
          $('#paymentOverlay .processing-text').text("Authenticating Transaction...");
          $('#paymentOverlay').css('display', 'flex').show();
          setTimeout(function() {
    $('#paymentOverlay').fadeOut('fast');
   
   
  
          // show warning on the Gold modal’s button
          var $btn = $('#payButton');
          $btn
           .html('<i class="fa-solid fa-triangle-exclamation" style="padding-right:2px;font-size:17px;"></i> Payment Incomplete.Retry !')
            .addClass('incomplete')
            .prop('disabled', false)  // still allow retry
            
          }, 4000);
        }
        
      });
    }
  }
};

          var rzp = new Razorpay(options);
          setTimeout(function () {
          rzp.open();
          $('#paymentOverlay').fadeOut('fast');
      }, 4000);
        } else {
          alert("Payment initiation failed. Please try again.");
        }
      },
      error: function () {
        alert("Something went wrong. Please try again.");
      }
    });
  });
</script>



  <script>
    const modal = document.getElementById('avatarModal');
    const currentAvatar = document.getElementById('currentAvatar');
    const avatarGrid = document.getElementById('avatarGrid');
   

    // Open the Gold-Upgrade Modal
function openGoldModal() {
  $('#goldOverlay').css('display', 'flex').hide().fadeIn();
  setTimeout(() => {
     $('#goldOverlay').fadeOut('fast');
  document.getElementById('goldModal').style.display = 'flex';
   }, 2500);
}

// Close the Gold-Upgrade Modal
function closeGoldModal() {
  document.getElementById('goldModal').style.display = 'none';
  // give the fade‐out a moment (optional) — you can remove setTimeout if you want instant
  setTimeout(() => {
    window.location.reload();
  }, 100);
}


function openAvatarModal() {
  const modal = document.getElementById('avatarModal');
  const overlay = document.getElementById('avatarLockOverlay');

  // always set the current avatar image
  const current = document.querySelector('.profile-sidebar img').src;
  document.getElementById('currentAvatar').src = current;

  // load the grid (but we'll disable clicks below if needed)
  avatarGrid.innerHTML = '';
  loadAvatars('adventurer');
  modal.style.display = 'flex';

  if (!isGold) {
    // show lock, disable all clicks on the grid
    overlay.style.display = 'flex';
    avatarGrid.style.pointerEvents = 'none';
    // optionally disable the close button too:
    modal.querySelector('.close-button').style.pointerEvents = 'none';
  } else {
    // hide lock, re-enable clicks
    overlay.style.display = 'none';
    avatarGrid.style.pointerEvents = '';
    modal.querySelector('.close-button').style.pointerEvents = '';
  }
}


    function closeAvatarModal() {
      modal.style.display = 'none';
      avatarGrid.innerHTML = '';
    }

    function loadAvatars(category) {
      
      avatarGrid.innerHTML = '';
      if (!category) return;
      for (let i = 0; i < 28; i++) {
        const seed = `user${Math.floor(Math.random() * 10000)}`;
        const url = `https://api.dicebear.com/7.x/${category}/svg?seed=${seed}`;
        const img = document.createElement('img');
        img.src = url;
        img.onclick = () => {
          currentAvatar.src = url;
          document.querySelector('.profile-sidebar img').src = url;
          fetch('<?= site_url("home/update_avatar") ?>', {
    method: 'POST',
    credentials: 'same-origin',
    headers: { 'Content-Type':'application/json' },
    body: JSON.stringify({ avatar_url: url })
  });
  
        };
        avatarGrid.appendChild(img);
      }
      
    }
    // cache container
const categoryContainer = document.getElementById('avatarCategories');

categoryContainer.addEventListener('click', function(e) {
  // only respond to clicks on .category-btn
  if (!e.target.classList.contains('category-btn')) return;

  // remove .active from all buttons
  Array.from(categoryContainer.children)
       .forEach(btn => btn.classList.remove('active'));

  // mark the clicked one active
  e.target.classList.add('active');

  // load that category
  const cat = e.target.getAttribute('data-cat');
  loadAvatars(cat);
});

  </script>
<script>
  // Toggle mobile menu
  const toggle = document.querySelector('.nav-toggle');
  const links = document.querySelector('.nav-links');
  toggle.addEventListener('click', () => {
    links.classList.toggle('open');
  });
</script>
<script>
  // Only for Gold members: clicking the badge opens the modal
  document.addEventListener('DOMContentLoaded', () => {
    const goldBadge = document.querySelector('.membership-card.gold .membership-badge');
    if (!goldBadge) return; // no gold badge on silver accounts

    goldBadge.style.cursor = 'pointer';
    goldBadge.addEventListener('click', () => {
      // 1) Open the existing Gold modal
      openGoldModal();
      startModalConfetti();

       

      // 2) Change heading
      const titleEl = document.querySelector('.gold-split-details .gold-title');
      if (titleEl) {
        titleEl.innerHTML = 'Explore your <span style="color:#FFD700;">GOLD</span> benefits!';
      }

      // 3) Disable the Pay button & change its label
      const payBtn = document.getElementById('payButton');
      if (payBtn) {
        payBtn.innerHTML = '<i class="fas fa-check-circle" style="font-size:17px;padding-right:3px;"></i> Already Subscribed!';

        payBtn.disabled   = true;
        payBtn.style.cursor = 'not-allowed';
        // Optional: dim it slightly
        payBtn.style.opacity = '1';
      }
    });
  });
</script>



</body>
</html>