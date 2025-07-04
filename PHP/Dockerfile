FROM php:8.3-apache

RUN groupadd -g 1000 www && useradd -u 1000 -ms /bin/bash -g www www

# Extensões
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    libzip-dev

RUN docker-php-ext-install pdo pdo_pgsql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer version=2.6.6

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN a2enmod rewrite

COPY ./apache-config.conf /etc/apache2/conf-enabled/custom.conf


# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia o código-fonte para o container
COPY ./src /var/www/html

RUN chown -R www:www /var/www/html

USER www