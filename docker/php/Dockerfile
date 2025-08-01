FROM php:8.4-fpm

WORKDIR /var/www

RUN rm -rf /var/www/html

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    apt-utils \
    libonig-dev \
    libicu-dev

RUN docker-php-ext-install zip pdo_mysql mbstring exif intl
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/
RUN docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 developer
RUN useradd -u 1000 -ms /bin/bash -g developer user

COPY --chown=user:developer . /var/www

USER user

EXPOSE 9000

CMD ["php-fpm"]

