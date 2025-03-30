#!/bin/bash
set -e

# Tunggu jika database belum siap (opsional)
# sleep 5

# Optimasi dan clear cache
php artisan optimize:clear

# Link storage
php artisan storage:link || true

# Migrasi database (hanya jika terhubung ke database)
php artisan migrate --force || echo "Couldn't run migrations. Database may not be ready."

# Execute CMD
exec "$@"