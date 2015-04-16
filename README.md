# Stathat wrapper for Laravel 4

### Requeriments
- `php >= 5.4`
- `illuminate/support: 4.2.*`

## Laravel 4.2 and Below

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `way/generators`.

    "require": {
		"diegorivas89/stathat-laravel": "dev-master"
	}

Next, update Composer from the Terminal:

    composer update

Once this operation completes, add the service provider. Open `app/config/app.php`, and add a new item to the providers array.

    'Stathat\StathatServiceProvider'

Also you can add the facade accesor to the end of `aliases` key in `app/config/app.php`

    'Stathat' => 'Stathat\Facades\Stathat'

The final step is publish the config file. for this run

    php artisan config:publish

### Usage