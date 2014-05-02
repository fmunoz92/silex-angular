## Quick Install

update app/config/dbs/db.php

```
$ composer install
$ bower install
$ php vendor/bin/doctrine orm:schema-tool:update --force
```

## Run server

```
$ php -S localhost:8000
```