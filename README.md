# OnlineShop-CI3 — Nomadenstuff

A thrift store e-commerce web application built with CodeIgniter 3.1.11.

**Admin credentials:** `admin` / `admin`

---

## Tech Stack

| Layer        | Technology                                                |
| ------------ | --------------------------------------------------------- |
| Backend      | PHP 5.3.7+ — CodeIgniter 3.1.11 (MVC framework)           |
| Database     | MySQL (mysqli driver) — `nomadenstuff`                    |
| Frontend     | Bootstrap 4, jQuery, FontAwesome, Owl Carousel            |
| Admin Theme  | SB Admin 2                                                |
| PDF          | Dompdf ^2.0 (via Composer)                                |
| Shipping API | RajaOngkir (Starter plan)                                 |
| Auth         | Custom session-based (two separate systems: user + admin) |

---

## Directory Structure

```
├── application/
│   ├── config/          # Config, database, routes, autoload, rajaongkir
│   ├── controllers/     # User controllers (Home, Shop, Cart, Login...)
│   │   └── admin/       # Admin controllers (Dashboard, Product, Order...)
│   ├── core/            # MY_Controller, MY_Model
│   ├── helpers/         # online-shop-ci_helper.php
│   ├── libraries/       # Pdfgenerator, Rajaongkir
│   ├── models/          # 15 models extending MY_Model
│   └── views/           # Layouts + page views (user/admin/auth)
├── assets/              # CSS, JS, vendor libs, images
├── images/              # Uploads: product/, profile/, slider/, confirm/
├── system/              # CI 3.1.11 framework core
└── vendor/              # Composer packages (dompdf, etc.)
```

---

## MVC Architecture

### Base Classes

All user controllers extend **`MY_Controller`** (`application/core/MY_Controller.php`), which in its constructor **auto-loads the matching model**:

```
Home  controller → Home_model  as $this->home  → targets `home`  table
Shop  controller → Shop_model  as $this->shop  → targets `shop`  table
Cart  controller → Cart_model  as $this->cart  → targets `cart`  table
...and so on
```

All models extend **`MY_Model`** (`application/core/MY_Model.php`), which provides a fluent/chainable query builder:

```php
$this->product
    ->where('is_available', 1)
    ->like('title', $keyword)
    ->orderBy('price', 'ASC')
    ->paginate($page)
    ->get();
```

### Request Lifecycle

```
1. Browser hits  /shop/detail/denim-jacket
                     ↓
2. .htaccess     Rewrites to index.php/shop/detail/denim-jacket
                     ↓
3. Router        Matches routes.php → Shop::detail($slug)
                     ↓
4. Controller    Shop constructor auto-loads Shop_model
                 (MY_Controller magic)
                     ↓
5. Action        Shop::detail($slug):
                 • $this->shop->where('slug', $slug)->first()
                 • Data returned as objects/arrays
                     ↓
6. View          $this->view($data)
                 → loads layouts/user/app.php
                 → includes pages/users/detail.php
                 → renders $product data
                     ↓
7. Response      HTML sent back to browser
```

### Key Conventions

| Convention                     | Implementation                                                               |
| ------------------------------ | ---------------------------------------------------------------------------- |
| **Controller → Model mapping** | `MY_Controller` auto-loads `{Classname}_model` as `$this->{classname}`       |
| **Table auto-detection**       | `MY_Model` derives table name from class name (`Home_model` → `home`)        |
| **Validation**                 | Models declare `getValidationRules()`, called via `$this->model->validate()` |
| **Pagination**                 | `MY_Model::paginate($page)` + `makePagination()`, each model sets `$perPage` |
| **Image uploads**              | Models define `uploadImage()` / `deleteImage()` — stored in `images/`        |
| **Soft delete**                | Products use `delete` column (0/1) rather than hard deletion                 |

### Routing (routes.php)

| URL                          | Controller::method                       |
| ---------------------------- | ---------------------------------------- |
| `/`                          | `Home::index()`                          |
| `/login`                     | `Login::index()`                         |
| `/register`                  | `Register::index()`                      |
| `/logout`                    | `Logout::index()`                        |
| `/shop`                      | `Shop::index()`                          |
| `/shop/men`                  | `Shop::men()`                            |
| `/shop/women`                | `Shop::women()`                          |
| `/shop/category/{slug}`      | `Shop::category()`                       |
| `/shop/search`               | `Shop::search()`                         |
| `/shop/detail/{slug}`        | `Shop::detail()`                         |
| `/cart/*`                    | `Cart::*()`                              |
| `/checkout/*`                | `Checkout::*()`                          |
| `/myorder/{num}`             | `Myorder::index($page)`                  |
| `/myorder/detail/{invoice}`  | `Myorder::detail()`                      |
| `/myorder/confirm/{invoice}` | `Myorder::confirm()`                     |
| `/myorder/cancel/{invoice}`  | `Myorder::cancel()`                      |
| `/profile/*`                 | `Profile::*()`                           |
| `/admin`                     | `admin/Admin::index()`                   |
| `/admin/dashboard`           | `admin/Dashboard::index()`               |
| `/admin/category`            | `admin/Category::index()`                |
| `/admin/product`             | `admin/Product::index()`                 |
| `/admin/order`               | `admin/Order::index()`                   |
| `/admin/order/report`        | `admin/Order::report()` (PDF via Dompdf) |
| `/admin/slider`              | `admin/Slider::index()`                  |
| `/admin/customer`            | `admin/Customer::index()`                |
| `/admin/setting/{id}`        | `admin/Setting::index($id)`              |

---

## Authentication

Two entirely separate auth systems:

### User Auth (front-end store)

- **Table:** `user`
- **Login:** `Login` controller → `Login_model::run()` verifies with `password_verify()`
- **Session:** `{id, name, email, is_login}`
- **Protected:** Cart, Checkout, Myorder, Profile controllers check `is_login` in constructor

### Admin Auth (back-end panel)

- **Table:** `admin`
- **Login:** `admin/Admin` controller → direct `password_verify()`
- **Session:** `{id, username, role}`
- **Protected:** All admin controllers check admin session in constructor

---

## Controllers

### User-Facing (all extend `MY_Controller`)

| Controller           | Purpose                                                           |
| -------------------- | ----------------------------------------------------------------- |
| `Home`               | Landing page — slider, men's & women's products                   |
| `Login` / `Register` | User authentication                                               |
| `Shop`               | Product browsing, filtering by men/women/category, search, detail |
| `Cart`               | Cart CRUD (add, update quantity, delete)                          |
| `Checkout`           | Checkout with RajaOngkir shipping cost calculation                |
| `Myorder`            | Order history, payment confirmation upload, cancel                |
| `Profile`            | User profile update                                               |
| `Logout`             | Session destroy + redirect (extends CI_Controller)                |

### Admin (extend `CI_Controller` or `MY_Controller`)

| Controller  | Purpose                              |
| ----------- | ------------------------------------ |
| `Admin`     | Admin login/logout                   |
| `Dashboard` | Counts: users, products, orders      |
| `Category`  | Category CRUD                        |
| `Product`   | Product CRUD with image upload       |
| `Order`     | Order management + PDF report export |
| `Customer`  | Customer/user management             |
| `Slider`    | Homepage slider CRUD                 |
| `Setting`   | Admin profile settings               |

---

## Models (all extend `MY_Model`)

| Model             | Table      | Highlights                           |
| ----------------- | ---------- | ------------------------------------ |
| `Home_model`      | `product`  | PerPage=40                           |
| `Login_model`     | `user`     | Auth logic with `password_verify`    |
| `Register_model`  | `user`     | Registration with validation         |
| `Shop_model`      | `product`  | PerPage=12                           |
| `Cart_model`      | `cart`     | Minimal                              |
| `Checkout_model`  | `orders`   | Order creation                       |
| `Myorder_model`   | `orders`   | Order queries + payment image upload |
| `Profile_model`   | `user`     | Profile update + image upload        |
| `Category_model`  | `category` | PerPage=5                            |
| `Product_model`   | `product`  | PerPage=8 + image upload             |
| `Order_model`     | `orders`   | Joins order + order_detail           |
| `Customer_model`  | `user`     | PerPage=10                           |
| `Dashboard_model` | dynamic    | Dynamic table setting                |
| `Setting_model`   | `admin`    | Admin profile update                 |
| `Slider_model`    | `slider`   | PerPage=6 + image upload             |

---

## Custom Libraries

| Library        | Purpose                                                           |
| -------------- | ----------------------------------------------------------------- |
| `Pdfgenerator` | Wraps Dompdf for PDF order reports                                |
| `Rajaongkir`   | RajaOngkir API client — shipping cost, provinces, cities, waybill |

## Custom Helper (`online-shop-ci_helper.php`)

| Function                            | Purpose                                     |
| ----------------------------------- | ------------------------------------------- |
| `getDropdownList($table, $columns)` | Generate `<select>` options from a DB table |
| `getCategories()`                   | Fetch all categories                        |
| `getCart()`                         | Get cart item count for logged-in user      |
| `hashEncrypt($input)`               | `password_hash()` wrapper                   |
| `hashEncryptVerify($input, $hash)`  | `password_verify()` wrapper                 |

---

## Database

Key tables:

- **`user`** — Customer accounts
- **`admin`** — Admin accounts
- **`category`** — Product categories (id, title, slug)
- **`product`** — Products (id, id_category, title, slug, description, price, type[L/W], image, is_available, delete)
- **`cart`** — Shopping cart items (id, id_user, id_product, quantity, message, sub_total)
- **`orders`** — Orders (id, id_user, invoice, total, status, courier, cost_courier, waybill, address, city, province)
- **`order_detail`** — Order line items
- **`order_confirm`** — Payment confirmations (account_name, nominal, note, image)
- **`slider`** — Homepage slider images

Product `type` column: `'L'` = Laki-laki (Men), `'W'` = Wanita (Women).

---

## Data Flow Example: Add to Cart

```
POST /cart/add  (product_id, qty)
  → Cart::add()
    → Checks $this->session->userdata('is_login')
    → $this->cart->create([...])     // MY_Model insert
    → Sets flashdata success message
    → Redirects back to referring page
```

```
GET /cart
  → Cart::index()
    → $this->cart->where('id_user', $userId)->get()
    → $this->view('pages/users/cart', ['cart' => $items, 'subtotal' => ...])
    → Renders cart table with quantity inputs + delete buttons
```
