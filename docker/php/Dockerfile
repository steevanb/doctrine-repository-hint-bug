FROM php:7.4.11-fpm-buster

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

ARG DOCKER_UID

RUN \
    apt-get update \
    && apt-get install -y zip git \
    && docker-php-ext-install opcache pdo_mysql \
    # Fix locale
    && echo "date.timezone = Europe/Paris" > /usr/local/etc/php/conf.d/timezone.ini \
    && ln -snf /usr/share/zoneinfo/Europe/Paris /etc/localtime \
    && echo "Europe/Paris" > /etc/timezone \
    # Create user with same uid as host
    && useradd -ms /bin/bash --uid ${DOCKER_UID} app \
    && usermod -a -G www-data app

USER app

WORKDIR /var/www/html
