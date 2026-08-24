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

# Ensure storage directories exist and are writable
RUN mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && mkdir -p storage/app/public \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 10000

# Use a shell script as entrypoint so each step is visible in logs
CMD echo "=== Starting Veiled Lumin ===" \
    && echo "PHP: $(php --version | head -1)" \
    && echo "=== Clearing caches ===" \
    && php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && echo "=== Running migrations ===" \
    && php artisan migrate --force \
    && echo "=== Seeding admin user ===" \
    && php artisan db:seed --class=AdminUserSeeder --force \
    && echo "=== Storage link ===" \
    && php artisan storage:link --force \
    && echo "=== Starting server on port ${PORT:-10000} ===" \
    && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
