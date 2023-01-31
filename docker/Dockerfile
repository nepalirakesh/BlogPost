# FROM php:8.1-rc-zts-alpine3.16

# # install all necessary packages
# RUN apk update & docker-php-ext-install mysqli pdo pdo_mysql

# # Copy composer installable
# COPY ./install-composer.sh ./

# # Install composer
# RUN sh ./install-composer.sh && rm ./install-composer.sh

# CMD ["cd", "app", "&", "php", "artisan", "serve", "--host=0.0.0.0:8000"]



# base-image
# FROM php:8.1-rc-zts-alpine3.16
# FROM php:8.1-apache


# # Copy virtual host into container
# COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# # Enable rewrite mode
# RUN a2enmod rewrite


# # install extra softwares
# RUN apt update && \
#     apt install wget \
#     git \
#     unzip\
#     -y --no-install-recommends


# # install composer
# COPY ./install-composer.sh ./
# RUN sh ./install-composer.sh && rm ./install-composer.sh


# # install drivers for communication with my-sql
# RUN apt-get update && docker-php-ext-install mysqli pdo pdo_mysql 


# # chage the working directory
# WORKDIR /var/www


# # change the owner of /var/www
# RUN chown -R www-data:www-data /var/www


# CMD ["apache2-foreground"]



FROM php:8.1-apache

# Copy virtual host into container
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Enable rewrite mode
RUN a2enmod rewrite

# Install necessary packages
RUN apt-get update && \
    apt-get install \
    libzip-dev \
    wget \
    git \
    unzip \
    -y --no-install-recommends

# Install PHP Extensions
RUN docker-php-ext-install zip pdo_mysql

# RUN pecl install -o -f xdebug-3.1.3 \
#     && rm -rf /tmp/pear

# Copy composer installable
COPY ./install-composer.sh ./

# Copy php.ini
# COPY ./php.ini /usr/local/etc/php/

# Cleanup packages and install composer
RUN apt-get purge -y g++ \
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/* \
    && rm -rf /tmp/* \
    && sh ./install-composer.sh \
    && rm ./install-composer.sh

# Change the current working directory
WORKDIR /var/www

# Change the owner of the container document root
RUN chown -R www-data:www-data /var/www
RUN chmod +s /var/www/
RUN chmod g+s /var/www


# Start Apache in foreground
CMD ["apache2-foreground"]