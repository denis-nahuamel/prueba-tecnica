PHP_CONTAINER=php_app

MYSQL_CONTAINER=mysql_db

init:
	@echo "Iniciando contenedores de Docker..."
	docker-compose up -d

	@echo "Instalando dependencias de Composer..."
	docker-compose exec $(PHP_CONTAINER) composer install

	@echo "Creando esquema de base de datos..."
	docker-compose exec $(PHP_CONTAINER) php bin/console doctrine:schema:create

test:
	@echo "Ejecutando pruebas con PHPUnit..."
	docker-compose exec $(PHP_CONTAINER) vendor/bin/phpunit
