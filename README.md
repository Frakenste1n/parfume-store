# Parfume Store — Dokumentasi Teknis

Dokumentasi ini dibuat berdasarkan analisis langsung terhadap source code, konfigurasi, asset, dan file SQL project **Parfume Store** (database: `parfume_v2`). Tujuan dokumen ini adalah membantu programmer baru memahami arsitektur, alur kerja, dan cara berkontribusi pada project.

---

## Daftar Isi

1. [Project Overview](#1-project-overview)
2. [Tech Stack](#2-tech-stack)
3. [Project Structure](#3-project-structure)
4. [Installation & Configuration](#4-installation--configuration)
5. [Database Documentation](#5-database-documentation)
6. [System Architecture](#6-system-architecture)
7. [Workflow](#7-workflow)
8. [Module Documentation](#8-module-documentation)
9. [API Documentation](#9-api-documentation)
10. [Asset Management](#10-asset-management)
11. [Coding Convention](#11-coding-convention)
12. [Troubleshooting](#12-troubleshooting)

---

## 1. Project Overview

### Tujuan Project

Parfume Store adalah aplikasi **e-commerce parfum** berbasis web yang terdiri dari dua sisi:

- **Customer storefront** — halaman publik untuk browsing produk, keranjang, checkout, dan riwayat pesanan.
- **Admin panel (CMS)** — panel manajemen untuk mengelola produk, order, user, banner, payment method, dan pengaturan situs.

### Deskripsi Project

Project ini dibangun dengan **CodeIgniter 3** sebagai backend PHP, menggunakan pola **REST API + SPA-like frontend** (data dimuat via AJAX/fetch dari JavaScript). Halaman HTML dirender oleh PHP (server-side view), sedangkan operasi CRUD dan interaksi dinamis dilakukan melalui endpoint `/api/*`.

Nama situs default di database: **AURA STORE** (tabel `settings.site_name`).

### Fitur Utama

| Area | Fitur |
|------|-------|
| **Customer** | Homepage dinamis, katalog produk, brand, pencarian, keranjang, checkout, riwayat pesanan, halaman tentang kami, login/register |
| **Admin** | Dashboard statistik, manajemen user, brand, kategori, produk (+ gambar), banner, metode pembayaran, order, setting CMS, manajemen founder |
| **API** | REST JSON untuk seluruh operasi data |
| **Upload** | Gambar produk, brand, banner, payment, settings, founder |

### Ruang Lingkup Project

- **Termasuk:** CRUD master data, cart & checkout, manajemen order, upload gambar, setting dinamis, dashboard admin.
- **Tidak termasuk:** Payment gateway otomatis (Midtrans/Xendit), email notification, JWT/token API, multi-vendor, shipping rate otomatis, migration CI aktif (folder migration ada tetapi tidak digunakan sebagai sumber schema utama).

---

## 2. Tech Stack

Teknologi yang **benar-benar digunakan** di project ini:

| Layer | Teknologi | Versi / Catatan |
|-------|-----------|-----------------|
| Backend Framework | **CodeIgniter 3** | Bundled di folder `system/` |
| Bahasa | **PHP** | `>= 5.3.7` (composer.json), database dump dari PHP 7.4.33 |
| REST API | **chriskacerguis/codeigniter-restserver** | `^3.1` via Composer |
| Database | **MySQL** | Driver `mysqli`, database `parfume_v2` |
| Frontend CSS | **Bootstrap 5** | Customer: 5.3.7, Admin: 5.3.3 |
| Icons | **Bootstrap Icons** | 1.13.1 (customer), 1.11.3 (admin) |
| JavaScript | **jQuery 3.7.1** | Admin & customer layout |
| JavaScript | **Vanilla JS (fetch/async)** | Customer module (`assets/js/customer/`) |
| Animasi | **AOS 2.3.4** | Scroll animation |
| Alert/Modal | **SweetAlert2 11** | Konfirmasi & notifikasi |
| Data Table | **DataTables 1.13.8** | Admin list pages |
| Font | **Google Fonts** | Cormorant Garamond + Inter (customer), system font (admin) |
| Package Manager | **Composer** | Dependency REST server |
| Web Server | **Apache + mod_rewrite** | `.htaccess` di root project |

**Tidak digunakan:** Laravel, Vue/React/Angular, Redis, Node.js build tool, JWT, OAuth.

---

## 3. Project Structure

### Tree Struktur Folder

```text
parfume-store/
│
├── application/                  # Aplikasi CodeIgniter (custom code)
│   ├── cache/
│   ├── config/                   # Konfigurasi CI (routes, database, autoload, dll)
│   ├── controllers/
│   │   ├── Welcome.php           # Halaman customer (home, katalog, cart, dll)
│   │   ├── admin/                # Controller halaman admin panel
│   │   ├── api/                  # REST API controllers
│   │   └── customer/             # Controller halaman auth customer
│   ├── core/
│   │   ├── MY_Controller.php     # Base admin controller + session guard
│   │   └── Base_api.php          # Base REST API + format response JSON
│   ├── helpers/
│   │   └── upload_helper.php     # Helper upload_image()
│   ├── hooks/
│   ├── language/
│   ├── libraries/                # REST_Controller (via vendor symlink/copy)
│   ├── logs/
│   ├── models/                   # 13 model database
│   └── views/
│       ├── admin/                # View admin panel
│       ├── customer/             # View storefront
│       └── errors/               # Halaman error CI
│
├── assets/
│   ├── css/
│   │   ├── admin-layout.css      # Layout admin (sidebar, navbar)
│   │   ├── customer/             # CSS per halaman customer
│   │   ├── brands.css            # CSS admin per modul
│   │   ├── banners.css
│   │   ├── categories.css
│   │   ├── dashboard.css
│   │   ├── founders.css
│   │   ├── orders.css
│   │   ├── parfume.css
│   │   ├── payments.css
│   │   ├── setting.css
│   │   └── users.css
│   └── js/
│       ├── admin-layout.js       # Sidebar toggle, logout admin
│       ├── customer/             # JS storefront (fetch-based)
│       ├── brands.js             # JS admin per modul
│       ├── banners.js
│       ├── categories.js
│       ├── dashboard.js
│       ├── founders.js
│       ├── orders.js
│       ├── parfume.js
│       ├── payments.js
│       ├── setting.js
│       └── users.js
│
├── database/
│   └── parfume_v2.sql            # Dump database lengkap
│
├── system/                       # Core CodeIgniter 3 (jangan edit)
│
├── uploads/                      # File upload runtime (per modul)
│   ├── banners/
│   ├── brands/
│   ├── founders/
│   ├── payments/
│   ├── products/
│   └── settings/
│
├── vendor/                       # Composer dependencies
│
├── .htaccess                     # URL rewriting ke index.php
├── composer.json
├── composer.lock
├── index.php                     # Front controller CI
└── readme.rst                    # Readme default CodeIgniter (bukan dokumentasi project)
```

### Fungsi Folder Penting

| Folder | Fungsi |
|--------|--------|
| `application/controllers/api/` | Semua endpoint REST JSON. Naming: `{Resource}.php`, method: `{action}_{httpverb}()` |
| `application/controllers/admin/` | Render halaman admin. Semua (kecuali Login) memanggil `admin_only()` |
| `application/controllers/customer/` | Render halaman login/register customer |
| `application/core/` | Base class custom: `MY_Controller`, `Base_api` |
| `application/models/` | Query Builder ke MySQL |
| `application/views/admin/layouts/` | Template admin: sidebar, navbar, app.php |
| `application/views/customer/layouts/` | Template customer: navbar, footer, app.php |
| `assets/css/customer/` | Stylesheet per halaman storefront |
| `assets/js/customer/` | JavaScript storefront dengan helper `api.js` |
| `assets/js/` (root) | JavaScript admin panel (jQuery AJAX) |
| `uploads/` | Penyimpanan file gambar hasil upload |
| `database/` | SQL dump sebagai referensi schema |

### Struktur Modul Aplikasi

```text
Parfume Store
│
├── Customer Storefront
│   ├── Beranda (/)
│   ├── Katalog (/katalog)
│   ├── Brand (/brands)
│   ├── Pencarian (/search)
│   ├── Keranjang (/cart)
│   ├── Checkout (/checkout)
│   ├── Checkout Success (/checkout/success/{id})
│   ├── Riwayat Pesanan (/orders)
│   ├── Tentang (/tentang)
│   ├── Login (/login)
│   └── Register (/register)
│
└── Admin Panel (/admin/*)
    ├── Dashboard
    ├── User
    ├── Brand
    ├── Kategori
    ├── Parfume (Produk)
    ├── Banner
    ├── Payment
    ├── Order
    └── Setting (+ Founder CRUD)
```

---

## 4. Installation & Configuration

### Requirements

- PHP >= 5.3.7 (disarankan PHP 7.4+)
- MySQL / MariaDB
- Apache dengan **mod_rewrite** enabled
- Composer
- Extension PHP: `mysqli`, `gd` atau `fileinfo` (untuk upload gambar)

### Langkah Instalasi

**1. Clone / copy project**

```bash
git clone <repository-url> parfume-store
cd parfume-store
```

**2. Install dependency Composer**

```bash
composer install
```

Dependency utama: `chriskacerguis/codeigniter-restserver`.

**3. Import database**

Import file SQL ke MySQL:

```bash
mysql -u root -p parfume_v2 < database/parfume_v2.sql
```

Atau via phpMyAdmin: import `database/parfume_v2.sql`.

**4. Konfigurasi database**

Edit `application/config/database.php`:

```php
'hostname' => 'localhost',
'username' => 'root',
'password' => '',
'database' => 'parfume_v2',
'dbdriver' => 'mysqli',
```

**5. Konfigurasi base URL**

Edit `application/config/config.php`:

```php
$config['base_url'] = 'http://localhost/parfume-store/';
$config['index_page'] = '';
```

**6. Konfigurasi Apache rewrite**

File `.htaccess` di root:

```apache
RewriteBase /parfume-store/
RewriteRule ^(.*)$ index.php/$1 [L]
```

Sesuaikan `RewriteBase` jika project tidak berada di subfolder `/parfume-store/`.

**7. Permission folder upload**

Pastikan folder `uploads/` dan subfoldernya writable oleh web server:

```text
uploads/
uploads/banners/
uploads/brands/
uploads/founders/
uploads/payments/
uploads/products/
uploads/settings/
```

**8. Environment**

Di `index.php`, environment default:

```php
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');
```

Untuk production, set environment server `CI_ENV=production`.

### Akun Default (dari SQL dump)

| Role | Email | Password |
|------|-------|----------|
| Admin | `ppp@gmail.com` | *(hash bcrypt di DB — reset manual jika tidak diketahui)* |
| Customer (contoh, punya order) | `dapa@gmail.com` | *(hash bcrypt di DB)* |

Password disimpan dengan `password_hash(..., PASSWORD_BCRYPT)`.

---

## 5. Database Documentation

Database: **`parfume_v2`**
File referensi: **`database/parfume_v2.sql`**

### Diagram Relasi (Text)

```text
users
  │
  ├──< carts (1 user = 1 cart, UNIQUE user_id)
  │      └──< cart_items >── products
  │
  └──< orders
         ├──< order_items >── products
         ├──< order_status_histories
         └──< payment_transactions >── payment_methods

brands ──< products >── categories
              │
              └──< product_images

settings (singleton, id=1)
founders (terpisah dari settings)
banners (standalone)
```

### Daftar Tabel

| Tabel | Fungsi |
|-------|--------|
| `users` | Akun admin & customer |
| `brands` | Master brand parfum |
| `categories` | Master kategori produk |
| `products` | Data produk parfum |
| `product_images` | Gambar produk (multi image per produk) |
| `banners` | Banner slider homepage |
| `settings` | Konfigurasi situs (logo, about, kontak, featured text) |
| `founders` | Data founder untuk halaman tentang |
| `payment_methods` | Metode pembayaran manual (BCA, dll) |
| `carts` | Keranjang belanja per user |
| `cart_items` | Item dalam keranjang |
| `orders` | Header pesanan |
| `order_items` | Detail item pesanan (snapshot nama & harga) |
| `order_status_histories` | Log perubahan status order/pembayaran |
| `payment_transactions` | Transaksi pembayaran per order |

### Detail Tabel & Kolom Penting

#### `users`

```text
users
├── id              (PK, AUTO_INCREMENT)
├── name            (varchar 100)
├── email           (varchar 100, UNIQUE)
├── password        (varchar 255, bcrypt hash)
├── phone           (varchar 20)
├── address         (text)
├── role            (enum: admin | customer)
├── token           (text, tidak aktif digunakan saat ini)
├── is_active       (tinyint, default 1)
├── created_at
└── updated_at
```

#### `products`

```text
products
├── id
├── brand_id        (FK → brands.id)
├── category_id     (FK → categories.id)
├── name
├── slug            (UNIQUE)
├── sku             (UNIQUE)
├── price           (decimal 12,2)
├── stock           (int)
├── short_description
├── description
├── is_featured     (tampil di homepage)
├── is_active
├── created_at
└── updated_at
```

#### `orders`

```text
orders
├── id
├── user_id         (FK → users.id)
├── order_number    (UNIQUE, format: ORD + YmdHis)
├── subtotal
├── grand_total
├── payment_status  (enum: pending | paid | failed)
├── status          (enum: pending | processing | shipped | completed | cancelled)
├── notes           (text — alamat pengiriman disimpan di sini saat checkout)
├── created_at
└── updated_at
```

**Catatan penting:** Kolom `shipping_address` tidak ada di schema. Checkout menyimpan alamat ke `notes` dengan format: `Alamat Pengiriman: {address}`.

#### `order_items`

Snapshot produk saat order dibuat (nama & harga tidak berubah meski produk diupdate):

```text
order_items
├── id
├── order_id        (FK → orders.id)
├── product_id      (FK → products.id)
├── product_name
├── price
├── qty
└── subtotal
```

#### `settings`

```text
settings
├── id
├── site_name
├── logo            (filename → uploads/settings/)
├── favicon         (filename → uploads/settings/)
├── about_us
├── whatsapp
├── instagram
├── email
├── google_maps_embed
├── featured_title
├── featured_subtitle
├── created_at
└── updated_at
```

**Catatan:** Founder **tidak** lagi disimpan di tabel `settings`. Data founder ada di tabel `founders`. Method `Setting_model::parse_founders()` masih ada sebagai legacy code.

#### `founders`

```text
founders
├── id
├── name
├── position
├── photo           (filename → uploads/founders/)
├── whatsapp
├── instagram
├── is_active
├── created_at
└── updated_at
```

### Foreign Key Constraints

| Tabel | FK | Referensi |
|-------|-----|-----------|
| `carts.user_id` | → | `users.id` |
| `cart_items.cart_id` | → | `carts.id` |
| `cart_items.product_id` | → | `products.id` |
| `orders.user_id` | → | `users.id` |
| `order_items.order_id` | → | `orders.id` |
| `order_items.product_id` | → | `products.id` |
| `order_status_histories.order_id` | → | `orders.id` |
| `payment_transactions.order_id` | → | `orders.id` |
| `payment_transactions.payment_method_id` | → | `payment_methods.id` |
| `products.brand_id` | → | `brands.id` |
| `products.category_id` | → | `categories.id` |
| `product_images.product_id` | → | `products.id` |

### Alur Penyimpanan Data Order

```text
Checkout (POST /api/orders)
    │
    ├─► INSERT orders (payment_status=paid, status=pending)
    ├─► INSERT order_items (snapshot produk)
    ├─► UPDATE products.stock (dikurangi)
    ├─► INSERT payment_transactions (status=paid)
    ├─► INSERT order_status_histories
    └─► DELETE cart_items (keranjang dikosongkan)
```

---

## 6. System Architecture

### Pola Arsitektur

Project menggunakan **CodeIgniter 3 MVC** dengan pemisahan:

- **Page Controller** — render HTML view (Welcome, admin/*, customer/Auth)
- **API Controller** — return JSON via REST_Controller
- **Model** — akses database via Query Builder
- **Frontend JS** — konsumsi API, manipulasi DOM

### Flow Request Umum

```text
Browser
    │
    ▼
Apache (.htaccess → index.php)
    │
    ▼
CodeIgniter Router (application/config/routes.php)
    │
    ├──► Page Route ──► Controller ──► View (HTML shell)
    │                         │
    │                         └──► Model (opsional, load setting)
    │
    └──► API Route ──► api/* Controller (Base_api)
                            │
                            ▼
                       Model (Query Builder)
                            │
                            ▼
                       MySQL (parfume_v2)
                            │
                            ▼
                       JSON Response
                            │
                            ▼
                       JavaScript (fetch/jQuery)
                            │
                            ▼
                       Update DOM / UI
```

### Format Response API

Semua API extends `Base_api` (`application/core/Base_api.php`):

**Success:**

```json
{
  "success": true,
  "message": "Pesan sukses",
  "data": { }
}
```

**Error:**

```json
{
  "success": false,
  "message": "Pesan error"
}
```

HTTP status code error tetap **200** (kecuali beberapa endpoint mengirim kode lain, tetapi `error_response()` default ke 200).

### Autentikasi — Dual System

```text
┌─────────────────────────────────────────────────────────────┐
│                      AUTENTIKASI                            │
├──────────────────────────┬──────────────────────────────────┤
│ Admin Panel              │ Customer Storefront                │
├──────────────────────────┼──────────────────────────────────┤
│ PHP Session              │ localStorage (client-side)         │
│ Keys: is_login, role,    │ Keys:                              │
│       id, name, email    │   customer_token = "true"          │
│                          │   customer_user = user ID          │
│                          │   customer_name = nama             │
├──────────────────────────┼──────────────────────────────────┤
│ Guard: MY_Controller     │ Guard: JavaScript cek localStorage │
│        ::admin_only()    │ (tidak ada guard server-side)      │
├──────────────────────────┼──────────────────────────────────┤
│ Login: POST api/login    │ Login: POST api/login              │
│   → POST admin/login/    │   → set localStorage               │
│     store (set session)  │                                    │
└──────────────────────────┴──────────────────────────────────┘
```

**Penting:** API endpoint **tidak memiliki middleware autentikasi**. Client mengirim `user_id` langsung tanpa token.

### Tema & Desain Visual

#### Customer Storefront (`assets/css/customer/app.css`)

| Elemen | Nilai |
|--------|-------|
| Background body | `#FFFDF9` |
| Teks utama | `#4B4035` |
| Teks muted | `#8D8278` |
| Accent / gold | `#C8A97E` |
| Border | `#E7DDD0`, `#EEE5D8` |
| Font heading | Cormorant Garamond |
| Font body | Inter |
| Navbar | Glassmorphism, sticky, border-radius 28px |
| Button gradient | `linear-gradient(135deg, #C8A97E, #b59569)` |

#### Admin Panel (`assets/css/admin-layout.css`)

| Elemen | Nilai |
|--------|-------|
| Sidebar background | `#0b1220` → `#0f172a` gradient |
| Accent | `#6366f1` (indigo) |
| Background body | `#f8fafc` → `#f1f5f9` gradient |
| Text muted | `#94a3b8` |

Admin dan customer menggunakan **palet warna berbeda** (gold/cream vs indigo/dark sidebar).

---

## 7. Workflow

### 7.1 Admin Login

```text
Browser (/admin/login)
    │
    ▼
POST /api/login  { email, password }
    │
    ▼
Auth::login_post() → Auth_model::find_by_email()
    │
    ▼
password_verify() → return user (role=admin)
    │
    ▼
Frontend cek role === 'admin'
    │
    ▼
POST /admin/login/store  { id, name, email, role }
    │
    ▼
Login::store() → session->set_userdata()
    │
    ▼
Redirect → /admin/dashboard
```

### 7.2 Customer Register & Login

**Register:**

```text
/register → register.js
    │
    ▼
POST /api/register  { name, email, password, phone, address }
    │
    ▼
Auth::register_post() → INSERT users (role=customer)
    │
    ▼
Redirect → /login
```

**Login:**

```text
/login → login.js
    │
    ▼
POST /api/login
    │
    ▼
Cek role !== 'admin'
    │
    ▼
localStorage.setItem('customer_token', 'true')
localStorage.setItem('customer_user', res.data.id)
localStorage.setItem('customer_name', res.data.name)
    │
    ▼
Redirect → /
```

### 7.3 CRUD Admin (Pola Umum)

```text
Admin Page (/admin/{module})
    │
    ▼
Controller admin/* → admin_only() → render_admin()
    │
    ▼
View HTML + JS modul (DataTables / Modal)
    │
    ▼
jQuery AJAX → /api/{resource}
    │
    ▼
api/* Controller → Model → MySQL
    │
    ▼
JSON { success, message, data }
    │
    ▼
Update tabel / modal / SweetAlert
```

### 7.4 Upload Gambar

```text
Form multipart/form-data
    │
    ▼
POST/PUT ke API endpoint
    │
    ▼
Controller cek $_FILES
    │
    ▼
upload_image($field, './uploads/{folder}/')
    │
    ▼
CI Upload Library
  - allowed: jpg|jpeg|png|webp
  - max_size: 4096 KB
  - encrypt_name: TRUE (MD5 random filename)
    │
    ▼
Simpan filename ke database
    │
    ▼
Akses file: {base_url}uploads/{folder}/{filename}
```

### 7.5 Cart & Checkout

```text
[Tambah ke Cart]
Customer klik "Add to Cart"
    │
    ▼
POST /api/cart  { user_id, product_id, qty }
    │
    ▼
Cart_model::get_or_create_cart() → add_item()

[Checkout]
/checkout → checkout.js
    │
    ▼
GET /api/cart?user_id={id}
GET /api/payment-methods
GET /api/users/{id}  (data alamat)
    │
    ▼
POST /api/orders  { user_id, payment_method_id, shipping_address }
    │
    ▼
Order_model::checkout()
  - Buat order (payment_status=paid)
  - Kurangi stock
  - Buat payment_transaction
  - Kosongkan cart
    │
    ▼
Redirect → /checkout/success/{order_id}
```

### 7.6 Order Management (Admin)

```text
/admin/orders → orders.js
    │
    ▼
GET /api/orders  (semua order + join user name)
    │
    ▼
DataTables render + filter status
    │
    ▼
Update status: PUT /api/orders/{id}  { payment_status }
Delete: DELETE /api/orders/{id}
Detail: GET /api/orders/{id}
```

### 7.7 Customer Riwayat Pesanan

```text
/orders → orders.js
    │
    ▼
Cek localStorage customer_user
    │
    ▼
GET /api/orders?user_id={id}
    │
    ▼
Render order cards
    │
    ▼
Detail: GET /api/orders/{id}
Cancel: PUT /api/orders/{id}/cancel
  (hanya jika status order: pending/processing/shipped)
```

### 7.8 Dashboard

```text
/admin/dashboard → dashboard.js
    │
    ▼
GET /api/dashboard
    │
    ▼
Dashboard_model:
  - total_users, total_brands, total_categories
  - total_products, total_orders, total_revenue
  - latest_orders
```

### 7.9 Settings & Founder

```text
/admin/setting
    │
    ├── setting.js → GET/PUT/POST /api/settings
    │     (site_name, logo, favicon, about_us, kontak, featured)
    │
    └── founders.js → CRUD /api/founders
          (tabel founders terpisah)
```

---

## 8. Module Documentation

### 8.1 Customer Storefront

| Halaman | Controller | View | JS | CSS | API |
|---------|------------|------|----|-----|-----|
| Beranda | `Welcome::index()` | `v_home.php` | `home.js` | `home.css` | `GET /api/home` |
| Katalog | `Welcome::katalog()` | `v_katalog.php` | `katalog.js` | `katalog.css` | `GET /api/products` |
| Brand | `Welcome::brands()` | `v_brands.php` | `brands.js` | `brands.css` | `GET /api/brands` |
| Pencarian | `Welcome::search()` | `v_search.php` | `search.js` | `search.css` | `GET /api/products/search?q=` |
| Keranjang | `Welcome::cart()` | `v_cart.php` | `cart.js` | `cart.css` | `GET/PUT/DELETE /api/cart` |
| Checkout | `Welcome::checkout()` | `v_checkout.php` | `checkout.js` | `checkout.css` | `POST /api/orders` |
| Success | `Welcome::checkout_success()` | `v_checkout_success.php` | `checkout-success.js` | `checkout-success.css` | `GET /api/orders/{id}` |
| Riwayat | `Welcome::orders()` | `v_orders.php` | `orders.js` | `orders.css` | `GET /api/orders?user_id=` |
| Tentang | `Welcome::tentang()` | `v_tentang.php` | `tentang.js` | `tentang.css` | `GET /api/settings`, `GET /api/founders` |
| Login | `customer/Auth::login()` | `v_login.php` | `login.js` | `auth.css` | `POST /api/login` |
| Register | `customer/Auth::register()` | `v_register.php` | `register.js` | `auth.css` | `POST /api/register` |

**Layout customer:** `application/views/customer/layouts/app.php`
- Load: Bootstrap, AOS, SweetAlert2, `api.js`, `app.js`
- Global: `BASE_URL` constant
- Navbar dinamis berdasarkan localStorage

### 8.2 Admin — Dashboard

| Komponen | File |
|----------|------|
| Controller | `admin/Dashboard.php` |
| View | `admin/dashboard.php` |
| JS | `assets/js/dashboard.js` |
| CSS | `assets/css/dashboard.css` |
| Model | `Dashboard_model.php` |
| API | `GET /api/dashboard` |

### 8.3 Admin — User

| Fitur | Detail |
|-------|--------|
| List | DataTables, `GET /api/users` |
| Create | Modal, `POST /api/users` |
| Update | Modal, `PUT /api/users/{id}` |
| Delete | Konfirmasi SweetAlert, `DELETE /api/users/{id}` |
| Controller | `admin/Users.php` |
| Model | `User_model.php` |
| View | `admin/user.php` |
| JS | `assets/js/users.js` |

### 8.4 Admin — Brand

| Fitur | Detail |
|-------|--------|
| CRUD | Full CRUD via API |
| Upload | Logo → `uploads/brands/` |
| Controller | `admin/Brands.php` |
| API | `api/Brands.php` |
| Model | `Brand_model.php` |
| View | `admin/brand.php` |
| JS | `assets/js/brands.js` |

Kolom: `name`, `slug`, `logo`, `description`, `website`, `instagram`, `origin_country`, `is_featured`, `is_active`.

### 8.5 Admin — Kategori

| Fitur | Detail |
|-------|--------|
| CRUD | Full CRUD |
| Controller | `admin/Categories.php` |
| API | `api/Categories.php` |
| Model | `Category_model.php` |
| View | `admin/category.php` |
| JS | `assets/js/categories.js` |

### 8.6 Admin — Parfume (Produk)

| Fitur | Detail |
|-------|--------|
| List | DataTables produk dengan brand & kategori |
| Create/Update | Form modal, `POST/PUT /api/products` |
| Delete | Diblokir jika produk sudah ada di `order_items` |
| Upload Gambar | `POST /api/product-images` → `uploads/products/` |
| Hapus Gambar | `DELETE /api/product-images/{id}` |
| Controller | `admin/Parfume.php` |
| API | `api/Products.php`, `api/Product_images.php` |
| Model | `Product_model.php`, `Product_image_model.php` |
| View | `admin/parfume.php` |
| JS | `assets/js/parfume.js` |

### 8.7 Admin — Banner

| Fitur | Detail |
|-------|--------|
| CRUD | Full CRUD + upload image |
| Upload path | `uploads/banners/` |
| Update dengan file | `POST /api/banners/{id}` (bukan PUT) |
| Controller | `admin/Banners.php` |
| API | `api/Banners.php` |
| Model | `Banner_model.php` |
| View | `admin/banner.php` |
| JS | `assets/js/banners.js` |

### 8.8 Admin — Payment Method

| Fitur | Detail |
|-------|--------|
| CRUD | Metode pembayaran manual |
| Upload logo | `uploads/payments/` |
| Controller | `admin/Payments.php` |
| API | `api/Payment_methods.php` |
| Model | `Payment_method_model.php` |
| View | `admin/payment.php` |
| JS | `assets/js/payments.js` |

### 8.9 Admin — Order

| Fitur | Detail |
|-------|--------|
| List | DataTables semua order |
| Filter | Filter by payment status |
| Update status | `PUT /api/orders/{id}` → `payment_status` |
| Detail | Modal dengan items |
| Delete | `DELETE /api/orders/{id}` |
| Controller | `admin/Orders.php` |
| API | `api/Orders.php` |
| Model | `Order_model.php` |
| View | `admin/orders.php` |
| JS | `assets/js/orders.js` |

Status pembayaran di admin: `pending`, `paid`, `failed`, `cancelled`.

### 8.10 Admin — Setting & Founder

| Fitur | Detail |
|-------|--------|
| Setting CMS | Site name, logo, favicon, about, kontak, maps, featured |
| Founder CRUD | Terpisah via `founders.js` |
| Upload | Logo & favicon → `uploads/settings/` |
| Founder photo | `uploads/founders/` |
| Controller | `admin/Setting.php` |
| API | `api/Settings.php`, `api/Founders.php` |
| Model | `Setting_model.php`, `Founder_model.php` |
| View | `admin/setting.php` |
| JS | `assets/js/setting.js`, `assets/js/founders.js` |

**Catatan edit founder:** Gunakan `POST /api/founders/{id}` dengan FormData (bukan PUT), karena PHP tidak parse multipart pada PUT.

---

## 9. API Documentation

Base URL: `{base_url}api/`

Contoh: `http://localhost/parfume-store/api/products`

### 9.1 Auth

#### POST `/api/register`

| | |
|---|---|
| **Tujuan** | Registrasi customer baru |
| **Body** | `name`, `email`, `password`, `phone`, `address` |
| **Success** | `{ success: true, message: "Register berhasil" }` |
| **Error** | `{ success: false, message: "Email sudah digunakan" }` |

#### POST `/api/login`

| | |
|---|---|
| **Tujuan** | Login admin & customer |
| **Body** | `email`, `password` |
| **Success data** | User object tanpa password: `id`, `name`, `email`, `role`, dll |
| **Error** | Email tidak ditemukan / Password salah |

---

### 9.2 Users

| Method | URL | Tujuan |
|--------|-----|--------|
| GET | `/api/users` | List semua user |
| GET | `/api/users/{id}` | Detail user |
| POST | `/api/users` | Create user |
| PUT | `/api/users/{id}` | Update user |
| DELETE | `/api/users/{id}` | Delete user |

**POST body:** `name`, `email`, `phone`, `address`, `role`, `password`

**PUT body:** `name`, `email`, `phone`, `address`, `role`, `is_active`, `password` (opsional)

---

### 9.3 Brands

| Method | URL | Tujuan |
|--------|-----|--------|
| GET | `/api/brands` | List brands |
| GET | `/api/brands/{id}` | Detail brand |
| POST | `/api/brands` | Create (multipart, field `logo`) |
| PUT | `/api/brands/{id}` | Update |
| DELETE | `/api/brands/{id}` | Delete |

---

### 9.4 Categories

| Method | URL | Tujuan |
|--------|-----|--------|
| GET | `/api/categories` | List categories |
| GET | `/api/categories/{id}` | Detail |
| POST | `/api/categories` | Create |
| PUT | `/api/categories/{id}` | Update |
| DELETE | `/api/categories/{id}` | Delete |

**Body:** `name`, `slug`, `description`, `is_active`

---

### 9.5 Products

| Method | URL | Tujuan |
|--------|-----|--------|
| GET | `/api/products` | List produk (join brand & category) |
| GET | `/api/products/search?q={keyword}` | Pencarian produk |
| GET | `/api/products/{id}` | Detail + images |
| POST | `/api/products` | Create produk |
| PUT | `/api/products/{id}` | Update produk |
| DELETE | `/api/products/{id}` | Delete (gagal jika sudah di order) |

**POST/PUT body:** `brand_id`, `category_id`, `name`, `slug`, `sku`, `price`, `stock`, `short_description`, `description`, `is_featured`, `is_active`

---

### 9.6 Product Images

| Method | URL | Tujuan |
|--------|-----|--------|
| POST | `/api/product-images` | Upload gambar (multipart: `image`, `product_id`, `is_primary`) |
| DELETE | `/api/product-images/{id}` | Hapus gambar |

---

### 9.7 Banners

| Method | URL | Tujuan |
|--------|-----|--------|
| GET | `/api/banners` | List semua banner |
| GET | `/api/banners/{id}` | Detail banner |
| POST | `/api/banners` | Create (multipart: `image` + metadata) |
| PUT | `/api/banners/{id}` | Update metadata saja |
| POST | `/api/banners/{id}` | Update dengan file gambar baru |
| DELETE | `/api/banners/{id}` | Delete + hapus file |

---

### 9.8 Settings

| Method | URL | Tujuan |
|--------|-----|--------|
| GET | `/api/settings` | Ambil setting situs |
| PUT | `/api/settings` | Update setting |
| POST | `/api/settings` | Update setting (multipart logo/favicon) |

**Fields:** `site_name`, `about_us`, `whatsapp`, `instagram`, `email`, `google_maps_embed`, `featured_title`, `featured_subtitle`, file `logo`, file `favicon`

---

### 9.9 Founders

| Method | URL | Tujuan |
|--------|-----|--------|
| GET | `/api/founders` | List founders (`?active_only=true` opsional) |
| GET | `/api/founders/{id}` | Detail founder |
| POST | `/api/founders` | Create (multipart: `photo`) |
| PUT | `/api/founders/{id}` | Update tanpa file |
| POST | `/api/founders/{id}` | Update dengan FormData |
| PUT | `/api/founders/{id}/toggle` | Toggle is_active |
| DELETE | `/api/founders/{id}` | Delete + hapus foto |

**Body:** `name`*`, `position`*, `whatsapp`, `instagram`, `is_active`, file `photo`

---

### 9.10 Payment Methods

| Method | URL | Tujuan |
|--------|-----|--------|
| GET | `/api/payment-methods` | List active |
| GET | `/api/payment-methods?all=1` | List semua (admin) |
| GET | `/api/payment-methods/{id}` | Detail |
| POST | `/api/payment-methods` | Create (multipart: `logo`) |
| PUT | `/api/payment-methods/{id}` | Update |
| POST | `/api/payment-methods/{id}` | Update dengan logo |
| DELETE | `/api/payment-methods/{id}` | Delete |

---

### 9.11 Cart

| Method | URL | Tujuan |
|--------|-----|--------|
| GET | `/api/cart?user_id={id}` | Ambil isi keranjang |
| POST | `/api/cart` | Tambah item |
| PUT | `/api/cart/{id}` | Update qty (id = cart_item id) |
| DELETE | `/api/cart/{id}` | Hapus item (id = cart_item id) |

**POST body:** `user_id`, `product_id`, `qty`

**Response GET data:**

```json
{
  "items": [ ... ]
}
```

---

### 9.12 Orders

| Method | URL | Tujuan |
|--------|-----|--------|
| GET | `/api/orders` | Semua order (admin) |
| GET | `/api/orders?user_id={id}` | Order per customer |
| GET | `/api/orders/{id}` | Detail order + items |
| POST | `/api/orders` | Checkout |
| PUT | `/api/orders/{id}` | Update payment_status |
| PUT | `/api/orders/{id}/cancel` | Cancel order + restore stock |
| DELETE | `/api/orders/{id}` | Delete order |

**POST checkout body:** `user_id`, `payment_method_id`, `shipping_address`

**PUT update body:** `payment_status` (pending | paid | failed)

**Cancel rule:** Hanya jika `orders.status` ∈ `pending`, `processing`, `shipped`

---

### 9.13 Dashboard & Home

#### GET `/api/dashboard`

**Response data:**

```json
{
  "total_users": 0,
  "total_brands": 0,
  "total_categories": 0,
  "total_products": 0,
  "total_orders": 0,
  "total_revenue": 0,
  "latest_orders": []
}
```

#### GET `/api/home`

**Response data:**

```json
{
  "settings": {},
  "banners": [],
  "categories": [],
  "brands": [],
  "featured_products": []
}
```

---

## 10. Asset Management

### Struktur Assets

```text
assets/
├── css/
│   ├── admin-layout.css       # Shared admin layout
│   ├── customer/
│   │   ├── app.css            # Global customer (navbar, footer, mobile menu)
│   │   ├── auth.css           # Login & register
│   │   ├── home.css
│   │   ├── katalog.css
│   │   ├── cart.css
│   │   ├── checkout.css
│   │   ├── orders.css
│   │   └── ...
│   ├── dashboard.css          # Per-module admin CSS
│   └── ...
└── js/
    ├── admin-layout.js
    ├── customer/
    │   ├── api.js             # Helper fetch API (WAJIB load pertama)
    │   ├── app.js             # Navbar, cart badge, mobile menu
    │   └── {page}.js
    └── {module}.js            # Admin per modul
```

### Pola Loading Asset

**Customer** — via `Welcome::render_page()`:

```php
$page_css = 'home.css';
$page_js  = 'home.js';
// Di layout: assets/css/customer/{page_css}
//            assets/js/customer/{page_js}
```

**Admin** — setiap view admin me-load CSS/JS modul sendiri di dalam view content (mis. `orders.php` load `orders.css` + `orders.js`).

### Upload Path per Modul

| Modul | Folder Upload | Field File | Helper |
|-------|---------------|------------|--------|
| Settings (logo, favicon) | `uploads/settings/` | `logo`, `favicon` | `upload_image()` |
| Brand | `uploads/brands/` | `logo` | `upload_image()` |
| Banner | `uploads/banners/` | `image` | `upload_image()` |
| Product Image | `uploads/products/` | `image` | `upload_image()` |
| Payment Method | `uploads/payments/` | `logo` | `upload_image()` |
| Founder | `uploads/founders/` | `photo` | `upload_image()` |

### Konfigurasi Upload (`upload_helper.php`)

```php
allowed_types: jpg|jpeg|png|webp
max_size: 4096 KB
encrypt_name: TRUE  // filename = hash random
```

### URL Akses Gambar

```text
{base_url}uploads/{folder}/{filename}
```

Helper JS customer:

```javascript
uploadUrl('products', filename)
// → http://localhost/parfume-store/uploads/products/{filename}
```

---

## 11. Coding Convention

### Penamaan Controller

| Tipe | Pola | Contoh |
|------|------|--------|
| Page (customer) | PascalCase, singular | `Welcome`, `Auth` |
| Page (admin) | PascalCase | `Dashboard`, `Parfume`, `Brands` |
| API | PascalCase, plural/singular | `Products`, `Payment_methods`, `Carts` |

Admin controller method umumnya: `index()` → render view.

API controller method: `{action}_{httpverb}()` — contoh: `index_get()`, `store_post()`, `update_put()`, `delete_delete()`.

### Penamaan Model

- Suffix `_model`: `Product_model`, `Order_model`
- File: `application/models/{Name}_model.php`
- Class: `{Name}_model extends CI_Model`

### Struktur API Controller

```php
require APPPATH.'core/Base_api.php';

class Products extends Base_api
{
    public function index_get() {
        return $this->success_response('message', $data);
    }
}
```

### Format JSON Response

Selalu gunakan `success_response()` / `error_response()` dari `Base_api`.

### Struktur View Admin

```php
// Controller
$data = [
    'title'   => 'Orders',
    'content' => 'admin/orders'
];
$this->render_admin($data);

// View admin/orders.php — konten halaman
// Layout admin/layouts/app.php — load sidebar + navbar + $content
```

### Struktur View Customer

```php
// Welcome::render_page()
$data = [
    'page_title' => '...',
    'page_css'   => 'home.css',
    'page_js'    => 'home.js',
    'content'    => 'customer/v_home',
    'site_name'  => '...',
    'site_logo'  => '...'
];
$this->load->view('customer/layouts/app', $data);
```

### JavaScript Convention

| Area | Pola | Base URL Variable |
|------|------|-------------------|
| Customer | Vanilla JS + fetch, `async/await` | `BASE_URL` (uppercase) |
| Admin | jQuery `$.ajax()` | `base_url` (lowercase) |

Customer API helper (`api.js`):

- `apiGet(endpoint)` — return `result.data` (sudah unwrap)
- `apiPost(endpoint, payload)` — JSON body
- `apiPut(endpoint, payload)` — JSON body
- `apiDelete(endpoint)`

### Routing Convention

Semua API route didefinisikan eksplisit di `application/config/routes.php`:

```php
$route['api/products']['GET'] = 'api/products/index';
$route['api/products/{id}']['PUT'] = 'api/products/update/$1';
```

Customer page routes:

```php
$route['katalog'] = 'welcome/katalog';
$route['login'] = 'customer/auth/login';
```

### Helper & Library

| File | Fungsi |
|------|--------|
| `upload_helper.php` | `upload_image($field, $path)` |
| Autoload libraries | `database`, `session`, `form_validation` |
| Autoload helpers | `url`, `form`, `upload` |

### Pola Upload dengan FormData

Untuk update dengan file, project menggunakan **POST** (bukan PUT):

- Banner: `POST /api/banners/{id}`
- Payment: `POST /api/payment-methods/{id}`
- Founder: `POST /api/founders/{id}`
- Settings: `POST /api/settings`

---

## 12. Troubleshooting

### Database tidak terkoneksi

**Gejala:** Error "Unable to connect to the database" atau halaman blank.

**Solusi:**
1. Pastikan MySQL/MariaDB running
2. Cek kredensial di `application/config/database.php`
3. Pastikan database `parfume_v2` sudah di-import dari `database/parfume_v2.sql`

### Halaman 404 / URL tidak berfungsi

**Gejala:** Semua route kecuali `index.php` return 404.

**Solusi:**
1. Aktifkan `mod_rewrite` di Apache
2. Sesuaikan `RewriteBase` di `.htaccess` dengan path project
3. Pastikan `$config['index_page'] = ''` di `config.php`

### base_url salah

**Gejala:** CSS/JS/API request ke URL yang salah.

**Solusi:**
Edit `application/config/config.php`:

```php
$config['base_url'] = 'http://localhost/parfume-store/';
```

Harus ada trailing slash.

### Upload gagal

**Gejala:** Error "Gagal mengupload" atau folder not writable.

**Solusi:**
1. Buat folder `uploads/` dan subfolder jika belum ada
2. Set permission writable (755/777)
3. Cek `allowed_types` dan `max_size` di `upload_helper.php`
4. Pastikan ukuran file <= 4 MB

### Composer belum diinstall

**Gejala:** Error class `RestController` not found.

**Solusi:**

```bash
composer install
```

### Riwayat pesanan customer kosong / error

**Gejala:** Login berhasil tapi order tidak muncul.

**Solusi:**
1. Pastikan `localStorage.customer_user` berisi ID user yang valid
2. Pastikan user tersebut punya data di tabel `orders`
3. `orders.js` harus memakai return `apiGet()` langsung sebagai array (bukan `response.data`)

### Edit founder gagal (Validasi gagal)

**Gejala:** Save founder edit return error validasi.

**Solusi:**
- Edit founder harus via `POST /api/founders/{id}` dengan FormData
- Jangan gunakan PUT untuk multipart upload

### API tidak terautentikasi — data bisa diakses siapa saja

**Gejala:** Semua endpoint `/api/*` bisa dipanggil tanpa login.

**Penjelasan:** Ini adalah behavior saat ini di codebase. Bukan bug konfigurasi — memang belum ada middleware auth di API. Untuk production, perlu ditambahkan token/session validation di `Base_api`.

### Produk tidak bisa dihapus

**Gejala:** API return "Produk tidak dapat dihapus karena sudah digunakan di order".

**Penjelasan:** By design — `Product_model::has_order_items()` mencegah delete jika produk pernah dipesan.

### Admin redirect ke login terus

**Solusi:**
1. Login via `/admin/login`
2. Pastikan flow: `POST api/login` → `POST admin/login/store`
3. Cek session PHP aktif (autoload `session` library)

### Customer terlihat login tapi fitur butuh login gagal

**Solusi:**
- Navbar cek `customer_token`
- Cart/order cek `customer_user` (ID numerik)
- Pastikan keduanya ter-set saat login

---

## Menambah Fitur Baru

Panduan singkat berdasarkan pola yang sudah ada di project:

### Menambah Modul Admin + API Baru

```text
1. Buat tabel di MySQL (+ update parfume_v2.sql)
2. Buat Model        → application/models/{Name}_model.php
3. Buat API          → application/controllers/api/{Name}.php (extends Base_api)
4. Tambah routes     → application/config/routes.php
5. Buat Controller   → application/controllers/admin/{Name}.php (extends MY_Controller)
6. Buat View         → application/views/admin/{name}.php
7. Buat JS + CSS     → assets/js/{name}.js, assets/css/{name}.css
8. Tambah menu       → application/views/admin/layouts/_sidebar_menu.php
```

### Menambah Halaman Customer

```text
1. Tambah method di Welcome.php → render_page(...)
2. Buat view       → application/views/customer/v_{name}.php
3. Buat JS + CSS   → assets/js/customer/{name}.js, assets/css/customer/{name}.css
4. Tambah route    → application/config/routes.php (jika URL custom)
5. Tambah link     → navbar.php
```

### Checklist API Endpoint Baru

- [ ] Method REST: `{action}_{verb}()`
- [ ] Return via `success_response()` / `error_response()`
- [ ] Route terdaftar di `routes.php`
- [ ] Model handle query & validasi bisnis
- [ ] JS admin/customer panggil endpoint dengan method yang benar
- [ ] Upload file gunakan POST + FormData jika ada file

---

## Referensi File Kunci

| File | Peran |
|------|-------|
| `application/config/routes.php` | Semua routing URL |
| `application/config/database.php` | Koneksi MySQL |
| `application/config/config.php` | base_url, index_page |
| `application/config/autoload.php` | Library & helper autoload |
| `application/core/MY_Controller.php` | Admin session guard |
| `application/core/Base_api.php` | Format JSON API |
| `application/helpers/upload_helper.php` | Upload gambar |
| `database/parfume_v2.sql` | Schema & data awal |
| `assets/js/customer/api.js` | Customer API helper |
| `assets/js/customer/app.js` | Customer global UI logic |

---

*Dokumentasi ini dibuat berdasarkan analisis source code project Parfume Store. Jika ada perubahan kode, update README ini agar tetap akurat.*
