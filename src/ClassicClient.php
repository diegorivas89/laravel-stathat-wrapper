<?php
namespace Stathat;

/**
* Classic Stathat Client
*/
class ClassicClient implements StathatClientInterface
{
	const COUNT_API_URL = 'http://api.stathat.com/c';
	const VALUE_API_URL = 'http://api.stathat.com/v';

	protected $userKey;
	protected $httpClient;

	public function __construct($userKey, $httpClient)
	{
		$this->userKey = $userKey;
		$this->httpClient = $httpClient;
	}

	/**
	 * Make a count against a stat asynchronously
	 * 
	 * @param  string 	$stat_name
	 * @param  int 		$count
	 * @param  string 	$accountId
	 * @return void
	 */
	public function count($stat_name, $count, $accountId = '')
	{
		return $this->httpClient->doAsyncPostRequest(
			self::COUNT_API_URL,
			array(
				'key' 	=> $stat_name,
				'ukey' 	=> $this->getUserKey($accountId),
				'count' => $count
			)
		);
	}

	/**
	 * Log a value against a stat asynchronously
	 *
	 * @param  string 	$stat_name
	 * @param  int 		$value
	 * @param  string 	$accountId
	 * @return void
	 */
	public function value($stat_name, $value, $accountId = '')
	{
		$this->httpClient->doAsyncPostRequest(
			self::VALUE_API_URL,
			array(
				'key' => $stat_name,
				'ukey' => $this->getUserKey($accountId),
				'value' => $value
			)
		);
	}

	/**
	 * Make a count against a stat
	 *
	 * @param  string 	$stat_name
	 * @param  int 		$value
	 * @param  string 	$accountId
	 * @return void
	 */
	public function countSync($stat_name, $count, $accountId = '')
	{
		$accountId = $this->getUserKey($accountId);

		return $this->httpClient->doPostRequest(
			self::COUNT_API_URL,
			"key=$stat_name&ukey=$accountId&count=$count"
		);
	}

	/**
	 * Log a value against a stat
	 *
	 * @param  string 	$stat_name
	 * @param  int 		$value
	 * @param  string 	$accountId
	 * @return void
	 */
	public function valueSync($stat_name, $value, $accountId = '')
	{
		$accountId = $this->getUserKey($accountId);

		return $this->httpClient->doPostRequest(
			self::VALUE_API_URL,
			"key=$stat_name&ukey=$accountId&value=$value"
		);
	}

	/**
	 * Return account's user key
	 *
	 * @param string $default
	 * @return string
	 */
	protected function getUserKey($default = null)
	{
		return ($default) ? $default : $this->userKey;
	}
}

?>