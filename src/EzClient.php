<?php
namespace Stathat;

/**
* 
*/
class EzClient extends Client
{
	
	public function __construct($email)
	{
		parent::__construct();
		$this->email = $email;
	}

	public function count($stat_name, $count, $email = '')
	{
		$this->doAsyncPostRequest(
			self::EZ_API_URL,
			array(
				'email' => $this->getEmail($email),
				'stat' 	=> $stat_name,
				'count' => $count
			)
		);
	}

	public function value($stat_name, $value, $email = '')
	{
		$this->doAsyncPostRequest(
			self::EZ_API_URL,
			array(
				'email' => $this->getEmail($email),
				'stat' 	=> $stat_name,
				'value' => $value
			)
		);
	}

	public function countSync($stat_name, $count, $email = '')
	{
		$email = $this->getEmail($email);

		return $this->doPostRequest(
			self::EZ_API_URL,
			"email=$email&stat=$stat_name&count=$count"
		);
	}

	public function valueSync($stat_name, $value, $email = '')
	{
		$email = $this->getEmail($email);

		return $this->doPostRequest(
			self::EZ_API_URL,
			"email=$email&stat=$stat_name&value=$value"
		);
	}
}

?>