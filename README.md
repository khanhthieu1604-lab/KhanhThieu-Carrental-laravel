# 🚗 Thiuu Car Rental  
**Full-stack Web Application | Laravel**

Thiuu Car Rental is a full-stack web application built with **Laravel**, designed to simulate a real-world car rental management system.  
The project demonstrates practical backend development skills, clean MVC architecture, and common business workflows used in production systems.

---

## 🔍 Project Overview

The system allows users to browse available vehicles and create rental orders, while administrators can manage vehicles, categories, users, and rental data.

This project focuses on **functionality, architecture, and code organization**, rather than UI-heavy design, making it suitable as a **portfolio project for backend / full-stack roles**.

---

## 🎯 What This Project Demonstrates

- Laravel MVC architecture in a real project
- Clean separation of Controller, Model, and View
- CRUD operations with relational data
- Authentication and basic role-based access (Admin / User)
- Image upload and storage handling
- Practical Git workflow and project structure
- Database design with migrations and seeders

---

## ✨ Features

### User Features
- Register and login
- Browse vehicle listings
- View vehicle details
- Create rental orders
- Manage personal profile

### Admin Features
- Vehicle management (Create / Update / Delete)
- Category management
- Rental order management
- User management
- Basic system overview

---

## 🧠 Architecture

- **Framework**: Laravel
- **Pattern**: MVC (Model – View – Controller)
- **Routing**: REST-style routes (`routes/web.php`)
- **Views**: Blade Template Engine
- **Storage**: Laravel Storage (public disk)

Flow overview:

Request → Route → Controller → Model → Database  
                             → Blade View

---

## 🧱 Tech Stack

| Layer | Technology |
|-----|-----------|
| Backend | Laravel |
| Frontend | Blade, TailwindCSS |
| Database | MySQL |
| Language | PHP |
| Version Control | Git, GitHub |

---

## 📁 Project Structure (Simplified)

app/  
 ├── Http/Controllers  
 ├── Models  
routes/  
 └── web.php  
resources/  
 └── views  
database/  
 ├── migrations  
 └── seeders  
storage/  
public/

---

## ⚙️ Installation & Run Locally

### Requirements
- PHP >= 8.1
- Composer
- MySQL

### Steps

git clone https://github.com/khanhthieu1604-lab/Thiuu.git  
cd Thiuu  
composer install  
cp .env.example .env  
php artisan key:generate  

Configure database in `.env`:

DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=thiuu_carrental  
DB_USERNAME=root  
DB_PASSWORD=  

Run migrations and start server:

php artisan migrate  
php artisan storage:link  
php artisan serve  

Access the application at:

http://127.0.0.1:8000

---

## 🖼️ Image Handling

- Uploaded images are stored in `storage/app/public`
- Public access via `public/storage`
- Designed to be migrated to AWS S3 / Cloudinary / CDN

---

## 🚧 Known Limitations

- No online payment gateway
- No advanced permission system
- UI is functional-focused

---

## 🚀 Planned Improvements

- Online payment integration
- Role & permission management
- Vehicle availability calendar
- REST API for mobile application
- Dockerized deployment

---

## 👨‍💻 Author

**Lương Khánh Thiệu**  
Full-stack / Backend Developer (Laravel)  

GitHub: https://github.com/khanhthieu1604-lab

---

## 📄 License

This project is intended for learning, portfolio, and demonstration purposes.
