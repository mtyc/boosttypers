#!/bin/bash

docker-compose down

docker run --rm --interactive --tty --user $(id -u):$(id -g) --volume $PWD:/app --volume /tmp:/tmp composer install

docker-compose up -d

echo 'Waiting for mysql'

sleep 60

docker-compose exec php-fpm php bin/console --no-interaction doctrine:migrations:migrate

docker-compose exec php-fpm php bin/console bts:gallery:import

docker-compose exec php-fpm php bin/console bts:gallery:photo:import

echo 'Now you can open http://localhost in your browser'