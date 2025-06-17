# Use official PHP + Apache image
FROM php:8.0-apache

# Install Python 3, pip, Composer dependencies
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
    && docker-php-ext-install mysqli

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html/

# Copy project files
COPY . /var/www/html/

# Run Composer install
RUN composer install --no-dev --optimize-autoloader

# Copy Python requirements file
COPY requirements.txt /tmp/requirements.txt

# Create virtual environment and install Python packages
RUN python3 -m venv /opt/venv \
    && /opt/venv/bin/pip install --upgrade pip \
    && /opt/venv/bin/pip install --no-cache-dir -r /tmp/requirements.txt

# Set venv Python as default
ENV PATH="/opt/venv/bin:$PATH"

# Fix permissions
RUN chown -R www-data:www-data /var/www/html/
