# 📬 Contact Us API - Laravel Backend

This is a simple contact form backend built with Laravel. It supports sending messages, viewing submitted contacts in an admin panel, and replying to messages via email (Mailtrap).

---

## 🚀 Features

- Contact form submission (with email notification)
- Save contact messages to database
- Admin panel to view, filter, and delete messages
- Reply to messages via email (Mailtrap)
- RESTful API design
- JSON request & response

---

## 🛠️ Tech Stack

- PHP 8.x
- Laravel 12.x
- MySQL / PostgreSQL
- Mailtrap for email testing

---

## ⚙️ Requirements

- PHP >= 8.1
- Composer
- MySQL or PostgreSQL
- Node.js & npm (for frontend, optional)
- Mailtrap account (for email testing)

---

## 📦 Installation

1. **Clone the repository**

```bash
1. git clone https://github.com/your-username/contact-us-backend.git
 cd contact-us-backend

2. **Install dependencies**
composer install

3. Copy environment file
4. Set up .env
APP_NAME=ContactUs
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="ContactUs Support"

5. Generate app key
php artisan key:generate

6. Run migrations
php artisan migrate

7. Run seeders for admin access
php artisan db:seed

8. Run the server
php artisan serve
