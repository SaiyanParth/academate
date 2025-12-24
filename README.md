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

Open:

http://localhost/phpmyadmin


Create database:

academate

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