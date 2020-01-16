FROM php:7.4.1-apache
MAINTAINER williman.nicolas@gmail.com

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && apt-get install -y \
	libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
	libxslt1-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

COPY docker/php.ini /usr/local/etc/php/

RUN pecl install mongodb \
	&& echo "extension=mongodb.so" >> /usr/local/etc/php/php.ini

#RUN a2enmod rewrite
#RUN a2enmod headers

RUN chmod -R 777 /var/log

COPY docker/vhost.conf /etc/apache2/sites-available/
RUN a2ensite vhost.conf

WORKDIR /var/www/

COPY . ./

RUN composer install
