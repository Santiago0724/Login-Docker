
FROM php:7.3-apache
COPY . /var/www/html/
RUN docker-php-ext-install mysqli pdo_mysql


FROM mysql
ADD init.sql /docker-entrypoint-initdb.d