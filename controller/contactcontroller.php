<?php
if (preg_match('@/success$@i', $_SERVER['REQUEST_URI'])) {
    echo "<p>Vielen Dank für Ihre Anfrage, wir setzen uns sobald wie möglich mit Ihnen in Verbindung.</p>";
} else {
    if ((!empty($_POST['contact'])) && (empty($_POST['name']))) {
        $message = "Vom Benutzer erfasste Daten:\n\n";
        foreach ($_POST as $key => $value) {
            $message .= "$key: $value\n";
        }
        mail("jem@semabit.ch", "TicSys - Kontaktformular", $message);
        header("HTTP/1.1 303 See Other");
        header("Location: " . URI_KONTAKT . "/success");
        exit();
    }
    ?>
    <form id="contactform" action="<?php echo URI_KONTAKT ?>" method="post" name="contactform">
        <label for="contactform-subject">Betreff</label>
        <input type="text" id="contactform-subject" name="subject" required autocomplete="off" list="subjects">
        <datalist id="subjects">
            <option value="Bestellung">
            <option value="Rechnung">
            <option value="Medien">
            <option value="Fehler auf der Seite">
            <option value="Generelles">
        </datalist>

        <label for="contactform-message">Mitteilung</label>
        <textarea id="contactform-message" name="message" rows="8" cols="50" required></textarea>

        <label for="contactform-last_name">Name</label>
        <input type="text" id="contactform-last_name" name="last_name">

        <label for="contactform-first_name">Vorname</label>
        <input type="text" id="contactform-first_name" name="first_name">

        <label for="contactform-phone">Telefon-Nr.</label>
        <input type="tel" id="contactform-phone" name="phone">

        <label for="contactform-email">Email-Adresse</label>
        <input type="email" id="contactform-email" name="email" required>

        <label for="contactform-newsletter">Newsletter abonnieren</label>
        <input type="checkbox" id="contactform-newsletter" name="newsletter" checked>

        <input type="text" id="contactform-name" name="name">
        <input type="hidden" name="contact" value="1">
        <input type="submit" name="contactform_submit" value="Senden">
    </form>

    <?php
}
?>
