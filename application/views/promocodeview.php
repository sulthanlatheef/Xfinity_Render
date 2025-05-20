<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <meta charset="UTF-8">
  <title>Manage Promocodes</title>
  <style>
    :root{
      --accent-1:#ff9a00;
      --accent-2:#ff3d00;
      --card-bg:rgba(255,255,255,0.35);
      --card-border:rgba(255,255,255,0.55);
      --txt:#3d2b1f;
      --danger:#c62828;
    }
    /* Page & container */
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f4f6f8;
      margin: 0;
      padding: 40px 20px;
      position:relative;

    }
    .container {
      max-width: 960px;
      margin: auto;
      margin-top:60px;
      background: #ffffff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    /* Header */
    h1 {
      margin-bottom: 24px;
      color: #fb8c00;
      font-size: 28px;
      font-weight: 600;
    }

    /* Flash messages */
    .flash {
      padding: 15px 20px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-weight: 500;
    }
    .flash-success {
      background-color: #e0f7e9;
      color: #2e7d32;
      border-left: 4px solid #2e7d32;
    }
    .flash-error {
      background-color: #fdecea;
      color: #c62828;
      border-left: 4px solid #c62828;
    }

    /* Table: fixed‑layout so column widths are consistent */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      table-layout: fixed;           /* enforce fixed widths */
    }
    colgroup col { }
    th, td {
      padding: 14px 12px;
      text-align: left;
      border-bottom: 1px solid #e0e0e0;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      vertical-align: middle;
    }
    th {
      background-color: #fb8c00;
      color: white;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 14px;
    }
    tr:hover {
      background-color: #fff8f0;
    }
    .no-data {
      text-align: center;
      padding: 20px;
      color: #757575;
      white-space: normal;
    }

    /* fixed width per column */
    <colgroup>
      <col style="width: 20%;" />    /* Code */
      <col style="width: 15%;" />    /* Discount */
      <col style="width: 15%;" />    /* Type */
      <col style="width: 15%;" />    /* Status */
      <col style="width: 35%;" />    /* Actions */
    </colgroup>

    /* ensure each row is same height */
    tbody tr {
      height: 60px;
    }

    /* center the contents of the Actions cell */
    td:nth-child(5) {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Action Buttons Container */
    .action-buttons {
      display: inline-flex;
      gap: 8px;
    }
     .navbar{
      position:fixed;top:0;left:0;right:0;
      height:60px;
      display:flex;align-items:center;justify-content:space-between;
      padding:0 24px;
      font-weight:600;font-size:1.05rem;
      color:#fff;
      background:linear-gradient(90deg,var(--accent-1),var(--accent-2));
      box-shadow:0 2px 8px rgba(0,0,0,.12);
      z-index:50;
    }

    /* Base button style */
    .btn {
      display: inline-flex;
      align-items: center;
      gap: 4px;
      padding: 8px 16px;
      font-size: 0.9rem;
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
    .btn:active {
      transform: translateY(0);
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    /* Toggle (activate/deactivate) */
    .btn-toggle {
      background: linear-gradient(135deg, #81c784 0%, #388e3c 100%);
      color: #fff;
    }
    .btn-toggle:hover {
      background: linear-gradient(135deg, #66bb6a 0%, #2e7d32 100%);
    }

    /* Delete */
    .btn-delete {
      background: linear-gradient(135deg, #e57373 0%, #c62828 100%);
      color: #fff;
    }
    .btn-delete:hover {
      background: linear-gradient(135deg, #ef5350 0%, #b71c1c 100%);
    }
  </style>
</head>
<body>
   <nav class="navbar">
    <div>🎉 Promocode Session</div>
      <div style="display: flex; gap: 12px; align-items: center;">
    <a href="<?= site_url('admin'); ?>" class="btn" style="background-color: white; color: var(--accent-2);">
      🏠 Home
    </a>
    <a href="<?= site_url('home/logoutadmin'); ?>" class="btn" style="background-color: #ffffff; color: var(--danger);">
      🔓 Logout
    </a>
    <span>Admin Panel</span>
  </div>
  </nav>
  <div class="container">
    <h1>🎟️ Manage Promocodes</h1>

    <?php if ($this->session->flashdata('success')): ?>
      <div class="flash flash-success"><?= $this->session->flashdata('success'); ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
      <div class="flash flash-error"><?= $this->session->flashdata('error'); ?></div>
    <?php endif; ?>

    <table>
      <colgroup>
        <col style="width: 20%;" />
        <col style="width: 15%;" />
        <col style="width: 15%;" />
        <col style="width: 15%;" />
        <col style="width: 35%;" />
      </colgroup>
      <thead>
        <tr>
          <th>Code</th>
          <th>Discount (₹)</th>
          <th>Type</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($promocodes)): foreach ($promocodes as $p): ?>
          <tr>
            <td><?= htmlspecialchars($p->promocode); ?></td>
            <td><?= $p->discount; ?></td>
            <td><?= ucfirst($p->type); ?></td>
            <td><?= ucfirst($p->status); ?></td>
            <td>
              <div class="action-buttons">
                <a href="javascript:void(0);" 
                class="btn btn-toggle"

             onclick="confirmDe('<?= site_url('admin/toggle_status/'.urlencode($p->promocode)); ?>')">
                   
                  <span><?= $p->status === 'active' ? '🔒' : '🔓'; ?></span>
                  <span><?= $p->status === 'active' ? 'Deactivate' : 'Activate'; ?></span>
                </a>
              <a href="javascript:void(0);"
   class="btn btn-delete"
   onclick="confirmDelete('<?= site_url('admin/delete_promocode/'.urlencode($p->promocode)); ?>')">
  <span>🗑️</span>
  <span>Delete</span>
</a>



              </div>
            </td>
          </tr>
        <?php endforeach; else: ?>
          <tr>
            <td colspan="5" class="no-data">No promocodes found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
<script>
  function confirmDelete(deleteUrl) {
    Swal.fire({
      title: 'Delete Promocode?',
      text: "This action cannot be undone.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = deleteUrl;
      }
    });
  }

  function confirmDe(deleteUrl) {
    Swal.fire({
      title: 'Promocode Deactivation/Activaton?',
      text: "This action cannot be undone.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Yes, deactivate/activate it!',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = deleteUrl;
      }
    });
  }
</script>



</body>
</html>
