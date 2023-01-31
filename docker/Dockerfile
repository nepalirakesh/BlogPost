FROM php:8.1-apache

# Copy virtual host into container
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Enable rewrite mode
RUN a2enmod rewrite

# Install necessary packages
RUN apt-get update && \
    apt-get install \
    wget \
    git \
    unzip \
    -y --no-install-recommends

# Install PHP Extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy composer installable
COPY ./install-composer.sh ./


# Install composer
RUN sh ./install-composer.sh \
    && rm ./install-composer.sh

# Change the current working directory
WORKDIR /var/www

# Change the owner of the container document root
RUN chgrp -R www-data /var/www
RUN chmod g+s /var/www

RUN find /var/www -type d -exec chgrp www-data {} +
RUN find /var/www -type d -exec chmod g+s {} +


# Start Apache in foreground
CMD ["apache2-foreground"]