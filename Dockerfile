FROM php:8.3-cli

# system deps
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    libzip-dev

# install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl

# install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# copy project
COPY . .

# install dependencies
RUN composer install --no-dev --optimize-autoloader

# permissions (important for Laravel)
RUN chmod -R 775 storage bootstrap/cache

# expose port Render uses
EXPOSE 10000

# start server
CMD php artisan serve --host=0.0.0.0 --port=10000