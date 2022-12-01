#!/bin/bash

if [[ $1 == "up" ]]; then
    user=${USER} uid=${UID} docker-compose -f docker-compose.yaml up -d
elif [[ $1 == "down" ]]; then
    user=${USER} uid=${UID} docker-compose -f docker-compose.yaml down
elif [[ $1 == "start" ]]; then
    user=${USER} uid=${UID} docker-compose -f docker-compose.yaml start
elif [[ $1 == "stop" ]]; then
    user=${USER} uid=${UID} docker-compose -f docker-compose.yaml stop
elif [[ $1 == "build" ]]; then
   sed -e "s/DATABASE_URL=postgresql://root:password@appcake-db:5432/app_cake?serverVersion=14&charset=utf8 /g"  .env.example > .env

    user=${USER} uid=${UID} docker-compose -f docker-compose.yaml up -d --build

    docker-compose -f docker-compose.yaml exec app bash -c "composer install --ignore-platform-reqs"
    docker-compose -f docker-compose.yaml exec app bash -c "php bin/console doctrine:migrations:migrate"
    docker-compose -f docker-compose.yaml exec app bash -c "php bin/console user:seed"
    docker-compose -f docker-compose.yaml exec app bash -c "php bin/console post:import"
    docker-compose -f docker-compose.yaml exec app bash -c "symfony server:start -d"

elif [[ $1 == "test" ]]; then
   sed -e "s/DATABASE_URL=postgresql://root:password@appcake-db:5432/app_cake?serverVersion=14&charset=utf8 /g"  .env.example > .env

    user=${USER} uid=${UID} docker-compose -f docker-compose.yaml up -d --build

    docker-compose -f docker-compose.yaml exec app bash -c "composer install --ignore-platform-reqs"
    docker-compose -f docker-compose.yaml exec app bash -c "php bin/console doctrine:migrations:migrate"
    docker-compose -f docker-compose.yaml exec app bash -c "php bin/console user:seed"
    docker-compose -f docker-compose.yaml exec app bash -c "php bin/console post:import"
    docker-compose -f docker-compose.yaml exec app bash -c "symfony server:start -d"

fi
