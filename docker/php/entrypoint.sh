#!/bin/sh

chmod 777 -R .

if [ ! -f .env ]; then
    cp .env.dist .env
fi

if [ ! -f .env.test ]; then
    cp .env.test.dist .env.test
fi

composer install

exec php-fpm
