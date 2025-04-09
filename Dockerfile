# Utiliser une image officielle PHP 8.3 avec Apache
FROM php:8.3-apache

# Installer les extensions nécessaires
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    unzip \
    git \
    libpq-dev \
    && docker-php-ext-install intl pdo pdo_pgsql zip opcache \
    && a2enmod rewrite

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers de l'application
COPY . .

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Installer Yarn + packages front
RUN curl -sS https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && npm install -g yarn && yarn && yarn build

# Permissions Symfony
RUN chown -R www-data:www-data var public

# Exposer le port 80
EXPOSE 80

# Lancer Apache
CMD ["apache2-foreground"]
