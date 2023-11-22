FROM php:8.0-apache

RUN mkdir -p /kfive/sessions
RUN chmod 0700 /kfive/sessions
RUN chown www-data /kfive/sessions

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN apt-get update && apt-get upgrade -y

RUN a2enmod rewrite