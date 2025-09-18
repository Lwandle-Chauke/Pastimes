# Pastimes 

## Overview

The **Pastimes** website is an online platform for buying and selling second-hand branded clothing.

* **Buyers** can browse, purchase items, and manage shopping carts.
* **Admins** can manage users, products, and orders through a secure dashboard.

---

## Buyer Page

The Buyer Page is designed for customers who want to purchase clothing from the website.

### Key Features

* **Product Browsing** – Browse items by category: Women, Men, Kids, Accessories, Shoes.
* **Search & Filters** – Search by category, price range, or size.
* **Add to Cart** – Select and store items in a shopping cart.
* **Cart Summary** – View items, quantities, and total price.
* **Checkout** – Enter shipping details, payment method, and confirm orders.
* **Order Confirmation** – Receive an order confirmation with details (Order Number, Session ID).

### Components

1. **Product Listings**

   * Dynamic display using data from `tblclothes`.
   * Grid layout with images, prices, sizes.

2. **Cart Functionality**

   * Add/remove items.
   * Automatic updates to totals.

3. **Checkout Form**

   * Billing details, shipping address, payment method.
   * Orders saved in `tblorders`.

4. **Order Confirmation**

   * Displays confirmation message + order details.

### Page Flow

1. Browse → 2. Add to Cart → 3. View Cart → 4. Checkout → 5. Confirmation

---

## Admin Page

The Admin Page provides tools for administrators to manage users, products, and orders.

### Key Features

* **User Management** – View/edit users (`tblUser`), manage roles (Admin, Seller, Buyer), deactivate accounts.
* **Product Management** – Add, edit, delete items (`tblclothes`).
* **Order Management** – View/update orders (`tblorders`).
* **Category Management** – Update product categories.
* **Reports** – Generate sales and activity reports.
* **Messages** – Send/receive messages with buyers and sellers.

### Components

1. **User Management** – Full control over users and roles.
2. **Product Management** – Add/edit/remove product listings.
3. **Order Management** – View orders, update status (Pending, Shipped, Delivered).
4. **Messages** – Communication tool between admins, buyers, sellers.

### Page Flow

1. Login → 2. Dashboard → 3. Manage Users → 4. Manage Products → 5. Manage Orders → 6. Messages

---

## Technical Details

### Database Schema

* **Users Table (`tblUser`)** – Stores user info (name, email, hashed password, role).
* **Products Table (`tblclothes`)** – Stores product details (name, price, category, description).
* **Orders Table (`tblorders`)** – Stores order info (total, shipping, payment).
* **Order Items Table (`tblorder_items`)** – Stores detailed info about ordered items.

### Back-End Functionality

* **Buyer Side** – Product fetching (PHP + MySQL), session-based cart, checkout stored in `tblorders` and `tblorder_items`.
* **Admin Side** – Role-based access, database CRUD for products/users, order management.

### Front-End Components

* **HTML** – Page structure.
* **CSS** – Styling (forms, buttons, grids).
* **JavaScript** – Interactivity (cart updates, totals).

---

## Setup & Installation

1. Clone this repository:

   ```bash
   git clone <repo-url>
   ```
2. Set up a local server (WAMP/XAMPP).
3. Import SQL file to create tables (`tblUser`, `tblclothes`, `tblorders`).
4. Update database connection details in PHP files.
5. Run the website on your local server.

---

## Conclusion

The **Pastimes Website** delivers a smooth shopping experience for buyers and efficient management tools for administrators. This README serves as a guide to the system’s features, technical setup, and workflow.
