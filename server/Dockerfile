FROM php:8.2-cli
FROM composer

COPY . /server
WORKDIR /server

EXPOSE 8000

RUN composer install
# RUN docker-php-ext-install mysqli 

# CMD php -S 0.0.0.0:8080 /server/router.php