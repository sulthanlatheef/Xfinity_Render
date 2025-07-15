<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>XFINITY Invoice</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 30px;
      background: #f2f2f2;
    }
    .invoice-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .invoice-logo img { max-width: 100px; }
    .invoice-title h2 {
      margin: 0;
      color: #ff6600;
      font-size: 24px;
    }
    .invoice-info {
      background: #f9f9f9;
      padding: 10px 20px;
      border: 1px solid #ddd;
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      font-weight: 600;
    }
    .invoice-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    .invoice-table th, .invoice-table td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: left;
    }
    .invoice-table th { background: #f9f9f9; }
    .invoice-table tfoot td { font-weight: 600; }

    input[type="text"], input[type="number"] {
      width: 100%;
      padding: 6px;
      margin-top: 4px;
      margin-bottom: 10px;
      box-sizing: border-box;
    }

    button {
      padding: 8px 16px;
      background: #ff6600;
      color: white;
      border: none;
      cursor: pointer;
      margin-top: 10px;
    }

    .form-row {
      display: flex;
      gap: 20px;
      margin-bottom: 10px;
    }

    .form-row div {
      flex: 1;
    }
  </style>
</head>
<body>

<div class="form-row">
  <div>
    <label>Customer Name</label>
    <input type="text" id="customer-name" placeholder="Enter customer name"
  value="<?php echo isset($name) ? htmlspecialchars($name, ENT_QUOTES) : ''; ?>"
  oninput="updateCustomer()">

  </div>
  <div>
    <label>Invoice Number</label>
    <input type="text" id="invoice-no" readonly>
  </div>
</div>

<div id="invoice-modal">
  <div id="invoice-content">
    <div class="modal-content">
      <div class="invoice-header">
        <div class="invoice-logo">
          <img src="<?php echo base_url('assets/images/creative ai (2).png'); ?>" alt="XFINITY Logo">
        </div>
        <div class="invoice-title">
          <h2>XFINITY INVOICE</h2>
          <p>123 Demo Street, City, State - PIN</p>
        </div>
      </div>
      <div class="invoice-info">
        <div class="number-label">Invoice No: <span id="invoice-number-display"></span></div>
        <div>Date: <span id="invoice-date"></span></div>
      </div>

      <div class="invoice-billing">
        <h3>Bill To: <span id="invoice-bill-to">Customer Name</span></h3>
      </div>

      <table class="invoice-table" id="invoice-table">
        <thead>
          <tr>
            <th>Description</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Amount</th>
          </tr>
        </thead>
        <tbody id="invoice-body">
          <!-- Items added here -->
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3">Subtotal</td>
            <td id="invoice-subtotal">0.00</td>
          </tr>
          <tr>
            <td colspan="3">CGST (9%)</td>
            <td id="invoice-cgst">0.00</td>
          </tr>
          <tr>
            <td colspan="3">SGST (9%)</td>
            <td id="invoice-sgst">0.00</td>
          </tr>
          <tr>
            <td colspan="3">Total</td>
            <td id="invoice-total">0.00</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<h4>Add Item</h4>
<div class="form-row">
  <div><input type="text" id="desc" placeholder="Description"></div>
  <div><input type="number" id="qty" placeholder="Quantity" min="1"></div>
  <div><input type="number" id="price" placeholder="Unit Price" step="0.01"></div>
  <div><button style="transform:translateY(-7px);border-radius:10px;padding:9px;padding-right:15px;padding-left:15px;" onclick="addItem()">Add</button></div>
</div>

<button id="savebtn" style= "border-radius:10px;"onclick="downloadPDF()">Download & Save Invoice</button>

<script>
  // Auto-populate bill-to name if present
  var membership = <?= json_encode($membership) ?>;
  document.addEventListener("DOMContentLoaded", function() {
  updateCustomer();
  updateTotals();
});

const invoiceNo = 'INV-' + Math.floor(100000 + Math.random() * 900000);
document.getElementById('invoice-no').value                 = invoiceNo;
document.getElementById('invoice-number-display').textContent = invoiceNo;
document.getElementById('invoice-date').textContent         = new Date().toLocaleDateString();

function updateCustomer() {
  const name = document.getElementById('customer-name').value || 'Customer Name';
  document.getElementById('invoice-bill-to').textContent = name;
}

function addItem() {
  const desc  = document.getElementById('desc').value;
  const qty   = parseFloat(document.getElementById('qty').value);
  const price = parseFloat(document.getElementById('price').value);

  if (!desc || qty <= 0 || price <= 0) {
    alert('Please enter valid item details.');
    return;
  }

  const amount = qty * price;
  const row = document.createElement('tr');
  row.innerHTML = `
    <td>${desc}</td>
    <td>${qty}</td>
    <td>${price.toFixed(2)}</td>
    <td>${amount.toFixed(2)}</td>
  `;
  document.getElementById('invoice-body').appendChild(row);

  // clear inputs
  document.getElementById('desc').value  = '';
  document.getElementById('qty').value   = '';
  document.getElementById('price').value = '';

  updateTotals();
}

function updateTotals() {
  // remove previous free-wash row if any
  document.querySelectorAll('.membership-service').forEach(el => el.remove());

  // if $membership === "Gold Membership", add free interior wash
  if (membership === 'Gold Membership') {
    const washRow = document.createElement('tr');
    washRow.className = 'membership-service';
    washRow.innerHTML = `
      <td style="color:green;">Free Interior Wash (worth ₹500) for GOLD Membership</td>
      <td style="color:green;">1</td>
      <td style="color:green;">₹500</td>
      <td style="color:green;">Free</td>
    `;
    document.getElementById('invoice-body').appendChild(washRow);
  }

  // recalc totals
  let subtotal = 0;
  document.querySelectorAll('#invoice-body tr').forEach(row => {
    subtotal += parseFloat(row.children[3].textContent) || 0;
  });

  const cgst  = subtotal * 0.09;
  const sgst  = subtotal * 0.09;
  const total = subtotal + cgst + sgst;

  document.getElementById('invoice-subtotal').textContent = subtotal.toFixed(2);
  document.getElementById('invoice-cgst').textContent     = cgst.toFixed(2);
  document.getElementById('invoice-sgst').textContent     = sgst.toFixed(2);
  document.getElementById('invoice-total').textContent    = total.toFixed(2);
}


  function downloadPDF() {
    const saveBtn    = document.getElementById('savebtn');
    saveBtn.innerHTML = '<i style="margin-right:5px;" class="fas fa-spinner fa-spin"></i><span>Saving Invoice</span>';
    const $clone = $('#invoice-content').clone();
    const modifiedNum = document.getElementById('invoice-no').value;

    const opt = {
      margin: 0.5,
      filename: modifiedNum + '.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    };

    html2pdf().set(opt).from($clone[0]).outputPdf('blob').then(function(pdfBlob) {
      var formData = new FormData();
      formData.append('invoice', pdfBlob, modifiedNum + ".pdf");

      $.ajax({
        url: '<?php echo site_url("invoice/save_invoice"); ?>',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          console.log("Invoice upload success:", response);

          // Send invoice number & total to another controller
          const invoiceNumber = document.getElementById('invoice-no').value;
          const total = document.getElementById('invoice-total').textContent;
          
    const pickupId = '<?= isset($pickup_id) ? htmlspecialchars($pickup_id, ENT_QUOTES) : '' ?>';


          $.post('<?php echo site_url("mechacontrol/finvoice"); ?>', {
            invoice_number: invoiceNumber,
            total: total,
            pickup_id: pickupId
          }, function(finRes) {
            saveBtn.disabled = true;
            saveBtn.innerHTML = '<i style="margin-right:5px;" class="fas fa-circle-check"></i><span>Invoice Saved Successfully</span>';
            console.log("finvoice() success:", finRes);
            
          }).fail(function(err) {
            console.error("finvoice() failed:", err);
            alert("Invoice PDF saved but info not sent to backend.Please refresh the page and try again");
          });

        },
        error: function(xhr, status, error) {
          console.error("PDF Upload Error:", error);
          alert("Failed to save PDF.");
        }
      });
    });
  }

  // Init with one row
  
</script>

</body>
</html>
