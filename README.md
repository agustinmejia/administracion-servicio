<!-- <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/agustinmejia/farmacia/master/public/img/icon.png" width="150"></a></p> -->

# Administración de mantenimientos.

## Instalación
```
composer install
cp .env.example .env
php artisan migrate --seed
php artisan storage:link
php artisan key:generate
chmod -R 777 storage bootstrap/cache
```