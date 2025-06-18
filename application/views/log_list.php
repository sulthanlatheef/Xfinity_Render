<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Xfinity Logs Pannel</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #fff3e0, #ffe0b2);
            color: #333;
        }

        header {
            background: linear-gradient(90deg, #ff6f00, #ff9800);
            color: white;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        header h1 {
            margin: 0;
            font-size: 2.4rem;
            letter-spacing: 1px;
        }

        .container {
            max-width: 960px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        h2 {
            font-size: 1.8rem;
            color: #ff6f00;
            margin-bottom: 25px;
            border-bottom: 2px solid #ffcc80;
            padding-bottom: 10px;
        }

        .log-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .log-item {
            background-color: #fff8e1;
            border-left: 6px solid #ff9800;
            padding: 15px 20px;
            border-radius: 10px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .log-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }

        .log-item a {
            text-decoration: none;
            color: #e65100;
            font-weight: 600;
            font-size: 1rem;
            word-break: break-word;
        }

        @media (max-width: 600px) {
            header h1 {
                font-size: 1.8rem;
            }

            .container {
                padding: 20px;
            }

            .log-item {
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Xfinity Logs Pannel</h1>
</header>

<div class="container">
    <h2>Available Logs</h2>
    <ul class="log-list">
        <?php foreach ($files as $file): ?>
            <li class="log-item">
                <a href="<?php echo site_url('logcontroller/view/' . $file); ?>">
                    📄 <?php echo $file; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>
