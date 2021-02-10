### Setup Steps

- copy the repository
- composer install
- npm i
- add database name in env DB_DATABASE=""
- php artisan migrate
- add this line into VUE_APP_BASE_URL="${APP_URL}" env
- php artisan db:seed
- php artisan serve in one terminal
- npm run watch in another terminal
- hit this url http://localhost:8000/products into browser
