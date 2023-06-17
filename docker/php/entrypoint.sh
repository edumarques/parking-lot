#!/bin/sh

chmod 777 -R .

if [ ! -f .env ]; then
    cp .env.dist .env
fi

composer install

exec php-fpm
