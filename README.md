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

# Requests
You can run the API requests in PhpStorm from the `requests` directory.

# Database
You can run SQL requests to the database in PhpStorm. Get credentials from the `.env` file, but the DB host is `localhost`.

# Add roles
```shell
# Update the migration file
./vendor/bin/sail artisan make:migration add_role_to_users_table --table=users
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan make:controller UserController
```

# Add the task categories
```shell
./vendor/bin/sail artisan make:model TaskCategory -c -m --policy --api -R
# Update the migration file
./vendor/bin/sail artisan migrate
```

# Add the tasks
```shell
./vendor/bin/sail artisan make:model Task -c -m --policy --api -R
# Update the migration file
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan make:resource TaskResource
```

# Update the user controller
```shell
mv app/Http/Controllers/UserController{,2}.php
mv app/Models/User{,2}.php
./vendor/bin/sail artisan make:model User -c --policy --api -R
./vendor/bin/sail artisan make:resource UserResource
```
Then manually merge models and controllers.

# XDebug
Edit the `.env` file and add the following line: `SAIL_XDEBUG_MODE=debug`. Then restart the container with `Ctrl+C` and `./vendor/bin/sail up`.
