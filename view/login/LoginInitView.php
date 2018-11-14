<?php

class LoginInitView extends View {

    public function display() {
        echo "<h1>Login</h1>";
        if (!empty($this->notification)) {
            echo "<p class=\"notification\">{$this->notification}</p>";
        }
        echo <<<FORM
        <form id="loginform" action="/{$this->loginUri}" method="post" name="loginform">
            <label for="loginform-username" class="required">Benutzername</label>
            <input type="text" id="loginform-username" name="username" required {$this->validatedUserName}>
                
            <label for="loginform-password" class="required">Passwort</label>
            <input type="password" id="loginform-password" name="password" required {$this->validatedPassword}>
                
            <input type="text" id="loginform-name" name="name">
            <input type="hidden" name="login" value="1">
            <input type="submit" name="loginform_submit" value="Senden">
        </form>
        <div id="close-login-overlay"></div>
FORM;
    }

}

