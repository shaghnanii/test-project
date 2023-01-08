# Laravel Setup

## Steps

```bash
# After cloning from the repo. Create a copy of .env file from .env.example.
$ copy .env .env.example (And setup you database)

# Install the dependencies.
$ composer install

# now migrate the database table and seed the db.
$ php artisan migrate:fresh --seed

# If want to migrate and seed separating
$ php artisan migrate
$ php artisan db:seed
```
