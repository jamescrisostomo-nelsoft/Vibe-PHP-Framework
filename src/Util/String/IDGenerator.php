<?php

namespace Util\String;

class IDGenerator {

    private static $length = 0;

    public static function get($length) {
        static::$length = $length;
    }

}