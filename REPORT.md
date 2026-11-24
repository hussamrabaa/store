# Store Admin Panel — Build Report

A learning report describing what was built, how it works, and how to run it.

## Overview

- Converted the static site into a **Laravel 13** app in the same repo (existing `.git` preserved).
- Moved assets: `views/images` -> `public/images`, `css/` -> `public/css`, `js/` -> `public/js`.
- Added **Laravel Breeze (Blade)** authentication.
- Database `store` is now managed by Laravel migrations: `users` (with `role`) and `products`.
- Admin panel: dashboard, product CRUD with image upload, user/role management.
- Storefront homepage reads products from MySQL.
- Seeded demo accounts and 3 sample products.

## How to run

```powershell
cd C:\laragon\www\store
php artisan serve
```

- Storefront: http://127.0.0.1:8000/
- Login: http://127.0.0.1:8000/login
- Admin dashboard: http://127.0.0.1:8000/dashboard

## Accounts

Change these passwords after first login.

| Role   | Email               | Password   |
|--------|---------------------|------------|
| Admin  | admin@store.local   | Admin123!  |
| Editor | editor@store.local  | Editor123! |
| User   | user@store.local    | User123!   |

## Key files and concepts

### Routing — `routes/web.php`

- `Route::get('/', [HomeController::class, 'index'])` maps a URL to a controller method.
- `Route::middleware('auth')` requires login.
- `Route::middleware('role:admin,editor')` is a custom gate using the role middleware.
- `Route::resource('products', ...)` auto-creates index/create/store/edit/update/destroy routes.

### Controllers — `app/Http/Controllers/`

- `HomeController.php` — loads products for the storefront.
- `Admin/DashboardController.php` — counts for the dashboard.
- `Admin/ProductController.php` — CRUD + validation + image handling.
- `Admin/UserController.php` — role management (admin only).
- MVC idea: controllers coordinate, models talk to the DB, views render HTML.

### Models — `app/Models/`

- `User.php`: `role`, `isAdmin()`, `isEditor()`, and `products()` relationship.
- `Product.php`: fillable fields and `user()` relationship.
- Eloquent relationships: `User hasMany Product`, `Product belongsTo User`.

### Migrations — `database/migrations/`

- `0001_01_01_000000_create_users_table.php`: includes the `role` enum (`admin`/`editor`/`user`).
- `2026_11_24_161411_create_products_table.php`: name, description, price, nullable image,
  `user_id` foreign key with cascade delete, timestamps.
- Migrations are version-controlled schema changes — `php artisan migrate` applies them.

### Middleware — `app/Http/Middleware/EnsureRole.php`

- Reads the logged-in user's `role`; calls `abort(403)` if not allowed.
- Registered as the alias `role` in `bootstrap/app.php`.

### Views — `resources/views/`

- `home.blade.php`: the original design, now looping `@foreach ($products as $product)`.
- `admin/products/{index,create,edit,_form}.blade.php`
- `admin/users/{index,edit}.blade.php`
- Blade: `{{ }}` escapes output (XSS safety); `@csrf`, `@method`, `@foreach`, `@if`.

### Uploads

- Admin uploads go to `storage/app/public/products/` (outside the webroot).
- `php artisan storage:link` created `public/storage` -> symlink so the browser can load
  `/storage/products/...`.
- Validation: `image`, `mimes:jpg,jpeg,png,webp`, `max:2048` (2 MB).
- Old files are deleted on update/delete.

### Config — `.env`

- `DB_CONNECTION=mysql`, `DB_DATABASE=store`, `DB_USERNAME=root`, empty password.
- `.env` is gitignored; `.env.example` documents the expected values.

## Verification performed

- `/` returns 200; sample product "Classic Tee" rendered from the DB; image served from `/storage/...`.
- `/login` returns 200; unauthenticated `/dashboard` and `/admin/products` redirect to login.
- Admin: dashboard, products, and users pages all 200.
- Editor: products 200, users page **403** (role enforcement works).
- Upload test: created a product with an image -> row in DB, file on disk, appeared in admin list
  and storefront.
- Delete test: removed the DB row **and** the image file.

## Notes and next steps

- **Change the seeded passwords** immediately (Profile -> Update Password, or via `/admin/users`).
- **Public registration is enabled** by Breeze; anyone can create a `user` account. Disable it if
  you don't want that (remove the `register` routes in `routes/auth.php`).
- **Image gotcha:** several existing `images/*.png` files are actually JPEG/AVIF content. Display
  works, but uploads whose real type isn't in the allowed list are rejected — correct behavior.
  New uploads are stored with the correct extension.
- **User deletion:** the DB cascade removes that user's product rows, but their image files are not
  auto-deleted (cascade bypasses Eloquent events). Add cleanup if needed.
- **Production:** set `APP_ENV=production`, `APP_DEBUG=false`, then run `php artisan optimize` and
  `npm run build`.
- **Migrations note:** `migrate:fresh` did not clear the manually-created tables in this
  environment, so the old `users`/`products` were dropped manually and then `migrate --seed` was
  run. Use migrations for all future schema changes.
- No git commit was made. `git status` shows the old static files deleted and the Laravel app added.
