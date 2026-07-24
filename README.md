# Fontis Fine Dine

Fontis Fine Dine is a food ordering website built for a Work Integrated Learning (WIL) project by:

- Shaun Makhobo
- Kamogelo Seilane
- Masoma Pauline

It lets customers browse a menu, add items to a cart, and place an order that gets confirmed directly with the restaurant over WhatsApp, while admin staff manage products, orders, users, and customer messages from a separate dashboard.

## Why this stack

- **PHP + MySQL (procedural, mysqli).** Kept deliberately simple and framework-free so every team member could read, run, and debug the whole codebase without a build step — appropriate for a WIL project where the goal was demonstrating end-to-end understanding of a dynamic, database-backed website, not framework proficiency.
- **Server-rendered pages, no JS framework.** Each page (`shop.php`, `cart.php`, `checkout.php`, etc.) is self-contained PHP that queries the database and renders HTML directly. This matches the course's teaching stack and avoids the deployment complexity of a JS build pipeline on free/shared hosting.
- **InfinityFree hosting.** A free host was chosen because this is a student project without a hosting budget. It only requires plain PHP + MySQL support, which InfinityFree provides, and is realistic for showing the project live during evaluation.

## Key design decisions

**Guest browsing, gated purchasing.**
Visitors can explore the home page, shop, and about/contact pages without an account (`guest_home.php` sets a guest session flag). Adding to cart and checking out require login. This mirrors how most restaurant/e-commerce sites work: let people see the menu freely, but require an account to track orders.

**WhatsApp-based order confirmation instead of a payment gateway.**
`checkout.php` records the order in the database, then opens a WhatsApp chat (`wa.me` / `web.whatsapp.com`) pre-filled with the order details so the customer can confirm directly with restaurant staff. This was chosen over integrating a payment gateway (PayFast, Stripe, etc.) because:
- it needs no merchant account, transaction fees, or approval process — impractical for a short-lived student project;
- it matches how small South African food vendors actually take orders (WhatsApp is the de facto ordering channel);
- `payment_status` still exists on the `orders` table so an admin can mark orders as `completed` once payment is settled off-platform.

**Passwords are hashed, never stored or compared in plain text.**
`register.php` and `login.php` use PHP's `password_hash()` / `password_verify()` (bcrypt), and `login.php` uses a prepared statement for the credential lookup, so SQL injection isn't possible on the login path.

**Separate admin area.**
`admin_header.php`, `admin_page.php`, `admin_products.php`, `admin_orders.php`, `admin_users.php`, and `admin_contacts.php` form a dashboard restricted to accounts with `user_type = 'admin'`. This keeps store-management logic (adding products, reviewing orders, viewing contact messages) out of the customer-facing pages entirely, rather than branching UI by role on shared pages.

**All registrations default to `user_type = 'user'`.**
Admin accounts can't be self-registered through the public form — only seeded directly in the database — so the storefront can't be used to create new admin accounts.

## Project structure

```
DbConn.php          Single shared MySQL connection (mysqli)
index.php            Home page (renamed from home.php for InfinityFree/Apache auto-routing)
header.php / footer.php   Shared layout, included on every customer-facing page
about.php, contact.php, shop.php, cart.php, checkout.php, orders.php
login.php, register.php, logout.php, guest_home.php
admin_header.php, admin_page.php, admin_products.php, admin_orders.php,
admin_users.php, admin_contacts.php
css/                 style.css (storefront), admin_style.css (dashboard)
js/                  script.js, admin_script.js
images/              Static site imagery
uploaded_img/        Product images uploaded via the admin panel
fontis_db.sql        Database schema + seed admin account
```

## Database

Five tables (see `fontis_db.sql`): `users`, `products`, `cart`, `orders`, `message`. Carts and orders are scoped to a logged-in `user_id`; guests can only submit contact messages (`user_id` nullable there). Foreign keys cascade/null appropriately when a user is deleted.

## Running locally

1. Serve the folder with a PHP + MySQL stack (WAMP/XAMPP/MAMP).
2. Import `fontis_db.sql` into a local MySQL database.
3. Point `DbConn.php` at your local database credentials.
4. Visit `index.php`.

## Deploying to InfinityFree

1. Create a MySQL database via vPanel → MySQL Databases, and import `fontis_db.sql` through its phpMyAdmin.
2. Update `DbConn.php` with the hostname, username, password, and database name shown on that same page (InfinityFree's MySQL host is never `localhost`).
3. Upload every file *except* `.git/` and `.vscode/` into `htdocs/` via FTP.
4. Once your domain's SSL certificate is issued, force HTTPS via `.htaccess`.

## Known limitations

- No real payment processing — `checkout.php`'s payment method field is informational, and payment is confirmed manually by an admin over WhatsApp.
- No password reset flow.
- Product images are uploaded manually by an admin, with no image resizing/validation beyond what the browser enforces.
