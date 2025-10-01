FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    librdkafka-dev \
    git \
    unzip \
    netcat-openbsd \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-install pdo pdo_pgsql zip \
    && pecl install rdkafka \
    && docker-php-ext-enable rdkafka

RUN a2enmod rewrite && \
    sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf && \
    echo "ServerName localhost" >> /etc/apache2/apache2.conf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html

EXPOSE 80
