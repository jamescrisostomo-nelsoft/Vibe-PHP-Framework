<?php

namespace System\Service\Session;

class SessionModel extends SessionBuilder {

    private static $models = array();
    private static $registered = array();

    private $name;

    private function __construct($name) {
        $this->name = $name;
        
        if(!$this->exist($name)) {
            
        }
    }

    public static function create($name) {
        if(!in_array($name, static::$registered)) {
            static::$registered[] = $name;
            static::$models[] = new self($name);
            return static::$models[(sizeof(static::$models) - 1)];
        }
    }

}
