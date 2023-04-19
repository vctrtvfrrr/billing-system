#!/bin/bash

php artisan migrate --force --seed
php artisan octane:start --host=0.0.0.0 --port=3000
