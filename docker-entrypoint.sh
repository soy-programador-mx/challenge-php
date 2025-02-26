#!/bin/bash

# Run phpunit tests
if [ "$1" = '/var/www/html/vendor/bin/phpunit' ]; then
    php /var/www/html/vendor/bin/phpunit --colors=always tests
fi

exec "$@"