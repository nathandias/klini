FROM php:fpm

RUN docker-php-ext-install pdo pdo_mysql
COPY ./php.ini /usr/local/etc/php.ini

# optional: install alternate mysqli library
#RUN docker-php-ext-install mysqli

#RUN pecl install xdebug && docker-php-ext-enable xdebug