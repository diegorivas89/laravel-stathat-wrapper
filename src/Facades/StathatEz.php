<?php
namespace Stathat\Facades;

use Illuminate\Support\Facades\Facade;
/**
* 	
*/
class StathatEz extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() {
		return 'stathat-ez';
	}
}

?>