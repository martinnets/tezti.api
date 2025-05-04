#!/bin/bash

# Script para compilar y desplegar en cloud.laravel

# Actualizar dependencias de Composer
echo "Actualizando dependencias de Composer..."
composer install --no-dev --optimize-autoloader

# Compilar assets con Vite
echo "Compilando assets con Vite..."
npm ci
npm run build

# Configuración para producción
echo "Configurando para producción..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Migración de base de datos
echo "¿Deseas ejecutar las migraciones en producción? (s/n)"
read ejecutar_migracion

if [ "$ejecutar_migracion" = "s" ] || [ "$ejecutar_migracion" = "S" ]; then
    echo "Ejecutando migraciones..."
    php artisan migrate --force
fi

echo "¡Compilación completa! El proyecto está listo para ser desplegado."