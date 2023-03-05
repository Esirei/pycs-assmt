FROM php:8.1-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    cron \
    nano \
    openssh-server \
    libonig-dev \
    libxml2-dev \
    libmemcached-dev \
    libzip-dev \
    libz-dev \
    libpq-dev \
    libjpeg-dev \
    libpng-dev \
    libfreetype6-dev \
    libssl-dev \
    libmagickwand-dev \
    libreadline-dev \
    libgmp-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    libicu-dev \
    libxslt-dev \
    libxpm-dev \
    libxslt1-dev \
    libxml2

# Install supervisor
RUN apt-get install -y supervisor

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Add docker php ext repo
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install php extensions
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions bcmath mbstring pdo_pgsql zip exif pcntl soap gd \
    memcached intl opcache redis xdebug gmp imagick

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Add user for application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory permissions
#COPY --chown=www:www-data . /app

WORKDIR /app

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
