<?php 

/**
* 		
*/
class HttpClientStub extends Stathat\HttpClient
{
	public $doPostRequest;
	public $doAsyncPostRequest;
	function __construct()
	{
		parent::__construct();
		$this->doPostRequest = Array();
		$this->doAsyncPostRequest = Array();
	}

	public function doPostRequest($url, $data, $optional_headers = null)
	{
		$this->doPostRequest[] = Array(
			'url' => $url,
			'data' => $data,
			'headers' => $optional_headers
		);
	}

	/**
	 * Perform an asynchronous post request
	 * 
	 * @param  string 	$url
	 * @param  array 	$params
	 * @return void
	 */
	public function doAsyncPostRequest($url, $data)
	{
		$this->doAsyncPostRequest[] = Array(
			'url' => $url,
			'data' => $data,
		);
	}
}

?>