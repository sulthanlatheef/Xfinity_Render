import os
os.chdir(r'C:\wamp64\www\XFINITY\assets\python')
import sys
import base64
from google.auth.transport.requests import Request
from google.oauth2.credentials import Credentials
from google_auth_oauthlib.flow import InstalledAppFlow
from googleapiclient.discovery import build
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

# Usage check
# argv[1]: recipient email
# argv[2]: customer name
# argv[3]: pickup ID
if len(sys.argv) != 4:
    print("Usage: python send_completion_email.py <email> <name> <pickup_id>")
    sys.exit(1)

recipient_email = sys.argv[1]
customer_name   = sys.argv[2]
pickup_id       = sys.argv[3]

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
    # Build MIME container
    message = MIMEMultipart()
    message['To']      = recipient_email
    message['From']    = "XFINITY <sulthanlatheef0@gmail.com>"
    message['Subject'] = f"Service Completed – Appointment #{pickup_id}"

    # HTML email body
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
            <p>Your vehicle service (Appointment ID: <strong>{pickup_id}</strong>) is now complete and ready for pickup.</p>
            <p>Thank you for choosing XFINITY—your satisfaction is our top priority!</p>
            <p>If you have any questions, simply reply to this email or contact us at 
               <a href="mailto:support@xfinity.in">support@xfinity.in</a>.</p>
            <a href="https://www.xfinity.in" class="cta">Visit Our Website</a>
          </div>
          <div class="footer">
            © 2025 XFINITY. All rights reserved.
          </div>
        </div>
      </body>
    </html>
    """

    message.attach(MIMEText(html_body, 'html'))
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
