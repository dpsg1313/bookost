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