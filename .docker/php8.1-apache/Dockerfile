FROM php:8.1-apache

ARG USER_ID
ARG GROUP_ID

RUN usermod --non-unique --uid $USER_ID www-data
RUN groupmod --gid $GROUP_ID www-data
RUN a2enmod rewrite

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

RUN apt-get install -y libjpeg-dev libpng-dev libfreetype6-dev libwebp-dev
RUN docker-php-ext-configure gd --with-jpeg --with-freetype
RUN docker-php-ext-install gd

RUN apt-get update && apt-get install -y \
    imagemagick libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick

WORKDIR /var/www/html
COPY --chown=www-data:www-data . .

USER www-data