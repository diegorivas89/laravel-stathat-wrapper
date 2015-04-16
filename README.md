# Stathat wrapper for Laravel 4

Laravel 4 integration for the Stathat API

### Requeriments
- `php >= 5.4`
- `illuminate/support: 4.2.*`

### Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `diegorivas89/stathat-laravel`.

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

### Configuration

In the published file you must set your credentials, this is the `user_key` and the `email` depending on the type of api you will use.

### Usage

	Stathat::ezCount('page_views', 1);

or if you have to have to use more than one account of stathat, you could do:

	Stathat::ezCount('page_views', 1); // default account from config
	Stathat::ezCount('page_views', 1, 'first.account@email.com');
	Stathat::ezCount('page_views', 1, 'second.account@email.com');