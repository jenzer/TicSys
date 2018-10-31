<?php

include_once 'controller/FormController.php';
include_once 'view/View.php';
include_once 'view/contact/ContactInitView.php';
include_once 'view/contact/ContactConfirmationView.php';

class ContactController extends FormController {

    protected function init() {
        $view = new ContactInitView();
        $view->notification = $this->notification;
        $view->contactUri = URI_KONTAKT;
        $message = "";
        if (!empty($_POST['message'])) {
            $message = $_POST['message'];
        }
        $view->message = $message;
        $view->messageClasses = $this->getRequiredCssClass('message');
        $view->validatedSubject = $this->validate('subject', true);
        $view->validatedlastName = $this->validate('last_name');
        $view->validatedFirstName = $this->validate('first_name');
        $view->validatedPhone = $this->validate('phone');
        $view->validatedEmail = $this->validate('email', true);
        $view->display();
    }

    protected function create() {
        if ((!empty($_POST['contact'])) && (empty($_POST['name']))) {
            // Form submitted by human
            // validate form
            $valid = true;
            $valid &=!empty($_POST['subject']);
            $valid &=!empty($_POST['message']);
            $valid &=!empty($_POST['email']);

            if ($valid) {
                $message = "Vom Benutzer erfasste Daten:\n\n";
                foreach ($_POST as $key => $value) {
                    $message .= "$key: $value\n";
                }
                mail("jem@semabit.ch", "TicSys - Kontaktformular", $message);
                header("HTTP/1.1 303 See Other");
                header("Location: " . URI_KONTAKT . "/success");
                exit();
            } else {
                $this->notification = "Bitte füllen Sie alle markierten Felder aus.";
                $this->init();
            }
        }
    }

    protected function index() {
        if (preg_match('@/success$@i', $_SERVER['REQUEST_URI'])) {
            // show confirmation page
            $view = new ContactConfirmationView();
            $view->display();
        }
    }

}

