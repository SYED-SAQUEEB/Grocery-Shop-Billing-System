# 🛒 Grocery Shop Billing System

<div align="center">

![PHP](https://img.shields.io/badge/PHP-8.x-blue?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge&logo=mysql)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6-yellow?style=for-the-badge&logo=javascript)
![HTML5](https://img.shields.io/badge/HTML5-Markup-red?style=for-the-badge&logo=html5)
![CSS3](https://img.shields.io/badge/CSS3-Styling-blue?style=for-the-badge&logo=css3)

### Modern Grocery Shop Management & Billing Solution

A complete PHP & MySQL based billing system designed for grocery stores to manage customers, products, invoices, loyalty points, and sales records efficiently.

</div>

---

## 📌 Features

### 👥 Customer Management
- Add New Customers
- Edit Customer Details
- Delete Customers
- Customer Search
- Loyalty Points Tracking

### 📦 Product Management
- Add Products
- Update Product Details
- Delete Products
- Stock Management
- Product Search

### 🧾 Billing System
- Create Bills
- Generate Invoices
- Auto Calculate Total Amount
- Apply Customer Loyalty Points
- Store Billing History

### 🎯 Loyalty Program
- Earn Points on Purchases
- Redeem Available Points
- Automatic Point Calculation

### 📊 Dashboard
- Total Customers
- Total Products
- Total Bills
- Total Sales Overview

---

## 🛠️ Tech Stack

| Technology | Usage |
|------------|--------|
| PHP | Backend Development |
| MySQL | Database |
| HTML5 | Structure |
| CSS3 | Styling |
| JavaScript | Client-side Functionality |
| AJAX | Dynamic Requests |
| XAMPP | Local Development Server |

---

## 📂 Project Structure

```text
Grocery-Shop-Billing-System/
│
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
│
├── customers/
│
├── products/
│
├── bills/
│
├── includes/
│
├── db.example.php
│
├── database_structure.sql
│
├── index.php
│
└── README.md
```

---

## ⚙️ Installation

### 1️⃣ Clone Repository

```bash
git clone https://github.com/YOUR_USERNAME/Grocery-Shop-Billing-System.git
```

### 2️⃣ Move Project

Place the project inside:

```text
xampp/htdocs/
```

### 3️⃣ Create Database

Create a database named:

```sql
grocery_shop
```

### 4️⃣ Import Database

Import:

```text
database_structure.sql
```

### 5️⃣ Configure Database

Rename:

```text
db.example.php
```

to:

```text
db.php
```

Update your database credentials:

```php
$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "grocery_shop";
$port       = 3306;
```

### 6️⃣ Run Project

```text
http://localhost:8080/grocery_shop/
```

---

## 📸 Screenshots

### Dashboard
<img src="screenshots/dashboard.png" width="100%">

### Customer Management
<img src="screenshots/customers.png" width="100%">

### Billing Page
<img src="screenshots/billing.png" width="100%">

---

## 🔒 Security Notes

- Database credentials are excluded from the repository.
- Sensitive customer data is not included.
- Use environment-specific database configuration.

---

## 🚀 Future Improvements

- PDF Invoice Generation
- Sales Reports
- Inventory Alerts
- GST Integration
- User Authentication & Roles
- Email Invoice System

---

## 👨‍💻 Developer

### Syed Saqueeb

Software Developer | .NET Developer | PHP Developer

GitHub:
https://github.com/SYED-SAQUEEB

LinkedIn:
https://www.linkedin.com/in/syed-saqueeb085/

---

## ⭐ Support

If you found this project useful:

⭐ Star this repository

🍴 Fork the project

🤝 Contribute improvements

---

<div align="center">

Made with ❤️ by Syed Saqueeb

</div>
