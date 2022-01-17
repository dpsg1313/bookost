artisan=php artisan

install: install_dependencies .env

install_dependencies:# install dependencies
	composer install
	npm install

.env: # generate .env file
	cp -n .env.example .env
	$(artisan) key:generate
	touch database/database.sqlite
	$(artisan) migrate

live_upgrade:
    rm public/css/app.css
    rm public/js/app.js
    git pull origin master
    php -d open_basedir= /usr/local/bin/composer install
    yarn install --dev
    composer dump-autoload --optimize
    php artisan migrate
    php artisan optimize
    php artisan route:cache
    php artisan view:cache
    yarn run prod