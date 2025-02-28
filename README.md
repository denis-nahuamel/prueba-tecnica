# Proyecto PHP con Doctrine y MySQL

Este proyecto utiliza PHP 8.2, Doctrine ORM, y MySQL para gestionar la persistencia de datos en una aplicación de ejemplo. El proyecto también incluye Docker para facilitar la configuración del entorno.

## Requisitos

- Docker
- Docker Compose

## Instalación y Configuración

### Paso 1: Clonar el repositorio

Clona este repositorio en tu máquina local:

```bash
git https://github.com/denis-nahuamel/prueba-tecnica.git
cd prueba-tecnica
```

### Paso 2: Construir el entorno con Docker
```bash
docker-compose up -d
```
### Paso 3: Instalar dependencias
```bash
docker-compose exec php composer install
```
### Paso 4: Crear el esquema de la base de datos
```bash
docker-compose exec php php bin/console doctrine:schema:create
```
### Paso 5: Inicializar el entorno con Makefile
```bash
make init
```
### Paso 6: Ejecutar las pruebas
```bash
make test
```
Si no tienes make instalado, puedes ejecutar las pruebas manualmente dentro del contenedor PHP:
```bash
docker-compose exec php vendor/bin/phpunit test/Unit
```