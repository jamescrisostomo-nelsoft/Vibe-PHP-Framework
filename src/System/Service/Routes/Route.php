<?php

namespace System\Service\Routes;

use System\Console\Logger as Console;

class Route {

    private static $registered = array();
    private static $routes = array();

    private $path;
    private $callback;

    private function __construct($path, $callback) {
        $this->path = $path;
        $this->callback = $callback;
    }

    public function path() {
        return explode('/', explode('?', $this->path)[0]);
    }

    public function callback() {
        return $this->callback;
    }

    public static function get($path, $callback) {
        if(!in_array($path, static::$registered)) {
            static::$registered[] = $path;
            static::$routes[] = new self($path, $callback);
        }
        else {
            Console::error('Route ' . $path . ' already exist. Please avoid duplication of routes.');
        }
    }

    /*
    | ///////////////////////////////////////////////
    |   Route Tester
    | ///////////////////////////////////////////////
    |
    |   Traversing your route table to look for
    |   matches for your current request uri.
    |
    */

    public static function has($path) {
        $table = static::table();
        $has = -1;

        for($i = 0; $i <= (sizeof($table) - 1); $i++) {
            $route = $table[$i]->path();
            $size = sizeof($route);
            $matched = 0;

            if($size === sizeof($path)) {
                for($j = 0; $j <= (sizeof($path) - 1); $j++) {
                    if(strtolower($path[$j]) === strtolower($route[$j])) {
                        $matched++;
                    }
                    else {
                        $f = substr($route[$j], 0, 1);
                        $l = substr($route[$j], strlen($route[$j]) - 1, strlen($route[$j]));
                        if($f === '{' && $l === '}') {
                            $matched++;
                        }
                    }
                }
            }
            if($matched == $size) {
                $has = $i;
                break;
            }
        }

        return $has;
    }

    public static function getData($index) {
        return new RouteData(static::$routes[$index], Router::currentURI());
    }

    public static function table() {
        return static::$routes;
    }

}
