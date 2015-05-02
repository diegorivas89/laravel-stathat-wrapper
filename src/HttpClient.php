<?php
namespace Stathat;

use Illuminate\Support\Facades\Config;

/**
* Http client
*/
class HttpClient
{

	/**
	 * Class constructor
	 */
	public function __construct()
	{
	}

	/**
	 * Perform post request
	 *
	 * @param  string 	$url
	 * @param  array 	$data
	 * @param  array 	$optional_headers
	 * @return string
	 */
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

	/**
	 * Perform an asynchronous post request
	 * 
	 * @param  string 	$url
	 * @param  array 	$params
	 * @return void
	 */
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