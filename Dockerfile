# ─── Stage 1: Build frontend assets ────────────────────────────────────────
FROM node:20-slim AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY . .
RUN npm run build


# ─── Stage 2: PHP application ───────────────────────────────────────────────
FROM php:8.3-cli

# System dependencies
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite zip \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy app source
COPY . .

# Copy compiled frontend assets from stage 1
COPY --from=frontend /app/public/build ./public/build

# Install PHP dependencies (no dev)
RUN composer install --no-dev --optimize-autoloader

# Ensure the SQLite database file and storage directories exist
RUN mkdir -p /var/data \
    && touch /var/data/database.sqlite \
    && mkdir -p storage/framework/{sessions,views,cache} \
    && mkdir -p storage/logs \
    && mkdir -p storage/app/public/covers

# Set correct permissions
RUN chown -R www-data:www-data storage bootstrap/cache \
    || true

EXPOSE 10000

# On startup: run migrations, link storage, then serve
CMD php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && php artisan migrate --force \
    && php artisan storage:link \
    && php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
