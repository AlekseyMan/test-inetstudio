<?php

class SomeObject {
    protected $name;

    public function __construct(string $name) { }

    public function getObjectName() { }
}

class SomeObjectsHandler {
    public const NAMES = [
        'object_1',
        'object_2'
    ];
    	
    public function __construct() { }

    public function handleObjects(array $objects): array {
        $handlers = [];
        foreach ($objects as $object) {
            if($this->isValidName($object->getObjectName())){
	         $handlers[] = 'handle_' . $object->getObjectName();	

	    }
        }
        return $handlers;
    }
    
    private function isValidName(string $name) : boolean
    {
    	if (in_array($name, self::NAMES, true)) {
            return true;
        }
        
        return false;
    }
    
}

$objects = [
    new SomeObject('object_1'),
    new SomeObject('object_2')
];



$soh = new SomeObjectsHandler();
$soh->handleObjects($objects, $names);
