<?php

class HomeView extends View {

    public function display() {
        echo "<h1>Die nächsten Events</h1>\n";
        echo "<div id=\"homeslider-wrap\">\n";
        echo "  <div id=\"homeslider\">\n";
        echo "    <ul>\n";
        foreach ($this->list as $event) {
            $date = new DateTime($event->getStarttime());
            $date->setTimezone(new DateTimeZone('Europe/Zurich'));
            $startTime = $date->format('d.m.Y H:i');
            
            $url = URI_EVENTS . "/{$event->getId()}-" . Controller::encodeUrl("{$event->getName()}-{$startTime}");
            $artist = $event->getArtist();
            echo "      <li data-info=\"" . htmlentities($event->getName() . " " . $startTime) . "\"><a href=\"$url\"><img src=\"/resources/{$artist->getImage()}\" alt=\"{$artist->getName()}\" /></a></li>\n";
        }
        echo "    </ul>\n";
        echo "    <a id=\"previous\" href=\"#\" class=\"slider-control\"></a>\n";
        echo "    <a id=\"next\" href=\"#\" class=\"slider-control\"></a>\n";
        echo "    <div class=\"clear\"></div>\n";
        echo "  </div>\n";
        echo "  <div id=\"info-frame\"><p></p></div>\n";
        echo "</div>\n";
    }

}

