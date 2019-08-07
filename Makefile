env:
	> .env
	cp .env.example .env

local:
	composer install
	php artisan key:generate 
	php artisan migrate:fresh --seed
	
dev: create_local
	npm install
	npm run dev

test:
	vendor/bin/phpunit