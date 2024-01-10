FROM php:8.2.14-cli

RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        unzip \
        libpng-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install gd

RUN docker-php-ext-install zip

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

VOLUME /app/data 

CMD ["php" , "./src/webcrawler.php"]