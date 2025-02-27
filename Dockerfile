FROM php:8.3-apache

# Update package lists AND install GIT
RUN apt-get update && \
    apt-get install -y git libzip-dev zip unzip default-mysql-client

# Install dependencies
RUN docker-php-ext-install mysqli pdo pdo_mysql zip

# Composer install
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy source code
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Copy entrypoint
COPY ./docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh
RUN rm -rf ./docker-entrypoint.sh

# Copy doctrine binary
COPY ./bin/doctrine /usr/local/bin/doctrine
RUN chmod +x /usr/local/bin/doctrine
RUN rm -rf ./bin/doctrine

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Switch to www-data user
USER www-data

# Install composer dependencies
RUN composer install

# Set the entrypoint to our custom script
ENTRYPOINT ["/docker-entrypoint.sh"]

# Set the command to start Apache
CMD ["apache2-foreground"]