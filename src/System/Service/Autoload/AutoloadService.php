<?php

namespace System\Service;

    /*
    | ///////////////////////////////////////////////
    |   Autoload Service
    | ///////////////////////////////////////////////
    |
    |   Converts namespace to PHP file path then
    |   automatically require if it exist.
    |
    */

class AutoloadService {

    private static $instance;
    private $path = [

        'system' => 'src/',

        'modules' => 'modules/',

        'database' => 'database/',

    ];
    private $namespace = [

        'modules' => 'App\Modules',

        'database' => 'App\Database',

    ];
    
    /*
    | ///////////////////////////////////////////////
    |   PHP File Inclusion Log
    | ///////////////////////////////////////////////
    |
    |   All files to be include dynamically will be
    |   logged here.
    |
    */
    
    private $loaded = [];

    /*
    | ///////////////////////////////////////////////
    |   Exception
    | ///////////////////////////////////////////////
    | 
    |   PHP class files included to except array are
    |   unaccessible to autoloader.
    |
    */

    private $except = [

        'src/System/Service/Autoload/AutoloadService.php'

    ];
    
    private function __construct() {}

    /*
    |
    */

    public function load($class) {
        $namespace = substr($class, 0, strlen($this->namespace['modules']));
        if($namespace === $this->namespace['modules']) {
            $namespace = substr($class, strlen($this->namespace['modules'])+1, strlen($class));
            $this->require($this->path['modules'] . str_replace('\\', '/', $namespace) . '.php', 'system');
        }
        else {
            $this->require($this->path['system'] . str_replace('\\', '/', $class) . '.php', 'system');  
        }
    }

    private function require($path, $namespace) {
        if(file_exists($path) && !in_array($path, $this->except)) {
            $this->loaded[] = $path;
            require $path;
        }
    }

    public static function init() {
        return static::$instance = new self();
    }

}