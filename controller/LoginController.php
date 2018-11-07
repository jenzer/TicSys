<?php

include_once 'controller/FormController.php';
include_once 'view/login/LoginInitView.php';
include_once 'view/login/LoginConfirmationView.php';

class LoginController extends FormController {

    protected function init() {
        $view = new LoginInitView();
        $view->notification = $this->notification;
        $view->loginUri = URI_LOGIN;
        $view->validatedUserName = $this->validate('username', true);
        $view->validatedPassword = $this->validate('password', true);
        $view->display();
    }

    protected function create() {
    }

    protected function index() {
        if (preg_match('@/success$@i', $_SERVER['REQUEST_URI'])) {
            // show confirmation page
            $view = new LoginConfirmationView();
            $view->display();
        }
    }

}

