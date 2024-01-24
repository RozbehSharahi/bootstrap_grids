FROM php:7.4.15-apache

ARG HOST_USER_ID

RUN usermod --non-unique --uid $HOST_USER_ID www-data
RUN a2enmod rewrite
RUN chown -R www-data:root /var/www

ARG APACHE_DOCUMENT_ROOT
ENV APACHE_DOCUMENT_ROOT $APACHE_DOCUMENT_ROOT

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN apt-get -y update \
&& apt-get install -y libicu-dev \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl \
&& docker-php-ext-install pdo pdo_mysql mysqli

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && apt-get install -y mariadb-client

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN apt-get update && apt-get install -y iputils-ping && apt-get install -y telnet && apt-get install -y iproute2

RUN apt-get install -y libzip-dev zip && docker-php-ext-install zip

RUN apt-get update && apt-get install curl && curl -sL https://deb.nodesource.com/setup_14.x | bash
RUN apt-get install nodejs
RUN npm install --global yarn

RUN apt-get install -y libjpeg-dev libpng-dev libfreetype6-dev libwebp-dev
RUN docker-php-ext-configure gd --with-jpeg --with-freetype
RUN docker-php-ext-install gd
