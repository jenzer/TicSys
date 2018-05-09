<?php

/*
 * event csv structure
 * ---------------
 * 0 => ID
 * 1 => Title
 * 2 => Date
 * 3 => Image
 * 4 => Image Thumbnail
 * 5 => Description
 */
$handle = fopen("{$_SERVER['DOCUMENT_ROOT']}/resources/eventlist.csv", "r");
if ($handle !== false) {
    $baseUrl = URI_EVENTS; // needed since constants cannot be used in heredoc
    $matches = array();
    if (preg_match("@^$baseUrl/([0-9]+)@", $_SERVER['REQUEST_URI'], $matches)) {
        $selectedEvent = array();
        while (!feof($handle)) {
            $event = fgetcsv($handle);
            if ($matches[1] == $event[0]) {
                $selectedEvent = $event;
                break;
            }
        }
        if (!empty($selectedEvent)) { // Event with transmitted ID was found
            echo <<<EVENT
        
            <div class="event-info">
                <h2>{$event[1]}</h2>
                <h3>{$event[2]}</h3>
                <p><img src="/resources/{$event[3]}" alt="{$event[1]}" /></p>
                <p>{$event[5]}</p>
            </div>
        
EVENT;
        }
    } else {
        while (!feof($handle)) {
            $event = fgetcsv($handle);
            $url =  "$baseUrl/{$event[0]}-" . encodeUrl("{$event[1]}-{$event[2]}");
            echo <<<EVENT
        
            <div class="event-info">
                <a href="$url">
                    <h2>{$event[1]}</h2>
                    <h3>{$event[2]}</h3>
                    <p><img src="/resources/{$event[4]}" alt="{$event[1]}" />{$event[5]}</p>
                </a>
            </div>
        
EVENT;
        }
    }
    fclose($handle);
}

function encodeUrl($url) {
    $specialChars = array(
        "ä" => "ae",
        "ö" => "oe",
        "ü" => "ue",
        "é|ê|è" => "e",
        "á|â|à" => "a",
        "ç" => "c"
    );
    foreach ($specialChars as $find => $replace) {
        $url = preg_replace("/($find)/i", $replace, $url);
    }
    // Replace whitespace chars
    $url = preg_replace('/\s/', '-', $url);
    // Remove all remaining disallowed chars
    $url = preg_replace('/[^a-zA-Z0-9_-]/', '', $url);
    // Replace multiple '-' chars with a single '-'
    $url = preg_replace('/(\-)+/', '-', $url);
    return $url;
}