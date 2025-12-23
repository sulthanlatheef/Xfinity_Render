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
    libpq-dev \
    docker-php-ext-install pgsql pdo_pgsql


# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html/

# COPY ONLY composer files first (layer caching)
COPY composer.json composer.lock ./

# Run Composer install
RUN composer install --no-dev --optimize-autoloader

# Now copy the rest of the project (including your CodeIgniter app)
COPY . .

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
