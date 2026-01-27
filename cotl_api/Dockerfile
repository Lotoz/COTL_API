FROM php:8.4-apache

# 1. Instalar dependencias del sistema necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# 2. Instalar extensiones de PHP para Laravel y MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql gd mbstring

# 3. INSTALAR COMPOSER (Copiándolo desde la imagen oficial de Composer)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Habilitar mod_rewrite para las rutas de Laravel
RUN a2enmod rewrite

# 5. Configurar el DocumentRoot a /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html