🚗 FullStack Automobile Service & Diagnostics Web App
=====================================================

A **modern, AI-powered web application** that combines automobile **damage detection**
with a full-featured **service management system**. Users can upload images of their
vehicles, detect visible damages automatically, and get real-time service estimates — all in one place! ⚙️🧠

✨ Key Features
--------------

🔍 **AI-Based Damage Detection**

- Upload vehicle images to detect:
  - 🚙 Bumper dents
  - ✨ Scratches
  - 🔍 Glass cracks
  - 💡 Headlight issues

- Powered by a **YOLOv5 deep learning model** and OpenCV.

🧾 **Dynamic Service Estimates**

- Generates a detailed repair invoice based on:
  - ✅ Damage detection results
  - 🚗 Selected car brand and model

🧑‍💻 **FullStack Functionality**

- Backend: PHP + CodeIgniter
- Frontend: Clean HTML/CSS/JS design

🖥️ **User-Friendly Interface**

- Book repair services
- Select vehicle brand/model
- View repair diagnostics and cost estimates

🚀 **Future-Ready Architecture**

- Designed to integrate:
  - 💳 Payment gateways
  - 📅 Appointment scheduling
  - 🧠 Advanced AI diagnostics

🧰 Tech Stack
-------------

+----------------+----------------------------------------+
| 🧱 Layer       | 🧪 Technologies                         |
+================+========================================+
| Backend        | PHP, CodeIgniter 3.1.14                |
+----------------+----------------------------------------+
| Frontend       | HTML, CSS, JavaScript                  |
+----------------+----------------------------------------+
| AI/ML Module   | Python, YOLOv5, OpenCV                 |
+----------------+----------------------------------------+
| Database       | MySQL                                  |
+----------------+----------------------------------------+
| Server         | Apache / Localhost (cloud deployable)  |
+----------------+----------------------------------------+

⚙️ Installation & Setup
------------------------

1️⃣ **Clone the Repository**

::

   git clone https://github.com/sulthanlatheef/Xfinity_Render.git
   cd Xfinity_Render

2️⃣ **Install Python Dependencies for AI Module**

::

   pip install -r requirements.txt

3️⃣ **Configure the Database**

Edit your DB credentials in:

::

   application/config/database.php

4️⃣ **Run the Application**

- Start your Apache server (e.g., XAMPP/MAMP)
- Access via `localhost` or deploy to a cloud provider

🖼️ Screenshots (Optional)
--------------------------

.. image:: screenshots/homepage.png
   :alt: Homepage UI
   :align: center

.. image:: screenshots/detection_result.png
   :alt: AI Damage Detection
   :align: center

💡 Tip: Make sure screenshots are added to the `screenshots/` folder.

🤝 Contributions & Feedback
----------------------------

We welcome your contributions! 🙌

- ⭐ Star this repo
- 🍴 Fork and contribute
- 🐛 Report bugs or suggest features via Issues or Pull Requests

📄 License
----------

This project is licensed under the **MIT License**.  
See the ``LICENSE`` file for details.

