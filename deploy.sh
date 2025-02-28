#!/bin/bash

# Deploy skripti: production uchun Laravel artisan buyruqlari

echo "Configuration keshini tozalash va qayta yaratish..."
php artisan config:clear
php artisan config:cache

echo "Marshrutlar keshini tozalash va qayta yaratish..."
php artisan route:clear
php artisan route:cache

echo "Ko‘rinishlar (views) keshini tozalash va qayta yaratish..."
php artisan view:clear
php artisan view:cache

echo "Migratsiyalarni bajarish..."
php artisan migrate --force

echo "Storage papkasi uchun simvolik link yaratish..."
php artisan storage:link

echo "Deployment jarayoni yakunlandi!"
