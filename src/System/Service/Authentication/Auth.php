<?php

namespace System\Service\Authentication;

use System\Service\Session\SessionModel;
use System\Console\Logger as Console;

class Auth {

    private static $instance;
    private $model;
    private $alive = false;

    private function __construct() {
        $this->model = SessionModel::create('Authentication');
        Console::log('Authentication session model is created.');
    }

    public function require($data) {
        
    }

    public static function init() {
        if(is_null(static::$instance)) {
            Console::log('Authentication service is initiated.');
            static::$instance = new self();
            return static::$instance;
        }
        else {
            Console::warn('Authentication service must be initiated once.');
        }
    }

    public static function read() {
        return static::$instance;
    }

}