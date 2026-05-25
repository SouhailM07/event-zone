FROM php:8.3-cli

# =========================
# System dependencies
# =========================
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev

# =========================
# PHP extensions
# =========================
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    exif \
    pcntl

# =========================
# Composer
# =========================
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# =========================
# App setup
# =========================
WORKDIR /app
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN chmod -R 775 storage bootstrap/cache

# Render port
EXPOSE 10000

# =========================
# Start command (ALL-IN-ONE)
# =========================
CMD sh -c "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000"