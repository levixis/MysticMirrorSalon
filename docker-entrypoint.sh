#!/bin/bash
set -e

echo "🪞 Mystic Mirror Salon — Starting..."

# Generate APP_KEY if not set in environment
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generating application key..."
    # key:generate needs a .env file with APP_KEY= placeholder
    echo "APP_KEY=" > .env
    php artisan key:generate --force
    export APP_KEY=$(grep APP_KEY .env | head -1 | cut -d '=' -f2-)
    echo "✅ Generated APP_KEY=$APP_KEY"
    rm -f .env
fi

# Set permissions
chmod -R 775 storage bootstrap/cache

# Run migrations (safe for production, won't drop tables)
echo "🗄️  Running migrations..."
php artisan migrate --force

# Create storage symlink
php artisan storage:link 2>/dev/null || true

# Optimize for production
echo "⚡ Optimizing for production..."
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

echo "✅ Ready! Starting server on port 8080..."

# Start the application
exec php artisan serve --host=0.0.0.0 --port=8080
