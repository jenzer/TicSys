<?php

include_once 'controller/Controller.php';

class LogoutController extends Controller {

    protected function init() {
        echo "not implemented";
    }

    protected function create() {
        echo "not implemented";
    }

    protected function index() {
        session_destroy();
        header("HTTP/1.1 303 See Other");
        header("Location: " . URI_HOME);
        exit();
    }

    protected function show() {
        echo "not implemented";
    }

}

