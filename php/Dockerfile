
FROM php:8.3-fpm

# Use the default configuration
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# configure

# Install PHP modules
RUN apt-get update \
    && apt-get install -y \
        libpq-dev \
        libzip-dev \
        zip \
&& docker-php-ext-install bcmath zip pdo pdo_mysql


# Install Composer from Composer official Docker image
COPY --from=composer /usr/bin/composer /usr/bin/composer
