# recruitment-manager-api
## Enviroment
### Build docker
- `docker-compose build`
### Run docker
- `docker-compose up`
### ssh to docker instance
- `docker exec -it recruitment-manager-php bash`
### Install laravel's packages
- `composer install`
### DB migration
- `php artisan migrate`
### Generate fake data
- `php artisan db:seed`
### Base URL
- http://localhost:8010/api/v1
### Run application
- http://localhost:8010
### Doc API
- http://localhost:8010/api/v1/documentation
### Debug query for perfomance
- http://localhost:8010/clockwork/app
### Check coding convention
- `./vendor/bin/phpcs --ignore=./vendor/,./storage,./resources,./bootstrap,./database,./public,./config,./docs --standard=PSR12 --extensions=php ./`
