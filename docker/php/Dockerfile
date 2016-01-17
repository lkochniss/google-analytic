FROM php:5.6-fpm
RUN apt-get update && apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev libpng12-dev libmemcached-dev mysql-client

RUN docker-php-ext-install iconv mcrypt
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install gd
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install mysql
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install zip

RUN curl -L http://pecl.php.net/get/xdebug-2.3.3.tgz >> /usr/src/php/ext/xdebug.tgz \
    && tar -xf /usr/src/php/ext/xdebug.tgz -C /usr/src/php/ext/ \
    && rm /usr/src/php/ext/xdebug.tgz
RUN docker-php-ext-install xdebug-2.3.3

RUN curl -L http://pecl.php.net/get/memcached-2.2.0.tgz >> /usr/src/php/ext/memcached.tgz \
    && tar -xf /usr/src/php/ext/memcached.tgz -C /usr/src/php/ext/ \
    && rm /usr/src/php/ext/memcached.tgz
RUN docker-php-ext-install memcached-2.2.0

RUN curl -L https://github.com/twigphp/Twig/archive/v1.22.2.tar.gz >> /usr/src/php/ext/twig.tgz \
    && tar -xf /usr/src/php/ext/twig.tgz -C /usr/src/php/ext/ \
    && rm /usr/src/php/ext/twig.tgz
RUN docker-php-ext-install Twig-1.22.2/ext/twig

CMD ["php-fpm"]