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

    /**
     * Count tests
     */
    

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

    /**
     * Value tests
     */
    

    public function testValueDefaultAccount()
    {
        $this->client->value('test_value', 1.5);

        $this->assertEquals(1, count($this->http->doAsyncPostRequest));
        $this->assertEquals('test_value', $this->http->doAsyncPostRequest[0]['data']['stat']);
        $this->assertEquals(1.5, $this->http->doAsyncPostRequest[0]['data']['value']);
        $this->assertEquals('stathat@test.com', $this->http->doAsyncPostRequest[0]['data']['email']);
    }

    public function testValueAnotherAccount()
    {
        $this->client->value('test_value', 500, 'another.account@test.com');

        $this->assertEquals(1, count($this->http->doAsyncPostRequest));
        $this->assertEquals('test_value', $this->http->doAsyncPostRequest[0]['data']['stat']);
        $this->assertEquals(500, $this->http->doAsyncPostRequest[0]['data']['value']);
        $this->assertEquals('another.account@test.com', $this->http->doAsyncPostRequest[0]['data']['email']);
    }

    public function testValueMultipleRequests()
    {
        $this->client->value('test_value', 7);

        $this->assertEquals(1, count($this->http->doAsyncPostRequest));
        $this->assertEquals('test_value', $this->http->doAsyncPostRequest[0]['data']['stat']);
        $this->assertEquals(7, $this->http->doAsyncPostRequest[0]['data']['value']);
        $this->assertEquals('stathat@test.com', $this->http->doAsyncPostRequest[0]['data']['email']);

        $this->client->value('test_value2', 15);

        $this->assertEquals(2, count($this->http->doAsyncPostRequest));
        $this->assertEquals('test_value2', $this->http->doAsyncPostRequest[1]['data']['stat']);
        $this->assertEquals(15, $this->http->doAsyncPostRequest[1]['data']['value']);
        $this->assertEquals('stathat@test.com', $this->http->doAsyncPostRequest[1]['data']['email']);

        $this->client->value('test_value3', -8);

        $this->assertEquals(3, count($this->http->doAsyncPostRequest));
        $this->assertEquals('test_value3', $this->http->doAsyncPostRequest[2]['data']['stat']);
        $this->assertEquals(-8, $this->http->doAsyncPostRequest[2]['data']['value']);
        $this->assertEquals('stathat@test.com', $this->http->doAsyncPostRequest[2]['data']['email']);
    }

    public function testValueSyncDefaultAccount()
    {
        $this->client->valueSync('test_value', 854);

        parse_str($this->http->doPostRequest[0]['data'], $query);
        
        $this->assertEquals(1, count($this->http->doPostRequest));
        $this->assertEquals('test_value', $query['stat']);
        $this->assertEquals(854, $query['value']);
        $this->assertEquals('stathat@test.com', $query['email']);
    }
    
    public function testValueSyncAnotherAccount()
    {
        $this->client->valueSync('test_value', 542, 'another.account@test.com');

        parse_str($this->http->doPostRequest[0]['data'], $query);

        $this->assertEquals(1, count($this->http->doPostRequest));
        $this->assertEquals('test_value', $query['stat']);
        $this->assertEquals(542, $query['value']);
        $this->assertEquals('another.account@test.com', $query['email']);
    }

    public function testValueSyncMultipleRequests()
    {
        $this->client->valueSync('test_value', 7);

        parse_str($this->http->doPostRequest[0]['data'], $query);

        $this->assertEquals(1, count($this->http->doPostRequest));
        $this->assertEquals('test_value', $query['stat']);
        $this->assertEquals(7, $query['value']);
        $this->assertEquals('stathat@test.com', $query['email']);


        $this->client->countSync('test_value2', 15);

        parse_str($this->http->doPostRequest[1]['data'], $query);

        $this->assertEquals(2, count($this->http->doPostRequest));
        $this->assertEquals('test_value2', $query['stat']);
        $this->assertEquals(15, $query['count']);
        $this->assertEquals('stathat@test.com', $query['email']);


        $this->client->countSync('test_value3', -8);

        parse_str($this->http->doPostRequest[2]['data'], $query);

        $this->assertEquals(3, count($this->http->doPostRequest));
        $this->assertEquals('test_value3', $query['stat']);
        $this->assertEquals(-8, $query['count']);
        $this->assertEquals('stathat@test.com', $query['email']);
    }

}

?>