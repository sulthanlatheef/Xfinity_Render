<!DOCTYPE html>
<html lang="en">
<head>
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
      padding: 1.2rem 2rem;
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
    <h1>Xfinity Garage</h1>
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
            <th>Pickup Address</th>
            <th>Issue</th>
            <th>Pickup Date</th>
            <th>Pickup Time</th>
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
              <td data-label="Pickup Address"><?= htmlspecialchars($p['pickup_address']) ?></td>
              <td data-label="Issue"><?= htmlspecialchars($p['issue']) ?></td>
              <td data-label="Pickup Date"><?= htmlspecialchars($p['pickup_date']) ?></td>
              <td data-label="Pickup Time"><?= htmlspecialchars($p['pickup_time']) ?></td>
              <td data-label="Status"><?= htmlspecialchars($p['status']) ?></td>
              <td data-label="Action">
              <?php if ((strtolower($p['status']) !== 'Pickup Completed') && !$p['status_locked']): ?>
  <form action="<?= site_url('Mechacontrol/complete_pickup/'.$p['pickup_id']) ?>" method="post" style="margin:0;">
    <button type="submit" class="action-button">Mark Completed</button>
  </form>
<?php elseif ($p['status_locked']): ?>
  <span class="status-complete">✅ Completed (Locked)</span>
<?php else: ?>
  <span class="status-complete">✅ Completed</span>
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
