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
# Node.js (IMPORTANT for Blade/Vite)
# =========================
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

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

# =========================
# Install PHP deps
# =========================
RUN composer install --no-dev --optimize-autoloader

# =========================
# Install JS deps + build assets (THIS FIXES YOUR UI)
# =========================
RUN npm install
RUN npm run build

# =========================
# Permissions
# =========================
RUN chmod -R 775 storage bootstrap/cache

# Render port
EXPOSE 10000

# =========================
# Start Laravel
# =========================
CMD sh -c "php artisan config:cache && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000"