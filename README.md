## Requirements

* Apache and/or Nginx
* PHP 7.4.9
* redis-cli 3.2.6 optional
* MariaDB Server version: 10.1.41

## Installation Steps 

*  `mkdir dirname && cd dirname && git clone git@github.com:prazvan/poker_hands.git .`
*  composer install 
*  composer update  - if needed
*  npm install
*  create a new database `mysql -u username -p` then ` drop schema database_name;`
*  copy `.env.example` to `.env` and change the database name with the new schema name.
*  php artisan optimize:clear
*  php artisan route:clear
*  php artisan view:clear
* `above commands are just to make sure we clear all the caches`
*  php artisan storage:link
*  php artisan key:generate
*  php artisan migrate `to create the database tables`
* php optimize

### Setup for Reverse Proxy with Nginx and Apache

below are two virtual host for nginx as a reverse proxy and apache.

### Nginx Reverse proxy vhost
````
server {
       listen         80;
       server_name    domainname.com;
       return         301 https://$server_name$request_uri;
}

server {
        listen 443 ssl;

        server_name poker-hands.com;
        ssl_certificate /etc/nginx/certs/domainname.com.crt;
        ssl_certificate_key /etc/nginx/certs/domainname.com.key;

        error_log /var/log/nginx/error.log;

        location / {
           proxy_pass http://domainname.com:8080;
           proxy_set_header X-Real-IP  $remote_addr;
           proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
           proxy_set_header X-Forwarded-Proto https;
           proxy_set_header X-Forwarded-Port 443;
           proxy_set_header Host $host;
           fastcgi_buffers 16 16k;
           fastcgi_buffer_size 32k;
           proxy_buffer_size   128k;
           proxy_buffers   4 256k;
           proxy_busy_buffers_size   256k;
        }
}
````
### Apache vhost
````
<VirtualHost *:8080>
   ServerName domainname.com
   DocumentRoot /www/domainname.com/public

   <Directory "/www/domainname.com/public>
   	AllowOverride All
	Options FollowSymLinks
	Options Indexes FollowSymLinks Includes ExecCGI
    	AllowOverride All
        Order allow,deny
        Allow from all
        Require all granted
   </Directory>

   LogLevel debug
   DirectoryIndex index.php

</VirtualHost>
````

# Laravel Local Development Server

If you have PHP installed locally and you would like to use PHP's 
built-in development server to serve your application, you may use 
the serve Artisan command. This command will start a 
development server at `http://localhost:8000`:

`php artisan serve` or with specific port `php artisan serve --port 8080`

### Important notes when using the Build in Development Server.

* in the `.env` file make sure to change the `CONNECTION_PROTOCOL` to `http`
since the php server does not support https. 

After Changing the `.env` file, make sure you run the following

* `php artisan config:clear` 
* `php artisan optimize:clear`
* `php artisan optimize`

# Done
![That's all Folks!](https://i.pinimg.com/originals/ae/c2/8f/aec28f0b31f6f5bbf6c6b4321eed2186.jpg)
