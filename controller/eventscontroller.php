<?php

include_once 'lib/CSVAdapter.php';
include_once 'model/Event.php';
include_once 'model/Artist.php';

$csvAdapter = new CSVAdapter("{$_SERVER['DOCUMENT_ROOT']}/resources/eventlist.csv");

$baseUrl = URI_EVENTS; // needed since constants cannot be used in heredoc
$matches = array();
if (preg_match("@^$baseUrl/([0-9]+)@", $_SERVER['REQUEST_URI'], $matches)) {
    $event = $csvAdapter->getEvent($matches[1]);
    if (!empty($event)) { // Event with transmitted ID was found
        echo "<div class=\"event-info\">\n";
        echo "<h2>{$event->getName()}</h2>\n";
        echo "<h3>" . date("d.m.Y H:i", $event->getStarttime()) . "</h3>\n";
        $artist = $event->getArtist();
        if ($artist instanceof Artist) {
            echo "<p><img src=\"/resources/{$artist->getImage()}\" alt=\"{$artist->getName()}\" /></p>\n";
            echo "<p>{$artist->getDescription()}</p>\n";

            if ($event->getId() == 1) {
                echo "<video controls width=\"600\" height=\"420\" ";
                echo "poster=\"/resources/videos/FooFighters-ThePretender.png\" preload=\"none\">\n";
                echo "<source src=\"/resources/videos/FooFighters-ThePretender.mp4\" type=\"video/mp4\">\n";
                echo "<source src=\"/resources/videos/FooFighters-ThePretender.ogv\" type=\"video/ogg\">\n";
                echo "<iframe width=\"600\" height=\"338\" src=\"http://www.youtube.com/embed/SBjQ9tuuTJQ\" frameborder=\"0\" allowfullscreen></iframe>";
                echo "</video>\n";
            }
        }
    }
} else {
    $eventList = $csvAdapter->getEventList();
    foreach ($eventList as $event) {
        $startTime = date("d.m.Y H:i", $event->getStarttime());
        $url = "$baseUrl/{$event->getId()}-" . encodeUrl("{$event->getName()}-{$startTime}");
        $artist = $event->getArtist();
        echo <<<EVENT
        
            <div class="event-info list">
                <a href="$url">
                    <h2>{$event->getName()}</h2>
                    <h3>{$startTime}</h3>
                    <p><img src="/resources/{$artist->getImageThumb()}" alt="{$artist->getName()}" />{$artist->getDescription()}</p>
                    <div class="clear"></div>
                </a>
            </div>
        
EVENT;
    }
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