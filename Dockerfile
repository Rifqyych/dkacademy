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

# Railway injects PORT at runtime. SERVER_ROOT keeps Laravel's public folder
# as the only web-accessible directory.
ENV SERVER_ROOT=/app/public
EXPOSE 8080

# Migrations are executed by Railway's pre-deploy command. Do not run
# migrate:fresh here: it would erase production data on every deployment.
CMD ["sh", "-c", "mkdir -p storage/framework/views storage/framework/sessions storage/framework/cache storage/logs && chmod -R ug+rwX storage bootstrap/cache && SERVER_NAME=:${PORT:-8080} exec frankenphp run --config /etc/frankenphp/Caddyfile"]
