<?php

include_once 'controller/Controller.php';
include_once 'view/View.php';

abstract class FormController extends Controller {

    protected $notification;

    protected function init() {
        echo "not implemented";
    }

    protected function create() {
        echo "not implemented";
    }

    protected function index() {
        echo "not implemented";
    }

    protected function show() {
        echo "not implemented";
    }

    protected function validate($key, $required = false) {
        $ret = "";
        if (!empty($_POST[$key])) {
            $ret .= "value=\"{$_POST[$key]}\"";
        }
        if ($required) {
            $ret .= $this->getRequiredCssClass($key);
        }
        return $ret;
    }

    protected function getRequiredCssClass($key) {
        $class = "required";
        if ((!empty($_POST['contact'])) && (empty($_POST[$key]))) {
            $class .= " missing";
        }
        return "class=\"$class\"";
    }

}

