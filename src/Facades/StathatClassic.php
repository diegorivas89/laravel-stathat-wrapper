<?php
namespace Stathat\Facades;

use Illuminate\Support\Facades\Facade;
/**
* 	
*/
class StathatClassic extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() {
		return 'stathat-classic';
	}
}

?>