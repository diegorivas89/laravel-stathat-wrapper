<?php
namespace Stathat\Providers;

use Illuminate\Support\ServiceProvider;

class StathatServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('diegorivas89/laravel-stathat', 'stathat', dirname(__FILE__).'/..');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['stathat-ez'] = $this->app->share(function($app)
		{
			return new \Stathat\EzClient(
				$app['config']->get('stathat::stathat.email'),
				new \Stathat\HttpClient()
			);
		});

		$this->app['stathat-classic'] = $this->app->share(function($app)
		{
			return new \Stathat\ClassicClient(
				$app['config']->get('stathat::stathat.user_key'),
				new \Stathat\HttpClient()
			);
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('stathat-ez', 'stathat-classic');
	}

}
