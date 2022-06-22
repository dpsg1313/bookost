## Helpful shell commands

Getting into web user shell:
`sudo su www-data -s /bin/bash`

## Live Deployment

There is a shortcut: after git-pull just run `make live_upgrade` as user `www-data` in the application directory.

1. Composer install:
   `php -d open_basedir= /usr/local/bin/composer install`

2. yarn install:
   `yarn install --dev`

3. Apply changes to .env file:
   - APP_ENV=production
   - APP_DEBUG=false

4. Make sure that you are optimizing Composer's class autoloader map (docs):
   - composer dump-autoload --optimize
   - or along install: composer install --optimize-autoloader --no-dev
   - or during update: composer update --optimize-autoloader
   
5. Optimize and reset Cache:

    `php artisan optimize`

6. Optimizing Route Loading

    `php artisan route:cache`

7. Compile all of the application's Blade templates:

   `php artisan view:cache`
   Cache the framework bootstrap files:

8. Compiling assets (docs):

    `yarn run prod`

9. (Once) Generate the encryption keys Laravel Passport needs (docs):

    `php artisan key:generate`

10. (Once) Create a symbolic link from public/storage to storage/app/public (docs):

    `php artisan storage:link`

## Database Backup
sudo mysqldump -u root -p bookost > bookost_db_backup.sql