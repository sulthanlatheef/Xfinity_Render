import os
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
os.chdir(BASE_DIR)

import sys
import base64
from google.auth.transport.requests import Request
from google.oauth2.credentials import Credentials
from google_auth_oauthlib.flow import InstalledAppFlow
from googleapiclient.discovery import build
from email.mime.text import MIMEText

# Expecting 9 parameters: name, brand, model, email, original_prediction, pickup_date, pickup_time, vehicle_reg_no, pickup_id
if len(sys.argv) != 10:
    print("Usage: python pickupconfirmation.py <name> <brand> <model> <email> <original_prediction> <pickup_date> <pickup_time> <vehicle_reg_no> <pickup_id>")
    sys.exit(1)

name = sys.argv[1]
brand = sys.argv[2]
model = sys.argv[3]
email = sys.argv[4]
original_prediction = sys.argv[5]
pickup_date = sys.argv[6]
pickup_time = sys.argv[7]
vehicle_reg_no = sys.argv[8]
pickup_id = sys.argv[9]

# Gmail API Scopes
SCOPES = ['https://www.googleapis.com/auth/gmail.send']

def get_credentials():
    creds = None
    # Load existing token if available
    if os.path.exists('token.json'):
        creds = Credentials.from_authorized_user_file('token.json', SCOPES)
    
    # If no valid credentials, authenticate
    if not creds or not creds.valid:
        if creds and creds.expired and creds.refresh_token:
            creds.refresh(Request())
        else:
            flow = InstalledAppFlow.from_client_secrets_file('credentials.json', SCOPES)
            creds = flow.run_local_server(port=0)
        # Save the credentials for the next run
        with open('token.json', 'w') as token:
            token.write(creds.to_json())
    
    return creds

def send_email(service, message):
    try:
        service.users().messages().send(userId='me', body=message).execute()
        print("Email sent successfully!")
    except Exception as e:
        print(f"Error: {str(e)}")

def main():
    # Email subject
    subject = "Pickup Confirmed!"
    
    # Advanced, modern and stylish HTML email content
    body = f"""
    <html>
      <head>
        <meta charset="UTF-8">
        <title>Pickup Confirmation</title>
        <style>
          @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
          body {{
            margin: 0;
            padding: 0;
            background-color: #f2f4f8;
            font-family: 'Roboto', sans-serif;
          }}
          .container {{
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
          }}
          .header {{
            background: linear-gradient(135deg, #FFA500, #FF4500);
            padding: 20px;
            text-align: center;
            color: #ffffff;
          }}
          .header h1 {{
            margin: 0;
            font-size: 28px;
            letter-spacing: 1px;
          }}
          .content {{
            padding: 30px;
            color: #555555;
          }}
          .content h2 {{
            color: #333333;
            margin-bottom: 20px;
          }}
          .details {{
            background-color: #f9f9f9;
            border-left: 4px solid #FFA500;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
          }}
          .details p {{
            margin: 8px 0;
            font-size: 16px;
          }}
          .button {{
            display: inline-block;
            padding: 12px 25px;
            margin-top: 20px;
            background-color: #FF4500;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 30px;
            font-size: 16px;
            transition: background-color 0.3s ease;
          }}
          .button:hover {{
            background-color: #e03e00;
          }}
          .footer {{
            background-color: #f2f4f8;
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #999999;
          }}
        </style>
      </head>
      <body>
        <div class="container">
          <div class="header">
            <h1>XFINITY</h1>
          </div>
          <div class="content">
            <h2>Pickup Confirmed!</h2>
            <p>Dear {name},</p>
            <p>Your pickup for the vehicle <strong>{brand} {model}</strong> (Registration: <strong>{vehicle_reg_no}</strong>) has been successfully scheduled. Please find the details below:</p>
            <div class="details">
              <p><strong>Issue:</strong> {original_prediction}</p>
              <p><strong>Pickup ID:</strong> {pickup_id}</p>
              <p><strong>Pickup Date:</strong> {pickup_date}</p>
              <p><strong>Pickup Time:</strong> {pickup_time}</p>
            </div>
            <p>If you have any questions or need further assistance, feel free to contact our support team.</p>
            <p style="text-align:center;">
              <a class="button" href="https://www.XFINITY.IN">Visit Our Website</a>
            </p>
            <p>Thank you for choosing Sterelx.ai!</p>
          </div>
          <div class="footer">
            &copy; {name} {brand} {model} - XFINITY. All rights reserved.
          </div>
        </div>
      </body>
    </html>
    """
    
    # Create MIME message with HTML content
    mime_message = MIMEText(body, "html")
    mime_message['To'] = email
    mime_message['Subject'] = subject
    mime_message['From'] = "XFINITY <sulthanlatheef0@gmail.com>"
    
    # Encode the message in base64 URL-safe format
    raw_message = base64.urlsafe_b64encode(mime_message.as_bytes()).decode()
    
    # Get credentials and build the Gmail API service
    creds = get_credentials()
    service = build('gmail', 'v1', credentials=creds)
    
    # Send the email
    send_email(service, {'raw': raw_message})

if __name__ == '__main__':
    main()
