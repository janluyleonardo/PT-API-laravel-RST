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

### Para procesar trabajos en segundo plano (colas) ejecutar el siguiente comando en otra terminal:

```bash
php artisan queue:work
```
esto pondra a la escucha el worker de las colas configuradas para la generacion del excel y CSV, asi se puede consumir los servicios de export y exportcsv.

### Ejemplo de rutas de consumo por medio de cliente REST como Postman o Insomnia

usando php artisan serve la url base sera http://127.0.0.1:8000

### servicio exportar productos a excel
GET http://127.0.0.1:8000/api/products/export

### servicio exportar productos a csv
GET http://127.0.0.1:8000/api/products/exportcsvs

# Importante:

Para poder generar el excel es necesario aumentar la memoria del servidor 
Pasos para aumentar el límite de memoria en php.ini:

1. Abrir el archivo php.ini:
- Ubica el archivo php.ini en tu servidor. Puedes encontrar su ubicación ejecutando:
```bash
php --ini
```
- En sistemas Linux/Unix, suele estar en:
```bash
/etc/php/<versión>/cli/php.ini
/etc/php/<versión>/apache2/php.ini
```
  
- En Windows, puede estar en la carpeta de instalación de PHP, por ejemplo: C:\xampp\php\php.ini.

2. Editar el archivo php.ini para modificar el limite de memoria:
- Busca la línea que dice memory_limit y cámbiala a un valor mayor, por ejemplo:
```ini
memory_limit = 2048M
```
- Si no existe, puedes agregarla.

3. Guardar los cambios y reiniciar el servidor web:
- Después de guardar los cambios en php.ini, reinicia tu servidor web para que los cambios surtan efecto.
- Por ejemplo, si usas Apache:
```bash
sudo service apache2 restart
```
- Si usas Nginx con PHP-FPM:
```bash
sudo service php<versión>-fpm restart
sudo service nginx restart
```
Aumentar el Límite de Memoria Temporalmente en el Script (Para Desarrollo)
- Si no tienes acceso al archivo php.ini o solo necesitas aumentar el límite de memoria temporalmente, puedes hacerlo directamente en tu script de PHP:
```php
ini_set('memory_limit', '2048M');
```
Agrega esta línea al inicio de tu script o en el método donde se está ejecutando el proceso que consume mucha memoria.

Aumentar el Límite de Memoria para el Worker de Colas
Si el error ocurre al ejecutar el worker de colas, puedes aumentar el límite de memoria específicamente para el comando queue:work:
```bash
php -d memory_limit=2048M artisan queue:work
```

- Para verificar el límite de memoria actual de PHP, ejecuta:
```bash
php -i | grep memory_limit
```

### Importante:

Para autenticarte y obtener el token de acceso usa el siguiente usuario creado en el seeder:
email:admin@example.com
password:password
Usa la ruta POST /api/login para obtener el token de acceso y usarlo en las demas rutas protegidas.
el token ed tipo bearer token
# Rutas disponibles
