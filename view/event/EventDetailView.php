<?php

class EventDetailView extends View {

    public function display() {
        $event = $this->vars['event'];

        echo "<div class=\"event-info\">\n";
        echo "<h1>{$event->getName()}</h1>\n";
        echo "<h2>" . date("d.m.Y H:i", $event->getStarttime()) . "</h2>\n";
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

