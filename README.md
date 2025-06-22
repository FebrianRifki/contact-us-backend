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

1. Clone the repository: `git clone https://github.com/your-username/contact-us-backend.git && cd contact-us-backend`
2. Install dependencies: `composer install`
3. Copy environment file: `cp .env.example .env`
4. Edit `.env` and configure your database and Mailtrap (or other SMTP settings)
5. Generate application key: `php artisan key:generate`
6. Run database migrations: `php artisan migrate`
7. Seed admin data: `php artisan db:seed`
8. Start the development server: `php artisan serve`

