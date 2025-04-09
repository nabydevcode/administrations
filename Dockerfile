# Utiliser l'image officielle PHP avec Apache
FROM php:8.1-apache

# Installer les extensions PHP nécessaires pour Symfony + PostgreSQL
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    gnupg \
    libpq-dev \
    nodejs \
    npm \
    && docker-php-ext-install intl pdo pdo_pgsql zip opcache \
    && a2enmod rewrite

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers de l'application dans le conteneur
COPY . .

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader

# Installer Yarn (recommandé pour Tailwind/Encore) et les packages front
RUN npm install -g yarn && yarn install && yarn build

# Donner les bonnes permissions
RUN chown -R www-data:www-data var public

# Exposer le port 80
EXPOSE 80

# Lancer Apache
CMD ["apache2-foreground"]
