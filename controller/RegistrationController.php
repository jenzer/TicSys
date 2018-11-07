<?php

include_once 'controller/FormController.php';
include_once 'model/Customer.php';
include_once 'view/registration/RegistrationInitView.php';
include_once 'view/registration/RegistrationConfirmationView.php';
include_once 'lib/MysqlAdapter.php';

class RegistrationController extends FormController {

    protected function init() {
        $view = new RegistrationInitView();
        $view->notification = $this->notification;
        $view->registrationUri = URI_REGISTRATION;
        $view->validatedUserName = $this->validate('username', true);
        $view->validatedPassword = $this->validate('password', true);
        $view->validatedPasswordRepetition = $this->validate('password_repetition', true);
        $view->validatedLastName = $this->validate('last_name', true);
        $view->validatedFirstName = $this->validate('first_name', true);
        $view->validatedPhone = $this->validate('phone');
        $view->validatedEmail = $this->validate('email', true);
        $view->display();
    }

    protected function create() {
        if ((!empty($_POST['registration'])) && (empty($_POST['name']))) {
            // Form submitted by human
            // validate form
            $valid = true;
            $valid &=!empty($_POST['username']);
            $valid &=!empty($_POST['password']);
            $valid &=!empty($_POST['password_repetition']);
            $valid &=!empty($_POST['last_name']);
            $valid &=!empty($_POST['first_name']);
            $valid &=!empty($_POST['email']);

            if ($valid) {
                // check username
                if (preg_match("/" . Customer::USERNAME_REGEX . "/", $_POST['username'])) {
                    $mysqlAdapter = new MysqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                    if ($mysqlAdapter->isUsernameAvailable($_POST['username'])) {
                        // check password combination
                        if ($_POST['password'] == $_POST['password_repetition']) {
                            $customer = new Customer();
                            $customer->setUserName($_POST['username']);
                            $customer->setPassword($_POST['password']);
                            $customer->setLastName($_POST['last_name']);
                            $customer->setFirstName($_POST['first_name']);
                            $customer->setPhone($_POST['phone']);
                            $customer->setEmail($_POST['email']);
                            $id = $mysqlAdapter->insertCustomer($customer);
                            if ($id > 0) {
                                header("HTTP/1.1 303 See Other");
                                header("Location: " . URI_REGISTRATION . "/success");
                                exit();
                            } else {
                                $this->notification = "Es ist ein Fehler aufgetreten, bitte versuchen Sie es später wieder.";
                            }
                        } else {
                            $this->notification = "Die Passworte stimmen nicht überein.";
                        }
                    } else {
                        $this->notification = "Bitte wählen Sie einen anderen Benutzernamen, {$_POST['username']} ist bereits vergeben.";
                    }
                } else {
                    $this->notification = "Bitte verwenden Sie für den Benutzernamen nur Buchstaben und Ziffern, Binde- und Unterstrich.";
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
            $view = new RegistrationConfirmationView();
            $view->display();
        }
    }

}

