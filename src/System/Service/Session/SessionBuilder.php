<?php

namespace System\Service\Session;

class SessionBuilder {

    public function exist($name) {
        return isset($_SESSION[$name]);
    }

    public function set($name, $value) {
        if(!$this->exist($name)) {
            $_SESSION[$name] = $value;
        }
        else {
            if(!$this->is($name, $value)) {
                $_SESSION[$name] = $value;
            }
        }
    }

    public function is($name, $value) {
        return $this->get($name) === $value;
    }

    public function get($name) {
        return $_SESSION[$name];
    }

    public function delete($name) {
        if($this->exist($name)) {
            unset($_SESSION[$name]);
        }
    }

}