<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Pickup Data Details</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: "Poppins", sans-serif;
      background: #f5f7fa;
      padding: 20px;
      color: #333;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    h1 {
      color: #ff6600;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    table, th, td {
      border: 1px solid #ddd;
    }
    th, td {
      padding: 10px;
      text-align: left;
    }
    th {
      background: #ff6600;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Pickup Data Details</h1>
    <table>
      <tr>
        <th>Field</th>
        <th>Value</th>
      </tr>
      <tr>
        <td>Original Prediction</td>
        <td><?php echo html_escape($this->session->userdata('originalPrediction')); ?></td>
      </tr>
      <tr>
        <td>Brand</td>
        <td><?php echo html_escape($this->session->userdata('brand')); ?></td>
      </tr>
      <tr>
        <td>Model</td>
        <td><?php echo html_escape($this->session->userdata('model')); ?></td>
      </tr>
      <tr>
        <td>Invoice Number</td>
        <td><?php echo html_escape($this->session->userdata('invoiceNumber')); ?></td>
      </tr>
      <tr>
        <td>Total Amount</td>
        <td><?php echo html_escape($this->session->userdata('totalAmount')); ?></td>
      </tr>
      <tr>
        <td>Pickup Date</td>
        <td><?php echo html_escape($this->session->userdata('pickupdate')); ?></td>
      </tr>
      <tr>
        <td>Pickup Time</td>
        <td><?php echo html_escape($this->session->userdata('pickuptime')); ?></td>
      </tr>
      <tr>
        <td>Pickup Address</td>
        <td><?php echo html_escape($this->session->userdata('pickupaddress')); ?></td>
      </tr>
      <tr>
        <td>Pickup City</td>
        <td><?php echo html_escape($this->session->userdata('pickupcity')); ?></td>
      </tr>
      <tr>
        <td>Pickup State</td>
        <td><?php echo html_escape($this->session->userdata('pickupstate')); ?></td>
      </tr>
      <tr>
        <td>Pickup Zip</td>
        <td><?php echo html_escape($this->session->userdata('pickupzip')); ?></td>
      </tr>
    </table>
  </div>
</body>
</html>
