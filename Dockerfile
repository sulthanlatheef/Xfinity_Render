# Use official PHP + Apache image
FROM php:8.2-apache

# Install Python 3, pip, Composer dependencies
RUN apt-get update && apt-get install -y \
    python3 \
    python3-pip \
    curl \
    unzip \
    git \
    build-essential \
    libffi-dev \
    libssl-dev \
    libxml2-dev \
    libjpeg-dev \
    zlib1g-dev \
    && docker-php-ext-install mysqli

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy all project files
COPY . /var/www/html/

# Run Composer install
WORKDIR /var/www/html/
RUN composer install --no-dev --optimize-autoloader

# Install Python dependencies
COPY requirements.txt /tmp/requirements.txt
RUN pip3 install --no-cache-dir --break-system-packages -r /tmp/requirements.txt

# Set permissions
RUN chown -R www-data:www-data /var/www/html/
