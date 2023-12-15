FROM php:7.2-fpm

COPY . /var/www/html
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN composer install
RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /var/www/html

RUN mkdir -p storage/framework/cache
RUN mkdir -p storage/framework/sessions
RUN chmod -R 777 storage

EXPOSE 9000

ENTRYPOINT ["/var/www/html/run.sh"]
