<?php

namespace System\Application;

use System\Console\Logger as Console;
use System\Service\Authentication\Auth;
use System\Service\Routes\Router;
use System\Locale\Lang;


    /*
    | ///////////////////////////////////////////////
    |   Application Service
    | ///////////////////////////////////////////////
    |
    |   This class controls everything that is
    |   happening under the hood.
    |
    */

class ApplicationService {

    private static $instance;
    
    private $VERSION = '1.0.0.0';
    private $config;
    private $auth;
    private $router;
    private $locale;

    private function __construct() {

        Console::log('Vibe PHP Framework is now ready for development.');
        Console::log('API version ' . $this->VERSION);
        Configuration::set(require 'config/config.php');
        
        $this->config = Configuration::get();
        Configuration::enumerate();
        
        /*
        | ///////////////////////////////////////////////
        |   Debug Status
        | ///////////////////////////////////////////////
        |
        |   Console logs, errors and warnings will not
        |   register and show when app release is in
        |   production status.
        |
        */

        if(!$this->config->isDebug()) {
            error_reporting(0);
            ini_set('display_errors', 0);
            Console::setDebug(false);
        }


        /*
        | ///////////////////////////////////////////////
        |   Authentication Service
        | ///////////////////////////////////////////////
        |
        |   Permissions will be managed here.
        |
        */

        $this->auth = Auth::init();


        /*
        | ///////////////////////////////////////////////
        |   Localization Service
        | ///////////////////////////////////////////////
        |
        |   Set the language to use before rendering.
        |   You can change the default locale in
        |   config.php file.
        |
        */

        $this->locale = Lang::init($this->config->lang());



        /*
        | ///////////////////////////////////////////////
        |   Router Service
        | ///////////////////////////////////////////////
        |
        |   Will initiate after configuration is ready.
        |
        */

        $this->router = Router::init($this->config);
    }

    public function routerService() {
        return $this->router;
    }

    public static function apiVersion() {
        return static::$instance->VERSION;
    }

    /*
    | ///////////////////////////////////////////////
    |   Application Service Initialization
    | ///////////////////////////////////////////////
    |
    |   Initialize application controller using
    |   singleton to prevent future instantiation
    |   of Application Class
    |
    */

    public static function init() {
        if(is_null(static::$instance)) {
            static::$instance = new self();
        }
        else {
            Console::warn('You cannot declare the ApplicationService class again.');
        }
    }

}