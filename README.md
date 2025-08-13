
````md
# ✝️ DevineUI – Church CRM (TALL Stack) [BETA] 🚧

[![Project Status: Beta](https://img.shields.io/badge/status-beta-orange?style=for-the-badge)](https://github.com/davidchemwetich/devineui)
[![PHP Version](https://img.shields.io/badge/PHP-8.4-blue?style=for-the-badge&logo=php)](https://www.php.net/)
[![Laravel Version](https://img.shields.io/badge/Laravel-12-red?style=for-the-badge&logo=laravel)](https://laravel.com/)

> ⚠️ **Beta Notice:** This project is still under active development.  
> Fully functional core modules are ready, but advanced features are still in progress.  
> Not recommended for production use (yet).

---

🚀 **DevineUI** is a **modern, responsive Church CRM** built with the **TALL Stack**  
(**Tailwind CSS**, **Alpine.js**, **Laravel**, **Livewire**) for managing members, attendance, donations, and events — running with **Docker Sail** 🐳

---

## ✅ Completed Features

- 🔐 **Authentication & Roles**
- 👥 **Member Management (CRUD)**
- 📅 **Events & Calendar**
- ✅ **Attendance Tracking**
- 💰 **Donation Module**

---

## 🚧 In Development

- 📊 **Reports & Analytics**
- 💳 **Donation Payment Gateway Integrations**
- 📱 **Mobile App Version** (Flutter planned)

---

## 🛠️ Tech Stack

- **PHP 8.4**
- **Laravel 12**
- **Livewire** – Real-time interactivity
- **Alpine.js** – Lightweight JS framework
- **Tailwind CSS** – Modern UI styling
- **MySQL** – Database
- **Docker Sail** – Local development environment

---

## 🐳 Installation (Docker Sail)

### 1️⃣ Clone the Repository
```bash
git clone https://github.com/davidchemwetich/devineui.git
cd devineui
````

### 2️⃣ Install Dependencies

```bash
composer install
npm install
```

### 3️⃣ Copy `.env` & Set App Key

```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database & mail settings.

### 4️⃣ Start Docker Sail

```bash
./vendor/bin/sail up -d
```

(Optional alias for convenience):

```bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

### 5️⃣ Run Migrations & Seed Data

```bash
sail artisan migrate --seed
```

### 6️⃣ Build Frontend Assets

```bash
sail npm run dev
```

### 7️⃣ Access the App

Go to 👉 **[http://localhost](http://localhost)**
(Default credentials will be in the database seed.)

---

## 📌 Roadmap

* [x] Authentication & Roles
* [x] Member CRUD
* [x] Events & Calendar
* [x] Attendance Tracking
* [x] Donation Module
* [ ] Reports & Analytics
* [ ] Payment Gateway Integrations
* [ ] Mobile App

---

## 🤝 Contributing

Pull requests are welcome!
Since we’re still in **beta**, contributions can shape the future of DevineUI.

---

## 📜 License

This project is **MIT Licensed** – free to use, study, and modify.

---

## 🙏 Acknowledgements

* Built with ❤️ by [David Chemwetich](https://github.com/davidchemwetich)
* Powered by the **TALL Stack** 🖤

```
---
```
