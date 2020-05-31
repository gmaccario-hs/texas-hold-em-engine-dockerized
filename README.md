# PHP Texas Hold'em Hands Validation Engine Dockerized
Root folder contains the docker-compose file used to run the container. More info about the application in app/README.md

## Environment
* Nginx 1.13.6
* PHP 7.2-fpm

## Installation
```
git clone https://github.com/gmaccario/texas-hold-em-engine-dockerized.git texas-hold-em-engine
cd texas-hold-em-engine
docker-compose up -d

docker exec -it texas-hold-em-engine-php /bin/bash
composer install
```
