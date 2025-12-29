#!/bin/bash
# Railway deployment script
# This runs after build and before the app starts

echo "🚀 Running deployment tasks..."

# Run migrations
echo "📦 Running database migrations..."
php artisan migrate --force --no-interaction

# Optional: Run seeders only if DATABASE_SEED=true
if [ "$DATABASE_SEED" = "true" ]; then
    echo "🌱 Seeding database..."
    php artisan db:seed --force --no-interaction
fi

# Clear and optimize
echo "🔧 Optimizing application..."
php artisan optimize

echo "✅ Deployment complete!"
