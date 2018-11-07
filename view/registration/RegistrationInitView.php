<?php

class RegistrationInitView extends View {

    public function display() {
        echo "<h1>Registration</h1>";
        if (!empty($this->notification)) {
            echo "<p class=\"notification\">{$this->notification}</p>";
        }
        echo <<<FORM
        <form id="registrationform" action="{$this->registrationUri}" method="post" name="registrationform">
            <label for="registrationform-username" class="required">Benutzername</label>
            <input type="text" id="registrationform-username" name="username" required {$this->validatedUserName}>
                
            <label for="registrationform-password" class="required">Passwort</label>
            <input type="password" id="registrationform-password" name="password" required {$this->validatedPassword}>
                
            <label for="registrationform-password-repetition" class="required">Passwort wiederholen</label>
            <input type="password" id="registrationform-password-repetition" name="password_repetition" required {$this->validatedPasswordRepetition}>
                
            <label for="registrationform-last_name" class="required">Name</label>
            <input type="text" id="registrationform-last_name" name="last_name" required {$this->validatedLastName}>

            <label for="registrationform-first_name" class="required">Vorname</label>
            <input type="text" id="registrationform-first_name" name="first_name" required {$this->validatedFirstName}>

            <label for="registrationform-phone">Telefon-Nr.</label>
            <input type="tel" id="registrationform-phone" name="phone" {$this->validatedPhone}>

            <label for="registrationform-email" class="required">Email-Adresse</label>
            <input type="email" id="registrationform-email" name="email" required {$this->validatedEmail}>

            <input type="text" id="registrationform-name" name="name">
            <input type="hidden" name="registration" value="1">
            <input type="submit" name="registrationform_submit" value="Senden">
        </form>
FORM;
    }

}

