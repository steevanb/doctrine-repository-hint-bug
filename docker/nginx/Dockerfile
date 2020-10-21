# Version de la prod : 1.4.6, non disponible sur dockerhub
FROM nginx:1.17.9-alpine

COPY docker/nginx/vhost.conf /etc/nginx/conf.d/default.conf

RUN \
    ln -snf /usr/share/zoneinfo/Europe/Paris /etc/localtime \
    && echo "Europe/Paris" > /etc/timezone

WORKDIR /var/www/html
