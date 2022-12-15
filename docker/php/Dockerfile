FROM php:8.0-cli
 
# install command
RUN apt-get update && apt-get install -y --no-install-recommends \
        vim \
        unzip \
        git \
        wget \
        gnupg \
        curl

# change bash
RUN mv /bin/sh /bin/sh_tmp && ln -s /bin/bash /bin/sh
 
# set timezone
ARG TZ="Asia/Tokyo"
ENV TZ ${TZ}
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && \
        echo $TZ > /etc/timezone
 
# set locale
RUN apt-get update
RUN apt-get install -y locales
RUN echo "ja_JP.UTF-8 UTF-8" > /etc/locale.gen && \
    locale-gen ja_JP.UTF-8
 
RUN echo "export LANG=ja_JP.UTF-8" >> ~/.bashrc
RUN source ~/.bashrc
 
# php-module
RUN apt-get install -y libicu-dev
RUN apt-get install -y libz-dev
RUN apt-get install -y libmemcached-dev
RUN docker-php-ext-install intl
RUN docker-php-ext-install sysvshm
RUN pecl install APCu
RUN pecl install xdebug
RUN pecl install memcached
RUN docker-php-ext-enable apcu xdebug memcached
 
# php.ini
RUN sed -ie "s/;date.timezone =/date.timezone = Asia\/Tokyo/g" /usr/local/etc/php/php.ini-development
RUN sed -ie "s/;date.timezone =/date.timezone = Asia\/Tokyo/g" /usr/local/etc/php/php.ini-production
# https://pentan.info/php/30timeout.html
RUN sed -ie "s/max_execution_time = 30/max_execution_time = 120/g" /usr/local/etc/php/php.ini-development
RUN sed -ie "s/max_execution_time = 30/max_execution_time = 120/g" /usr/local/etc/php/php.ini-production
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
 
# composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer