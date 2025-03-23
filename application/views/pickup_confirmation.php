<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pickup Confirmation</title>
    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
       <div class="card">
          <div class="card-header bg-success text-white">
              Pickup Confirmation
          </div>
          <div class="card-body">
              <h5 class="card-title">Thank you, <?php echo $data['name']; ?>!</h5>
              <p class="card-text">Your pickup has been scheduled successfully. Below are the details:</p>
              <ul class="list-group list-group-flush">
                  <li class="list-group-item"><strong>Pickup ID:</strong> <?php echo $pickup_id; ?></li>
                  <li class="list-group-item"><strong>Brand:</strong> <?php echo $data['brand']; ?></li>
                  <li class="list-group-item"><strong>Model:</strong> <?php echo $data['model']; ?></li>
                  <li class="list-group-item"><strong>Original Prediction:</strong> <?php echo $data['original_prediction']; ?></li>
                  <li class="list-group-item"><strong>Pickup Address:</strong> <?php echo $data['pickup_address']; ?></li>
                  <li class="list-group-item"><strong>Pickup Date:</strong> <?php echo $data['pickup_date']; ?></li>
                  <li class="list-group-item"><strong>Pickup Time:</strong> <?php echo $data['pickup_time']; ?></li>
                  <li class="list-group-item"><strong>Pickup City:</strong> <?php echo html_escape($this->session->userdata('pickupcity')); ?></li>
                  <li class="list-group-item">
                      <strong>Invoice Number:</strong>
                      <?php echo (!empty($data['invoice_number'])) ? $data['invoice_number'] : 'force pickup'; ?>
                  </li>
                  <li class="list-group-item">
                      <strong>Total Invoice Amount:</strong>
                      <?php echo (!empty($data['total_amount'])) ? $data['total_amount'] : 'force pickup'; ?>
                  </li>
                  <li class="list-group-item"><strong>Vehicle registration no:</strong> <?php echo $data['vehicle_reg']; ?></li>
              </ul>
              <div class="mt-4">
                  <a href="<?php echo site_url('advanced'); ?>" class="btn btn-primary">Return Home</a>
              </div>
          </div>
       </div>
    </div>

    <!-- Output debug logs to browser console -->
    <?php if (isset($debug_logs) && is_array($debug_logs)): ?>
    <script>
        (function() {
            var logs = <?php echo json_encode($debug_logs); ?>;
            logs.forEach(function(log) {
                console.log("[Pickup Controller] " + log);
            });
        })();
    </script>
    <?php endif; ?>
</body>
</html>
