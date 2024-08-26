# Created project
```shell
composer create-project laravel/laravel:^10 laravel-task-manager
cd laravel-task-manager
php ./artisan sail:install --with=pgsql
./vendor/bin/sail pull pgsql
./vendor/bin/sail build
./vendor/bin/sail up
./vendor/bin/sail artisan migrate
git init
git add .
git commit -m "Initial commit"
git remote add origin git@github.com:abicorios/laravel-task-manager.git
git push -u origin master
```
Refs: https://laravel.com/docs/10.x/installation, https://laravel.build/example-app?with=pgsql

# JWT
```shell
./vendor/bin/sail composer require tymon/jwt-auth
./vendor/bin/sail artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
./vendor/bin/sail artisan jwt:secret
./vendor/bin/sail artisan make:controller AuthController
```
Refs: https://jwt-auth.readthedocs.io/en/develop/laravel-installation/
