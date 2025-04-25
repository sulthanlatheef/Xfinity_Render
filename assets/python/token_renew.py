import os
os.chdir(r'C:\wamp64\www\XFINITY\assets\python')
import sys
import base64
from google.auth.transport.requests import Request
from google.oauth2.credentials import Credentials
from google_auth_oauthlib.flow import InstalledAppFlow
from googleapiclient.discovery import build
from email.mime.text import MIMEText

# Get arguments from PHP
email = sys.argv[2]

amount = sys.argv[1]



# Gmail API Scopes
SCOPES = ['https://www.googleapis.com/auth/gmail.send']

def get_credentials():
    creds = None
    # Load existing token
    if os.path.exists('token.json'):
        creds = Credentials.from_authorized_user_file('token.json', SCOPES)
    
    # If no valid credentials, authenticate
    if not creds or not creds.valid:
        if creds and creds.expired and creds.refresh_token:
            creds.refresh(Request())
        else:
            flow = InstalledAppFlow.from_client_secrets_file('credentials.json', SCOPES)
            creds = flow.run_local_server(port=0)
        # Save credentials for future use
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
    subject = "Payment Confirmation - Xfinity"
    
    # Updated HTML email with key values in the message highlighted in red,
    # while values in the transaction details table remain black.
    body = f"""
    <html>
      <head>
        <meta charset="UTF-8">
        <title>Payment Confirmation</title>
        <style>
          body {{
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            font-family: 'Arial', sans-serif;
          }}
          .container {{
            width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
          }}
          .header {{
            background: linear-gradient(135deg, #FF7043, #FF5722);
            padding: 30px;
            text-align: center;
          }}
          .header h1 {{
            color: #fff;
            font-size: 32px;
            margin: 0;
          }}
          .content {{
            padding: 40px 30px;
            text-align: left;
            color: #555;
          }}
          .content h2 {{
            color: #FF5722;
            font-size: 26px;
            margin-bottom: 20px;
            font-weight: normal;
            text-align: center;
          }}
          /* .highlight is used only in the message text */
          .highlight {{
            color: #e64a19;
            font-size: 16px;
            font-weight: bold;
          }}
          .details {{
            margin-top: 20px;
          }}
          /* Stylish Transaction Details Table */
          .details table {{
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 20px 0;
            border: 1px solid #ffe0b2;
            border-radius: 6px;
            overflow: hidden;
          }}
          .details th {{
            background-color: #FF5722;
            color: #fff;
            padding: 12px;
            font-size: 16px;
            text-align: left;
          }}
          .details td {{
            padding: 12px;
            font-size: 15px;
            border-bottom: 1px solid #ffe0b2;
            color: #000;  /* Ensure text in table cells is black */
          }}
          .details tr:last-child td {{
            border-bottom: none;
          }}
          .details tr:nth-child(even) {{
            background-color: #fff8f0;
          }}
          .note {{
            background-color: #fff3e0;
            padding: 15px;
            border-radius: 8px;
            margin-top: 30px;
            font-size: 14px;
            line-height: 1.5;
          }}
          .cta-button {{
            display: block;
            width: max-content;
            background-color: #FF5722;
            color: #fff;
            padding: 15px 40px;
            text-decoration: none;
            border-radius: 50px;
            font-size: 16px;
            text-align: center;
            margin: 30px auto 0;
            transition: background 0.3s ease;
          }}
          .cta-button:hover {{
            background-color: #e64a19;
          }}
          .footer {{
            background-color: #fff3e0;
            padding: 25px 20px;
            text-align: center;
            font-size: 14px;
            color: #888;
          }}
          .footer a {{
            color: #FF5722;
            text-decoration: none;
          }}
          .social-icons {{
            margin: 10px 0;
          }}
          .social-icons a {{
            text-decoration: none;
            margin: 0 5px;
            display: inline-block;
          }}
        </style>
      </head>
      <body>
        <div class="container">
          <!-- Header -->
          <div class="header">
            <h1>Xfinity</h1>
          </div>
          <!-- Content -->
          <div class="content">
            <h2>Payment Successful! 🎉</h2>
            <p>Dear Customer,</p>
            <p>
              Thank you for your payment. We are pleased to confirm that we have received your payment of 
              <strong class="highlight">₹{amount}</strong> for your service appointment (ID: 
              ). Your transaction has been processed successfully.
            </p>
           
            <div class="note">
              <p>
                If you have any questions about this transaction, or require further assistance regarding your appointment, please do not hesitate to reach out. Our team is available 24/7 to ensure your complete satisfaction.
              </p>
              <p>
                Please retain this email as your receipt for future reference.
              </p>
            </div>
            <a href="mailto:support@Xfinity" class="cta-button">Contact Support</a>
          </div>
          <!-- Footer -->
          <div class="footer">
            <p><strong>Stay Connected</strong></p>
            <div class="social-icons">
              <!-- Replace with your own social icon links or inline SVGs -->
              <a href="#"><img src="https://ci3.googleusercontent.com/meips/ADKq_NaNbH4fNcQ4rkeRRsYdIgEDIAUwye_ixttSSjodXH6JzHWLxVzjiFvhXAuY2N2RDx0vfjLWo911LFI_fVJSyBUeAmYhSdU0bCQd22ibAwSYOGKl43RBFMnhx3Q4VPTgQokPt9XxHgoQJd9UizCvxcQTvG5GwUSY=s0-d-e1-ft#https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/circle-color/youtube@2x.png"></a>
              <a href="#"><img src="https://ci3.googleusercontent.com/meips/ADKq_NbQsNMaIRKRK-CcqulA5aIcTaNS-PW3IbSaCh6_nblgxnrNvenXZtcr23NqW9SJxGcyUwsUOqIPufCBGMRWjeP5o3YqeGkdvKx-qOVCxhDgRPdCGCnR2nF08T7j2rhj0Qjlys2_cbSLujaPw8-A-61Hd3kKD80I=s0-d-e1-ft#https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/circle-color/twitter@2x.png" alt="Twitter"></a>
              <a href="#"><img src="https://ci3.googleusercontent.com/meips/ADKq_NYMXOawSxxF7p15K8URsrZuWzfXquzBfKn7PUxsFiBcL-laOhLzt6ANFeigHJTAY53t6Jisnk7sVCK2jdtHZ-0tWbkTq9OX_07SJbpv-32GhXjNLF05JmtmoH9cGvtufQ2Q6HqD3RTYeI_d1qYFBjziKXncy6Ew8ho=s0-d-e1-ft#https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/circle-color/instagram@2x.png"></a>
              <a href="#"><img src="https://ci3.googleusercontent.com/meips/ADKq_NZd3tGMVs1j_XR-0CWGvWHz8wu_6xZeGWU0QLZo7Ezcl9COsB7BvG8LCcSamA4rp_wHOqo53Ny7rj1_gOJjSJZVvndKYAorH5W0mhr303Q6PKy1Y-Rf6IwzqCtk5ZdQQME5blKaqNjsvLY3b1-deETDMCFbFOfflw=s0-d-e1-ft#https://app-rsrc.getbee.io/public/resources/social-networks-icon-sets/circle-color/linkedin@2x.png"></a>
            </div>
            <p>© {2025} Xfinity.All rights reserved.</p>
            <p><a href="https://www.Xfinity.in">Visit our website</a></p>
          </div>
        </div>
      </body>
    </html>
    """
    
    # Create MIME message in HTML format
    mime_message = MIMEText(body, "html")
    mime_message['To'] = email
    mime_message['Subject'] = subject
    mime_message['From'] = "XFINITY <sulthanlatheef0@gmail.com>"
    
    # Encode the MIME message
    raw_message = base64.urlsafe_b64encode(mime_message.as_bytes()).decode()
    
    # Get credentials and build the Gmail service
    creds = get_credentials()
    service = build('gmail', 'v1', credentials=creds)
    
    # Send the email
    send_email(service, {'raw': raw_message})

if __name__ == '__main__':
    main()
