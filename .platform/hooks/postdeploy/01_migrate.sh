#!/bin/bash

cd /var/app/current

# Establecer permisos adecuados
chmod -R 755 storage bootstrap/cache
php artisan storage:link

# Generar la clave de la aplicación si no existe
php artisan key:generate --force

# Ejecutar migraciones de la base de datos
php artisan migrate --force

# Limpiar caché
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear