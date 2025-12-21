import os
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
os.chdir(BASE_DIR)
import sys
import base64
from google.auth.transport.requests import Request
from google.oauth2.credentials import Credentials
from googleapiclient.discovery import build
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

# Usage check: argv[1]=recipient email, argv[2]=OTP
if len(sys.argv) != 3:
    print("Usage: python send_otp_email.py <email> <otp>")
    sys.exit(1)

recipient_email = sys.argv[1]
otp_code        = sys.argv[2]

# Gmail API scope
SCOPES = ['https://www.googleapis.com/auth/gmail.send']

def get_credentials():
    creds = None
    
    creds = Credentials(
    token=None,  # access token will be fetched
    refresh_token=os.getenv("GOOGLE_REFRESH_TOKEN"),
    token_uri=os.getenv("GOOGLE_TOKEN_URI"),
    client_id=os.getenv("GOOGLE_CLIENT_ID"),
    client_secret=os.getenv("GOOGLE_CLIENT_SECRET"),
    scopes=SCOPES
        )
    
    creds.refresh(Request())
    return creds

def create_message(email, otp):
    # Build MIME container
    message = MIMEMultipart()
    message['To']      = email
    message['From']    = "XFINITY <sulthanlatheef0@gmail.com>"
    message['Subject'] = "🔐 Your XFINITY Verification Code"

    # HTML email body
    html_body = f"""
    <html>
      <head>
        <meta charset="UTF-8">
        <style>
          body {{ font-family: 'Segoe UI', Tahoma, sans-serif; background-color: #fff8f0; margin:0; padding:0; }}
          .container {{ max-width:600px; margin:40px auto; background:#ffffff; padding:0; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.05); overflow:hidden; }}
          .header {{ text-align:center; padding:30px; background: #ff7500; color:#fff; }}
          .header h1 {{ margin:0; font-size:32px; letter-spacing:1px; }}
          .content {{ padding:30px; color: #555; line-height:1.6; text-align:left; }}
          .content p {{ margin:0 0 16px; }}
          .otp-box {{ display:flex; justify-content:center; align-items:center; margin:20px 0; }}
          .otp-code {{
            font-size:28px;
            font-weight:700;
            color:#FF7500;
            padding:15px 25px;
            background:#FFF3E0;
            border:2px dashed #FF8C00;
            border-radius:8px;
          }}
          .footer {{ font-size:12px; color:#888; text-align:center; padding:20px; background:#fff8f0; }}
        </style>
      </head>
      <body>
        <div class="container">
          <div class="header">
            <h1>Welcome to XFINITY!</h1>
          </div>
          <div class="content">
            <p>Hey there 👋,</p>
            <p>Thanks for choosing XFINITY. To complete your sign-up, just use the code below. It’s quick and keeps your account secure:</p>
            <div class="otp-box">
              <span class="otp-code">{otp}</span>
            </div>
            <p>This code <strong>expires in 10 minutes</strong>, so be sure to use it soon.</p>
            <p>If you didn’t request this, you can safely ignore this email.</p>
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
    msg = create_message(recipient_email, otp_code)
    try:
        service.users().messages().send(userId='me', body=msg).execute()
        print("OTP email sent successfully!")
    except Exception as e:
        print(f"Failed to send OTP email: {e}")

if __name__ == '__main__':
    send_email()
