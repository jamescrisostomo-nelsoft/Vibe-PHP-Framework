<?php

namespace System\Console;

use Util\String\IDGenerator;

class LogData {

    private $id;
    private $message;
    private $file;
    private $line;
    private $type;

    public function __construct($message, $type) {
        $this->id = IDGenerator::get(10);
        $this->message = $message;
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }

    public function getMessage() {
        return $this->message;
    }

}