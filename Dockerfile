FROM php:8.2-apache

# Activer les modules Apache
RUN a2enmod rewrite headers

# Installer les dépendances et extensions PHP
RUN apt-get update && apt-get install -y --no-install-recommends \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier seulement le nécessaire
COPY . /var/www/html

# Ajouter un .dockerignore (RECOMMANDÉ)
# Exposer
EXPOSE 80

# Démarrer Apache
CMD ["apache2-foreground"]
