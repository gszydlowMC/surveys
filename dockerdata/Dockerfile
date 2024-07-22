FROM php:8.3-fpm

WORKDIR "/var/www/html"

RUN apt-get update && apt-get dist-upgrade --allow-unauthenticated -y && export LANG=C.UTF-8 && apt-get install -y --no-install-recommends \
git \
curl \
libpng-dev \
libonig-dev \
libxml2-dev \
libzip-dev \
zip \
unzip \
libpq-dev \
cron \
build-essential \
supervisor \
&& apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN apt-get update && apt-get install -y netcat-traditional

# Install PHP extensions https://github.com/mlocati/docker-php-extension-installer
RUN docker-php-ext-install pdo pdo_pgsql mbstring bcmath zip exif opcache
RUN docker-php-ext-install mysqli pdo_mysql && docker-php-ext-enable pdo_mysql

RUN docker-php-ext-configure gd && docker-php-ext-install -j$(nproc) gd

RUN pecl install -o -f redis \
&&  rm -rf /tmp/pear \
&&  docker-php-ext-enable redis

RUN apt-get install npm nodejs -y
RUN npm i concurrently -g
# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN ln -snf /usr/share/zoneinfo/UTC /etc/localtime && echo UTC > /etc/timezone

EXPOSE 9000
