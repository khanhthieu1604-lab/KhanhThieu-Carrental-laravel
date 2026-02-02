#!/bin/bash
set -e

echo "=== Database Initialization Script ==="

# Run migrations
echo "Running migrations..."
docker-compose exec app php artisan migrate --force

# Ask if user wants to seed
read -p "Do you want to seed the database with demo data? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]
then
    echo "Seeding database..."
    docker-compose exec app php artisan db:seed --force
    echo "Database seeded successfully!"
fi

echo "=== Database initialization complete! ==="
