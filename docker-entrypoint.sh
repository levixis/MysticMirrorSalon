#!/bin/bash
set -e

echo "🪞 Mystic Mirror Salon — Starting..."

# Create .env from environment variables
if [ ! -f .env ]; then
    echo "⚙️  Creating .env from environment variables..."
    env | grep -E '^(APP_|DB_|DATABASE_|MAIL_|CACHE_|SESSION_|QUEUE_|LOG_|BCRYPT_|ADMIN_|FILESYSTEM_|BROADCAST_|REDIS_|VITE_)' | while read line; do
        echo "$line" >> .env
    done
fi

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generating application key..."
    php artisan key:generate --force
fi

# Set permissions
chmod -R 775 storage bootstrap/cache

# Run migrations
echo "🗄️  Running migrations..."
php artisan migrate --force

# Create storage symlink
php artisan storage:link 2>/dev/null || true

# Cache for production
echo "⚡ Optimizing for production..."
php artisan config:cache 2>/dev/null || true
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

echo "✅ Ready! Starting server on port 8080..."

# Start the application
exec php artisan serve --host=0.0.0.0 --port=8080
