<?php

namespace System\Service\Routes;

use System\Console\Logger as Console;

class Router {

    private static $instance;
    private $route_path = 'config/routes.php';
    private $routes;
    private $route_data;
    private $config;

    private function __construct($config) {
        $this->config = $config;

        require $this->route_path;

        Console::log('Route table is loaded.');
        $this->routes = Route::table();
        $this->navigate();
    }

    /*
    | ///////////////////////////////////////////////
    |   Current URI
    | ///////////////////////////////////////////////
    |
    |   All request will be diverted to /index.php
    |   no matter if it is valid or invalid uri. Then
    |   Router can check if the requested uri exist
    |   from our route table.
    |
    */

    public function currentURI() {
        $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
        $end = substr($uri, strlen($uri) - 1, strlen($uri));
        
        if($end === '/' && $uri !== '/') {
            $uri = substr($uri, 0, strlen($uri) - 1);
        }

        return explode('/', $uri);
    }

    /*
    | ///////////////////////////////////////////////
    |   GET Request Parameter
    | ///////////////////////////////////////////////
    |
    |   This method return an array of GET request
    |   parameter containing it's request name and
    |   value.
    |
    */

    public function requestParam() {
        $ex = explode('?', $_SERVER['REQUEST_URI']);
        $params = array();

        if(sizeof($ex) === 2) {
            $param = explode('&', $ex[1]);
            for($i = 0; $i <= (sizeof($param) - 1); $i++) {
                $data = explode('=', $param[$i]);
                $params[] = array(

                    'name' => $data[0],

                    'value' => $data[1]

                );
            }
        }

        return $params;
    }

    /*
    | ///////////////////////////////////////////////
    |   Callback Controller
    | ///////////////////////////////////////////////
    |
    |   Immediately call the controller's callback
    |   main method to start rendering.
    |
    */

    private function navigate() {
        $index = Route::has($this->currentURI());
        if($index >= 0) {
            Console::log('Current request URI successfully matched from the route table.');
            
            if(!$this->config->isDownMode()) {
                Console::log('Route data is fetched.');
                $data = Route::getData($index);
                $data->init();
            }
            else {
                Console::log('Will show Page is down page instead.');
            }
        }
        else {
            Console::log('Route not found.');
        }
    }

    public static function init($config) {
        if(is_null(static::$instance)) {
            Console::log('Router Service is now ready.');
            return static::$instance = new self($config);
        }
    }

}