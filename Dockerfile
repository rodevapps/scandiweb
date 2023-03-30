FROM php:8.2.4-apache-buster

RUN docker-php-ext-install mysqli
