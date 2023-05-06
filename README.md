# recruitment-manager-api
## Enviroment
### Install laravel's packages
- `composer install`
### Migrate database
- `php artisan migrate`
### Generate fake data
- `php artisan db:seed`
### Reset database
- `php artisan migrate:fresh --seed`
### Run server
- `php artisan serve --host={your IPV4} --port=8000`
### Base URL
- http://localhost:8000/api/v1
### Run application
- http://localhost:8000
### Doc API
- http://localhost:8010/api/v1/documentation
### Debug query for perfomance
- http://localhost:8000/clockwork/app
### Check coding convention
- `./vendor/bin/phpcs --ignore=./vendor/,./storage,./resources,./bootstrap,./database,./public,./config,./docs --standard=PSR12 --extensions=php ./`
