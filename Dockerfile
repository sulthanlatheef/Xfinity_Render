# Use official PHP + Apache image
FROM php:8.2-apache

# Install Python 3, pip, and mysqli for CodeIgniter
RUN apt-get update && apt-get install -y \
    python3 \
    python3-pip \
    && docker-php-ext-install mysqli

# Enable Apache mod_rewrite for CodeIgniter URLs
RUN a2enmod rewrite

# Copy all project files to Apache web root
COPY . /var/www/html/

# Install Python dependencies from requirements.txt
COPY requirements.txt /tmp/requirements.txt
RUN pip3 install --no-cache-dir -r /tmp/requirements.txt

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html/
