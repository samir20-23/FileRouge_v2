# 13.Eloquence_advanced

## Installation:

- Create a new Laravel project

```bash
composer create-project laravel/laravel Blog_app

cd Blog_app
```

- configure `.env` file

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Blog_app
DB_USERNAME=root
DB_PASSWORD=
```

- migrate database

```bash
php artisan migrate
```

- serve the application

```bash
php artisan serve
```

- install laravel/ui

```bash
composer require laravel/ui
php artisan ui bootstrap --auth
npm install
```

- install admin-lte

```bash
npm i admin-lte --save
npm run dev
```

- install spatie

```bash
composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

php artisan migrate
```

- Add the necessary trait to the `User` model:

```php
use HasRoles;
```

- register the middleware in `bootstrap\app.php`:

```php
$middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
```

## Cloning

- Clone the Project

```bash
git clone https://github.com/SolicodeDev/13.Eloquence_advanced.git
cd 13.Eloquence_advanced
```

- Install the dependencies

```bash
composer install
npm install
```

- Copy the `.env.example` file to `.env`

```bash
cp .env.example .env
```

- Configure the `.env` file

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=Blog_app
DB_USERNAME=root
DB_PASSWORD=
```

- Generate the key

```bash
php artisan key:generate
```

- Migrate the database

```bash
php artisan migrate
```

- Seed the database

```bash
php artisan db:seed
```

- Run the application

```bash
npm run dev

php artisan serve
```

## Presentation

[Presentation](https://suirita.github.io/13.Eloquence_advanced/)
