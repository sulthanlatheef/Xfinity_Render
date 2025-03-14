<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Image Upload and YOLOv5 Prediction</title>
  <link rel="stylesheet" href="<?= base_url('assets/css/stylee.css'); ?>">
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
        <!-- Wrap buttons in a container -->
        <div class="button-container">
          <button type="button" id="show-price-button">Show Price</button>
          <button id="schedule-pickup-btn">Schedule Pickup</button>
        </div>
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

      // Upload form submit handler
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
                console.log("Filtered Accessory:", filterAccessory(pred.original));
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
        // Generate invoice number with the "EST-" prefix
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

      // Schedule Pickup button click handler.
      $("#schedule-pickup-btn").click(function() {
        // Clone the modal content
        var clone = $("#invoice-modal .modal-content").clone();

        // Update the label: change "Estimate number :" to "Invoice number :"
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

        // Generate PDF blob and send to the server
        html2pdf().set(opt).from(clone[0]).outputPdf('blob').then(function(pdfBlob) {
          var formData = new FormData();
          formData.append('invoice', pdfBlob, filename);
          $.ajax({
            url: '<?php echo site_url("invoice/save_invoice"); ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
              // Retrieve original prediction (without filtering)
              var originalItem = $("#prediction-list li").filter(function() {
                return $(this).text().toLowerCase().indexOf("original:") !== -1;
              }).first().text();

              var originalPrediction = "";
              var regex = /original\s*:\s*(.*?)(?:\s*custom\s*:|$)/i;
              var match = originalItem.match(regex);
              if (match) {
                originalPrediction = match[1].trim().replace(/-/g, " ");
              }
              // Get selected brand and model
              var brand = $("#vehicle-brand").val();
              var model = $("#vehicle-model").val();
              // Invoice number and total amount from modal
              var invoiceNumber = modifiedNum;
              var totalAmountText = $("#invoice-total").text();
              var totalAmount = totalAmountText.replace("₹", "");

              // Save pickup data in session via AJAX call to homec controller
              $.ajax({
                url: '<?php echo site_url("ImageUpload/save_pickupdata"); ?>',
                type: 'POST',
                data: {
                  originalPrediction: originalPrediction,
                  brand: brand,
                  model: model,
                  invoiceNumber: invoiceNumber,
                  totalAmount: totalAmount
                },
                success: function(response2) {
                  // Redirect to homec controller after saving pickup data
                  window.location.href = '<?php echo site_url("imageupload/pickupdata_view"); ?>';
                },
                error: function(xhr, status, error) {
                  console.error("Error saving pickup data: " + error);
                  window.location.href = '<?php echo site_url("homec"); ?>';
                }
              });
            },
            error: function(xhr, status, error) {
              console.error('Error saving invoice on server: ' + error);
            }
          });
        });
      });
    });
  </script>
</body>
</html>
