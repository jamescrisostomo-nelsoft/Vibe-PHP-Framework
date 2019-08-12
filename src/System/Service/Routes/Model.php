<?php

namespace System\Service\Routes;

class Model {

    private $path;

    private function __construct($path) {
        $this->path = $path;
    }

    public static function from($path) {
        return new self($path);
    }

}