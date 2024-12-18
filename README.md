## Installation
```bash
docker compose up -d --build 
docker compose exec app bash
chmod -R 777 /var/www/html/storage/ /var/www/html/bootstrap/
cp .env.example .env
composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate:fresh --seed
```
## Contents
```text
laravel
mysql
graphql
Docker
Composer
Nginx
```
#### Example
```graphql
graphql?query={product(id:1){id,title}}
```
```graphql
{
    user(id:3){
        id,
        name,
        email
    }
},
mutation{
    createUser(name: "hello", email: "hello@gmail.com", password: "123456"){
        name,
        email,
        password
    },
    updateUser(id: "1", name: "hello1", email: "price11.shanie@example.com"){
        id,
        name
    } ,
    deleteUser(id:11){
        name
    }
}
```
