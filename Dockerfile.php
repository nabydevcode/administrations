FROM php:8.2-fpm

# Installer les dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    gnupg \
    libpq-dev \
    && docker-php-ext-install intl pdo pdo_pgsql zip opcache

# Ajouter Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html/appt-cmr

# Copier les fichiers de l'application dans le conteneur
COPY . .

# Installer les dépendances PHP avec Composer
RUN composer install --no-dev --optimize-autoloader

# Donner les permissions nécessaires
RUN chown -R www-data:www-data var public

# Exposer le port 9000 pour PHP-FPM
EXPOSE 9000
