import os
BASE_DIR = os.path.dirname(os.path.abspath(__file__))
os.chdir(BASE_DIR)
import sys
import base64
from dotenv import load_dotenv
from google.auth.transport.requests import Request
from google.oauth2.credentials import Credentials
from googleapiclient.discovery import build
from email.mime.text import MIMEText
load_dotenv(dotenv_path="../../.env")

# Get arguments from PHP (in order: pickup_id, name, email)
pickup_id = sys.argv[3]
recipient_name = sys.argv[2]
recipient_email = sys.argv[1]

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
def send_email(service, message):
    try:
        service.users().messages().send(userId='me', body=message).execute()
        print("Email sent successfully!")
    except Exception as e:
        print(f"Error sending email: {e}")

def main():
    subject = "Delivery Confirmation Of Your Vehicle – Xfinity Auto"
    body = f"""
    <html>
      <head>
        <meta charset="UTF-8">
        <style>
          @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

          body {{
            margin: 0;
            padding: 0;
            background-color: #f7f2ed;
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
          }}
          .wrapper {{
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
          }}
          /* Logo bar */
          .logo-bar {{
            background-color: #ff7e00;
            padding: 16px 24px;
            text-align: left;
          }}
          .logo-bar img {{
            height: 32px;
          }}
          /* Hero header */
          .hero {{
            background: linear-gradient(135deg, #ff4500, #ffae42);
            color: #fff;
            padding: 40px 24px;
            text-align: center;
          }}
          .hero h1 {{
            margin: 0 0 12px;
            font-size: 30px;
            font-weight: 600;
          }}
          .hero p {{
            margin: 0;
            font-size: 16px;
            font-weight: 300;
          }}
          /* Content */
          .content {{
            padding: 32px 24px;
          }}
          .content h2 {{
            font-size: 22px;
            font-weight: 500;
            color: #ff4500;
            margin-bottom: 16px;
          }}
          .content p {{
            margin: 16px 0;
            font-size: 15px;
            color: #333;
          }}
          .divider {{
            border-top: 1px solid #eee;
            margin: 24px 0;
          }}
          .details {{
            background-color: #fff4e6;
            border-radius: 6px;
            padding: 20px;
          }}
          .details-table {{
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
          }}
          .details-table td {{
            padding: 8px 0;
          }}
          .details-table td.label {{
            font-weight: 500;
            color: #e65c00;
            width: 35%;
          }}
          /* CTA button */
          .btn {{
            display: inline-block;
            padding: 14px 28px;
            background-color: #ff7e00;
            color: #ffffff;
            text-decoration: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 500;
            margin-top: 24px;
          }}
          .btn:hover {{
            background-color: #e65c00;
          }}
          /* Footer */
          .footer {{
            background-color: #f0e7de;
            padding: 24px;
            text-align: center;
            font-size: 13px;
            color: #777;
          }}
          .footer a {{
            color: #ff7e00;
            text-decoration: none;
            margin: 0 8px;
          }}
          .social-icons img {{
            width: 24px;
            margin: 0 6px;
            vertical-align: middle;
          }}
        </style>
      </head>
      <body>
        <div class="wrapper">
          <!-- Logo Bar -->
          <div class="logo-bar">
            <img src="https://www.xfinity-auto.com/assets/logo-white.png" alt="Xfinity Auto">
          </div>

          <!-- Hero Section -->
          <div class="hero">
            <h1>🎉 Delivery Confirmed!</h1>
            <p>Your vehicle is now in your hands.</p>
          </div>

          <!-- Main Content -->
          <div class="content">
            <h2>Hi {recipient_name},</h2>
            <p>We’re thrilled to let you know that your vehicle has been safely delivered. Below are your delivery details:</p>

            <!-- Details Card -->
            <div class="details">
              <table class="details-table">
                <tr>
                  <td class="label">🚗 Pickup ID:</td>
                  <td>{pickup_id}</td>
                </tr>
                <tr>
                  <td class="label">📅 Delivery Date:</td>
                  <td>{__import__('datetime').date.today().strftime('%B %d, %Y')}</td>
                </tr>
              </table>
            </div>

            <div class="divider"></div>

            <p>If you have any questions or need a hand, our support team is standing by 24/7.</p>
            <p style="text-align:center;">
              <a href="mailto:support@xfinity-auto.com" class="btn">Contact Support</a>
            </p>
          </div>

          <!-- Footer -->
          <div class="footer">
            <p>Thank you for choosing <strong>Xfinity Auto</strong>.</p>
            <p>
              <a href="https://www.xfinity-auto.com">Website</a> |
              <a href="https://www.xfinity-auto.com/terms">Terms</a> |
              <a href="https://www.xfinity-auto.com/privacy">Privacy</a>
            </p>
            <div class="social-icons">
              <a href="https://facebook.com/xfinity-auto"><img src="https://www.xfinity-auto.com/assets/icons/facebook.png" alt="Facebook"></a>
              <a href="https://twitter.com/xfinity-auto"><img src="https://www.xfinity-auto.com/assets/icons/twitter.png" alt="Twitter"></a>
              <a href="https://instagram.com/xfinity-auto"><img src="https://www.xfinity-auto.com/assets/icons/instagram.png" alt="Instagram"></a>
            </div>
            <p>© 2025 Xfinity Auto. All rights reserved.</p>
          </div>
        </div>
      </body>
    </html>
    """



    # Build and send the email
    mime_msg = MIMEText(body, 'html')
    mime_msg['To'] = recipient_email
    mime_msg['Subject'] = subject
    mime_msg['From'] = "XFINITY <sulthanlatheef0@gmail.com>"

    raw_msg = base64.urlsafe_b64encode(mime_msg.as_bytes()).decode()
    creds = get_credentials()
    service = build('gmail', 'v1', credentials=creds)
    send_email(service, {'raw': raw_msg})

if __name__ == '__main__':
    main()
