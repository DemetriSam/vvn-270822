setup-ci: env-prepare install-ci key-ci database-prepare-ci install-front-ci

setup: env-prepare build install key database-prepare storage-link

test:
	docker compose exec php php artisan test --testsuite=Feature

unit-test:
	docker compose exec php php artisan test --testsuite=Unit

install-front-ci:
	npm install
	npm run build

test-coverage-ci:
	composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

install-ci:
	composer install

key-ci:
	php artisan key:gen --ansi
	php artisan jwt:secret --force

database-prepare-ci:
	php artisan migrate:fresh --seed

lint-ci:
	composer exec --verbose phpcs -- --standard=PSR12

lint-fix-ci:
	composer exec --verbose phpcbf -- --standard=PSR12

phpstan-ci:
	composer exec phpstan analyse

analyse-ci:
	composer exec phpstan analyse -v

config-clear-ci:
	php artisan config:clear

test-coverage:
	docker compose exec php composer exec --verbose phpunit tests -- --coverage-clover build/logs/clover.xml

lint:
	composer exec --verbose phpcs -- --standard=PSR12 app

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 app

phpstan:
	docker compose exec php composer exec phpstan analyse

analyse:
	docker compose exec php composer exec phpstan analyse -v

config-clear:
	docker compose exec php php artisan config:clear

ide-helper:
	php artisan ide-helper:eloquent
	php artisan ide-helper:gen
	php artisan ide-helper:meta
	php artisan ide-helper:mod -n

update:
	git pull
	docker compose exec php composer install
	docker compose exec php php artisan migrate --force
	docker compose exec php php artisan optimize

seeder:
	docker compose exec php php artisan db:seed

env-prepare:
	cp -n .env.example .env || true

build:
	docker compose up -d --build

install:
	docker compose exec php composer install

key:
	docker compose exec application-fpm php artisan key:gen --ansi
	docker compose exec application-fpm php artisan jwt:secret --force

database-prepare:
	docker compose exec application-fpm php artisan migrate:fresh --seed

storage-link:
	docker compose exec application-fpm php artisan storage:link

heroku-build:
	composer install
	php artisan migrate --force
	php artisan db:seed --force
	php artisan optimize
	php artisan parse-vk-users

db-import-from-backup:
	docker compose exec -T database psql -d tapigo-database -U postgres  < data

db-start:
	sudo service postgresql start

fpm-start:
	sudo service php8.1-fpm start

nginx-start:
	sudo service nginx start

start: db-start fpm-start nginx-start

compile-assets:
	npm run build
build-php:
	docker build -t cr.yandex/crp3vb48visoe0anu49g/php8.1-fpm:latest -f ./images/php/Dockerfile . && docker push cr.yandex/crp3vb48visoe0anu49g/php8.1-fpm:latest
build-nginx:
	docker build -t cr.yandex/crp3vb48visoe0anu49g/nginx:latest -f ./images/nginx/Dockerfile . && docker push cr.yandex/crp3vb48visoe0anu49g/nginx:latest

build-containers: compile-assets build-nginx build-php