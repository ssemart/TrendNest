# TrendNest E-commerce Installation Guide

This guide will help you transfer and set up the TrendNest e-commerce project on a new computer while preserving your existing database.

## Prerequisites

1. Install the following software on the new computer:
   - XAMPP (with PHP 8.1 or higher)
   - Composer
   - Node.js and npm
   - Git (optional but recommended)

## Step 1: Database Backup

Before moving the project, create a backup of your current database:

1. Open phpMyAdmin on your current computer
2. Select your project's database
3. Click on "Export" in the top menu
4. Choose "Custom" export method
5. Select "SQL" as the format
6. Click "Go" to download the database backup file (save it as `trendnest_backup.sql`)

## Step 2: Project Transfer

### Option 1: Using Git (Recommended)

1. If your project is not already in a Git repository:
   ```bash
   git init
   git add .
   git commit -m "Initial commit"
   ```
2. Create a repository on GitHub/GitLab/Bitbucket
3. Push your code to the remote repository
4. On the new computer, clone the repository:
   ```bash
   git clone <repository-url>
   ```

### Option 2: Manual Transfer

1. Create a ZIP archive of your entire project folder
2. Exclude the following directories when creating the ZIP:
   - /vendor
   - /node_modules
   - /storage/*.key
   - /public/storage
   - /public/hot
3. Transfer the ZIP file to the new computer
4. Extract the ZIP file in your desired location

## Step 3: Project Setup on New Computer

1. Navigate to the project directory:
   ```bash
   cd path/to/TrendNest
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install JavaScript dependencies:
   ```bash
   npm install
   ```

4. Create environment file:
   - Copy `.env.example` to `.env`
   - Update database credentials in `.env` to match your new environment

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Create symbolic link for storage:
   ```bash
   php artisan storage:link
   ```

## Step 4: Database Setup

1. Create a new database in phpMyAdmin on the new computer
2. Import the backup file:
   - Open phpMyAdmin
   - Select the newly created database
   - Click "Import"
   - Choose the `trendnest_backup.sql` file you created earlier
   - Click "Go"

## Step 5: Environment Configuration

Update the following values in your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

APP_URL=http://localhost/Ecommerce/TrendNest
```

## Step 6: File Permissions (For Linux/Unix systems)

If you're on Linux or Unix, set proper permissions:
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

## Step 7: Build Assets

1. Build frontend assets:
   ```bash
   npm run dev
   ```
   or for production:
   ```bash
   npm run build
   ```

## Step 8: Clear Cache

Run these commands to ensure a clean state:
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

## Verification

1. Start your local server:
   - If using XAMPP, start Apache and MySQL services
   - Access your project through: `http://localhost/Ecommerce/TrendNest`

2. Verify that:
   - The website loads properly
   - Database connections work
   - All images and assets are loading
   - User authentication works
   - Product catalog is visible
   - Admin panel is accessible

## Troubleshooting

1. If images are not showing:
   - Check if the storage link is created properly
   - Verify storage permissions
   - Ensure image paths in the database are correct

2. If database connection fails:
   - Verify database credentials in `.env`
   - Check if MySQL service is running
   - Ensure database exists and is properly imported

3. If pages aren't loading:
   - Check Apache configuration
   - Verify rewrite module is enabled
   - Check file permissions

## Support

If you encounter any issues, please:
1. Check the Laravel logs in `storage/logs`
2. Review the Apache error logs
3. Ensure all prerequisites are properly installed
4. Verify all environment variables are correctly set

## Important Notes

- Never transfer `.env` files between environments; create them fresh and configure as needed
- Always backup your database before making any major changes
- Keep your composer.json and package.json files up to date
- Regularly update your installation guide if you make changes to the project structure or dependencies
installation