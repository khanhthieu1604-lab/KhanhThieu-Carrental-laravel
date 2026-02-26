#!/bin/bash
set -e

echo "=== Thiuu Rental Elite - Startup Script ==="

# Copy .env.docker to .env if .env doesn't exist
if [ ! -f .env ]; then
    echo "Copying .env.docker to .env..."
    cp .env.docker .env
fi

echo "Waiting for MySQL to be ready..."

# Wait for MySQL to be ready using a more reliable check
max_tries=30
counter=0
until php -r "new PDO('mysql:host=mysql;dbname=laravel', 'laravel', 'password');" &> /dev/null || [ $counter -eq $max_tries ]
do
    echo "MySQL is unavailable - sleeping (attempt $counter/$max_tries)"
    sleep 2
    counter=$((counter + 1))
done

if [ $counter -eq $max_tries ]; then
    echo "ERROR: MySQL did not become ready in time!"
    exit 1
fi

echo "MySQL is ready!"

# Generate application key if not set
if grep -q "APP_KEY=$" .env 2>/dev/null; then
    echo "Generating application key..."
    php artisan key:generate --force --no-interaction
fi

# Run database migrations  
echo "Running database migrations..."
php artisan migrate --force --no-interaction || echo "Warning: Some migrations failed, continuing anyway..."

# Create storage link if it doesn't exist
if [ ! -L public/storage ]; then
    echo "Creating storage symlink..."
    php artisan storage:link --force
fi

# Clear any existing cache
echo "Clearing caches..."
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Set proper permissions
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

echo "=== Startup complete! Starting PHP-FPM ==="
exec php-fpm
