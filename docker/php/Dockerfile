#FROM php:8.1-fpm
#
## Install dockerize so we can wait for containers to be ready
#ENV DOCKERIZE_VERSION 0.6.1
#
#RUN curl -s -f -L -o /tmp/dockerize.tar.gz https://github.com/jwilder/dockerize/releases/download/v$DOCKERIZE_VERSION/dockerize-linux-amd64-v$DOCKERIZE_VERSION.tar.gz \
#    && tar -C /usr/local/bin -xzvf /tmp/dockerize.tar.gz \
#    && rm /tmp/dockerize.tar.gz
#
## Install Composer
#ENV COMPOSER_VERSION 2.1.5
#
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=$COMPOSER_VERSION
#
## Install nodejs
#RUN curl -sL https://deb.nodesource.com/setup_16.x | bash
#
#
#RUN apt-get update \
#    && apt-get install -y --no-install-recommends \
#        libz-dev \
#        libpq-dev \
#        libjpeg-dev \
#        libpng-dev \
#        libssl-dev \
#        libzip-dev \
#        unzip \
#        zip \
#        nodejs \
#    && apt-get clean \
#    && pecl install redis \
#    && docker-php-ext-configure gd \
#    && docker-php-ext-configure zip \
#    && docker-php-ext-install \
#        gd \
#        exif \
#        opcache \
#        pdo_mysql \
#        pdo_pgsql \
#        pgsql \
#        pcntl \
#        zip \
#    && docker-php-ext-enable redis \
#    && rm -rf /var/lib/apt/lists/*;
#
#COPY ./docker/php/laravel.ini /usr/local/etc/php/conf.d/laravel.ini
#
#WORKDIR /usr/src/app
#
#RUN chown -R www-data:www-data .
#
#COPY package.json .
#COPY package-lock.json .
#RUN npm install
#RUN npm run setup
#RUN npm run prod

FROM php:8.1-fpm

# Install dockerize so we can wait for containers to be ready
ENV DOCKERIZE_VERSION 0.6.1
RUN curl -s -f -L -o /tmp/dockerize.tar.gz https://github.com/jwilder/dockerize/releases/download/v$DOCKERIZE_VERSION/dockerize-linux-amd64-v$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf /tmp/dockerize.tar.gz \
    && rm /tmp/dockerize.tar.gz

# Install Composer
ENV COMPOSER_VERSION 2.1.5
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=$COMPOSER_VERSION

# Install Node.js
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libz-dev \
        libpq-dev \
        libjpeg-dev \
        libpng-dev \
        libssl-dev \
        libzip-dev \
        unzip \
        zip \
        nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*;

# Install PHP extensions
RUN docker-php-ext-configure gd \
    && docker-php-ext-configure zip \
    && docker-php-ext-install \
        gd \
        exif \
        opcache \
        pdo_mysql \
        pdo_pgsql \
        pgsql \
        pcntl \
        zip \
    && pecl install redis \
    && docker-php-ext-enable redis;

# Copy Laravel configuration
COPY ./docker/php/laravel.ini /usr/local/etc/php/conf.d/laravel.ini

WORKDIR /usr/src/app

# Set ownership
RUN chown -R www-data:www-data .

# Copy package files and install dependencies
COPY package.json .
COPY package-lock.json .
RUN npm install

# Copy the rest of your Laravel application
COPY . .
COPY --overwrite .env.example .env
RUN chown -R 33:33 "/root/.npm"
RUN chown -R www-data:www-data /usr/src/app/public

# Run artisan commands
RUN php artisan key:generate
#
# Build assets
#RUN php artisan migrate:reset
#RUN php artisan config:clear
#RUN php artisan migrate
#CMD dockerize -wait tcp://db:3306 -timeout 60s php artisan migrate --force
RUN #php artisan db:seed
RUN php artisan storage:link
RUN npm run prod
#RUN npm run setup
CMD ["php-fpm"]
#RUN #php artisan migrate --force
