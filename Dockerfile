# Use official PHP + Apache image
FROM php:8.2-apache

# Install Python 3, pip, and required libraries
RUN apt-get update && apt-get install -y \
    python3 \
    python3-pip \
    build-essential \
    libffi-dev \
    libssl-dev \
    libxml2-dev \
    libjpeg-dev \
    zlib1g-dev \
    && docker-php-ext-install mysqli

# Enable Apache mod_rewrite for CodeIgniter URLs
RUN a2enmod rewrite

# Copy all project files
COPY . /var/www/html/

# Install Python dependencies with override
COPY requirements.txt /tmp/requirements.txt
RUN pip3 install --no-cache-dir --break-system-packages -r /tmp/requirements.txt

# Set permissions
RUN chown -R www-data:www-data /var/www/html/
