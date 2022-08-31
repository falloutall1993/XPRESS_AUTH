## Installation Project
First clone this repository, install the dependencies, and setup your .env file.

```bash
 # install dependencies
 composer install

 #generate key
 php artisan key:install

 # copy file exemple in .env
 Copy .env.example .env

 #This command allow to generate bearer token for API
 php passport:install
```

Then create the necessary database.

* Create database
```bash
#migrate database
php artisan migrate
```

## Configure Docker with Sails

```bash
# Start the environment
./vendor/bin/sail up

#Stop the environnement
./vendor/bin/sail stop
```

## Authentication API
In Controllers/Api/Auth/AuthController.php

## Crud API
In Http/Controllers/Api/Crud/UserController.php

## Restrict User API
In Http/Middleware/RestrictIpAddressMiddleware.php

## Route API
In route/api.php

```bash
# Auth route (method : POST)
baseUrl/api/login

#Create User (method : POST)
baseUrl/api/create

#Show Users (method : GET)
baseUrl/api/show

#Show Users (method : PUT)
baseUrl/api/update/{id}

#Show Users (method : DELETE)
baseUrl/api/delete/{id}
```


