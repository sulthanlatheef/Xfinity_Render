FullStack Automobile Service & Diagnostics Web App
==================================================

A **modern, AI-powered web application** that combines **automobile damage detection**
with a **comprehensive service management system**. Users can upload images of their
vehicles, detect external damages, and instantly receive a detailed service estimate — all in one place.

Key Features
------------

- **AI-Based Damage Detection**

  Upload images of your vehicle to detect:
  
  - Bumper dents
  - Scratches
  - Glass cracks
  - Headlight issues

  Powered by a **YOLOv5-based deep learning model**.

- **Dynamic Service Estimates**

  Generates detailed invoices based on:
  
  - Detected damages
  - Selected vehicle brand and model

- **FullStack Web Functionality**

  Developed with a **CodeIgniter (PHP)** backend and modern frontend stack.

- **User-Friendly Interface**

  Allows:
  
  - Booking services
  - Selecting vehicle make/model
  - Viewing damage reports and repair cost estimates

- **Future-Ready Architecture**

  Designed for easy integration of:
  
  - Payment gateways
  - Appointment scheduling
  - Advanced diagnostics

Tech Stack
----------

+----------------+--------------------------------------+
| Layer          | Technologies                         |
+================+======================================+
| Backend        | PHP, CodeIgniter 3.1.14              |
+----------------+--------------------------------------+
| Frontend       | HTML, CSS, JavaScript                |
+----------------+--------------------------------------+
| AI/ML Module   | Python, YOLOv5, OpenCV               |
+----------------+--------------------------------------+
| Database       | MySQL                                |
+----------------+--------------------------------------+
| Server         | Apache / Localhost (Cloud-Ready)     |
+----------------+--------------------------------------+

Installation & Setup
---------------------

1. **Clone the Repository**

::

   git clone https://github.com/sulthanlatheef/Xfinity_Render.git
   cd Xfinity_Render

2. **Install Python Dependencies for AI Module**

::

   pip install -r requirements.txt

3. **Configure the Database**

Edit the file:

::

   application/config/database.php

Add your MySQL credentials.

4. **Run the Application**

- Start your Apache server (e.g., XAMPP, MAMP, etc.)
- Access the project via `localhost` or deploy it to your preferred cloud provider.

Screenshots *(Optional)*
-------------------------

Add screenshots to showcase:

- Homepage UI
- AI Detection Results
- Service Estimate Page

You can add images like:

.. image:: screenshots/homepage.png
   :alt: Homepage

.. image:: screenshots/detection_result.png
   :alt: Damage Detection Result

Contributions & Feedback
-------------------------

Have suggestions or want to contribute?

- Fork the repository
- Submit a Pull Request
- Open an Issue for bugs or feature requests

License
-------

This project is licensed under the MIT License. See the ``LICENSE`` file for more details.
