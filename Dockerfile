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

# Copy composer.json dan composer.lock terlebih dahulu untuk mengoptimalkan caching
COPY composer.json composer.lock ./

# Install dependencies composer (tanpa script dan tanpa autoloader)
RUN composer install --no-scripts --no-autoloader --ignore-platform-reqs

# Copy seluruh kode proyek
COPY . .

# Generate autoloader dan jalankan script post-install
RUN composer dump-autoload --optimize && composer run-script post-install-cmd

# Install dependensi NPM jika diperlukan
RUN if [ -f package.json ]; then npm install && npm run build; fi

# Set permissions
RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port 8000
EXPOSE 8000

# Persiapkan script entrypoint
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Command untuk menjalankan aplikasi
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]