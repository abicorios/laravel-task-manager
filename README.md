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
