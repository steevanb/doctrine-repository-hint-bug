# Version de la prod : 5.5.62
FROM mysql:5.7.24

RUN \
    apt-get update \
    && apt-get install -y vim

COPY my.cnf /etc/mysql/conf.d/goodnews.cnf
