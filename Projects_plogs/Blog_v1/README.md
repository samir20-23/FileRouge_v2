php artisan make:model User -m -s
php artisan make:model Document -m -s
php artisan make:model Categorie -m -s 
php artisan make:model Validation -m -s
php artisan make:controller UserController --resource
php artisan make:controller DocumentController --resource
php artisan make:controller CategorieController --resource
php artisan make:controller ValidationController --resource
composer require laravel/breeze --dev
php artisan breeze:install
php artisan migrate
php artisan migrate
php artisan db:seed 
npm install 
npm run dev
