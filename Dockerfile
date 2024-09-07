# Usare PHP 8.x come base
FROM php:8.2-fpm

# Settiamo la variabile di lavoro (la directory dove ci muoviamo)
WORKDIR /var/www

# Installare estensioni di sistema e PHP necessarie
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
    libzip-dev \
    libonig-dev \
    libpng-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Scaricare e installare Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiare i file dell'applicazione nel container
COPY ./lumen-app /var/www

# Installare le dipendenze PHP dell'app Lumen
RUN composer update -W

# Dare i permessi corretti alla directory
RUN chown -R www-data:www-data /var/www

# Esportare la porta 8000 per Lumen
EXPOSE 8000

# Comando per avviare il server Lumen
CMD php -S 0.0.0.0:8000 -t public
