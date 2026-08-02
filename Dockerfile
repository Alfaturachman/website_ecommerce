FROM php:8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set Working Directory
WORKDIR /var/www/html

# Copy project files into container
COPY . /var/www/html/

# Set permissions for webserver
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/images

EXPOSE 80
