# Stage 1: Build front-end assets using Node.js (Vite)
FROM node:18 AS node_builder
WORKDIR /app

# Copy package.json and install dependencies
COPY package*.json ./
RUN npm install

# Copy the rest of the project files
COPY . .

# Build assets using Vite (output goes to public/build)
RUN npm run build

# Stage 2: Build PHP application image for production
FROM php:8.2-fpm

# Install necessary system libraries, PHP extensions, and Node.js
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    nodejs \
    npm

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Copy Composer from the official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html

# Copy Laravel project files
COPY . /var/www/html

# Copy built front-end assets from the Node.js stage
COPY --from=node_builder /app/public/build /var/www/html/public/build

# Set correct ownership and permissions for Laravel directories
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 775 {} \; \
    && find /var/www/html -type f -exec chmod 664 {} \; \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache \
    && chmod +x /var/www/html/artisan

# Expose the PHP-FPM port
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
