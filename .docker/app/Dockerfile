FROM php:7.4-fpm

ENV TZ=Europe/Minsk

RUN apt-get update && apt-get install -y \
    git \
    curl \
    zsh \
    zip \
 && pecl install redis-5.2.2 \
 && pecl install xdebug \
 && docker-php-ext-enable xdebug \
 && docker-php-ext-install pdo_mysql \
 && echo "date.timezone=$TZ" > "$PHP_INI_DIR/conf.d/date-time-zone.ini" \
 && mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

RUN groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

WORKDIR /var/www/html
ADD . .

RUN mkdir /var/www/.composer
RUN chown www-data:www-data /var/www/.composer

COPY --from=composer:2.0 /usr/bin/composer /usr/bin/composer

COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

USER www-data