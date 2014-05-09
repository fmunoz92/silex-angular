## REST API PHP Silex + Angular + Bootstrap

Technologies and Frameworks

- Silex http://silex.sensiolabs.org
- Doctrine 2 ORM http://www.doctrine-project.org/
- Angular.js https://angularjs.org
- Bootstrap 3 http://getbootstrap.com

## Requirements

- PHP 5.5.3 at least
- Mysql 5 
- bower http://bower.io/
- composer https://getcomposer.org

## Quick Install

update data base params in config/dbs/db.php

```
$ composer install
$ bower install
$ php vendor/bin/doctrine orm:schema-tool:update --force
```

## Run tests

```
$ php vendor/bin/phpunit --colors --bootstrap tests/backendTests/bootstrap.php tests/backendTests/*/*
```

## Run server

```
$ php -S localhost:8000
```