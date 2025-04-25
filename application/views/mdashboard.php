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
        <h1>Xfinity Garage <?php if ($this->session->userdata('musername')): ?>
          <i class="fa-solid fa-wrench" style="color:;font-size:25px;"></i>
        <?php endif; ?></h1>
        <div>Mechanic Panel</div>
    </div>

    <div class="dashboard">
        <div class="tile" onclick="location.href='<?php echo site_url('mechacontrol/view_pickups'); ?>'">
            <h2>View Pickups</h2>
        </div>
        <div class="tile" onclick="location.href='<?php echo site_url('mechacontrol/manage_service'); ?>'">
            <h2>Manage Service</h2>
        </div>
        <div class="tile" onclick="location.href='<?php echo site_url('mechanic/ready_for_delivery'); ?>'">
            <h2>Ready for Delivery</h2>
        </div>
    </div>

    <div class="footer">
        © <?php echo date("Y"); ?> Xfinity Automobile Services. All rights reserved.
    </div>

</body>
</html>
