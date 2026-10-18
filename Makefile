#!make
include .env

IMAGE_VERSION ?= latest

export IMAGE_VERSION
export DOCKER_REGISTRY

ps:
	docker compose -f docker-compose.yaml -p ${DOCKER_NAME} ps;

serve:
	docker compose -f docker-compose.yaml -p ${DOCKER_NAME} up -d;

down:
	docker compose -f docker-compose.yaml -p ${DOCKER_NAME} down;

shell:
	docker compose -f docker-compose.yaml -p ${DOCKER_NAME} exec -it web sh;

migrate-fresh:
	php artisan migrate:fresh --force && php artisan optimize:clear && php artisan shield:generate --all --panel=admin --no-interaction && php artisan db:seed --force
