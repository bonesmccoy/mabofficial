FROM php:5.6-fpm

MAINTAINER Daniele Murroni <daniele.murroni@gmail.com>

RUN apt-get update && apt-get install -y git
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

ADD php-custom.ini /usr/local/etc/php/conf.d/20-xdebug.ini

ADD pool.conf /etc/php5/fpm/pool.d/

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

RUN usermod -u 1000 www-data

EXPOSE 9000

RUN export XDEBUG_CONFIG="idekey=PHPStorm"

WORKDIR /var/www
