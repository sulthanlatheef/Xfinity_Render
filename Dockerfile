# Use official PHP + Apache image
FROM php:8.0-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    python3 \
    python3-pip \
    python3-venv \
    curl \
    unzip \
    git \
    build-essential \
    libffi-dev \
    libssl-dev \
    libxml2-dev \
    libjpeg-dev \
    zlib1g-dev \
    libpq-dev \
    && docker-php-ext-install pgsql pdo_pgsql

# Enable Apache rewrite (important for CodeIgniter)
RUN a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php \
    -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html/

# Copy composer files first (for cache)
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy the rest of the application
COPY . .

# Copy Python requirements
COPY requirements.txt /tmp/requirements.txt

# Create Python virtual environment
RUN python3 -m venv /opt/venv \
    && /opt/venv/bin/pip install --upgrade pip \
    && /opt/venv/bin/pip install --no-cache-dir -r /tmp/requirements.txt

# Set venv Python as default
ENV PATH="/opt/venv/bin:$PATH"

# Fix permissions
RUN chown -R www-data:www-data /var/www/html/

# Expose Apache port
EXPOSE 80
