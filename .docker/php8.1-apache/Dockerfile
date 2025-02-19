FROM php:8.1-apache

ARG USER_ID
ARG GROUP_ID
ARG APACHE_DOCUMENT_ROOT

ENV APACHE_DOCUMENT_ROOT=${APACHE_DOCUMENT_ROOT}

# Configure www-data user and Apache
RUN usermod --non-unique --uid $USER_ID www-data \
    && groupmod --gid $GROUP_ID www-data \
    && a2enmod rewrite \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Update and install all required packages in one step
RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get install -y --no-install-recommends \
        git \
        imagemagick \
        iproute2 \
        iputils-ping \
        mariadb-client \
        libfreetype6-dev \
        libicu-dev \
        libjpeg-dev \
        libmagickwand-dev \
        libpng-dev \
        libwebp-dev \
        libzip-dev \
        telnet \
        zip \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl pdo pdo_mysql mysqli \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install gd zip \
    && pecl install xdebug imagick \
    && docker-php-ext-enable xdebug imagick \
    && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory, copy application files, set ownership, and switch to non-root user
WORKDIR /var/www/html
COPY --chown=www-data:www-data . .
USER www-data
