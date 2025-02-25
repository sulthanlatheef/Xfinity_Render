<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Advanced Page</title>
</head>
<body>
    <h1>Welcome to the Advanced Page, <?php echo $this->session->userdata('username'); ?>!</h1>
    <p>This page is accessible only to logged-in users.</p>
    <a href="<?php echo site_url('home/logout'); ?>">Logout</a>
</body>
</html>
