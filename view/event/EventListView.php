<?php

class EventListView extends View {

    public function display() {
        echo "<h1>Alle Events</h1>";
        foreach ($this->vars['list'] as $event) {
            $startTime = date("d.m.Y H:i", $event->getStarttime());
            $url = URI_EVENTS . "/{$event->getId()}-" . Controller::encodeUrl("{$event->getName()}-{$startTime}");
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

}

