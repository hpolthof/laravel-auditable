# Auditable
Add the ability to easily add ```created_by``` and ```updated_by``` fields
to a migration.

## How to use?
Require the package

```bash
composer require hpolthof/laravel-auditable
```

### In a migration
In a migration you can now do something like:

```php
Schema::create('users', function (Blueprint $table) {
    $table->increments('id');
    $table->string('email');
    $table->auditable();
    $table->timestamps();
});
```

You can also use the function ```dropAuditable``` in your ```down()``` method.

## Disclaimer
This package is used for internal development, but published for public use. 
Obviously this software comes *as is*, and there are no warranties or whatsoever.

If you like the package it is always appreciated if you drop a message of gratitude! ;-)

The package was build by: Paul Olthof