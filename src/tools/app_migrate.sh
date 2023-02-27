#!/bin/bash
docker compose exec app bash -c "php artisan migrate"
