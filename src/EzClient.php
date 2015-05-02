<?php
namespace Stathat;

/**
* Ez StatHat Client
*/
class EzClient implements StathatClientInterface
{
	const EZ_API_URL 	= 'http://api.stathat.com/ez';
	
	protected $email;
	protected $httpClient;

	/**
	 * Class constructor
	 *
	 * @param string 				$email
	 * @param \Stathat\HttpClient 	$httpClient
	 */
	public function __construct($email, \Stathat\HttpClient $httpClient)
	{
		$this->email = $email;
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
	public function count($stat_name, $count = 1, $accountId = '')
	{
		$this->httpClient->doAsyncPostRequest(
			self::EZ_API_URL,
			array(
				'email' => $this->getEmail($accountId),
				'stat' 	=> $stat_name,
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
			self::EZ_API_URL,
			array(
				'email' => $this->getEmail($accountId),
				'stat' 	=> $stat_name,
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
	public function countSync($stat_name, $count = 1, $accountId = '')
	{
		$accountId = $this->getEmail($accountId);

		return $this->httpClient->doPostRequest(
			self::EZ_API_URL,
			"email=$accountId&stat=$stat_name&count=$count"
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
		$accountId = $this->getEmail($accountId);

		return $this->httpClient->doPostRequest(
			self::EZ_API_URL,
			"email=$accountId&stat=$stat_name&value=$value"
		);
	}

	/**
	 * Return account's email
	 *
	 * @param string $default
	 * @return string
	 */
	protected function getEmail($default = null)
	{
		return ($default) ? $default : $this->email;
	}
}

?>