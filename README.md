# LARAVEL 8 Currency with Passport Oauth2

---

[Laravel PHP Framework 8.0](http://laravel.com).

[APP DEMO on Heroku](https://avz-laravel-currency.herokuapp.com/) : `https://avz-laravel-currency.herokuapp.com`.
## Prerequisites

1. PHP > 7.3
1. MySQL or PostgreSql
1. [Composer](http://getcomposer.org)


## Getting Started

1. Clone to your base project directory.
    
	```
	git clone https://github.com/rizalsk/laravel8.0-currency-restapi.git
	```
	
2. Install composer dependencies.

	```
	composer install
	```
	
3. Create configuration file `.env` (copy from `.env.example`)

	```
	##MySQL
	DB_CONNECTION=mysql
	DB_HOST=localhost
	DB_PORT=3306
	DB_DATABASE=database
	DB_USERNAME=root
	DB_PASSWORD=
	```
    
1. Migrate the database.

	```
	php artisan migrate
	```
1. Seed the user database.

	```
	php artisan db:seed
	```
1. Run Artisan command Install Passport Oauth2.

	```
	php artisan passport:install
	```
    you can generate new passport client using this artisan command, give name to the new client oauth and select index [0] users provider

    ```
	php artisan passport:client --password
	```
1. When deploying Passport to your application's servers for the first time, you will likely need to run the passport:keys command. 

    ```
	php artisan passport:keys
	```
1. Login with postman to get token
    - Method : POST
    - Default URL : {{base_url}}/api/login
    - params
        ```
        email : admin@mail.com
        password : password
        ```
        
    - Url
        ```
        {{base_url}}/api/login
        ```
    
    - response json
        ```
        token : {bearer token}
        ```
    - Curl


        ```
        curl --location --request POST '{{base_url}}/api/login' \
        --form 'email="admin@mail.com"' \
        --form 'password="password"'
        ```

        or with default oauth2 method

        ```
        curl --location --request POST '{{base_url}}/oauth/token' \
        --form 'grant_type="password"' \
        --form 'client_id="{{client_id}}"' \
        --form 'client_secret=" {{client_secret}}"' \
        --form 'username="admin@mail.com"' \
        --form 'password="password"' \
        --form 'scope=""'
        ```

        please change the {{base_url}}, {{client_secret}}, and {{client_id}}

## Rest Currency :

### 1. Fetch external currency data
- Web Service Provider
  - [Exchange Rates Api](https://api.exchangeratesapi.io)
- Method
  - GET 
- Token
  - Bearer
- Route 
    ```
    {{base_url}}/api/currency/{date}
    ```
    date or latest
- Curl
    ```
    curl --location --request GET '{{base_url}}/api/currency/2022-02-11' \
    --header 'Authorization: Bearer {{replace with token}}'
    ```
    change {date} to latest if you want to fetch latest currencies
### 2. Index
- Method
  - GET
- Token
  - Bearer
- Route 
    ```
    {{base_url}}/api/currencies
    ```
    
- Curl
    ```
    curl --location --request GET '{{base_url}}/api/currencies' \
    --header 'Authorization: Bearer {{replace with token}}'
    ```
### 2. Show
- Method
  - GET 
- Token
  - Bearer 
- Route 
    ```
    {{base_url}}/api/currencies/{code}
    ```
    
- Curl
    ```
    curl --location --request GET '{{base_url}}/api/currencies' \
    --header 'Authorization: Bearer {{replace with token}}'
    ```
## Demo on Heroku
  - POST
    [https://avz-laravel-currency.herokuapp.com/api/login](https://avz-laravel-currency.herokuapp.com/api/login)
    ```
    user : admin@mail.com
    password : password
    ```
  - GET (Auth Bearer Token)
  [https://avz-laravel-currency.herokuapp.com/api/currency/latest](https://avz-laravel-currency.herokuapp.com/api/currency/latest)
  [https://avz-laravel-currency.herokuapp.com/api/currencies/usd](https://avz-laravel-currency.herokuapp.com/api/currencies/usd)
  [https://avz-laravel-currency.herokuapp.com/api/currencies/usd](https://avz-laravel-currency.herokuapp.com/api/currencies/usd)


## Plugins
In this laravel 8.0, **we've installed**:

1. [Laravel/Passport](https://github.com/laravel/passport)
1. [Jetstream](https://jetstream.laravel.com/2.x/introduction.html)
