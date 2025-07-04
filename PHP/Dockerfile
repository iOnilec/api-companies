FROM php:8.3-apache

# Extensões
# Instalar dependências do sistema necessárias para compilar extensões
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia o código-fonte para o container
COPY ./src /var/www/html