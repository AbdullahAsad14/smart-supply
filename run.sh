#!/bin/bash

cd /var/www/html

php artisan migrate:fresh --seed
php artisan cache:clear
php artisan route:cache

php artisan serve --host=0.0.0.0 --port=8080
