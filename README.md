Instalacion

ejecuar los siguientes comandos par alevantar el proyecto ya sea local o en servidor

```bash
git clone https://github.com/janluyleonardo/PT-API-laravel-RST.git
```
```bash
cd PT-API-laravel-RST
```
```bash
composer install
```
```bash
cp .env.example .env
```
```bash
php artisan key:generate
```
```bash
configurar en el archivo .env las variables de entorno para conexión a la base de datos por ej:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_base_datos
DB_USERNAME=usuario
DB_PASSWORD=contraseña
```
```bash
php artisan migrate --seed
```
```bash
php artisan serve
```

Si se ejecuta todo al pie de la letra estará listo para usarse en http://127.0.0.1:8000
