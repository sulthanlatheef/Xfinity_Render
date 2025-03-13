<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Image Upload and YOLOv5 Prediction</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet" />
  <!-- jQuery UI CSS -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <!-- jsPDF and html2pdf Library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- jQuery UI JS -->
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
  <style>
    /* Global Styles */
    * { box-sizing: border-box; }
    body {
      font-family: "Poppins", sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
      color: #333;
      overflow-x: hidden;
    }
    /* Navbar (simplified) */
   /* Global Styles */
* {
    box-sizing: border-box;
   }
   body {
    font-family: "Poppins", sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
    color: #333;
    overflow-x: hidden;
   }
   a { text-decoration: none; }
   h1, h2, p { margin: 0; padding: 0; }
   
   /* Navigation Bar */
   nav {
    background-color: #ff6600;
    padding: 8px 0;
    position: sticky;
    top: 0;
    z-index: 10;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: nowrap;
   }
   .navbar-logo {
    font-size: 25px;
    color: white;
    font-weight: 600;
    margin-left: 30px;
    animation: bounce 1.5s ease infinite;
    white-space: nowrap;
   }
   @keyframes bounce {
    0%, 50%, 100% { transform: translateY(0); }
    25% { transform: translateY(-10px); }
    75% { transform: translateY(-5px); }
   }
   .nav-links {
    flex: 1;
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    gap: 20px;
    flex-wrap: nowrap;
   }
   nav a {
    color: white;
    font-size: 20px;
    padding: 10px 30px;
    border-radius: 4px;
    transition: background-color 0.3s, transform 0.3s;
    white-space: nowrap;
   }
   nav a:hover {
    background-color: #ff944d;
    transform: translateY(-3px);
   }
   .user-info {
    display: flex;
    align-items: center;
    margin-right: 30px;
    flex-wrap: nowrap;
   }
   .user-info .username {
    font-size: 18px;
    color: white;
    font-weight: 600;
    margin-right: 15px;
    white-space: nowrap;
   }
   .user-info .logout-btn {
    background: red;
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    white-space: nowrap;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
   }
   .user-info .logout-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
   }
   @media (max-width: 768px) {
    .navbar-logo { font-size: 20px; margin-left: 15px; }
    nav a { padding: 10px 20px; font-size: 18px; }
    .user-info .username { font-size: 16px; }
    .user-info { margin-right: 15px; }
   }
   
   /* Main Content Styles */
   .container {
    max-width: 600px;
    margin: 60px auto;
    background: white;
    border-radius: 8px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    padding: 40px 30px;
    text-align: center;
    position: relative;
    overflow: hidden;
   }
   .container::before {
    content: "";
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle at center, rgba(255,255,255,0.15), transparent);
    animation: rotateBg 15s linear infinite;
    z-index: 0;
   }
   @keyframes rotateBg {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
   }
   .container > * { position: relative; z-index: 1; }
   .container h1 {
    margin-bottom: 20px;
    font-size: 28px;
    color: #333;
   }
   #error-message {
    color: #d9534f;
    margin-bottom: 15px;
    display: none;
    font-weight: 500;
   }
   
   /* Advanced Custom File Input */
   .custom-file-input {
    position: relative;
    display: inline-block;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid #ff6600;
    border-radius: 30px;
    padding: 10px 20px;
    background: linear-gradient(135deg, #ff6600, #ff944d);
    color: white;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    font-size: 16px;
    margin-bottom: 20px;
   }
   .custom-file-input:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
   }
   .custom-file-input input[type="file"] {
    position: absolute;
    left: 0;
    top: 0;
    opacity: 0;
    cursor: pointer;
    height: 100%;
    width: 100%;
   }
   .file-name {
    margin-top: 10px;
    font-size: 14px;
    color: #555;
   }
   
   /* Submit Button */
   button[type="submit"] {
    background: linear-gradient(135deg, #ff6600, #ff944d);
    border: none;
    padding: 12px 30px;
    color: white;
    font-size: 18px;
    border-radius: 30px;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
   }
   button[type="submit"]:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
   }
   
   /* Predictions Section */
   #predictions {
    margin-top: 30px;
    text-align: left;
   }
   #predictions h3 {
    color: #333;
    margin-bottom: 15px;
   }
   #prediction-list {
    list-style: none;
    padding: 0;
   }
   #prediction-list li {
    background: #f8f9fa;
    padding: 10px 15px;
    margin: 5px 0;
    border-radius: 5px;
    transition: background-color 0.3s;
   }
   #prediction-list li:hover {
    background: #e2e6ea;
   }
    /* Vehicle Details Section */
    #vehicle-info {
      margin-top: 20px;
      display: none;
      padding: 20px;
      background: #f0f4f8;
      border: 1px solid #d1e3f0;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .vehicle-input {
      width: calc(50% - 10px);
      padding: 10px;
      margin-right: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
      transition: border-color 0.3s, box-shadow 0.3s;
    }
    .vehicle-input:focus {
      outline: none;
      border-color: #ff6600;
      box-shadow: 0 0 5px rgba(255,102,0,0.4);
    }
    #show-price-button {
      padding: 10px 20px;
      background: #ff6600;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
      transition: background 0.3s;
      margin-top: 10px;
    }
    #show-price-button:hover {
      background: #ff944d;
    }
    /* Invoice Modal Styles */
    #invoice-modal {
      display: none;
      font-size: 14px;
    }
    #invoice-modal .modal-content {
      padding: 20px;
    }
    /* New invoice header with logo on left and header on right with a demo address */
    .invoice-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .invoice-logo img {
      max-width: 100px;
      height: auto;
    }
    .invoice-title {
      text-align: right;
    }
    .invoice-title h2 {
      margin: 0;
      color: #ff6600;
      font-size: 24px;
    }
    .invoice-title p {
      margin: 5px 0 0 0;
      font-size: 14px;
      color: #555;
    }
    .invoice-info {
      background: #f9f9f9;
      padding: 10px 20px;
      border: 1px solid #ddd;
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      font-size: 14px;
      font-weight: 600;
    }
    .number-label {
      /* This element displays "Estimate number :" on screen */
    }
    hr {
      border: none;
      border-top: 1px solid #ddd;
      margin: 10px 0;
    }
    .invoice-billing {
      margin-bottom: 20px;
    }
    .invoice-billing h3 {
      margin: 0 0 5px 0;
    }
    .invoice-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    .invoice-table th,
    .invoice-table td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: left;
    }
    .invoice-table th {
      background: #f9f9f9;
      font-weight: 600;
    }
    .invoice-table tfoot td {
      border: none;
      padding: 8px;
    }
    .invoice-table tfoot tr td:nth-child(1),
    .invoice-table tfoot tr td:nth-child(2),
    .invoice-table tfoot tr td:nth-child(3) {
      text-align: right;
      font-weight: 600;
    }
    .invoice-table tfoot tr td:nth-child(4) {
      text-align: left;
      font-weight: 600;
    }
    /* Schedule Pickup button styling */
    #schedule-pickup-btn {
      display: none;
      padding: 10px 20px;
      background: #28a745;
      color: #fff;
      border: none;
      border-radius: 4px;
      font-size: 16px;
      cursor: pointer;
      margin: 20px auto;
    }
    @media (max-width: 500px) {
      .vehicle-input { width: 100%; margin-right: 0; }
      .invoice-info { flex-direction: column; align-items: flex-start; }
      .invoice-header { flex-direction: column; align-items: center; }
    }
  </style>
</head>
<body>
  <!-- Navigation Bar -->
  <nav>
    <div class="navbar-logo">Xfinity</div>
    <div class="nav-links">
      <a href="#ai-features">AI Features</a>
      <a href="#schedule-pickup">Schedule Pickup</a>
      <a href="#ai-diagnosis">AI Diagnosis</a>
      <a href="#track-status">Track Status</a>
    </div>
    <?php if ($this->session->userdata('name')): ?>
      <div class="user-info">
        <span class="username"><?php echo html_escape($this->session->userdata('name')); ?></span>
        <a href="<?php echo site_url('home/logout'); ?>" class="logout-btn">Logout</a>
      </div>
    <?php else: ?>
      <a href="<?php echo site_url('login'); ?>" class="button" style="margin-right:30px; color:white; font-size:20px; padding:10px 30px;">Login</a>
    <?php endif; ?>
  </nav>

  <!-- Main Content -->
  <div class="container" style="padding: 20px;">
    <h1>Upload an Image for YOLOv5 Prediction</h1>
    <!-- Error Message -->
    <div id="error-message"></div>
    <!-- Upload Form -->
    <form id="upload-form" enctype="multipart/form-data">
      <label class="custom-file-input">
        Choose File
        <input type="file" id="image" name="image" required>
      </label>
      <div class="file-name" id="file-name">No file selected</div>
      <br>
      <button type="submit">Upload & Predict</button>
    </form>
    <!-- Prediction Results -->
    <div id="predictions">
      <h3>Predictions:</h3>
      <ul id="prediction-list"></ul>
      <!-- Vehicle Details Fields with Autocomplete -->
      <div id="vehicle-info">
        <h3>Enter Vehicle Details:</h3>
        <input type="text" id="vehicle-brand" class="vehicle-input" placeholder="Vehicle Brand">
        <input type="text" id="vehicle-model" class="vehicle-input" placeholder="Vehicle Model">
        <br>
        <button type="button" id="show-price-button">Show Price</button>
      </div>
    </div>
  </div>

  <!-- Invoice Modal Dialog -->
  <div id="invoice-modal" title="XFINITY Invoice">
    <div class="modal-content">
      <div class="invoice-header">
        <div class="invoice-logo">
        <img src="/XFINITY/assets/images/creative ai (2).png" alt="XFINITY Logo" />
        </div>
        <div class="invoice-title">
          <h2>XFINITY Invoice</h2>
          <p>123 Demo Street, City, State - PIN</p>
        </div>
      </div>
      <div class="invoice-info">
        <div class="number-label">Estimate number : <span id="invoice-number"></span></div>
        <div>Date: <span id="invoice-date"></span></div>
      </div>
      <hr>
      <div class="invoice-billing">
        <h3>Bill To:</h3>
        <p id="invoice-bill-to"><?php echo html_escape($this->session->userdata('name')); ?></p>
      </div>
      <table class="invoice-table">
        <thead>
          <tr>
            <th>Description</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Amount</th>
          </tr>
        </thead>
        <tbody>
          <!-- Invoice items will be inserted here dynamically -->
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3">Subtotal</td>
            <td id="invoice-subtotal"></td>
          </tr>
          <tr>
            <td colspan="3">CGST (9%)</td>
            <td id="invoice-cgst"></td>
          </tr>
          <tr>
            <td colspan="3">SGST (9%)</td>
            <td id="invoice-sgst"></td>
          </tr>
          <tr>
            <td colspan="3" class="total">Total</td>
            <td class="total" id="invoice-total"></td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

  <!-- Schedule Pickup Button (Initially hidden) -->
  <button id="schedule-pickup-btn">Schedule Pickup</button>

  <script>
    // Function to filter prediction text and clean up accessory name
    function filterAccessory(prediction) {
      let filtered = prediction.replace(/-/g, ' ').replace(/damage/gi, '').trim();
      return filtered.split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
    }

    $(document).ready(function () {
      // Initialize the invoice modal using jQuery UI Dialog
      $("#invoice-modal").dialog({
        autoOpen: false,
        modal: true,
        width: 650,
        show: { effect: "fade", duration: 300 },
        hide: { effect: "fade", duration: 300 },
        close: function() {
          // Show the "Schedule Pickup" button when the modal is closed
          $("#schedule-pickup-btn").fadeIn();
        },
        buttons: {
          "Close": function() {
            $(this).dialog("close");
          }
        }
      });

      // Update file name on file selection
      $("#image").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $("#file-name").text(fileName || "No file selected");
      });

      $("#upload-form").submit(function (event) {
        event.preventDefault();
        var formData = new FormData();
        var imageFile = $("#image")[0].files[0];
        if (!imageFile) {
          $("#error-message").text("Please select an image to upload.").show();
          return;
        }
        formData.append("image", imageFile);

        $.ajax({
          url: "<?php echo site_url('imageUpload/predict'); ?>",
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
            console.log("✅ API Response:", response);
            $("#error-message").hide();
            $("#predictions").show();
            $("#prediction-list").empty();

            if (response.predictions && response.predictions.length > 0) {
              response.predictions.forEach(function (pred) {
                $("#prediction-list").append("<li><strong>Custom:</strong> " + pred.custom + " <br> <strong>Original:</strong> " + pred.original + "</li>");
                var accessoryName = filterAccessory(pred.original);
                console.log("Filtered Accessory:", accessoryName);
              });
              $("#vehicle-info").fadeIn();
            } else if (response.error) {
              $("#error-message").text("Error: " + response.error).show();
            } else {
              $("#prediction-list").append("<li>FAILED TO COMMUNICATE WITH FLASK SERVER.</li>");
            }
          },
          error: function (xhr, status, error) {
            console.error("❌ AJAX Error:", error);
            console.error("❌ Server Response:", xhr.responseText);
            $("#error-message").text("Error: " + xhr.responseText).show();
          }
        });
      });

      // Autocomplete for vehicle brand field
      $("#vehicle-brand").autocomplete({
        source: function(request, response) {
          $.ajax({
            url: "<?php echo site_url('imageUpload/get_brands'); ?>",
            dataType: "json",
            data: { term: request.term },
            success: function(data) {
              response($.map(data, function(item) {
                return { label: item.name, value: item.name, id: item.id };
              }));
            }
          });
        },
        minLength: 1,
        select: function(event, ui) {
          $("#vehicle-brand").data("brand-id", ui.item.id);
          $("#vehicle-brand").data("brand-name", ui.item.value);
          $("#vehicle-model").val('');
        }
      });

      // Autocomplete for vehicle model field (dependent on brand)
      $("#vehicle-model").autocomplete({
        source: function(request, response) {
          var brandId = $("#vehicle-brand").data("brand-id");
          if (!brandId) { response([]); return; }
          $.ajax({
            url: "<?php echo site_url('imageUpload/get_models'); ?>",
            dataType: "json",
            data: { term: request.term, brand_id: brandId },
            success: function(data) {
              response($.map(data, function(item) {
                return { label: item.name, value: item.name, id: item.id };
              }));
            }
          });
        },
        minLength: 1,
        select: function(event, ui) {
          $("#vehicle-model").data("model", ui.item.value);
        }
      });

      // Function to lookup accessory price and open invoice modal
      function lookupAccessoryPrice() {
        var brandId = $("#vehicle-brand").data("brand-id");
        var brandName = $("#vehicle-brand").data("brand-name");
        var model = $("#vehicle-model").data("model");
        var predictionText = $("#prediction-list li").first().text();
        var accessoryName = filterAccessory(predictionText.split("Original:")[1]);
        console.log("Looking up price for:", brandName, model, accessoryName);

        var invoiceData = {
          brandName: brandName || "N/A",
          model: model || "N/A",
          accessory: accessoryName,
          price: null
        };

        if (accessoryName.toLowerCase().indexOf("scratch") !== -1) {
          invoiceData.accessory = "Scratch Repair";
          invoiceData.price = 1000;
          openInvoiceModal(invoiceData);
        } else if (accessoryName.toLowerCase().indexOf("dent") !== -1) {
          invoiceData.accessory = "Dent Repair";
          invoiceData.price = 2000;
          openInvoiceModal(invoiceData);
        } else if (brandId && model && accessoryName) {
          $.ajax({
            url: "<?php echo site_url('imageUpload/get_accessory_price'); ?>",
            dataType: "json",
            data: { brand_id: brandId, model: model, accessory: accessoryName },
            success: function(data) {
              invoiceData.price = data.price;
              openInvoiceModal(invoiceData);
            }
          });
        } else {
          alert("Please select both brand and model before checking the price.");
        }
      }

      // Function to build and open the detailed invoice modal with fixed labor charge and tax details.
      function openInvoiceModal(data) {
        var price = data.price ? parseFloat(data.price) : 0;
        var laborCharge = 200;
        var serviceDescription = data.accessory + " for " + data.brandName + " " + data.model;
        var serviceQty = 1;
        var serviceUnitPrice = price;
        var serviceAmount = price;
        var laborDescription = "Labor Charge";
        var laborQty = 1;
        var laborUnitPrice = laborCharge;
        var laborAmount = laborCharge;
        var subtotal = price + laborCharge;
        var cgst = subtotal * 0.09;
        var sgst = subtotal * 0.09;
        var total = subtotal + cgst + sgst;

        var currentDate = new Date().toLocaleDateString();
        // For display, generate invoice number with the "EST-" prefix
        var invoiceNumber = "EST-" + Math.floor(Math.random() * 9000 + 1000);
        $("#invoice-number").html(invoiceNumber);
        $("#invoice-date").html(currentDate);

        var tbodyHtml = "<tr>" +
            "<td>" + serviceDescription + "</td>" +
            "<td>" + serviceQty + "</td>" +
            "<td>₹" + serviceUnitPrice.toFixed(2) + "</td>" +
            "<td>₹" + serviceAmount.toFixed(2) + "</td>" +
          "</tr>" +
          "<tr>" +
            "<td>" + laborDescription + "</td>" +
            "<td>" + laborQty + "</td>" +
            "<td>₹" + laborUnitPrice.toFixed(2) + "</td>" +
            "<td>₹" + laborAmount.toFixed(2) + "</td>" +
          "</tr>";
        $("#invoice-modal .invoice-table tbody").html(tbodyHtml);
        
        $("#invoice-subtotal").html("₹" + subtotal.toFixed(2));
        $("#invoice-cgst").html("₹" + cgst.toFixed(2));
        $("#invoice-sgst").html("₹" + sgst.toFixed(2));
        $("#invoice-total").html("₹" + total.toFixed(2));

        // Hide the Schedule Pickup button while the modal is open.
        $("#schedule-pickup-btn").hide();
        $("#invoice-modal").dialog("open");
      }

      // "Show Price" button click handler.
      $("#show-price-button").click(function() {
        lookupAccessoryPrice();
      });

      // Schedule Pickup button click: Clone and modify modal content for PDF generation.
      $("#schedule-pickup-btn").click(function() {
        // Clone the modal content
        var clone = $("#invoice-modal .modal-content").clone();

        // In the clone, update the label from "Estimate number :" to "Invoice number :"
        clone.find(".number-label").each(function() {
          var html = $(this).html();
          html = html.replace("Estimate number", "Invoice number");
          $(this).html(html);
        });

        // Change the invoice number prefix from "EST-" to "INV-"
        var displayedNum = clone.find("#invoice-number").text();
        var modifiedNum = displayedNum.replace("EST-", "INV-");
        clone.find("#invoice-number").text(modifiedNum);

        // Set filename as the modified invoice number
        var filename = modifiedNum + ".pdf";

        var opt = {
          margin:       0.5,
          filename:     filename,
          image:        { type: 'jpeg', quality: 0.98 },
          html2canvas:  { scale: 2 },
          jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        };
        html2pdf().set(opt).from(clone[0]).save();
      });
    });
  </script>
</body>
</html>
