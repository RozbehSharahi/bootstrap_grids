#!/bin/sh

set -e

su-exec www-data sh -c "XDEBUG_MODE=off composer update"

php-fpm -D
exec nginx -g "daemon off;"
