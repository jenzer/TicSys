<?php

include_once 'controller/Controller.php';

class ContactController extends Controller {

    protected function init() {
        $contactUri = URI_KONTAKT;
        $message = "";
        if (!empty($_POST['message'])) {
            $message = $_POST['message'];
        }
        $messageClasses = $this->getRequiredCssClass('message');
        $validatedSubject = $this->validate('subject', true);
        $validatedlastName = $this->validate('last_name');
        $validatedFirstName = $this->validate('first_name');
        $validatedPhone = $this->validate('phone');
        $validatedEmail = $this->validate('email', true);

        echo <<<FORM
        <form id="contactform" action="{$contactUri}" method="post" name="contactform">
            <label for="contactform-subject" class="required">Betreff</label>
            <input type="text" id="contactform-subject" name="subject" required autocomplete="off" list="subjects" {$validatedSubject}>
            <datalist id="subjects">
                <option value="Beispiel Eins">
                <option value="Beispiel Zwei">
                <option value="Beispiel Drei">
                <option value="Bestellung">
                <option value="Rechnung">
                <option value="Medien">
                <option value="Fehler auf der Seite">
                <option value="Generelles">
            </datalist>

            <label for="contactform-message" class="required">Mitteilung</label>
            <textarea id="contactform-message" name="message" rows="8" cols="50" required {$messageClasses}>{$message}</textarea>

            <label for="contactform-last_name">Name</label>
            <input type="text" id="contactform-last_name" name="last_name" {$validatedlastName}>

            <label for="contactform-first_name">Vorname</label>
            <input type="text" id="contactform-first_name" name="first_name" {$validatedFirstName}>

            <label for="contactform-phone">Telefon-Nr.</label>
            <input type="tel" id="contactform-phone" name="phone" {$validatedPhone}>

            <label for="contactform-email" class="required">Email-Adresse</label>
            <input type="email" id="contactform-email" name="email" required {$validatedEmail}>

            <label for="contactform-newsletter">Newsletter abonnieren</label>
            <input type="checkbox" id="contactform-newsletter" name="newsletter" checked>

            <input type="text" id="contactform-name" name="name">
            <input type="hidden" name="contact" value="1">
            <input type="submit" name="contactform_submit" value="Senden">
        </form>
FORM;
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
                echo "<p>Bitte füllen Sie alle markierten Felder aus.</p>";
                $this->init();
            }
        }
    }

    protected function index() {
        if (preg_match('@/success$@i', $_SERVER['REQUEST_URI'])) {
            // show confirmation page
            echo "<p>Vielen Dank für Ihre Anfrage, wir setzen uns sobald wie möglich mit Ihnen in Verbindung.</p>";
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

