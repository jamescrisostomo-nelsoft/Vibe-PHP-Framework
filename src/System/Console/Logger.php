<?php

namespace System\Console;

    /*
    | ///////////////////////////////////////////////
    |   Console Log
    | ///////////////////////////////////////////////
    |
    |   Register log message to Vibe built-in
    |   debugging console to easily identify errors
    |   and warnings.
    |
    */

class Logger {

    private static $errors = 0;
    private static $debug = true;
    private static $logs = array();
    
    public static function error($message) {
        static::$errors++;
        if(static::$debug) {
            static::$logs[] = new LogData($message, 'error');
        }
    }

    public static function warn($message) {
        if(static::$debug) {
            static::$logs[] = new LogData($message, 'warn');
        }
    }

    public static function log($message) {
        if(static::$debug) {
            static::$logs[] = new LogData($message, 'log');
        }
    }

    public static function setDebug($bool) {
        static::$debug = $bool;
    }

    public static function get() {
        return static::$logs;
    }

    public static function errors() {
        return static::$errors;
    }

    public static function hasErrors() {
        return static::errors() > 0;
    }

    public static function length() {
        return sizeof(static::$logs);
    }

    public static function show() {
        $logs = static::$logs;
        if(sizeof($logs) > 0 && static::$debug) {
            
        }
    }

}