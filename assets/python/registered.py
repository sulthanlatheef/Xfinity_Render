import os
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
os.chdir(BASE_DIR)
import sys
import base64
from google.auth.transport.requests import Request
from google.oauth2.credentials import Credentials
from google_auth_oauthlib.flow import InstalledAppFlow
from googleapiclient.discovery import build
from email.mime.multipart import MIMEMultipart
from email.mime.text import MIMEText

# Usage check: argv[1]=recipient email, argv[2]=recipient name, argv[3]=recipient username
if len(sys.argv) != 4:
    print("Usage: python send_registration_success_email.py <email> <name> <username>")
    sys.exit(1)

recipient_email    = sys.argv[1]
recipient_name     = sys.argv[2]
recipient_username = sys.argv[3]

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

def create_message(email: str, name: str, username: str):
    # Build MIME container
    message = MIMEMultipart()
    message['To']      = email
    message['From']    = "XFINITY <sulthanlatheef0@gmail.com>"
    message['Subject'] = f"Welcome to XFINITY, {name}!"

    # HTML email body with #ff7500 theme
    html_body = f"""
    <html>
      <head>
        <meta charset="UTF-8">
        <style>
          body {{
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: #fff8f0;
            margin: 0;
            padding: 0;
          }}
          .container {{
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
          }}
          .header {{
            text-align: center;
            padding: 30px;
            background: #ff7500;
            color: #ffffff;
          }}
          .header h1 {{
            margin: 0;
            font-size: 34px;
            letter-spacing: 1px;
          }}
          .logo {{
            margin-bottom: 12px;
          }}
          .content {{
            padding: 30px;
            color: #333333;
            line-height: 1.6;
            text-align: left;
          }}
          .content p {{
            margin: 0 0 18px;
          }}
          .button-container {{
            text-align: center;
            margin: 30px 0;
          }}
          .btn {{
            display: inline-block;
            padding: 14px 28px;
            font-size: 17px;
            font-weight: 600;
            color: #ffffff;
            background: #ff7500;
            text-decoration: none;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
          }}
          .btn:hover {{
            background: #e46000;
          }}
          .divider {{
            width: 100%;
            height: 1px;
            background: #ffe0cc;
            margin: 0;
            border: none;
          }}
          .footer {{
            font-size: 13px;
            color: #888888;
            text-align: center;
            padding: 20px;
            background: #fff8f0;
          }}
          .social-icons {{
            margin-top: 16px;
          }}
          .social-icons img {{
            width: 30px;
            margin: 0 8px;
            vertical-align: middle;
          }}
        </style>
      </head>
      <body>
        <div class="container">
          <!-- Header with optional logo -->
          <div class="header">
            <!-- You can replace this text with an <img> tag for your logo, e.g. <img src="https://example.com/logo.png" class="logo" alt="XFINITY Logo"> -->
            <h1>Welcome to XFINITY!</h1>
          </div>

          <!-- Content Section -->
          <div class="content">
            <p>Hi <strong>{name}</strong>,</p>
            <p><strong>Congratulations!</strong> Your XFINITY account has been successfully created. We’re thrilled to have you on board and can’t wait for you to explore all the features we offer.</p>
            <p>
              You can now log in using  your username: <strong style="color:#ff7500">{username}</strong> and start enjoying:

         
           </p>
            <ul>
              <li>🚀 Seamless access to our services</li>
              <li>🔧 Advanced diagnostics and repair</li>
              <li>💬 24/7 customer support whenever you need it</li>
            </ul>
            
            <p>Need help getting started? Check out our <a href="https://www.xfinity.com/support" style="color:#ff7500; text-decoration:none;">Help Center</a> or reply to this email and our support team will assist you right away.</p>
            <p>Once again, welcome to the XFINITY family!</p>
          </div>

          <hr class="divider">

          <!-- Footer Section -->
          <div class="footer">
            <p>Stay connected:</p>
            <div class="social-icons">
              <a href="https://www.facebook.com/xfinity">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/05/Facebook_Logo_%282019%29.png/1200px-Facebook_Logo_%282019%29.png" alt="Facebook">
              </a>
             
              <a href="https://www.instagram.com/xfinity">
                <img src="data:image/jpeg;base64,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" alt="Instagram">
              </a>
            </div>
            <p>© 2025 XFINITY. All rights reserved.</p>
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
    msg = create_message(recipient_email, recipient_name, recipient_username)
    try:
        service.users().messages().send(userId='me', body=msg).execute()
        print("Registration success email sent successfully!")
    except Exception as e:
        print(f"Failed to send registration success email: {e}")

if __name__ == '__main__':
    send_email()
