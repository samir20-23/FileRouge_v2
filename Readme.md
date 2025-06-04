 
# Laravel Document Management System

A simple Laravel-based application for uploading and managing documents (PDFs, videos) with role-based access (admin vs. user).

## Features

- **Role-based Authentication**  
  - Admins can manage categories, documents, and validations (CRUD).  
  - Regular users can upload/view their own documents.

- **Document Upload & Storage**  
  - Files are stored under `storage/app/public/documents`.  
  - Publicly accessible via `public/storage/documents` (after running `php artisan storage:link`).

- **Category Management**  
  - Admins can create, read, update, delete categories via a CRUD interface.
  - AJAX search and statistics endpoints for categories (`categories-api/search`, `categories-api/stats`).

- **Document Management**  
  - Users upload documents through a form (`documents.create`).  
  - Admins CRUD all documents; users see only their own under “My Documents”.  
  - Download/view routes:  
    ```
    GET  /documents/{id}/download
    GET  /documents/{id}/view
    ```

- **Validation Workflow**  
  - Users submit validations on documents; admins approve/reject via `/validations` routes.  
  - Pending validations list: `GET /validations-pending`.  
  - AJAX check if a document already has a validation.

- **Admin Dashboard (AdminLTE)**  
  - Uses AdminLTE templates for a consistent admin UI.  
  - DashboardController handles `/dashboard` for admins; regular users get redirected to `/home`.

## Requirements

- PHP ≥ 8.0  
- Composer  
- Laravel 10.x  
- MySQL (or any supported SQL database)  
- Node.js & NPM (for compiling frontend assets if needed)  

## Installation

1. **Clone the repository**  
   ```bash
   git clone https://github.com/<your-username>/your-repo.git
   cd your-repo
````

2. **Install Composer dependencies**

   ```bash
   composer install
   ```

3. **Copy `.env.example` to `.env` and configure**

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   * Set `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` in `.env`.

4. **Run migrations & seeders**

   ```bash
   php artisan migrate --seed
   ```

   * This creates `users`, `documents`, `categories`, `validations`, etc.
   * The provided `UsersSeeder` seeds an admin user (`admin@gmail.com` / `admin`) and sample regular users.

5. **Create the storage symlink**

   ```bash
   php artisan storage:link
   ```

6. **Compile frontend assets (optional)**
   If you modify CSS/JS or use Laravel Mix:

   ```bash
   npm install
   npm run dev
   ```

7. **Serve the application**

   ```bash
   php artisan serve
   ```

   Visit `http://127.0.0.1:8000`.

## Usage

* **Login as Admin**

  * Email: `admin@gmail.com`
  * Password: `admin`
    → Redirected to `/dashboard`.

* **Login as Regular User**

  * Email: `samir@example.com` / `alex@example.com` (passwords set in seeder)
    → Redirected to `/home`.

* **Admin-Only Routes**

  * All routes under `/dashboard`, `/categories/*`, `/documents/*`, `/validations/*` require `is_admin` middleware.
  * If a non-admin tries to access, they’ll see an “Access Denied” warning or be redirected to `/home`.

* **Category Management (Admin)**

  ```
  GET    /categories
  GET    /categories/create
  POST   /categories
  GET    /categories/{id}
  GET    /categories/{id}/edit
  PUT    /categories/{id}
  DELETE /categories/{id}
  ```

* **Document Management**

  * **Upload (User):**

    ```
    GET  /documents/create
    POST /documents
    ```

    Form uses `<input type="file" name="file">`. Controller stores file under `storage/app/public/documents` and saves path in the `documents` table (`path` column).

  * **My Documents (User):**

    ```
    GET /my-documents
    ```

  * **Admin CRUD (Admin):**

    ```
    GET    /documents
    GET    /documents/{id}
    GET    /documents/{id}/edit
    PUT    /documents/{id}
    DELETE /documents/{id}
    POST   /documents/bulk-action
    ```

  * **Download / View**

    ```
    GET /documents/{id}/download
    GET /documents/{id}/view
    ```

* **Validation Workflow**

  * **Create Validation (User):**

    ```
    GET  /documents/{document}/validations/create
    POST /documents/{document}/validations
    ```

  * **Pending Validations (Admin):**

    ```
    GET /validations-pending
    POST /validations/{id}/approve
    POST /validations/{id}/reject
    POST /validations/bulk-action
    ```

  * **Download/View Document by Validation**

    ```
    GET /validations/document/{document}/download
    GET /validations/document/{document}/view
    ```

  * **AJAX Check (Any Authenticated User):**

    ```
    GET /documents/{document}/validation-exists
    ```

## Database Structure

* **users**

  * `id`, `name`, `email`, `role` (string, e.g. “admin”/“User”), `password`, timestamps, `is_admin` (boolean, if you added it).

* **categories**

  * `id`, `name`, timestamps.

* **documents**

  * `id`, `title`, `description` (optional), `path` (string; e.g. `documents/filename.pdf`), `user_id` (foreign key), timestamps.

* **validations**

  * `id`, `document_id` (foreign key), `validated_by` (user\_id of admin), `status` (enum: pending/approved/rejected), `comments`, timestamps.

## Folder Layout

```
app/
├─ Http/
│  ├─ Controllers/
│  │  ├─ Auth/
│  │  │  └─ LoginController.php (role-based redirectTo)
│  │  ├─ DashboardController.php
│  │  ├─ CategorieController.php
│  │  ├─ DocumentController.php
│  │  ├─ ValidationController.php
│  │  └─ HomeController.php
│  └─ Middleware/
│     └─ IsAdmin.php (restrict admin routes)
├─ Models/
│  ├─ User.php (add isAdmin() helper)
│  ├─ Category.php
│  ├─ Document.php
│  └─ Validation.php
resources/
├─ views/
│  ├─ auth/ (login/register)
│  ├─ categories/ (index, create, edit, show)
│  ├─ documents/ (index, create, edit, show, my-documents)
│  ├─ validations/ (index, pending, create, show)
│  ├─ dashboard.blade.php
│  ├─ home.blade.php
│  └─ layouts/ (AdminLTE integration)
routes/
└─ web.php (routes with `auth` and `is_admin` middleware)
storage/
├─ app/
│  └─ public/
│     └─ documents/ (uploaded files)
└─ framework/ (cache, sessions)
public/
├─ storage/ → symlink to `storage/app/public`
└─ vendor/adminlte/dist/img/ (contains your 404GIF.gif)
database/
├─ migrations/
└─ seeders/UsersSeeder.php
```

## Quick Tips

* **`php artisan storage:link`** → exposes `storage/app/public` under `public/storage`.

* In controllers, to store an uploaded file:

  ```php
  $path = $request->file('file')->store('documents', 'public');
  ```

  and save `$path` (e.g. `documents/xyz.pdf`) in the `documents` table.

* In Blade, to link/download a stored file:

  ```blade
  <a href="{{ asset('storage/' . $document->path) }}" target="_blank">View</a>
  ```

* Guard admin routes by adding **`->middleware(['auth','is_admin'])`** or grouping them under an `is_admin` middleware in `web.php`.

* Use `auth()->user()->isAdmin()` (define that method in `User` model) to check admin status in Blade.

 