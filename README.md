
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>


# A simple Image Repository
> A simple image repostory that with the following functionalities;
- **Registering**
- **Logging in**
- **Uploading single image**
- **Uploading bulk images**
- **Generating image sharable link**
- **Setting permissions for images**
- **Securing stored Images and uploading**


## Description
This project was built with Laravel and MySQL.

##### Integration testing :
- PHPUnit (https://phpunit.de)
- Faker (https://github.com/fzaninotto/Faker)

## Running the App
To run the App, you must have:
- **PHP** (https://www.php.net/downloads)
- **MySQL** (https://dev.mysql.com/downloads/installer)

Clone the repository to your local machine using the command
```console
$ git clone *remote repository url*
```

Create an `.env` file using the command. You can use this config or change it for your purposes.

```console
$ cp .env.example .env
```

### Environment
Configure environment variables in `.env` for dev environment based on your MYSQL database configuration and 
Cloudinary credentials(to get this, visit https://cloudinary.com/console)

```  
DB_CONNECTION=<YOUR_MYSQL_TYPE>
DB_HOST=<YOUR_MYSQL_HOST>
DB_PORT=<YOUR_MYSQL_PORT>
DB_DATABASE=<YOUR_DB_NAME>
DB_USERNAME=<YOUR_DB_USERNAME>
DB_PASSWORD=<YOUR_DB_PASSWORD>

CLOUDINARY_URL=
CLOUDINARY_NOTIFICATION_URL=
CLOUDINARY_API_KEY=
CLOUDINARY_API_SECRET=
CLOUDINARY_CLOUD_NAME=

```

### Installation
Install the dependencies and start the server

```console
$ composer install
$ php artisan key:generateZZZZZ
$ php artisan migrate
$ php artisan serve
```

You should be able to visit your app at http://localhost:8000

## Testing
To run integration tests:
```console
$ composer test
```
#Features that could be added to improve this app
- **Functionality to create categories for images. Categories can be set to be public or private**
- **Functionality to enable a user to generate a security key for each image  which can be given to other users to access  thier private images**
- **Functionality to notify a user when another user view thier image having been given it's sharable link or thier public images**
