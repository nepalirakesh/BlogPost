FROM php:8.1-rc-zts-alpine3.16

# install all necessary packages
RUN apk update & docker-php-ext-install mysqli pdo pdo_mysql

# Copy composer installable
COPY ./install-composer.sh ./

# Install composer
RUN sh ./install-composer.sh && rm ./install-composer.sh

CMD ["cd", "app", "&", "php", "artisan", "serve", "--host=0.0.0.0:8000"]





