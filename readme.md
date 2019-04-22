<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel-api





## Table of Contents

- [Installation](#installation)
- [Routes](#routes)
    - [Apientication](#Apientication)
    - [Password Reset](#password-reset)


### Installation

1. Clone repository
```
$ git clone https://github.com/santoshnet/laravel-api.git
```

2. Enter folder
```
$ cd laravel-api
```

3. Install composer dependencies
```
~/laravel-api$ composer install
```

4. Generate APP_KEY
```
~/laravel-api$ php artisan key:generate
```

5. Configure .env file, edit file with next command `$ nano .env`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=user
DB_PASSWORD=secret
```

MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=mymail@gmail.com
MAIL_PASSWORD=secret
MAIL_ENCRYPTION=TLS


6. Run migrations
```
~/laravel-api$ php artisan migrate
```

7. Create client
```
~/laravel-api$ php artisan passport:install
```


### Routes

##### Apientication

- POST /Api/login
- GET /Api/logout
- POST /Api/register
- GET /Api/register/activate/{token}
- GET /Api/user_details


##### Password Reset

- POST /password/create
- GET /password/find/{token}
- POST /password/reset

##### Blog Api

- POST /blog/
- GET /blogs/
- POST /blogs/{id}
- GET /blogs/{id}
- DELETE /blogs/{id}

##### Screenshot

<img src="screen/screen1.png">
<img src="screen/screen2.png">
<img src="screen/screen3.png">
<img src="screen/screen4.png">
<img src="screen/screen5.png">
<img src="screen/screen6.png">
<img src="screen/screen7.png">
<img src="screen/screen8.png">



## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
