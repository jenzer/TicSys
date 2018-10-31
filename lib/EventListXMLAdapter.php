<?php

class EventListXMLAdapter extends XMLAdapter {

    /**
     * @param string $filePath 
     */
    function __construct($filePath) {
        parent::__construct($filePath);
    }

    /**
     * Returns the event by given id if present, null otherwise
     * @param int $id
     * @return Event 
     */
    public function getEvent($id) {
        $list = $this->getEventList();
        if (!empty($list) && array_key_exists($id, $list)) {
            return $list[$id];
        }
        return null;
    }

    /**
     * @return array list of all events in xml file 
     */
    public function getEventList() {
        $list = array();

        $xml = new DOMDocument();
        $xml->load($this->getFilePath());

        if ($xml->schemaValidate(str_replace('.xml', '.xsd', $this->getFilePath()))) {
            $xml = simplexml_load_file($this->getFilePath());

            // read artists
            $artists = array();
            foreach ($xml->artist as $anArtist) {
                $artist = new Artist($anArtist->name, $anArtist->image, $anArtist->{'image-thumb'}, $anArtist->description);

                // add video if exists
                $videos = $anArtist->videos;
                if (isset($videos->video)) {
                    foreach ($videos->video as $aVideo) {
                        $video = new Video();
                        $video->setWidth((string) $aVideo['width']);
                        $video->setHeight((string) $aVideo['height']);
                        $video->setPoster((string) $aVideo['poster']);

                        foreach ($aVideo->source as $aSource) {
                            $video->addSource((string) $aSource['type'], (string) $aSource['src']);
                        }
                        $artist->addVideo($video);
                    }
                }

                $artists[(string) $anArtist['id']] = $artist;
            }
            foreach ($xml->musicevent as $musicevent) {
                $event = new MusicEvent(str_replace('e', '', (string) $musicevent['id']));
                $event->setName($musicevent->name);
                $event->setStarttime($musicevent->starttime);
                $event->setArtist($artists[(string) $musicevent['artist']]);
                $list[$event->getId()] = $event;
            }
        }
        return $list;
    }

}

