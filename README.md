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

1. Clone repo: `git clone https://github.com/your-username/contact-us-backend.git && cd contact-us-backend`
2. Install dependencies: `composer install`
3. Copy `.env`: `cp .env.example .env`
4. Edit `.env` dan sesuaikan konfigurasi DB dan Mailtrap
5. Generate key: `php artisan key:generate`
6. Jalankan migrasi: `php artisan migrate`
7. (Opsional) Seed admin: `php artisan db:seed`
8. Start server: `php artisan serve`
