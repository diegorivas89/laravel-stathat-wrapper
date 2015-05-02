<?php

/**
* 
*/
class EzClientTest extends PHPUnit_Framework_TestCase
{
    protected $client;
    protected $http;

    public function setUp(){
    	$this->http = new HttpClientStub();

    	$this->client = new \Stathat\EzClient(
    		'stathat@test.com',
    		$this->http
    	);
    }

    public function testDefaultCountDefaultAccount()
    {
        $this->client->count('test_count');

        $this->assertEquals(1, count($this->http->doAsyncPostRequest));
        $this->assertEquals('test_count', $this->http->doAsyncPostRequest[0]['data']['stat']);
        $this->assertEquals(1, $this->http->doAsyncPostRequest[0]['data']['count']);
        $this->assertEquals('stathat@test.com', $this->http->doAsyncPostRequest[0]['data']['email']);
    }

    public function testCountDefaultAccount()
    {
    	$this->client->count('test_count', 1);

        $this->assertEquals(1, count($this->http->doAsyncPostRequest));
        $this->assertEquals('test_count', $this->http->doAsyncPostRequest[0]['data']['stat']);
        $this->assertEquals(1, $this->http->doAsyncPostRequest[0]['data']['count']);
        $this->assertEquals('stathat@test.com', $this->http->doAsyncPostRequest[0]['data']['email']);
    }

    public function testCountAnotherAccount()
    {
    	$this->client->count('test_count', 1, 'another.account@test.com');

        $this->assertEquals(1, count($this->http->doAsyncPostRequest));
        $this->assertEquals('test_count', $this->http->doAsyncPostRequest[0]['data']['stat']);
        $this->assertEquals(1, $this->http->doAsyncPostRequest[0]['data']['count']);
        $this->assertEquals('another.account@test.com', $this->http->doAsyncPostRequest[0]['data']['email']);
    }

    public function testCountGreaterThanOne()
    {
    	$this->client->count('test_count', 7);

        $this->assertEquals(1, count($this->http->doAsyncPostRequest));
        $this->assertEquals('test_count', $this->http->doAsyncPostRequest[0]['data']['stat']);
        $this->assertEquals(7, $this->http->doAsyncPostRequest[0]['data']['count']);
        $this->assertEquals('stathat@test.com', $this->http->doAsyncPostRequest[0]['data']['email']);

        $this->client->count('test_count2', 15);

        $this->assertEquals(2, count($this->http->doAsyncPostRequest));
        $this->assertEquals('test_count2', $this->http->doAsyncPostRequest[1]['data']['stat']);
        $this->assertEquals(15, $this->http->doAsyncPostRequest[1]['data']['count']);
        $this->assertEquals('stathat@test.com', $this->http->doAsyncPostRequest[1]['data']['email']);

        $this->client->count('test_count3', -8);

        $this->assertEquals(3, count($this->http->doAsyncPostRequest));
        $this->assertEquals('test_count3', $this->http->doAsyncPostRequest[2]['data']['stat']);
        $this->assertEquals(-8, $this->http->doAsyncPostRequest[2]['data']['count']);
        $this->assertEquals('stathat@test.com', $this->http->doAsyncPostRequest[2]['data']['email']);
    }

    public function testCountSyncDefaultAccount()
    {
    	$this->client->countSync('test_count', 1);

    	parse_str($this->http->doPostRequest[0]['data'], $query);
    	
        $this->assertEquals(1, count($this->http->doPostRequest));
        $this->assertEquals('test_count', $query['stat']);
        $this->assertEquals(1, $query['count']);
        $this->assertEquals('stathat@test.com', $query['email']);
    }
    
    public function testCountSyncAnotherAccount()
    {
    	$this->client->countSync('test_count', 1, 'another.account@test.com');

    	parse_str($this->http->doPostRequest[0]['data'], $query);

        $this->assertEquals(1, count($this->http->doPostRequest));
        $this->assertEquals('test_count', $query['stat']);
        $this->assertEquals(1, $query['count']);
        $this->assertEquals('another.account@test.com', $query['email']);
    }

    public function testCountSyncGreaterThanOne()
    {
    	$this->client->countSync('test_count', 7);

    	parse_str($this->http->doPostRequest[0]['data'], $query);

        $this->assertEquals(1, count($this->http->doPostRequest));
        $this->assertEquals('test_count', $query['stat']);
        $this->assertEquals(7, $query['count']);
        $this->assertEquals('stathat@test.com', $query['email']);


        $this->client->countSync('test_count2', 15);

        parse_str($this->http->doPostRequest[1]['data'], $query);

        $this->assertEquals(2, count($this->http->doPostRequest));
        $this->assertEquals('test_count2', $query['stat']);
        $this->assertEquals(15, $query['count']);
        $this->assertEquals('stathat@test.com', $query['email']);


        $this->client->countSync('test_count3', -8);

        parse_str($this->http->doPostRequest[2]['data'], $query);

        $this->assertEquals(3, count($this->http->doPostRequest));
        $this->assertEquals('test_count3', $query['stat']);
        $this->assertEquals(-8, $query['count']);
        $this->assertEquals('stathat@test.com', $query['email']);
    }
}

?>