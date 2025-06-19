FROM dunglas/frankenphp:1-php8.4-alpine AS base
WORKDIR /app
COPY resources/Caddyfile /etc/frankenphp/Caddyfile
RUN set -eux; \
    install-php-extensions \
    @composer \
    ;

FROM base AS development
RUN cp $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

FROM base AS production
RUN cp $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini
COPY . .
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-dev --no-progress
