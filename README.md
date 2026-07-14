<div align="center">

# Pastimes

### A full-stack second-hand fashion e-commerce platform built with PHP, MySQL, HTML, CSS and JavaScript.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

**Author:** **Lwandle Chauke**

</div>

---

# Overview

**Pastimes** is a full-stack e-commerce platform designed for buying and selling second-hand branded clothing.

The platform provides a seamless shopping experience for customers while giving administrators a secure dashboard to manage products, users and orders.

The system supports product browsing, shopping cart functionality, checkout, order management and user administration through a responsive web interface backed by a MySQL database.

---

# Project Highlights

- Full-stack e-commerce platform
- Shopping cart and checkout system
- Role-based user management
- Product and inventory management
- Order management dashboard
- Sales reporting functionality
- MySQL relational database
- Responsive user interface
- Complete project demonstration

---

# Features

## Customer Portal

Customers can:

- Browse second-hand clothing
- Search products
- Filter by category, size and price
- Add items to a shopping cart
- Manage cart contents
- Complete the checkout process
- View order confirmation

---

## Administrator Portal

Administrators can:

- Manage users
- Manage products
- Update product categories
- View customer orders
- Update order statuses
- Generate reports
- Manage customer communications

---

# Tech Stack

## Frontend

- HTML5
- CSS3
- JavaScript

## Backend

- PHP

## Database

- MySQL

## Development Tools

- XAMPP / WAMP
- phpMyAdmin
- Visual Studio Code
- Git
- GitHub

---

# Customer Features

### Product Catalogue

Customers can browse products organised into multiple categories including:

- Women's Clothing
- Men's Clothing
- Children's Clothing
- Shoes
- Accessories

---

### Shopping Cart

The shopping cart allows customers to:

- Add products
- Remove products
- Update quantities
- View cart totals
- Continue shopping

---

### Checkout

Customers complete purchases by providing:

- Billing information
- Shipping details
- Payment method

Orders are stored securely in the database for processing.

---

### Order Confirmation

After checkout, customers receive confirmation including:

- Order Number
- Session ID
- Purchase Summary

---

# Administrator Features

### User Management

Administrators can:

- View users
- Edit user information
- Assign user roles
- Deactivate accounts

Supported roles include:

- Administrator
- Seller
- Buyer

---

### Product Management

Administrators can:

- Add products
- Edit products
- Delete products
- Update inventory
- Manage product categories

---

### Order Management

Orders can be:

- Reviewed
- Updated
- Processed
- Marked as:

- Pending
- Shipped
- Delivered

---

### Reporting

The system includes reporting functionality for monitoring:

- Sales
- Orders
- User activity

---

# Database Design

The application uses a relational MySQL database.

### Tables

**tblUser**

Stores:

- User information
- Login credentials
- User roles

---

**tblClothes**

Stores:

- Product information
- Categories
- Pricing
- Images
- Descriptions

---

**tblOrders**

Stores:

- Customer orders
- Shipping information
- Payment details

---

**tblOrder_Items**

Stores:

- Individual products linked to each order
- Product quantities
- Pricing

---

# System Workflow

### Customer Journey

```
Browse Products
        │
        ▼
Search & Filter
        │
        ▼
Add to Cart
        │
        ▼
Checkout
        │
        ▼
Order Confirmation
```

---

### Administrator Workflow

```
Login
    │
    ▼
Dashboard
    │
    ▼
Manage Products
    │
    ▼
Manage Orders
    │
    ▼
Generate Reports
```

---

# Repository Structure

```
pastimes/

├── admin/
├── customer/
├── css/
├── images/
├── includes/
├── js/
├── database/
│
├── README.md
└── .gitignore
```

---

# Running the Project

Clone the repository

```bash
git clone https://github.com/Lwandle-Chauke/pastimes.git
```

### Requirements

- PHP 8+
- MySQL
- Apache Server
- XAMPP or WAMP

### Installation

1. Clone the repository.
2. Place the project inside the **htdocs** directory.
3. Start Apache and MySQL.
4. Import the SQL database using phpMyAdmin.
5. Update the database connection details.
6. Open the project in your browser.

---

# Demo

A complete walkthrough of the application is available below.

**Google Drive**

https://drive.google.com/file/d/1KHlOpZil4siDrspNQkpLq0tC2PVSvRSN/view?usp=sharing

---

# What I Learned

This project strengthened my understanding of:

- Full-stack web development
- PHP application development
- MySQL database design
- Session management
- CRUD operations
- Relational databases
- User authentication
- Role-based access control
- E-commerce workflows
- Building responsive web applications

---

# Future Improvements

Planned enhancements include:

- Secure payment gateway integration
- Email notifications
- Wishlist functionality
- Product reviews and ratings
- Order tracking
- Image optimisation
- Advanced analytics dashboard
- Responsive mobile-first redesign
- REST API integration

---

# About Me

I'm **Lwandle Chauke**, a Computer Science graduate with interests in:

- Software Engineering
- Cybersecurity
- Full-Stack Development
- DevSecOps

I'm passionate about building secure, scalable applications while continuously expanding my knowledge of modern software development.

**GitHub**

https://github.com/Lwandle-Chauke

---

<div align="center">

If you found this project interesting, feel free to star the repository!

</div>
