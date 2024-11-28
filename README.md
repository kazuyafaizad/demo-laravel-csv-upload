# Sample Laravel App for Product CSV Uploads

This is a Laravel application designed for managing product uploads via CSV files. It utilizes various packages and features, including Laravel Breeze for authentication and Laravel Horizon for queue management.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Features](#features) 
- [Process Development](#features) 

## Installation

To get started with this project, follow these steps:

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd <repository-directory>
   ```

2. Install the dependencies:
   ```bash
   composer install
   npm install
   ```

3. Set up your environment file:
   ```bash
   cp .env.example .env
   ```

4. Generate the application key:
   ```bash
   php artisan key:generate
   ```

5. Run the migrations:
   ```bash
   php artisan migrate
   ```

6. Start the local development server:
   ```bash
   php artisan serve
   ```

7. If you are using Laravel Horizon, you can start it with:
   ```bash
   php artisan horizon
   ```

## Usage

After setting up the application, you can access it at `http://localhost:8000`. 

### Authentication

This application uses Laravel Breeze for authentication. You can register and log in to access protected routes.

### Queue Management

Laravel Horizon is used for managing queues. You can monitor your queues by accessing the Horizon dashboard at `http://localhost:8000/horizon`.

## Features

- **Laravel Breeze**: Simple and minimal authentication scaffolding.
- **Laravel Horizon**: A beautiful dashboard and configuration system for Laravel queues.
- **Model and Controller Generation**: Easily create models and controllers using Artisan commands.
- **CSV Upload**: Functionality to upload CSV files for product data processing.
 
## Process Development

```
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

```
