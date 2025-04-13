# Utiliser PHP 8.2 avec FPM pour Nginx
FROM php:8.2-fpm

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    curl \
    nginx \
    && docker-php-ext-install pdo pdo_pgsql

# Copier la configuration Nginx
COPY ./nginx.conf /etc/nginx/nginx.conf

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers de l'application
COPY . .

# Créer les répertoires nécessaires
RUN mkdir -p var public

# Donner les permissions appropriées
RUN chown -R www-data:www-data var public

# Exposer le port pour Nginx
EXPOSE 80

# Lancer PHP-FPM et Nginx
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
