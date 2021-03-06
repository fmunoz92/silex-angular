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

update data base params in config/env/develoment.json

```
$ composer install
$ bower install
$ php vendor/bin/doctrine orm:schema-tool:update --force
```

Create the database for tests then put the env var SILEX_MODE=test
update test data base params in config/env/test.json
```
$ php vendor/bin/doctrine orm:schema-tool:update --force
```
Change SILEX_MODE to development.

## Run tests
```
$ php vendor/bin/phpunit
```

## Run server

```
$ php -S localhost:8000
```