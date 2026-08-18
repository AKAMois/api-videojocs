#!/bin/sh
set -e

php artisan migrate --force
php artisan config:clear
php artisan config:cache
php artisan route:cache
