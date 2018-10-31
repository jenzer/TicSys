<?php

class EventDetailView extends View {

    public function display() {
        $event = $this->event;
        echo "<div class=\"event-info\">\n";
        echo "<h1>{$event->getName()}</h1>\n";
        $date = new DateTime($event->getStarttime());
        $date->setTimezone(new DateTimeZone('Europe/Zurich'));
        echo "<h2>" . $date->format('d.m.Y H:i') . "</h2>\n";
        $artist = $event->getArtist();
        if ($artist instanceof Artist) {
            echo "<p><img src=\"/resources/{$artist->getImage()}\" alt=\"{$artist->getName()}\" /></p>\n";
            echo "<p>{$artist->getDescription()}</p>\n";

            if ($artist->hasVideos()) {
                foreach ($artist->getVideos() as $aVideo) {
                    echo "<video ";
                    if ($aVideo->getControls()) {
                        echo "controls ";
                    }
                    echo "width=\"{$aVideo->getWidth()}\" height=\"{$aVideo->getHeight()}\" ";
                    echo "poster=\"{$aVideo->getPoster()}\" preload=\"{$aVideo->getPreload()}\">\n";
                    foreach ($aVideo->getSources() as $type => $src) {
                        echo "<source src=\"$src\" type=\"$type\">\n";
                    }
                    echo $aVideo->getAltContent();
                    echo "\n</video>\n";
                }
            }
        }
        echo "</div>\n";
    }

}

