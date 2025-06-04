# 1. stage: build frontend (Node/Vite)
FROM node:18 AS node-builder
WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY . .
RUN npm run build

# 2. stage: PHP runtime (Laravel)
FROM php:8.2-fpm-alpine
WORKDIR /app

RUN apk add --no-cache \
    git \
    libzip-dev \
    oniguruma-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring zip

COPY --from=node-builder /app /app

COPY composer.json composer.lock ./
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader

RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

EXPOSE 8000
CMD ["php", "-S", "0.0.0.0:$PORT", "-t", "public"]

