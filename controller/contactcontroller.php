<?php

include_once 'controller/Controller.php';
include_once 'view/View.php';
include_once 'view/contact/ContactInitView.php';
include_once 'view/contact/ContactConfirmationView.php';

class ContactController extends Controller {

    private $notification;

    protected function init() {
        $view = new ContactInitView();
        $view->assign('notification', $this->notification);
        $view->assign('contactUri', URI_KONTAKT);
        $message = "";
        if (!empty($_POST['message'])) {
            $message = $_POST['message'];
        }
        $view->assign('message', $message);
        $view->assign('messageClasses', $this->getRequiredCssClass('message'));
        $view->assign('validatedSubject', $this->validate('subject', true));
        $view->assign('validatedlastName', $this->validate('last_name'));
        $view->assign('validatedFirstName', $this->validate('first_name'));
        $view->assign('validatedPhone', $this->validate('phone'));
        $view->assign('validatedEmail', $this->validate('email', true));
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

    protected function show() {
        echo "not implemented";
    }

    private function validate($key, $required = false) {
        $ret = "";
        if (!empty($_POST[$key])) {
            $ret .= "value=\"{$_POST[$key]}\"";
        }
        if ($required) {
            $ret .= $this->getRequiredCssClass($key);
        }
        return $ret;
    }

    private function getRequiredCssClass($key) {
        $class = "required";
        if ((!empty($_POST['contact'])) && (empty($_POST[$key]))) {
            $class .= " missing";
        }
        return "class=\"$class\"";
    }

}

