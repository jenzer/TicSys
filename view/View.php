<?php

/**
 * abstract class for all views 
 *
 * @author Marc Jenzer
 */
abstract class View {

    protected $vars = array();

    abstract function display();

    public function __get($name) {
        if (array_key_exists($name, $this->vars)) {
            return $this->vars[$name];
        }
        $trace = debug_backtrace();
        trigger_error("Property '{$name}' not found in {$trace[0]['file']} on line {$trace[0]['line']}", E_USER_NOTICE);
        return null;
    }

    public function __set($name, $value) {
        $this->vars[$name] = $value;
    }

    public function __isset($name) {
        return isset($this->vars[$name]);
    }

    public function __unset($name) {
        unset($this->vars[$name]);
    }

}

