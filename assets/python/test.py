import os
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
os.chdir(BASE_DIR)
import sys
import base64
from google.auth.transport.requests import Request
from google.oauth2.credentials import Credentials
from google_auth_oauthlib.flow import InstalledAppFlow
from googleapiclient.discovery import build
from email import encoders
from email.mime.base import MIMEBase
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

# Get arguments from PHP (in order)
# 1: recipient email
# 2: customer name
# 3: pickup ID
# 4: invoice ID (filename without extension)
if len(sys.argv) != 5:
    print("Usage: python send_completion_email.py <email> <name> <pickup_id> <invoice_id>")
    sys.exit(1)

recipient_email = sys.argv[1]
customer_name   = sys.argv[2]
pickup_id       = sys.argv[3]
invoice_id      = sys.argv[4]

# Path to invoice PDF
invoice_folder = '/tmp/invoices/'
invoice_filename = f"{invoice_id}.pdf"
invoice_path = os.path.join(invoice_folder, invoice_filename)

if not os.path.isfile(invoice_path):
    print(f"Error: Invoice file not found at {invoice_path}")
    sys.exit(1)

# Gmail API scope
SCOPES = ['https://www.googleapis.com/auth/gmail.send']

def get_credentials():
    creds = None
    if os.path.exists('token.json'):
        creds = Credentials.from_authorized_user_file('token.json', SCOPES)
    if not creds or not creds.valid:
        if creds and creds.expired and creds.refresh_token:
            creds.refresh(Request())
        else:
            flow = InstalledAppFlow.from_client_secrets_file('credentials.json', SCOPES)
            creds = flow.run_local_server(port=0)
        with open('token.json', 'w') as token:
            token.write(creds.to_json())
    return creds

def create_message():
    # Create the multipart container
    message = MIMEMultipart()
    message['To'] = recipient_email
    message['From'] = "XFINITY <sulthanlatheef0@gmail.com>"
    message['Subject'] = f"Service Completed – Appointment #{pickup_id}"

    # HTML body
    html_body = f"""
    <html>
      <head>
        <meta charset="UTF-8">
        <style>
          body {{ font-family: Arial, sans-serif; background-color: #f4f4f4; margin:0; padding:0; }}
          .container {{ max-width:600px; margin:40px auto; background:#fff; padding:20px; border-radius:8px; }}
          .header {{ text-align:center; padding:30px 0; background:linear-gradient(135deg,#FF7043,#FF5722); color:#fff; }}
          .header h1 {{ margin:0; font-size:28px; }}
          .content {{ color: #333; line-height:1.5; }}
          .content h2 {{ color:#FF5722; }}
          .details {{ margin:20px 0; }}
          .footer {{ font-size:12px; color:#777; text-align:center; margin-top:30px; }}
          .cta {{ display:inline-block; margin-top:20px; padding:12px 24px; background:#FF5722; color:#fff; text-decoration:none; border-radius:4px; }}
        </style>
      </head>
      <body>
        <div class="container">
          <div class="header">
            <h1>XFINITY Service Complete</h1>
          </div>
          <div class="content">
            <h2>Hi {customer_name},</h2>
            <p>We’re pleased to inform you that your vehicle service (Appointment ID: <strong>{pickup_id}</strong>) has been successfully completed.</p>
            <p>Please find your invoice attached:</p>
            <div class="details">
              <strong>Invoice Number:</strong> {invoice_id}<br>
              <strong>Date:</strong> {__import__('datetime').datetime.now().strftime('%B %d, %Y')}
            </div>
            <p>If you have any questions or need further assistance, feel free to reply to this email or reach us at <a href="mailto:support@xfinity.in">support@xfinity.in</a>.</p>
            <p>Thank you for choosing XFINITY!</p>
            <a href="https://www.xfinity.in" class="cta">Visit Our Website</a>
          </div>
          <div class="footer">
            © 2025 XFINITY. All rights reserved.
          </div>
        </div>
      </body>
    </html>
    """

    # Attach HTML body
    message.attach(MIMEText(html_body, 'html'))

    # Attach invoice PDF
    with open(invoice_path, 'rb') as f:
        part = MIMEBase('application', 'pdf')
        part.set_payload(f.read())
    encoders.encode_base64(part)
    part.add_header(
        'Content-Disposition',
        f'attachment; filename="{invoice_filename}"'
    )
    message.attach(part)

    # Encode the message for Gmail API
    raw = base64.urlsafe_b64encode(message.as_bytes()).decode()
    return {'raw': raw}

def send_email():
    creds = get_credentials()
    service = build('gmail', 'v1', credentials=creds)
    msg = create_message()
    try:
        service.users().messages().send(userId='me', body=msg).execute()
        print("Service completion email sent successfully!")
    except Exception as e:
        print(f"Failed to send email: {e}")

if __name__ == '__main__':
    send_email()
