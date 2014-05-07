## Requirements

- PHP 5.5.3 at least
- Mysql 5 
- bower http://bower.io/
- composer https://getcomposer.org

## Quick Install

update data base params in app/config/dbs/db.php

```
$ composer install
$ bower install
$ php vendor/bin/doctrine orm:schema-tool:update --force
```

## Run server

```
$ php -S localhost:8000
```