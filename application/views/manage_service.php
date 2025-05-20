<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <meta charset="UTF-8">
  <title>Manage Service — Pickups in <?= htmlspecialchars($this->session->userdata('vcity')) ?></title>
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

   
    @keyframes spin{
      0%{ transform:rotate(0deg); }
      100%{ transform:rotate(360deg); }
    }

    .spinner{
      display:inline-block;
      margin-top:015px;
      animation:spin 1s linear infinite;
    }

    .container {
      padding: 2rem;
      max-width: 1100px;
      margin: auto;
      margin-left:70px;
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
    }

    td {
      background: #fff;
      padding: 0.75rem;
      border: 1px solid #eee;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    tr {
      transition: all 0.3s ease;
    }

    tr:hover {
      transform: scale(1.01);
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

    select {
      padding: 0.45rem;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 0.9rem;
      margin-right: 0.5rem;
    }

    .completed-status {
      font-weight: bold;
      color: var(--success);
    }
      .btn {

      margin-top:3px;
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 8px 16px;
      font-size: 16.5px;
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
    <h1>Xfinity Garage (Service)</h1>
      <span style="color: white;font-size:23px;font-weight:bold;">
      <i class="fa-solid fa-location-dot"></i>  <?= $this->session->userdata('vcity'); ?>
    </span> 
     <a href="<?= site_url('mechanic/mdashboard'); ?>" class="btn" style="background-color: white; color: red;">
      🏠 Home
    </a>
  </div>

<div class="container">
  <?php if (!empty($pickups)): ?>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Pickup Id</th>
          <th>Service Type</th>
          <th>Customer</th>
          <th>Concern</th>
          <th>Reg no</th>
          <th>Brand / Model</th>
          <th>Promised Deadline</th>
          <th>Current Status</th>
          <th>Status</th>
          <th>Invoice Amount</th>
          <th>Invoice Status</th> <!-- New column -->
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pickups as $i => $p): ?>
          <?php $current_status = trim(strtolower($p['status'])); ?>
          <tr>
            <td data-label="#"><?= $i + 1 ?></td>
            <td data-label="Pickup Id"><?= htmlspecialchars($p['pickup_id']) ?></td>
            <td data-label="Pickup Id"><?= htmlspecialchars($p['service_type']) ?></td>
            <td data-label="Customer"><?= htmlspecialchars($p['name']) ?></td>
            <td data-label="Concern"><?= htmlspecialchars($p['issue']) ?></td>
            <td data-label="Reg no"><?= htmlspecialchars($p['registration_no']) ?></td>
            <td data-label="Brand / Model"><?= htmlspecialchars($p['brand']) . ' / ' . htmlspecialchars($p['model']) ?></td>
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

            <td data-label="Current Status"><?= htmlspecialchars($p['status']) ?></td>
            <td data-label="Status">
              <?php if ($p['ser_locked'] == 1): ?>
                <span class="completed-status" style="padding-left:50px;font-weight:bold; font-size:17px;">Service Completed</span>
              <?php else: ?>
                <form method="post" action="<?= site_url('Mechacontrol/update_status') ?>" style="display: inline;">
                  <input type="hidden" name="pickup_id" value="<?= htmlspecialchars($p['pickup_id']) ?>">
                  <div style="display:flex; align-items:center; gap:8px;">
  <select name="status">
    <option value="In service" <?= $current_status === 'in service' ? 'selected' : '' ?>>In Service</option>
    <option value="Service Completed" <?= $current_status === 'service completed' ? 'selected' : '' ?>style=>Service Completed</option>
  </select>
  <button type="submit" class="action-button">Update</button>
</div>

                </form>
              <?php endif; ?>
            </td>
            <td data-label="Invoice Amount">
    <?= $p['total_amount'] === 'force pickup' 
        ? 'Invoice Not Yet Generated' 
        : '₹' . htmlspecialchars($p['total_amount']) ?>
</td>



            <td data-label="Invoice Status">
            <?php if ($p['total_amount'] === 'force pickup'): ?>
    <form method="post" action="<?= site_url('/mechacontrol/geninvoice') ?>" style="display:inline;">
        <input type="hidden" name="pickup_id" value="<?= htmlspecialchars($p['pickup_id']) ?>">
        <button type="submit" class="action-button" style="background-color:red;">Generate Invoice</button>
    </form>
              <?php else: ?>
                <span style="color:green; font-weight:bold;"> Generated!</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
    <div class="no-data">No scheduled pickups in your city.</div>
  <?php endif; ?>
</div>

</body>
</html>
