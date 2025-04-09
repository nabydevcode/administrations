# Utiliser une image officielle PHP 8.3 avec Apache
FROM php:8.3-apache

# Installer les extensions nécessaires
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    unzip \
    git \
    libpq-dev \
    curl \
    && docker-php-ext-install intl pdo pdo_pgsql zip opcache \
    && a2enmod rewrite

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers de l'application
COPY . .

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Installer Yarn + packages front
RUN curl -sS https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && npm install -g yarn && yarn && yarn build

# Donner les permissions nécessaires
RUN chown -R www-data:www-data /var/www/html /var/www/html/var /var/www/html/public

# Exposer le port 80
EXPOSE 80

# Lancer Apache
CMD ["apache2-foreground"]
