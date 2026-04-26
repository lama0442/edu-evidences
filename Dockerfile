FROM richarvey/php-apache-heroku:latest
COPY . /var/www/app
ENV WEBROOT /var/www/app/public
ENV PHP_VERSION 8.4