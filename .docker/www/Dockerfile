# syntax=docker/dockerfile:1
FROM php:8.3-fpm-alpine

ARG USER_ID=1000
ARG GROUP_ID=1000

RUN apk add --no-cache $PHPIZE_DEPS bash linux-headers libxslt-dev icu-dev shadow nginx mariadb-dev su-exec git openssh-client \
        imagemagick imagemagick-dev libpng-dev libjpeg-turbo-dev freetype-dev && \
    groupmod -g ${GROUP_ID} www-data && \
    usermod -u ${USER_ID} -g ${GROUP_ID} www-data

RUN docker-php-ext-configure intl && docker-php-ext-install sockets xsl pdo pdo_mysql intl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install gd

RUN pecl install xdebug imagick && docker-php-ext-enable xdebug imagick

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ARG TYPO3_VERSION

COPY .docker/www/php.ini /usr/local/etc/php/
COPY .docker/www/nginx-v$TYPO3_VERSION.conf /etc/nginx/http.d/default.conf

RUN mkdir /app && chown -Rf www-data:www-data /app

WORKDIR /app

ENV COMPOSER=composer-v$TYPO3_VERSION.json
ENV COMPOSER_HOME=/.composer
RUN mkdir /.composer && chown -R www-data:www-data /.composer
COPY ./composer* /app
RUN --mount=type=ssh,uid=${USER_ID},gid=${GROUP_ID} \
    export GIT_SSH_COMMAND='ssh -o StrictHostKeyChecking=no' && \
    su-exec www-data composer install

COPY . /app
COPY .docker/www/start.sh /start.sh
RUN chmod +x /start.sh

CMD ["/start.sh"]
