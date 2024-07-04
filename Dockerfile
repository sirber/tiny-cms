FROM dunglas/frankenphp AS base

FROM base AS development
RUN cp $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

FROM base AS production
RUN cp $PHP_INI_DIR/php.ini-production $PHP_INI_DIR/php.ini
COPY . /app/
RUN composer install --no-dev --no-progress