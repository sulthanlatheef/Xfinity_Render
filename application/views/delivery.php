<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <meta charset="UTF-8">
  <title>Xfinity — Pickups in <?= htmlspecialchars($this->session->userdata('vcity')) ?></title>
  <style>
    :root {
      --primary: #ff6f00;
      --primary-light: #ffcc80;
      --background: #fffaf5;
      --text-color: #333;
      --success: #4CAF50;
      --border-radius: 12px;
    }

    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: var(--background);
      color: var(--text-color);
      margin: 0;
      padding: 0;
    }

     .navbar {
      background: var(--primary);
      display:flex;
      flex-direction:row;
      align-items:center;
      justify-content:space-between;
      padding: 1.1rem 2rem;
      color: white;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar h1 {
      margin: 0;
      font-size: 1.6rem;
      letter-spacing: 0.5px;
    }


    .container {
      padding: 2rem;
      max-width: 1200px;
      margin: auto;
    }

    h2 {
      margin-top: 0;
      color: #bf360c;
      font-size: 1.4rem;
    }

    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 10px;
      margin-top: 1rem;
    }

    th {
      background-color: var(--primary-light);
      padding: 0.75rem;
      text-align: left;
      border-radius: var(--border-radius) var(--border-radius) 0 0;
      font-weight: 600;
    }

    td {
      background: #fff;
      padding: 0.75rem;
      border: 1px solid #eee;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
      font-size: 0.92rem;
    }

    tr {
      transition: all 0.3s ease;
    }

    tr:hover {
      
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .no-data {
      background-color: #ffe0b2;
      padding: 1rem;
      border-radius: var(--border-radius);
      text-align: center;
      color: #bf360c;
      font-weight: 600;
      margin-top: 2rem;
    }
     .btn {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 8px 16px;
      font-size: 1rem;
      font-weight: 600;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      text-decoration: none;
      transition: transform 0.1s ease, box-shadow 0.2s ease;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    
    
  .btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .action-button {
      background-color: var(--success);
      border: none;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 30px;
      font-size: 0.9rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .action-button:hover {
      background-color: #388e3c;
    }

    .status-complete {
      color: var(--success);
      font-weight: bold;
      font-size: 1rem;
    }

    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }

      thead tr {
        display: none;
      }

      td {
        position: relative;
        padding-left: 50%;
        margin-bottom: 1rem;
      }

      td::before {
        content: attr(data-label);
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        font-weight: bold;
        color: #999;
      }
    }
  </style>
</head>
<body>

   <div class="navbar">
    <h1>Xfinity Garage (Pickups)</h1>
     <span style="color: white;font-size:23px;font-weight:bold;">
      <i class="fa-solid fa-location-dot"></i>  <?= $this->session->userdata('vcity'); ?>
    </span> 
     <a href="<?= site_url('mechanic/mdashboard'); ?>" class="btn" style="background-color: white; color: red;">
      🏠 Home
    </a>
  </div>

  <div class="container">
    <h2>Pickups in “<?= htmlspecialchars($this->session->userdata('vcity')) ?>”</h2>

    <?php if (!empty($pickups)): ?>
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>User Id</th>
            <th>Pickup Id</th>
            <th>Service Type/th>
            <th>Customer Name</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Delivery Address</th>
          
            <th>Issue</th>
            <th>Pickup Date</th>
            <th>Promised Deadline</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pickups as $i => $p): ?>
            <tr>
              <td data-label="#"><?= $i + 1 ?></td>
              <td data-label="User Id"><?= htmlspecialchars($p['user_id']) ?></td>
              <td data-label="Pickup Id"><?= htmlspecialchars($p['pickup_id']) ?></td>
              <td data-label="Pickup Id"><?= htmlspecialchars($p['service_type']) ?></td>
              <td data-label="Customer Name"><?= htmlspecialchars($p['name']) ?></td>
              <td data-label="Brand"><?= htmlspecialchars($p['brand']) ?></td>
              <td data-label="Model"><?= htmlspecialchars($p['model']) ?></td>
              <td data-label="Delivery Address"><?= htmlspecialchars($p['delivery_address']) ?></td>
              <td data-label="Issue"><?= htmlspecialchars($p['issue']) ?></td>
              <td data-label="Pickup Date"><?= htmlspecialchars($p['pickup_date']) ?></td>
               <td data-label="When">
    <?php
        $pickupDate = new DateTime($p['pickup_date']);
        if ($p['service_type'] === 'Regular') {
            $pickupDate->modify('+7 days');
        } else {
            $pickupDate->modify('+1 day');
        }
        echo htmlspecialchars($pickupDate->format('Y-m-d')) . '<br>' . htmlspecialchars($p['pickup_time']);
    ?>
</td>
              <td data-label="Status"><?= htmlspecialchars($p['status']) ?></td>
              <td data-label="Action">
              <?php if ((strtolower($p['status']) !== 'delivered') ): ?>
  <form action="<?= site_url('Mechacontrol/complete_delivery/'.$p['pickup_id']) ?>" method="post" style="margin:0;">
    <button type="submit" class="action-button">Mark As Delivered </button>
  </form>

<?php else: ?>
  <span class="status-complete">✅ Delivery Completed</span>
<?php endif; ?>

              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <div class="no-data">
        No scheduled pickups in your city.
      </div>
    <?php endif; ?>
  </div>

</body>
</html>
