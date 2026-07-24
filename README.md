# Fontis Fine Dine

Fontis Fine Dine is a food ordering website developed as part of our Work Integrated Learning (WIL) project for the Diploma in IT Software Development.

The project was developed by:

* Shaun Makhobo
* Kamogelo Seilane
* Masoma Pauline

The purpose of the system is to provide customers with an easy and convenient way to browse menu items, add products to their cart, and place orders online. Once an order has been placed, the system generates a WhatsApp order confirmation message that allows customers to communicate directly with the restaurant. The system also includes an administrative dashboard that enables administrators to manage products, customer orders, users, and contact messages.

## Project Overview

Fontis Fine Dine was designed to digitise and simplify the restaurant ordering process. The website allows customers to:

* Browse menu items as guests.
* Register and log into their accounts.
* Add products to their shopping cart.
* Place food orders online.
* View their order history.
* Contact the restaurant through the contact page.

Administrators are able to:

* Add, update, and delete menu items.
* View and manage customer orders.
* Manage registered users.
* View customer enquiries submitted through the contact page.
* Monitor activity through the admin dashboard.

## Technologies Used

The project was developed using technologies that align with the skills gained throughout the Diploma programme.

### Front-End

* HTML5
* CSS3
* JavaScript
* Font Awesome Icons

### Back-End

* PHP
* MySQL
* mysqli

### Development Tools

* Visual Studio Code
* WAMP Server
* phpMyAdmin
* GitHub
* InfinityFree (Web Hosting)

## Why These Technologies Were Chosen

PHP and MySQL were selected because they provide a simple and reliable way of developing dynamic database-driven web applications. The technologies are easy to deploy on free hosting platforms and are well suited for student projects that focus on demonstrating back-end development concepts.

The project was intentionally developed without using external frameworks so that all functionality could be implemented manually. This allowed us to demonstrate our understanding of:

* Authentication and session management
* CRUD operations
* Database design
* Form handling and validation
* User role management
* Website deployment and hosting

## Key Features

### Guest Mode

Users are able to browse the website without creating an account. Guests can:

* View the homepage
* Browse the menu
* Read the About page
* Contact the restaurant

Guests are not allowed to:

* Add products to the cart
* Place orders
* Access their order history
* Access the admin dashboard

This approach was chosen to improve user experience by allowing customers to explore the website before deciding to register.

### User Authentication

Registered users can:

* Register an account
* Log into the website securely
* View their cart
* Place orders
* View previous orders

Passwords are securely stored using PHP's:

* `password_hash()`
* `password_verify()`

Prepared statements are also used during login to reduce the risk of SQL injection attacks.

### Shopping Cart System

The cart system allows users to:

* Add menu items
* Update quantities
* Remove products
* View order totals
* Proceed to checkout

All cart items are linked to the authenticated user's account through their `user_id`.

### WhatsApp Order Confirmation

After placing an order, the system:

1. Stores the order in the database.
2. Generates an order summary.
3. Creates a WhatsApp message containing:

   * Customer name
   * Phone number
   * Payment method
   * Products ordered
   * Total price
   * Date of the order

The customer is then redirected to WhatsApp where they can send the order confirmation directly to the restaurant.

WhatsApp integration was selected because it is commonly used by many small businesses in South Africa and removes the need for implementing a payment gateway for this academic project.

### Admin Dashboard

Administrative accounts are completely separated from customer accounts.

The dashboard allows administrators to:

* Manage products
* Manage customer orders
* Manage registered users
* View customer messages

Only accounts with:

```
user_type = 'admin'
```

can access the administrative pages.

Administrative accounts cannot be created through the public registration page and must be added directly through the database.

## Project Structure

```
DbConn.php
    Database connection file.

index.php
    Homepage of the website.

header.php / footer.php
    Shared website layout files.

about.php
    About Us page.

contact.php
    Contact page.

shop.php
    Displays available menu items.

cart.php
    Handles shopping cart functionality.

checkout.php
    Handles order placement and WhatsApp integration.

orders.php
    Displays customer order history.

login.php
    User authentication page.

register.php
    User registration page.

logout.php
    Handles user logout.

guest_home.php
    Guest browsing functionality.

admin_header.php
admin_page.php
admin_products.php
admin_orders.php
admin_users.php
admin_contacts.php
    Administrative dashboard pages.

css/
    Contains style.css and admin_style.css.

js/
    Contains JavaScript files.

images/
    Stores website images.

uploaded_img/
    Stores product images uploaded by administrators.

fontis_db.sql
    Database schema and default administrator account.
```

## Database Structure

The project uses a MySQL database named:

```
fontis_db
```

The following tables are included:

* users
* products
* cart
* orders
* message

Each table is responsible for storing information required by the system, including customer details, menu items, shopping cart information, customer orders, and customer enquiries.

## Running the Project Locally

### Step 1

Install and start:

* WAMP Server

### Step 2

Extract the project folder and place it inside:

```
wamp64/www/
```

Example:

```
wamp64/www/Fontis-Fine-Dine
```

### Step 3

Open phpMyAdmin and create a database named:

```
fontis_db
```

### Step 4

Import the provided:

```
fontis_db.sql
```

file into the newly created database.

### Step 5

Ensure that the database credentials inside:

```
DbConn.php
```

match your local WAMP configuration.

### Step 6

Run the project by visiting:

```
http://localhost/Fontis-Fine-Dine
```

or

```
http://localhost/Fontis-Fine-Dine/index.php
```

## Deployment

The project can also be deployed using InfinityFree hosting.

Deployment steps include:

1. Creating a MySQL database.
2. Importing the `fontis_db.sql` file.
3. Updating the database credentials inside `DbConn.php`.
4. Uploading all project files into the `htdocs` directory.
5. Configuring SSL certificates once available.

## Future Improvements

The following features may be added in future versions of the project:

* Online payment gateway integration.
* Order status tracking.
* Email notifications.
* Password recovery functionality.
* Google Maps integration.
* Customer reviews and ratings.
* Mobile application integration.
* Google Play Store deployment.

## Known Limitations

The current version of the project has the following limitations:

* Payments are handled manually and are not processed through the website.
* Password reset functionality has not yet been implemented.
* Product images are uploaded manually by administrators.
* Order status updates are currently managed manually through the admin dashboard.

## Conclusion

Fontis Fine Dine was developed to demonstrate practical software development skills acquired throughout the Diploma in IT Software Development. The project combines front-end development, database management, user authentication, administrative functionality, and third-party communication through WhatsApp to provide a complete restaurant ordering solution.

The system showcases the implementation of real-world concepts such as CRUD operations, session management, secure password handling, database integration, and responsive web development while addressing a practical business problem.
