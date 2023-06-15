# Imagem base
FROM php:8.1-fpm

# Instalação das dependências
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libonig-dev \
    libxml2-dev \
    unzip \
    vim

# Instalação das extensões do PHP
RUN docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath

# Instalação do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# Diretório de trabalho
WORKDIR /var/www/html

# Cópia do código do projeto Laravel
COPY . /var/www/html

# Permissões
RUN chmod -R 775 ./
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage

# Definição do usuário www-data
USER www-data

# Inicialização do servidor PHP-FPM
CMD ["php-fpm"]
