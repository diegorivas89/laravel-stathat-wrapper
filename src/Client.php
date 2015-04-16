<?php
namespace Stathat;
/**
* 
*/
class Client
{
	const EZ_API_URL 	= 'http://api.stathat.com/ez';
	const COUNT_API_URL = 'http://api.stathat.com/c';
	const VALUE_API_URL = 'http://api.stathat.com/v';

	public function __construct()
	{

	}

	public function count($stat_key, $user_key, $count)
	{
		return $this->doAsyncPostRequest(self::COUNT_API_URL, array('key' => $stat_key, 'ukey' => $user_key, 'count' => $count));
	}

	public function value($stat_key, $user_key, $value)
	{
		$this->doAsyncPostRequest(self::VALUE_API_URL, array('key' => $stat_key, 'ukey' => $user_key, 'value' => $value));
	}

	public function ezCount($email, $stat_name, $count)
	{
		$this->doAsyncPostRequest(self::EZ_API_URL, array('email' => $email, 'stat' => $stat_name, 'count' => $count));
	}

	public function ezValue($email, $stat_name, $value)
	{
		$this->doAsyncPostRequest(self::EZ_API_URL, array('email' => $email, 'stat' => $stat_name, 'value' => $value));
	}

	public function countSync($stat_key, $user_key, $count)
	{
		return $this->doPostRequest(self::COUNT_API_URL, "key=$stat_key&ukey=$user_key&count=$count");
	}

	public function valueSync($stat_key, $user_key, $value)
	{
		return $this->doPostRequest(self::VALUE_API_URL, "key=$stat_key&ukey=$user_key&value=$value");
	}

	public function ezCountSync($email, $stat_name, $count)
	{
		return $this->doPostRequest(self::EZ_API_URL, "email=$email&stat=$stat_name&count=$count");
	}

	public function ezValueSync($email, $stat_name, $value)
	{
		return $this->doPostRequest(self::EZ_API_URL, "email=$email&stat=$stat_name&value=$value");
	}

	protected function doPostRequest($url, $data, $optional_headers = null)
	{
		$params = array('http' => array(
			'method' => 'POST',
			'content' => $data
		));
		if ($optional_headers !== null) {
			$params['http']['header'] = $optional_headers;
		}
		$ctx = stream_context_create($params);
		$fp = @fopen($url, 'rb', false, $ctx);
		if (!$fp) {
			throw new Exception("Problem with $url, $php_errormsg");
		}
		$response = @stream_get_contents($fp);
		if ($response === false) {
			throw new Exception("Problem reading data from $url, $php_errormsg");
		}
		return $response;
	}

	protected function doAsyncPostRequest($url, $params)
	{
		foreach ($params as $key => &$val) {
		if (is_array($val)) $val = implode(',', $val);
			$post_params[] = $key.'='.urlencode($val);
		}
		$post_string = implode('&', $post_params);

		$parts=parse_url($url);

		$fp = fsockopen($parts['host'],
		isset($parts['port'])?$parts['port']:80,
		$errno, $errstr, 30);

		$out = "POST ".$parts['path']." HTTP/1.1\r\n";
		$out.= "Host: ".$parts['host']."\r\n";
		$out.= "Content-Type: application/x-www-form-urlencoded\r\n";
		$out.= "Content-Length: ".strlen($post_string)."\r\n";
		$out.= "Connection: Close\r\n\r\n";
		if (isset($post_string)) $out.= $post_string;

		fwrite($fp, $out);
		fclose($fp);
	}
}

?>