# Utiliser l'image officielle PHP 8.2 avec Apache
FROM php:8.2-apache

# Installer les dépendances système nécessaires
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

# Copier la configuration Apache personnalisée
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Ajouter Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers de l'application dans le conteneur
COPY . .

# (Optionnel) Si tu avais ajouté un dummy pour symfony-cmd, tu peux le conserver si besoin
RUN echo -e "#!/bin/sh\nexit 0" > /usr/local/bin/symfony-cmd && chmod +x /usr/local/bin/symfony-cmd

# Installer les dépendances PHP avec Composer
RUN composer install --no-dev --optimize-autoloader

# (Optionnel) Installer Yarn et compiler les assets front-end
RUN npm install -g yarn && yarn install && yarn build

# Créer les dossiers 'var' et 'public' s'ils n'existent pas déjà
RUN mkdir -p var public

# Donner les permissions nécessaires
RUN chown -R www-data:www-data var public

# Exposer le port 80
EXPOSE 80

# Lancer Apache
CMD ["apache2-foreground"]
