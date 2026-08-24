# ─── Stage 1: Build frontend assets ────────────────────────────────────────
FROM node:20-slim AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build


# ─── Stage 2: PHP application ───────────────────────────────────────────────
FROM php:8.4-cli

# System dependencies + PHP extensions
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy app source
COPY . .

# Copy compiled frontend assets from stage 1
COPY --from=frontend /app/public/build ./public/build

# Install PHP dependencies (no dev)
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Ensure ALL writable directories exist with correct permissions
RUN mkdir -p storage/framework/sessions \
    && mkdir -p storage/framework/views \
    && mkdir -p storage/framework/cache/data \
    && mkdir -p storage/logs \
    && mkdir -p storage/app/public \
    && mkdir -p bootstrap/cache \
    && chmod -R 777 storage bootstrap/cache

EXPOSE 10000

# Write a startup script so each step is isolated and failures are visible
RUN echo '#!/bin/sh\n\
set -e\n\
echo "=== PHP version ==="\n\
php --version\n\
echo "=== Clearing stale cache files ==="\n\
rm -f bootstrap/cache/config.php\n\
rm -f bootstrap/cache/routes-v7.php\n\
rm -f bootstrap/cache/packages.php\n\
rm -f bootstrap/cache/services.php\n\
echo "=== Running migrations ==="\n\
php artisan migrate --force\n\
echo "=== Seeding admin user ==="\n\
php artisan db:seed --class=AdminUserSeeder --force\n\
echo "=== Storage link ==="\n\
php artisan storage:link --force\n\
echo "=== Starting server on port ${PORT:-10000} ==="\n\
exec php artisan serve --host=0.0.0.0 --port=${PORT:-10000}\n\
' > /app/start.sh && chmod +x /app/start.sh

CMD ["/bin/sh", "/app/start.sh"]
