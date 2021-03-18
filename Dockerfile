FROM php:7.4-cli

RUN apt-get update && \
       apt-get install -y --no-install-recommends apt-utils && \
       apt-get -y install sudo


RUN pecl install psr

RUN pecl channel-update pecl.php.net
RUN pecl install phalcon
RUN echo "extension=psr.so" > "$PHP_INI_DIR/conf.d/docker-php-ext-psr.ini" \
    && echo "extension=phalcon.so" > "$PHP_INI_DIR/conf.d/docker-php-ext-phalcon.ini"

ADD . /code

WORKDIR /code

EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80", "-t", "public/", ".htrouter.php"]