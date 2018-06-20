<?php

include_once 'controller/Controller.php';
include_once 'lib/CSVAdapter.php';
include_once 'model/Event.php';
include_once 'model/MusicEvent.php';
include_once 'model/Artist.php';

class EventController extends Controller {

    private $csvAdapter;

    function __construct() {
        $this->csvAdapter = new CSVAdapter("{$_SERVER['DOCUMENT_ROOT']}/resources/eventlist.csv");
    }

    protected function index() {
        $eventList = $this->csvAdapter->getEventList();
        foreach ($eventList as $event) {
            $startTime = date("d.m.Y H:i", $event->getStarttime());
            $url = URI_EVENTS . "/{$event->getId()}-" . self::encodeUrl("{$event->getName()}-{$startTime}");
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

    protected function show() {
        $event = $this->csvAdapter->getEvent($this->resourceId);
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
            echo "</div>\n";
        }
    }

    protected function init() {
        echo "not implemented";
    }

    protected function create() {
        echo "not implemented";
    }

}

