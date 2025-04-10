# COVID-vms

COVID-vms is a web-based application designed to manage COVID-19 vaccination processes efficiently. It facilitates the administration of vaccine centers, vaccinators, and user appointments, ensuring a streamlined vaccination experience.

## Features

- **Admin Panel**: Manage vaccine centers, vaccinators, and view reports.
- **Vaccinator Module**: View assigned appointments and update vaccination status.
- **User Module**: Register, book vaccination slots, and view vaccination history.

## Installation

### Prerequisites

- A web server (e.g., Apache, Nginx) with PHP and MySQL installed.
- PHP 7.4 or higher.
- MySQL 5.7 or higher.
- Composer (for dependency management, if applicable).

### Steps to Install

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/PrasannaGokul/COVID-vms.git
   ```

2. **Set Up the Environment**:
   - Place the cloned repository in your server's root directory (e.g., `htdocs` for XAMPP or `/var/www/html/` for Apache).

3. **Database Configuration**:
   - Create a database named `covid_vms`.
   - Import the provided SQL file (`database/covid_vms.sql`) to set up the necessary tables.
   - Update the database connection settings in `includes/config.php` with your database credentials:
     ```php
     define('DB_SERVER', 'localhost');
     define('DB_USERNAME', 'your_db_username');
     define('DB_PASSWORD', 'your_db_password');
     define('DB_NAME', 'covid_vms');
     ```

4. **Configure Apache (Optional, if needed)**:
   - Ensure `mod_rewrite` is enabled in Apache for clean URLs.
   - Restart Apache after making any configuration changes.

## Usage

### Admin Panel
- Access: `http://yourdomain/admin/login.php`
- Default Credentials:
  - Username: `admin`
  - Password: `admin123`
- *Change the default password after the first login.*

### Vaccinator Module
- Login: `http://yourdomain/vaccinator/login.php`
- Use credentials provided by the admin.

### User Module
- Register: `http://yourdomain/user/signup.php`
- Login: `http://yourdomain/user/login.php`
- Book vaccination slots and check appointment status.

## Folder Structure

- `admin/` - Admin panel files.
- `vaccinator/` - Vaccinator module files.
- `user/` - User module files.
- `includes/` - Configuration and helper files.
- `database/` - Database schema and migration files.
- `assets/` - CSS, JS, and images.
- `index.php` - Main entry point of the web application.

## License

This project is open-source and available under the [MIT License](LICENSE).

---

Enjoy using **COVID-vms** and stay safe.

