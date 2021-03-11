phpunit:
	docker-compose exec php bash -c "./vendor/bin/phpunit ./tests/"

apidoc:
	docker-compose exec php bash -c "./vendor/zircote/swagger-php/bin/openapi ./src -o swagger.json"

