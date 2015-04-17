<?php
namespace Stathat\Providers;

use Illuminate\Support\ServiceProvider;

class StathatClassicServiceProvider extends ServiceProvider {

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
		$this->package('diegorivas89/laravel-stathat', 'stathat', dirname(__FILE__));
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['stathat-classic'] = new \Stathat\ClassicClient();
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
