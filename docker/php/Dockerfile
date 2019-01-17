#Based on https://github.com/ypereirareis/docker-permissions/blob/master/Dockerfile
FROM php:7.3.1-fpm-alpine3.8
RUN apk update && apk add --virtual build-dependencies build-base gcc wget git autoconf
RUN docker-php-ext-install -j$(nproc) pdo pdo_mysql
RUN pecl install apcu && docker-php-ext-enable apcu
ENV PROJECT_DIR=/var/www/html
RUN mkdir -p $PROJECT_DIR && chown -R www-data:www-data $PROJECT_DIR
COPY php/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
WORKDIR /var/www/html
VOLUME /var/www/html
ENTRYPOINT ["/entrypoint.sh"]
CMD ["php-fpm"]