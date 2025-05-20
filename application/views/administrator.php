<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Xfinity Mechanic Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #fff9f5;
        }

        .navbar {
            background-color: #ff6f00;
            padding: 1rem 2rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
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

        .navbar h1 {
            margin: 0;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .dashboard {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            padding: 50px 20px;
            gap: 30px;
            min-height:510px;
        }

        .tile {
            background-color: #ffe0b2;
            border-radius: 16px;
            padding: 40px 30px;
            width: 280px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .tile:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 25px rgba(0,0,0,0.15);
        }

        .tile h2 {
            margin: 0;
            color: #e65100;
            font-size: 22px;
            font-weight: 700;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #fff3e0;
            color: #777;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
                align-items: stretch;
            }

            .tile {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h1>Xfinity Administraton</h1>
          <a href="<?= site_url('home/logoutadmin'); ?>" class="btn" style="background-color: #ffffff; color: red;font-size:17px;">
      🔓 Logout
    </a>

        <div>Admin Panel</div>
    </div>

    <div class="dashboard">
        <div class="tile" onclick="location.href='<?php echo site_url('Admin/promocodes'); ?>'">
            <h2>Create Promocodes</h2>
        </div>
        <div class="tile" onclick="location.href='<?php echo site_url('Admin/promocodeview'); ?>'">
            <h2>Manage Promocodes</h2>
        </div>
       
    </div>

    <div class="footer">
        © <?php echo date("Y"); ?> Xfinity Automobile Services(Administartion). All rights reserved.
    </div>

</body>
</html>

