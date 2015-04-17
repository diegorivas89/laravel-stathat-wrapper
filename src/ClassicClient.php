<?php
namespace Stathat;
/**
* 
*/
class ClassicClient extends Client
{

	public function __construct()
	{
		# code...
	}

	public function count($stat_key, $count, $user_key = '')
	{
		return $this->doAsyncPostRequest(
			self::COUNT_API_URL,
			array(
				'key' 	=> $stat_key,
				'ukey' 	=> $this->getUserKey($user_key),
				'count' => $count
			)
		);
	}

	public function value($stat_key, $value, $user_key = '')
	{
		$this->doAsyncPostRequest(
			self::VALUE_API_URL,
			array(
				'key' => $stat_key,
				'ukey' => $this->getUserKey($user_key),
				'value' => $value
			)
		);
	}

	public function countSync($stat_key, $count, $user_key = '')
	{
		$user_key = $this->getUserKey($user_key);

		return $this->doPostRequest(
			self::COUNT_API_URL,
			"key=$stat_key&ukey=$user_key&count=$count"
		);
	}

	public function valueSync($stat_key, $value, $user_key = '')
	{
		$user_key = $this->getUserKey($user_key);

		return $this->doPostRequest(
			self::VALUE_API_URL,
			"key=$stat_key&ukey=$user_key&value=$value"
		);
	}
}

?>