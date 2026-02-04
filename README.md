# 🚖 Ride Booking API

A Laravel-based **Ride Booking Backend Application** built as part of a technical assessment.

This project provides a simple ride-booking flow used by a mobile application, along with a **Blade-based Admin Panel** to monitor and manage rides.

---

## 📌 Overview

The system supports:

- Passengers creating ride requests
- Drivers discovering nearby rides and requesting them
- Passenger approval of drivers
- Dual ride completion logic
- Admin viewing all rides via a web-based panel

---

## ✨ Features

- Passenger ride creation
- Driver nearby ride discovery (radius-based)
- Driver ride request / claim
- Passenger approval of driver
- Ride completion only when both passenger and driver confirm
- Admin panel using Blade templates
- JSON-based REST APIs
- No frontend framework
- No authentication (logic-restricted as per assessment)

---

## 🛠 Tech Stack

- Laravel Framework
- MySQL Database
- Blade Templates
- REST APIs (JSON responses)

---

## 📂 Project Installation

### 1️⃣ Clone Repository

```bash
git clone https://github.com/imtiyaj-php-backend-developer/RideBooking.git

2️⃣ Install Dependencies
composer install

3️⃣ Environment Configuration
cp .env.example .env

Update database credentials in .env:

DB_DATABASE=ride_booking
DB_USERNAME=root
DB_PASSWORD=

4️⃣ Database Migration & Seeder
php artisan migrate --seed


Seeder will create:

✅ 1 Admin

✅ Multiple Passengers

✅ Multiple Drivers

5️⃣ Run Application
php artisan serve


Application URL:

http://127.0.0.1:8000/admin/rides

## 📬 API Collection (Postman)

A complete Postman collection is included in this repository.

📁 Location: postman/RideBooking.postman_collection

### How to use:
1. Open Postman
2. Click **Import**
3. Select the JSON file from `/postman`
4. Set environment variables:
   - `base_url = http://127.0.0.1:8000/api`
