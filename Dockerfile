# Stage 1: Laravel and Apache setup
FROM php:8.2-apache AS laravel-apache

# Install required dependencies for Laravel
RUN apt-get update && apt-get install -y \
    git zip unzip curl libpng-dev libonig-dev libxml2-dev libfreetype6-dev libjpeg-dev supervisor \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set up Laravel application
WORKDIR /var/www/html
COPY ./laravel /var/www/html
RUN composer install --no-dev --optimize-autoloader

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy Apache configuration for Laravel
COPY ./laravel/laravel.conf /etc/apache2/sites-available/000-default.conf

# Stage 2: CoreDNS setup
FROM golang:1.22 AS coredns

# Clone and build CoreDNS
WORKDIR /go/src/github.com/coredns/coredns
RUN git clone --depth 1 https://github.com/coredns/coredns.git .
RUN go mod tidy
RUN make

# Stage 3: Combine Laravel, Apache, and CoreDNS
FROM laravel-apache

# Install Supervisor
RUN apt-get update && apt-get install -y supervisor && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copy CoreDNS binary
COPY --from=coredns /go/src/github.com/coredns/coredns/coredns /usr/bin/coredns

# Copy Supervisor configuration
COPY ./laravel/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy CoreDNS configuration
COPY ./coredns/Corefile /etc/coredns/Corefile

# Expose ports
EXPOSE 80 53/udp

# Start Supervisor to manage Apache and CoreDNS
CMD ["supervisord", "-n"]
