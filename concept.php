<?php
class Concept {

    const METHODS = [
         'file',
         'database',
         'redis',
         'cloud'  
    ];	

    private $client;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }

    public function getUserData() {
        $params = [
            'auth' => ['user', 'pass'],
            'token' => $this->getSecretKey()
        ];

        $request = new \Request('GET', 'https://api.method', $params);
        $promise = $this->client->sendAsync($request)->then(function ($response) {
            $result = $response->getBody();
        });

        $promise->wait();
        
        $this->saveKeyTo($promise->key, $method);
    }
    
    private function saveKeyTo($key, $method) 
    {
    	switch ($method) {
    	    case self::METHODS['file']:
    	    
    	breake;
    	    case self::METHODS['database']:
    	    
    	breake;
    	    case self::METHODS['redis']:
    	    
    	breake;
    	    case self::METHODS['cloud']:
    	    
    	breake;
    	}
    }
   
}
