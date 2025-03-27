# Gunakan base image PHP 8.2 dengan FPM
FROM php:8.2-fpm

# Install dependensi sistem
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    zip \
    unzip \
    nodejs \
    npm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install ekstensi PHP yang diperlukan
RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    gd \
    intl \
    zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy seluruh kode proyek
COPY . /var/www

# Install dependensi Composer dengan mengabaikan persyaratan platform
RUN composer install --no-interaction --ignore-platform-reqs

# Install dependensi npm
RUN npm install && npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port 8000
EXPOSE 8000

# Command untuk menjalankan aplikasi
CMD php artisan serve --host=0.0.0.0 --port=8000