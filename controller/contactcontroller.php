<form id="contactform" action="<?php echo URI_KONTAKT ?>" method="post" name="contactform">
    <label for="contactform-subject">Betreff</label>
    <input type="text" id="contactform-subject" name="subject">

    <label for="contactform-message">Mitteilung</label>
    <textarea id="contactform-message" name="message" rows="8" cols="50"></textarea>

    <label for="contactform-last_name">Name</label>
    <input type="text" id="contactform-last_name" name="last_name">

    <label for="contactform-first_name">Vorname</label>
    <input type="text" id="contactform-first_name" name="first_name">

    <label for="contactform-phone">Telefon-Nr.</label>
    <input type="text" id="contactform-phone" name="phone">

    <label for="contactform-email">Email-Adresse</label>
    <input type="text" id="contactform-email" name="email">

    <label for="contactform-newsletter">Newsletter abonnieren</label>
    <input type="checkbox" id="contactform-newsletter" name="newsletter" checked>

    <input type="hidden" name="contact" value="1">
    <input type="submit" name="contactform_submit" value="Senden">
</form>
