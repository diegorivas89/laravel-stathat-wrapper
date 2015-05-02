<?php
namespace Stathat;
/**
* 
*/
interface StathatClientInterface
{
	/**
	 * Make a count against a stat asynchronously
	 * 
	 * @param  string 	$stat_name
	 * @param  int 		$count
	 * @param  string 	$accountId
	 * @return void
	 */
	public function count($stat_name, $count, $accountId = '');
	
	/**
	 * Log a value against a stat asynchronously
	 *
	 * @param  string 	$stat_name
	 * @param  int 		$value
	 * @param  string 	$accountId
	 * @return void
	 */
	public function value($stat_name, $value, $accountId = '');

	/**
	 * Make a count against a stat
	 *
	 * @param  string 	$stat_name
	 * @param  int 		$value
	 * @param  string 	$accountId
	 * @return void
	 */
	public function countSync($stat_name, $count, $accountId = '');

	/**
	 * Log a value against a stat
	 *
	 * @param  string 	$stat_name
	 * @param  int 		$value
	 * @param  string 	$accountId
	 * @return void
	 */
	public function valueSync($stat_name, $value, $accountId = '');
}

?>