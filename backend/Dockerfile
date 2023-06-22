FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www/html/

# Install dependencies for the operating system software
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    zip \
    vim \
    git \
    pkg-config \
    libcurl4-openssl-dev \
    libssl-dev \
    libmongocrypt-dev \
    wget \
    make \
    curl

# Install extensions for php
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install gd

# Install MongoDB extension
RUN pecl uninstall mongodb

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

# Install composer (php package manager)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# Install chromedriver
#RUN apt-get -y install gnupg
#RUN wget -qO - https://dl.google.com/linux/linux_signing_key.pub | gpg --dearmor -o /usr/share/keyrings/googlechrome-linux-keyring.gpg
#RUN echo "deb [arch=amd64 signed-by=/usr/share/keyrings/googlechrome-linux-keyring.gpg] http://dl.google.com/linux/chrome/deb/ stable main" | tee /etc/apt/sources.list.d/google-chrome.list
#RUN apt-get -y update && apt-get -y install google-chrome-stable

# RUN cp -n .env.example .env

# composer install
# RUN composer install --no-interaction

# Copy composer.lock and composer.json into the working directory
COPY composer.lock composer.json /var/www/html/

# Copy existing application directory contents to the working directory
COPY . /var/www/html

# Assign permissions of the working directory to the www-data user
RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache

RUN adduser --disabled-password --gecos '' appuser
# USER appuser

# Expose port 9000 and start php-fpm server (for FastCGI Process Manager)
EXPOSE 9000
CMD ["php-fpm"]
