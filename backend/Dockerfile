FROM php:8.3-fpm-alpine

# php extensions installer: https://github.com/mlocati/docker-php-extension-installer
COPY --from=mlocati/php-extension-installer --link /usr/bin/install-php-extensions /usr/local/bin/

# Install dependencies
RUN apk add --no-cache \
        acl \
        fcgi \
        file \
        gettext \
        git \
        curl \
    ;

RUN set -eux; \
    install-php-extensions \
        pdo_sqlsrv \
        sqlsrv \
        opcache \
        apcu \
    ;

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# https://getcomposer.org/doc/03-cli.md#composer-allow-superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="${PATH}:/root/.composer/vendor/bin"

# Install PHP dependencies
RUN composer install

# Start PHP-FPM
CMD ["php-fpm"]
