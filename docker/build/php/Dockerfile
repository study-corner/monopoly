FROM php:fpm
RUN apt-get update && apt-get install -y --no-install-recommends \
        libxml2-dev \
        git \
        vim \
    && docker-php-ext-install \
        pdo_mysql \
        soap \
        bcmath \
        opcache

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN echo 'xdebug.remote_port=9001' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_enable=1' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.idekey=PHPSTORM' >> /usr/local/etc/php/php.ini

WORKDIR /var/www/monopoly/

EXPOSE 9001
