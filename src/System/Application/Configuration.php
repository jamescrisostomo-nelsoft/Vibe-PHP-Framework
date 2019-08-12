<?php

namespace System\Application;

use System\Console\Logger as Console;

    /*
    | ///////////////////////////////////////////////
    |   Configuration Object
    | ///////////////////////////////////////////////
    |
    |   Easy access object for configuration.
    |
    */

class Configuration {

    private static $instance;

    public $data;

    private function __construct($data) {
        $this->data = $data;
    }

    public static function release() {
        return static::$instance->data['release'];
    }

    public static function isDebug() {
        return static::release() === 'debug';
    }

    public static function mode() {
        return static::$instance->data['mode'];
    }

    public static function isDownMode() {
        return static::mode() === 'down';
    }

    public static function console() {
        return static::$instance->data['console'];    
    }

    public static function lang() {
        return static::$instance->data['locale'];
    }

    public static function set($data) {
        if(is_null(static::$instance)) {
            if(is_array($data)) {
                Console::log('Configuration file is successfully loaded.');
                static::$instance = new self($data);
            }
        }
    }

    public static function get() {
        return static::$instance;
    }

    public static function enumerate() {
        Console::log('Configuration is enumerated.');
    }

}