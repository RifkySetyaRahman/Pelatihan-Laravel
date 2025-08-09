# Stage 1 - Builder
FROM composer:2.7 AS builder

WORKDIR /app

# Salin semua file ke stage builder
COPY . .

# Install dependensi produksi Laravel
RUN composer install --no-dev --optimize-autoloader

# Stage 2 - Final image
FROM php:8.2-fpm-alpine

# Instal dependensi sistem
RUN apk add --no-cache \
    bash \
    postgresql-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    curl \
    git \
    icu-dev \
    autoconf \
    g++ \
    make \
    nodejs-current \
    npm

# Install ekstensi PHP
RUN docker-php-ext-install \
    pdo_pgsql \
    mbstring \
    xml \
    intl \
    gd

# Install Composer dari stage builder (alternatif aman dari composer:2)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Buat direktori kerja
WORKDIR /var/www

# Salin kode aplikasi dan vendor dari builder stage
COPY --from=builder /app /var/www
COPY --from=builder /app/vendor /var/www/vendor

# Set permission
RUN chown -R www-data:www-data /var/www

EXPOSE 9000

CMD ["php-fpm"]
# made by Rifky Setya Rahman