.PHONY: exec-backend


build:
	docker-compose build
up:
	docker-compose up -d
start:
	docker-compose start
down:
	docker-compose down
stats:
	docker stats
ps:
	docker compose ps
logs:
	docker compose logs


restart:
	docker stop $$(docker ps -a -q)
	docker rm $$(docker ps -a -q)
	make start

#user appuser
exec-backend:
	docker exec -it --user appuser backend bash $(COMMAND)
#user root
exec-backend0:
	docker exec -it backend bash $(COMMAND)

exec-frontend:
	docker exec -it frontend bash

copy-env:
	docker exec -it --user appuser backend bash -c "cp .env.example .env"

install:
	make build
	make up
	make start

prepare-backend:
	make copy-env
	docker exec -it --user appuser backend bash  -c "composer install --no-interaction"
	docker exec -it --user appuser backend bash  -c "php artisan migrate:rollback"
	docker exec -it --user appuser backend bash  -c "php artisan key:generate"
	docker exec -it --user appuser backend bash  -c "php artisan fix:passport"
	docker exec -it --user appuser backend bash  -c "php artisan migrate"
	docker exec -it --user appuser backend bash  -c "php artisan passport:install"
	docker exec -it --user appuser backend bash  -c "php artisan db:seed"
	docker exec -it --user appuser backend bash  -c "php artisan route:list"

prepare-frontend:
	docker exec -it frontend bash  -c "npm install"

drop:
	exit
	make down
	docker rm $$(docker ps -a -q)
	docker-compose down --volumes --remove-orphans

all:
	make install
	make prepare-backend
	make prepare-frontend
	@echo "Front:  http://localhost:8080"
	@echo "Api:    http://localhost/api/v1/users"
	make exec-backend






