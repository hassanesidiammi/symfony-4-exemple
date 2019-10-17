# symfony-4-exemple

## clone project
git clone https://github.com/hassanesidiammi/symfony-4-exemple.git shop

## install PHP dependencies (composer)
```shell
cd shop
composer install
```

## install Javascript dependencies (yarn)
```shell
cd shop
yarn install
```

Be shur you have **node-sass** if not run 
```shell
yarn add sass-loader@^7.0.1 node-sass --dev
```

## Database configuration
* In  **.env** file add/change this line
**DATABASE_URL=mysql://dbuser:dbpass@127.0.0.1:3306/dbname**
* Create data base
```shell
bin/console doctrine:database:create
```
* Create table
```shell
bin/console doctrine:migration:migrate
```
* Load fake data
```shell
bin/console doctrine:fixtures:load -n
```

## Install assets
```shell
yarn encore dev
```

## Clear the ches
```shell
bin/console c:c
```

## connect to your new Shop site :)
### Simple user
* username: h.sidiammi@gmail.com
* password: hassane

### Admin user
* username: admin
* password: admin
