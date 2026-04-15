FROM php:8.1-apache

#installa estensioni necessarie (es. mysqli)
RUN docker-php-ext-install mysqli

#copia il codice nel container
COPY . /var/www/html/

#imposta la DocumentRoot a /var/www/html/public
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

#abilita mod_rewrite
RUN a2enmod rewrite