#!/bin/bash
set -e

echo "🪞 Mystic Mirror Salon — Starting..."

# Laravel reads directly from system environment variables.
# We only need a .env file for APP_KEY generation.
# DO NOT dump all env vars to .env — it causes parsing issues with spaces.

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generating application key..."
    # Create minimal .env just for key generation
    echo "" > .env
    php artisan key:generate --force
    # Export the generated key so Laravel sees it
    export APP_KEY=$(grep APP_KEY .env | cut -d '=' -f2-)
    # Remove .env so Laravel uses system env vars
    rm -f .env
fi

# Set permissions
chmod -R 775 storage bootstrap/cache

# Run migrations
echo "🗄️  Running migrations..."
php artisan migrate --force

# Create storage symlink
php artisan storage:link 2>/dev/null || true

# Cache for production (skip config:cache as it bakes in env values)
echo "⚡ Optimizing for production..."
php artisan route:cache 2>/dev/null || true
php artisan view:cache 2>/dev/null || true

echo "✅ Ready! Starting server on port 8080..."

# Start the application
exec php artisan serve --host=0.0.0.0 --port=8080
