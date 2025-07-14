# 1. Use official PHP image with Apache
FROM php:8.4-apache

# 2. Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    npm \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# 3. Enable Apache mod_rewrite
RUN a2enmod rewrite

# 4. Set working directory
WORKDIR /var/www/html

# 5. Copy existing Laravel app
COPY . /var/www/html

# 6. Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 7. Install Laravel dependencies
RUN composer install --optimize-autoloader --no-dev

# 8. Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# 9. Expose Apache port
EXPOSE 80

# 10. Final CMD (optional - handled by Apache image)
