#!/bin/bash
# ============================================
# Mystic Mirror Salon — Production Deploy Script
# Run this on your hosting server after uploading the code
# ============================================

set -e

echo "🪞 Mystic Mirror Salon — Deploying..."

# 1. Install production dependencies
echo "📦 Installing dependencies..."
composer install --optimize-autoloader --no-dev --no-interaction

# 2. Set up environment
if [ ! -f .env ]; then
    echo "⚙️  Setting up environment..."
    cp .env.production .env
    php artisan key:generate --force
    echo "⚠️  IMPORTANT: Edit .env and set your APP_URL to your actual domain!"
fi

# 3. Set permissions
echo "🔒 Setting permissions..."
chmod -R 775 storage bootstrap/cache
chmod 664 database/database.sqlite 2>/dev/null || true

# 4. Run migrations
echo "🗄️  Running migrations..."
php artisan migrate --force

# 5. Create storage symlink
echo "🔗 Creating storage link..."
php artisan storage:link 2>/dev/null || true

# 6. Optimize for production
echo "⚡ Optimizing..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo ""
echo "✅ Deployment complete!"
echo ""
echo "📝 Next steps:"
echo "   1. Edit .env → set APP_URL to your domain (e.g. https://mysticmirror.in)"
echo "   2. Point your domain's document root to the 'public/' folder"
echo "   3. Make sure SQLite database file is writable"
echo "   4. Visit your website! 🎉"
