<?php

include_once 'controller/FormController.php';
include_once 'model/Customer.php';
include_once 'view/login/LoginInitView.php';
include_once 'view/login/LoginConfirmationView.php';
include_once 'lib/MysqlAdapter.php';

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
        if ((!empty($_POST['login'])) && (empty($_POST['name']))) {
            // Form submitted by human
            // validate form
            $valid = true;
            $valid &=!empty($_POST['username']);
            $valid &=!empty($_POST['password']);

            if ($valid) {
                if (preg_match("/" . Customer::USERNAME_REGEX . "/", $_POST['username'])) {
                    $mysqlAdapter = new MysqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                    $customer = $mysqlAdapter->getUserByUsername($_POST['username']);
                    if (($customer instanceof Customer) && ($customer->isPasswordValid($_POST['password']))) {
                        $_SESSION['user_name'] = $customer->getUserName();
                        $_SESSION['customer_name'] = $customer->getFirstName() . " " . $customer->getLastName();
                        setcookie('user_name', $customer->getUserName(), time() + 60 * 60 * 24 * 90, '/');

                        header("HTTP/1.1 303 See Other");
                        header("Location: " . URI_LOGIN . "/success");
                        exit();
                    } else {
                        $this->notification = "Benutzername oder Passwort ist falsch.";
                    }
                } else {
                    $this->notification = "Der Benutzername enthält unerlaubte Zeichen.";
                }
            } else {
                $this->notification = "Bitte füllen Sie alle markierten Felder aus.";
            }
            $this->init();
        }
    }

    protected function index() {
        if (preg_match('@/success$@i', $_SERVER['REQUEST_URI'])) {
            // show confirmation page
            $view = new LoginConfirmationView();
            $view->display();
        }
    }

}

