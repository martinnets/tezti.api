FROM php:8.3-fpm-alpine

LABEL maintainer="Evolbit Dev"

ARG WWWGROUP=1000
ARG NODE_VERSION=20
ARG MYSQL_CLIENT="mysql-client"
ARG POSTGRES_VERSION=17

WORKDIR /var/www/html

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=UTC
ENV SUPERVISOR_PHP_COMMAND="/usr/bin/php -d variables_order=EGPCS /var/www/html/artisan serve --host=0.0.0.0 --port=8080"
ENV SUPERVISOR_PHP_USER="sail"

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apk add --no-cache \
    nginx \
    wget \
    php83-pdo \
    php83-mysqli \
    php83-pdo_mysql \
    postgresql-client \
    php83-pdo_pgsql \
    php83-pgsql \
    postgresql-dev \
    php83-mbstring \
    php83-json \
    php83-openssl \
    php83-curl \
    php83-zip \
    php83-dom \
    php83-phar \
    php83-session \
    curl \
    git \
    unzip\
    gcc \
    g++ \
    linux-headers \
    g++ \
    make \
    php83-dev \
    autoconf \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libzip-dev \
    libwebp-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install pgsql

RUN echo "extension=/usr/lib/php83/modules/mysqli.so" > /usr/local/etc/php/conf.d/00_mysqli.ini \
    && echo "extension=/usr/lib/php83/modules/pdo_mysql.so" > /usr/local/etc/php/conf.d/00_pdo_mysql.ini

COPY . /var/www/html

RUN sh -c "wget http://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"
RUN /usr/local/bin/composer install --no-dev --no-cache

RUN mkdir -p /run/nginx

RUN chown -R www-data: /var/www/html
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/php.ini /usr/local/etc/php/conf.d/custom.ini

EXPOSE 80

CMD ["sh", "/var/www/html/docker/startup.sh"]
