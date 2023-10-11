- composer require laravel/breeze --dev
- php artisan breeze:install
- composer require laravel/horizon
- php artisan horizon:install
- php artisan make:model Product -m
- php artisan make:controller UploadProductController
- php artisan make:model CsvUpload -m
- php artisan make:request UploadCsvRequest

composer install
php artisan migrate
php artisan serve
php artisan horizon
