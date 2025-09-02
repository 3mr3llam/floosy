# New Start Project

## Requirements

> PHP version 8.2+

> Laravel version 11+

## Installation

-   Start by cloning this git

```
git clone https://github.com/3mr3llam/floosy.git

composer install
```

-   After the following command change DB name in `.env` and create it in `Phpmyadmin`

```
copy .env.example .env

php artisan key:generate
```

```
// You have to create the db first before running this command.
php artisan migrate

// if you have a problem run this command instead
php artisan migrate:fresh
```

-   You can edit the admin info in this file `AdminUserSeeder`

```
php artisan db:seed --class=AdminUserSeeder 'AdminUserSeeder'
```

-   After running the previous command **`You  MUST`** go to `User` and `Admin` models and uncomment line 80 to 96 in saving function after that run the following command

```
php artisan shield:super-admin --user=1
php artisan make:filament-user // Don't run this command if you run the previous one
npm install
npm run build
```

-   To make the project work correctly on XAMPP you need to fix post login error first by running the following commands after installing filament in command line

```

composer require livewire/livewire

php artisan vendor:publish --force --tag=livewire:assets

php artisan livewire:publish --config

```

-   After that add this line to `config/livewire.php`. Make sure to change `new-start` to the name of the project folder

```

'asset_url' => '/new-start/public/vendor/livewire/livewire.js',

```

-   Third step is to add this line in `AppServiceProvider.php` in `boot()`

```

use Livewire\Livewire;



Livewire::setUpdateRoute(function ($handle) {

return Route::post(env('LIVEWIRE_UPDATE_PATH'), $handle)->name('custom-livewire.update');

});

Livewire::setScriptRoute(function ($handle) {

return Route::get(env('LIVEWIRE_JAVASCRIPT_PATH'), $handle);

});

```

Last step is to add the following in `.env`. Make sure to change `new-start` to the name of the project folder

```

LIVEWIRE_UPDATE_PATH=new-start/livewire/update

LIVEWIRE_JAVASCRIPT_PATH=new-start/public/livewire/livewire.js

```

-   After that don't forget to run `npm install` and `npm run dev` for breeze in cli or you can copy all public/build/assets to /build/assets without running `npm run dev`
-   Run the following command to generate the permissions and policies

```
php artisan shield:generate --all
```

-   Log into the admin panel then go to roles page and click on edit for `super_admin` role and click on save in the edit page to save the permissions for the role and the admin user
