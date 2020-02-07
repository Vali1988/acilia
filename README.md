# Pasos a ejecutar
* Descargamos el repositorio.
* Cambiamos la variable de entorno DATABASE_URL con sus credenciales
* Hacemos composer install.
* Ahora ejecutaremos para la creación de base de datos
```
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --dump-sql (optativo solo para ver las queries que se van a ejecutar)
php bin/console doctrine:schema:update --force
```
* En caso de querer Fixtures
```
php bin/console doctrine:fixtures:load
```

# Ejecutar Tests
```
php bin/phpunit tests
```
