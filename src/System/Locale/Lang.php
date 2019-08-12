<?php

namespace System\Locale;

use System\Console\Logger as Console;

class Lang {

    private static $instance;

    private $locale;
    private $path = 'locale/';
    private $label;

    private function __construct($locale) {
        $this->locale = $locale;
        $this->path .= $locale . '/label.php';

        if(file_exists($this->path)) {
            $this->label = require $this->path;
            Console::log('Localization file is loaded.');
        }
        else {
            Console::error('Localization file failed to load.');
        }
    }

    public static function get($id) {
        
    }

    public static function init($locale) {
        if(is_null(static::$instance)) {
            Console::log('Language localization is ready.');
            static::$instance = new self($locale);
            return static::$instance;
        }
    }

}