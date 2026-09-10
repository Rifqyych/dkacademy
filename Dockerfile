FROM node:22-alpine AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY resources ./resources
COPY public ./public
COPY vite.config.js ./

RUN npm run build


FROM dunglas/frankenphp:1-php8.2-bookworm

WORKDIR /app

# Use the bundled PHP extension compiler. This avoids the m4 failure that can
# occur in DockHosting's BuildKit environment with install-php-extensions.
RUN apt-get update \
    && apt-get install -y --no-install-recommends libpq-dev libzip-dev unzip \
    && docker-php-ext-install pdo_pgsql zip \
    && cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install production dependencies before application code for efficient caching.
COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-interaction \
    --no-progress \
    --prefer-dist \
    --optimize-autoloader

COPY . .
COPY --from=frontend /app/public/build ./public/build

RUN composer dump-autoload --no-dev --optimize --no-interaction \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# DockHosting sends the runtime port through PORT. Its proxy uses port 80.
ENV SERVER_ROOT=/app/public
EXPOSE 80

# Database migrations run before the web server starts, then FrankenPHP binds
# to the port assigned by DockHosting.
CMD sh -c "mkdir -p /app/database /app/storage/framework/views /app/storage/framework/sessions /app/storage/framework/cache && chmod -R 777 /app/storage /app/bootstrap/cache && touch /app/database/database.sqlite && php artisan config:clear && php artisan cache:clear && php artisan migrate:fresh --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"
