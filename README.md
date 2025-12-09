**Academate**

**Overview**:
- **Project**: Academate — a simple PHP-based e-learning portal for managing streams, semesters, subjects, topics and learning materials.
- **Stack**: PHP (procedural), MySQL, plain HTML/CSS (no frontend framework). Designed to run on a local XAMPP (Apache + MySQL) setup.

**Features**:
- **User registration & login**: Basic authentication under `auth/`.
- **Admin panel**: Admin pages under `admin/` with management views for streams, subjects, topics and materials.
- **Content pages**: Student-facing pages in `pages/` showing available subjects and topics.

**Requirements**:
- **XAMPP** (or other Apache + PHP + MySQL stack)
- **PHP 7.0+** (or compatible)
- **MySQL / MariaDB**

**Quick Start (Windows, XAMPP)**
- 1. Copy the repository to your XAMPP `htdocs` directory (example path):
  - `C:\xampp\htdocs\Academate`
- 2. Start Apache and MySQL from the XAMPP Control Panel.
- 3. Import the database schema `elearning_portal.sql`:
  - Using phpMyAdmin: open `http://localhost/phpmyadmin`, create a database named `elearning_portal`, then import `elearning_portal.sql`.
  - Using the MySQL CLI (XAMPP):
    - Open PowerShell and run:
      `C:\xampp\mysql\bin\mysql.exe -u root -p elearning_portal < elearning_portal.sql`
    - Press Enter at the password prompt if your MySQL root password is blank (default XAMPP).
- 4. Open the app in your browser:
  - `http://localhost/Academate/` (adjust the path if you used a different folder name).

**Default Database Configuration**
- The DB connection is configured in `includes/db.php`.
- Default values (for XAMPP):
  - Host: `localhost`
  - User: `root`
  - Password: `` (empty)
  - Database: `elearning_portal`
- If you change DB credentials, update `includes/db.php` accordingly.

**Default Admin Credentials (local/dev only)**
- The admin login page (`admin/login.php`) uses demo credentials by default (replace with a proper DB-driven auth for production):
  - **Username**: `admin`
  - **Password**: `admin123`

**Project Structure (important files)**
- `elearning_portal.sql`: Database schema + sample data to import.
- `index.php`: Entry landing page.
- `admin/`: Admin-facing pages (login, dashboard, management views).
- `auth/`: Registration/login/logout for users.
- `includes/`:
  - `db.php`: Database connection file.
  - `header.php`, `footer.php`: Shared layout parts.
  - `admin_check.php`, `auth_check.php`: Access control helpers.
- `assets/style.css`: Main stylesheet.
- `pages/`: Student-facing views (dashboard, subjects, topics, etc.).

**Usage Notes & Next Steps**
- This project uses simple procedural PHP and minimal validation — intended as a learning/demo app. For production usage you should:
  - Implement database-backed user/auth management (do not use hard-coded credentials).
  - Use prepared statements or an ORM to prevent SQL injection.
  - Add proper input validation, password hashing, and session protections.
  - Move configuration values (e.g., DB credentials) to environment variables or a configuration file not committed to source control.

**Troubleshooting**
- If you see DB connection errors:
  - Ensure MySQL service is running in XAMPP.
  - Verify `includes/db.php` values match your MySQL setup.
  - Confirm the `elearning_portal` database exists.
- If styling looks broken:
  - Ensure `assets/style.css` is reachable and the app is served from the expected folder (`/Academate/`).

**Contributing**
- Feel free to open issues or submit PRs to improve structure, security, and features. For small fixes, update the relevant file and include a short description of the change.

**License & Contact**
- No license file is included. Add a `LICENSE` if you want to specify reuse terms.
- For questions, contact the repository owner or create an issue in the repo.

---
Created for local development and learning. Replace demo settings before using in production.
