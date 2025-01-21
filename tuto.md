Here’s an updated `tutorial.md` file that uses the **AdminLTE package** via Composer (`jeroennoten/laravel-adminlte`):

```markdown
# Laravel Project Setup with Laravel-AdminLTE and 13.Eloquence_advanced

This guide explains how to create a Laravel project, integrate **Laravel-AdminLTE**, and set up the **13.Eloquence_advanced** project with Spatie permissions.

---

## **1. Create a New Laravel Project**

```bash
composer create-project laravel/laravel Blog_app
cd Blog_app
```

---

## **2. Configure Database**

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

## **3. Install Laravel-AdminLTE**

```bash
composer require jeroennoten/laravel-adminlte
```

Publish the AdminLTE package configuration:

```bash
php artisan adminlte:install
```

Run the build process to compile the assets:

```bash
npm install
npm run dev
```

---

## **4. Configure Laravel-AdminLTE**

Edit the `config/adminlte.php` file to customize your AdminLTE settings, like menu items or layout.

To set the AdminLTE layout for your application, update the `resources/views/welcome.blade.php` file or any other view:

```blade
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Welcome to AdminLTE</h1>
@endsection

@section('content')
    <p>Your content goes here.</p>
@endsection
```

Run the application to verify the integration:

```bash
php artisan serve
```

---

## **5. Install Spatie Permissions**

```bash
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
```

Add the `HasRoles` trait to the `User` model:

```php
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
}
```

Register middleware in `App\Http\Kernel.php`:

```php
protected $routeMiddleware = [
    'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
    'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
    'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
];
```

---

## **6. Clone the 13.Eloquence_advanced Project**

```bash
git clone https://github.com/SolicodeDev/13.Eloquence_advanced.git
cd 13.Eloquence_advanced
```

---

## **7. Install Dependencies**

```bash
composer install
npm install
```

---

## **8. Configure `.env`**

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

## **9. Key Generation and Database Setup**

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
```

---

## **10. Run the Application**

```bash
npm run dev
php artisan serve
```

---

## **11. Presentation**

You can view the presentation [here](https://suirita.github.io/13.Eloquence_advanced/).

---

This will generate the necessary views for login, registration, and password reset, and compile the frontend assets.

3. **Run the migrations**:
```bash
php artisan migrate
```

This creates the necessary tables for users in your database.

---

### **Step 4: Set Up Routes and Controllers**

Create a controller for handling the document upload functionality.

1. **Create the Document Controller**:
```bash
php artisan make:controller DocumentController
```

2. **Add the upload function to `DocumentController.php`**:
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;

class DocumentController extends Controller
{
    public function upload(Request $request)
    {
        // Validate and upload the file
        $request->validate([
            'document' => 'required|file|mimes:pdf,docx,txt|max:10240',
        ]);

        $file = $request->file('document');
        $path = $file->storeAs('documents', $file->getClientOriginalName());

        Document::create([
            'titre' => $file->getClientOriginalName(),
            'chemin_fichier' => $path,
        ]);

        return redirect()->route('documents.index');
    }

    public function index()
    {
        $documents = Document::all();
        return view('documents.index', compact('documents'));
    }
}
```

---

### **Step 5: Create the Document Model and Migration**
1. **Create the Document model**:
```bash
php artisan make:model Document -m
```

2. **Add the migration code** for creating the documents table in the `database/migrations/{date}_create_documents_table.php` file:
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('chemin_fichier');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
```

3. **Run the migration**:
```bash
php artisan migrate
```

---

### **Step 6: Create Views for Document Management**

1. **Create a Blade view for the document upload form** in `resources/views/documents/create.blade.php`:
```blade
@extends('adminlte::page')

@section('title', 'Upload Document')

@section('content_header')
    <h1>Upload Document</h1>
@stop

@section('content')
    <form action="{{ route('documents.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="document">Document</label>
            <input type="file" name="document" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
@stop
```

2. **Create a Blade view for listing documents** in `resources/views/documents/index.blade.php`:
```blade
@extends('adminlte::page')

@section('title', 'Documents')

@section('content_header')
    <h1>Documents List</h1>
@stop

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>File</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
                <tr>
                    <td>{{ $document->titre }}</td>
                    <td><a href="{{ Storage::url($document->chemin_fichier) }}" target="_blank">View</a></td>
                    <td>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
```

---

### **Step 7: Update Routes**
Open `routes/web.php` and add the following routes for document upload and display:

```php
use App\Http\Controllers\DocumentController;

Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
Route::post('/documents/upload', [DocumentController::class, 'upload'])->name('documents.upload');
```

---

### **Step 8: Set Up AdminLTE Layout**
Ensure you’re using the AdminLTE layout for the pages by updating your `resources/views/layouts/app.blade.php` or directly in the `create.blade.php` and `index.blade.php` files, as shown in the above views.

Make sure your `config/adminlte.php` file is configured to use AdminLTE's default layout.

---

### **Step 9: Create Document Model**
As shown in Step 5, make sure your `app/Models/Document.php` file looks like this:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'chemin_fichier',
    ];
}
```

---

### **Step 10: Test Your Application**

1. Run the application using:
```bash
php artisan serve
```

2. Open the application in your browser (`http://localhost:8000`), log in, and test the document upload and display features.

---

### **Conclusion**
This is a basic Laravel project setup with AdminLTE for managing document uploads and sharing. You can expand this further by adding more functionality like user roles, access control, and categorization for the documents.

Let me know if you need more detailed explanations or further customization for your project!