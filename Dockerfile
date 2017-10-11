FROM php:7.1-fpm

RUN apt-get update \
    && apt-get install -y git libssl-dev zlib1g-dev libicu-dev g++ \
    && pecl install apcu-5.1.3 \
    && echo extension=apcu.so > /usr/local/etc/php/conf.d/apcu.ini \
    && docker-php-ext-install zip mbstring intl opcache

RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/bin/composer

RUN curl "http://www.phing.info/get/phing-latest.phar" -o /usr/bin/phing \
    && chmod +x /usr/bin/phing

RUN pecl install xdebug \
    && echo zend_extension=xdebug.so > /usr/local/etc/php/conf.d/xdebug.ini

ADD docker/php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www/inspizient
