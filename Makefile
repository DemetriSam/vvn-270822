setup-ci: env-prepare install-ci key-ci database-prepare-ci install-front-ci

setup: env-prepare build install key database-prepare storage-link

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

lint:
	composer exec --verbose phpcs -- --standard=PSR12 app

lint-fix:
	composer exec --verbose phpcbf -- --standard=PSR12 app

config-clear:
	php artisan config:clear

optimize:
	composer install --optimize-autoloader --no-dev
	php artisan config:cache
	php artisan route:cache
	php artisan view:cache

env-prepare:
	cp -n .env.example .env || true
	
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