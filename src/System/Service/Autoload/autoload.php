<?php

require 'AutoloadService.php';

    /*
    | ///////////////////////////////////////////////
    |   Class Autoload Service
    | ///////////////////////////////////////////////
    |
    |   Automatically load PHP class files by 
    |   converting namespace to file directory.
    |
    */

spl_autoload_register(function($class) {
    
    System\Service\AutoloadService::init()->load($class);

});