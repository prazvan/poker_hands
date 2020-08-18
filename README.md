1. git clone git@github.com:prazvan/poker_hands.git
2. composer install && composer update
3. npm install
4. copy .env.example to .env (cd working_dir && cp .env.example .env) 
5. create a database
5. php artisan optimize:clear
6. php artisan route:clear
7. php artisan view:clear
8. php artisan key:generate
9. php artisan migrate 
10.php optimize
11. create apache virtual host with https enabled or 

run php artisan serve --port 8080

if port is changed make sure to disable the https force secured located in 

AppServiceProvider::determinateRequestProtocol

comment line if from method

