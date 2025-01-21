Here’s the concise, step-by-step guide to set up **AdminLTE** and the **13.Eloquence_advanced** project in Laravel:

---

### **1. Create a New Laravel Project**
```bash
composer create-project laravel/laravel Blog_app
cd Blog_app
```

---

### **2. Configure Database**
Edit the `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Blog_app
DB_USERNAME=root
DB_PASSWORD=
```

Run database migrations:
```bash
php artisan migrate
```

Serve the application:
```bash
php artisan serve
```

---

### **3. Install Laravel/UI**
```bash
composer require laravel/ui
php artisan ui bootstrap --auth
npm install
```

---

### **4. Install AdminLTE**
```bash
npm i admin-lte --save
npm run dev
```

---

### **5. Install Spatie Permission**
```bash
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
```

Add `HasRoles` trait to **User model**:
```php
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
}
```

Register middleware in `bootstrap/app.php`:
```php
$middleware->alias([
    'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
    'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
    'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
]);
```

---

### **6. Clone the Project**
```bash
git clone https://github.com/SolicodeDev/13.Eloquence_advanced.git
cd 13.Eloquence_advanced
```

---

### **7. Install Dependencies**
```bash
composer install
npm install
```

---

### **8. Configure `.env`**
```bash
cp .env.example .env
```

Edit the `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Blog_app
DB_USERNAME=root
DB_PASSWORD=
```

---

### **9. Key Generation and Database Setup**
```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
```

---

### **10. Run the Application**
```bash
npm run dev
php artisan serve
```

---

Let me know if you need help with a specific step!