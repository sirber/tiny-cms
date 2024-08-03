FROM dunglas/frankenphp:1-php8.3-alpine AS base
WORKDIR /app
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY resources/Caddyfile /etc/caddy/Caddyfile
RUN set -eux; \
    install-php-extensions \
    @composer \
    ;

FROM base AS development
RUN cp $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

FROM base AS production
RUN cp $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini
COPY . .
RUN composer install --no-dev --no-progress