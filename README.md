🎓 Academate – PHP E-Learning Portal

A simple and lightweight PHP-based e-learning portal to manage academic content like streams, semesters, subjects, topics, and learning materials. Built for learning purposes using procedural PHP and a clean, minimal stack.

✨ Features

✅ User Registration & Login
✅ Admin Dashboard to Manage Content
✅ Student-Friendly Content Browsing
✅ Simple, Clean UI (Plain HTML + CSS)
✅ Runs Smoothly on XAMPP (Apache + MySQL)

🛠 Tech Stack

Backend: PHP (Procedural)

Database: MySQL / MariaDB

Frontend: HTML + CSS

Server: Apache (via XAMPP)

📦 Requirements

Make sure you have:

XAMPP / WAMP / MAMP installed

PHP 7.0+

MySQL / MariaDB

🚀 Quick Start Guide (Windows + XAMPP)
1️⃣ Move Project into htdocs
C:\xampp\htdocs\Academate

2️⃣ Start Services

Open XAMPP Control Panel and start:

✅ Apache

✅ MySQL

3️⃣ Import Database
Method A (phpMyAdmin)

Open:

http://localhost/phpmyadmin


Create database:

elearning_portal


Click Import → Select elearning_portal.sql

Method B (MySQL CLI)

Open PowerShell and run:

C:\xampp\mysql\bin\mysql.exe -u root -p elearning_portal < elearning_portal.sql


➡ Just press Enter if no password is set.

4️⃣ Open the Project

In your browser:

http://localhost/Academate/

🔐 Default Login Credentials (For Demo)
Admin Login
Field	Value
Username	admin
Password	admin123

⚠ Replace these in production.

⚙ Database Configuration

File:

includes/db.php


Default settings:

Host: localhost
User: root
Password: (empty)
Database: elearning_portal

📁 Project Structure
Academate/
index.php
admin/
   login.php
   dashboard.php
   streams.php
   subjects.php
   topics.php
   topic_details.php
   veiw_materials.php
auth/
   login.php
   register.php
   logout.php
includes/
   db.php
   header.php
   footer.php
   auth_check.php
   admin_check.php
assets/
   style.css
pages/
    subjects.php
    select_stream.php
    dashboard.php
    semesters.php
    topic_details.php
    topics.php

🔒 Recommended Improvements (For Production)

You should add:

✅ Prepared statements (SQL Injection protection)

✅ Password hashing (password_hash())

✅ Environment variables for DB credentials

✅ Better session security

✅ Input validation + sanitization

🛠 Troubleshooting

Database connection failed?

✔ Check MySQL service is running
✔ Verify includes/db.php credentials
✔ Ensure database exists

CSS not loading?

✔ Ensure assets/style.css path is correct

🤝 Contributing

Want to improve this project?

Fork the repository

Make your changes

Submit a Pull Request 🚀

📜 License

No license is currently added.
You can add one by creating a LICENSE file.

📬 Contact

For questions or suggestions, open an Issue or contact the repository owner.
