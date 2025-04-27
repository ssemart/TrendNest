# TrendNest Project Setup Guide

This guide provides step-by-step instructions for setting up the TrendNest_YT Laravel project on a new computer.

## Prerequisites

Before starting the setup, ensure your system has the following requirements:

- PHP 8.1 or higher
- Composer (PHP package manager)
- Node.js and npm
- MySQL/MariaDB
- Git (optional, for version control)

## Setup Steps

### 1. Project Files Transfer

1. Copy the entire `TrendNest` project folder to the new computer
2. Ensure all files are copied except for:
   - `vendor` directory (will be installed later)
   - `.env` file (if you have one, copy it but update the credentials)
   - Any local development files or logs

### 2. Install PHP and Required Extensions

1. Download and install PHP from [php.net](https://www.php.net/downloads.php)
2. Install Composer by running:
   ```bash
   curl -sS https://getcomposer.org/installer | php
   mv composer.phar /usr/local/bin/composer
   ```
3. Install Node.js from [nodejs.org](https://nodejs.org/)

### 3. Install Project Dependencies

1. Open terminal in your project directory
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Install JavaScript dependencies:
   ```bash
   npm install
   ```

### 4. Database Setup

1. Install MySQL/MariaDB
2. Create a new database for your project
3. Copy the `.env.example` file to `.env` if it doesn't exist:
   ```bash
   copy .env.example .env
   ```
4. Update the database credentials in `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

### 5. Key Generation

Generate a new application key:
```bash
php artisan key:generate
```

### 6. Database Migration

1. Run migrations to create database tables:
   ```bash
   php artisan migrate
   ```
2. If you have seed data, run:
   ```bash
   php artisan db:seed
   ```

### 7. Asset Compilation

Compile your assets:
```bash
npm run build
```

### 8. Storage Configuration

Create the storage symbolic link:
```bash
php artisan storage:link
```

### 9. Start the Development Server

1. Start the Laravel development server:
   ```bash
   php artisan serve
   ```
2. Access your application at `http://localhost:8000`

## Troubleshooting

### Common Issues and Solutions

1. **Composer Installation Issues**
   - Solution: Run `composer self-update` to get the latest version
   - Alternative: Download and install from [getcomposer.org](https://getcomposer.org/download/)

2. **Database Connection Issues**
   - Check if MySQL service is running
   - Verify database credentials in `.env` file
   - Ensure MySQL port is not blocked by firewall

3. **Asset Compilation Errors**
   - Clear npm cache: `npm cache clean --force`
   - Reinstall dependencies: `npm install`
   - Try different build command: `npm run dev`

4. **Storage Permissions**
   - Ensure `storage` directory has proper write permissions
   - Run: `chmod -R 775 storage`

## Additional Configuration

### Environment Variables

Update the following variables in your `.env` file as needed:

```env
APP_NAME="TrendNest_YT"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Custom Services

If you're using additional services (like Redis, Mail server, etc.), configure them in the `.env` file according to your needs.

## Security Notes

1. Never commit your `.env` file to version control
2. Keep your database credentials secure
3. Regularly update your dependencies
4. Use HTTPS in production environment

## Support

If you encounter any issues during setup, please:
1. Check the Laravel logs in `storage/logs/laravel.log`
2. Verify your PHP error logs
3. Check for any JavaScript compilation errors in the terminal

For additional help, refer to the official Laravel documentation: [laravel.com/docs](https://laravel.com/docs)

storage link
php artisan storage:link


First, I'll check if the storage link exists and delete it if it does, then recreate it:
d:\Xampp\htdocs\Ecommerce\TrendNest\public\storage
php artisan storage:link --force
ls -l d:\Xampp\htdocs\Ecommerce\TrendNest\public\storage

php artisan make:migration modify_product_price_columns

Go to the admin panel and edit your categories
Upload images for each category (recommended size 800x600 pixels)
The categories will automatically appear in a responsive grid on your homepage, with the images as backgrounds and category names overlaid
When you hover over a category, there will be a nice zoom effect and the overlay will darken slightly
Clicking a category will take users to that category's product listing page