##### BASE STEP ###########################################

FROM phpswoole/swoole:php8.2 AS base
RUN pecl channel-update https://pecl.php.net/channel.xml \
    && pecl install --onlyreqdeps --configureoptions='enable-redis-igbinary="yes" enable-redis-lzf="yes"' igbinary redis \
    && docker-php-ext-enable igbinary redis \
    && pecl clear-cache && rm -rf /tmp/pear
RUN docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-install bcmath
RUN groupadd --force -g 1000 www \
    && useradd -ms /bin/bash --no-user-group -g 1000 -u 1000 www \
    && mkdir /app && chown -R www:www /app

##### DEV STEP ############################################

FROM base AS development
WORKDIR /app
USER www
COPY --chown=www:www composer.* ./
RUN composer --no-ansi --no-interaction install --no-progress --no-scripts --optimize-autoloader
COPY --chown=www:www . .
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=3000"]

##### RUN STEP ############################################

FROM base AS production
WORKDIR /app
USER www
COPY --chown=www:www composer.* ./
RUN composer --no-ansi --no-interaction install --no-dev --no-progress --no-scripts --optimize-autoloader
COPY --chown=www:www . .
RUN cp .env.example .env \
    && php artisan key:generate \
    && sed -i "s/DB_HOST=.*/DB_HOST=mariadb/g" .env \
    && sed -i "s/APP_ENV=.*/APP_ENV=production/g" .env \
    && sed -i "s/APP_DEBUG=.*/APP_DEBUG=false/g" .env
ENTRYPOINT ["./start-container.sh"]
