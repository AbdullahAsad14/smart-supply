FROM php:7.2-fpm

COPY . /var/www/html
ENV PATH="$PATH:/usr/local/bin"
RUN composer install

WORKDIR /var/www/html

RUN mkdir -p storage/framework/cache
RUN mkdir -p storage/framework/sessions
RUN chmod -R 777 storage

EXPOSE 9000

ENTRYPOINT ["/var/www/html/run.sh"]
