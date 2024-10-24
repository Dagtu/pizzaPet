FROM php:8.2-fpm

RUN apt-get update && apt-get install -y libpq-dev
RUN docker-php-ext-install pdo_pgsql && docker-php-ext-enable pdo_pgsql
RUN docker-php-ext-install pgsql && docker-php-ext-enable pgsql

#Расширение PHP Ctype
#Расширение PHP cURL
#Расширение PHP DOM
#Расширение PHP Fileinfo
#Расширение PHP Filter
#Расширение PHP Hash
#Расширение PHP Mbstring
#Расширение PHP OpenSSL
#Расширение PHP PCRE
#Расширение PHP PDO
#Расширение PHP Session
#Расширение PHP Tokenizer
#Расширение PHP XML

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
