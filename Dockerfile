# FROM php:7.4-fpm-alpine

# WORKDIR /var/www/html

# RUN apk add --no-cache \
#     nginx \
#     supervisor \
#     curl \
#     libpng-dev \
#     libzip-dev \
#     zip \
#     && docker-php-ext-install pdo_mysql \
#     && docker-php-ext-install gd \
#     && docker-php-ext-install zip

# COPY ./nginx.conf /etc/nginx/nginx.conf
# COPY ./supervisor.conf /etc/supervisor.d/supervisor.ini
# COPY . /var/www/html

# RUN chown -R www-data:www-data /var/www/html \
#     && chmod -R 755 /var/www/html/storage \
#     && chmod -R 777 /var/www/html/bootstrap/cache

# EXPOSE 80

# CMD ["/usr/bin/supervisord", "-n", "-c", "/etc/supervisor.d/supervisor.ini"]
# Use the official PHP image as a parent image
#FROM php:8.1-apache
#
## Enable Apache Rewrite module
#RUN a2enmod rewrite
#
#RUN apt-get update && \
#    apt-get install -y npm
#
## Install required PHP extensions
#RUN docker-php-ext-install pdo pdo_mysql
#
## Install composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#
## Set the working directory in the container to /var/www/html
#WORKDIR /var/www/html
#
#ENV COMPOSER_ALLOW_SUPERUSER=1
#
## Copy the application files to the container
#COPY . .
#
## Install dependencies
#RUN composer install
#
##
#RUN npm install && npm run prod
#
## Set the owner of the application directory to the Apache user
#RUN chown -R www-data:www-data /var/www/html
#
#RUN chmod -R 755 /var/www/html
#
## Expose port 80
#EXPOSE 80
#
## Set the command to run when the container starts
#CMD ["apache2-foreground"]

# Set the base image to PHP with Apache
#FROM php:8.1-apache
#
## Enable Apache Rewrite module
#RUN a2enmod rewrite
#
## Install required PHP extensions
#RUN docker-php-ext-install pdo pdo_mysql
#
## Install composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#
#RUN apt-get update && \
#    apt-get install -y npm
#
## Set the working directory in the container to /var/www/html
#WORKDIR /var/www/html
#
#ENV COMPOSER_ALLOW_SUPERUSER=1
#
## Copy the application files to the container
#COPY . .
#
## Install dependencies
#RUN composer install --optimize-autoloader --no-interaction
#
#RUN npm install && npm run prod
#
## Set the owner of the application directory to the Apache user
#RUN chown -R www-data:www-data /var/www/html
#
## Set the permissions of the storage and bootstrap/cache directories
#RUN chmod -R 777 storage bootstrap/cache
#
#RUN chmod -R 755 /var/www/html
#
## Expose port 80
#EXPOSE 80
#
## Set the command to run when the container starts
#CMD ["apache2-foreground"]

FROM php:8.1-apache

#Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#Install npm
RUN apt-get update && \
    apt-get install -y npm

WORKDIR /app

COPY . .

RUN composer install --optimize-autoloader --no-interaction

RUN npm install && npm run prod

CMD ["npm", "run", "server:dev"]

EXPOSE 8000

