FROM php:7.4-fpm

RUN apt update && \
 apt install -y zip unzip

# docker-php-ext-install:
# bcmath bz2 calendar ctype curl dba dom enchant exif ffi fileinfo filter ftp gd gettext gmp hash iconv imap intl
# json ldap mbstring mysqli oci8 odbc opcache pcntl pdo pdo_dblib pdo_firebird pdo_mysql pdo_oci pdo_odbc pdo_pgsql pdo_sqlite
# pgsql phar posix pspell readline reflection session shmop simplexml snmp soap sockets sodium spl standard sysvmsg
# sysvsem sysvshm tidy tokenizer xml xmlreader xmlrpc xmlwriter xsl zend_test zip

# composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer;

COPY ./composer.json /var/www/html/composer.json
COPY ./composer.lock /var/www/html/composer.lock

# you would want this dynamically created, however, vlumes might ni=ot yet be mounted by compose :(
COPY ./swagger.json /var/www/html/swagger.json

RUN composer dump-autoload && \
composer update
