<?php

class CSVAdapter {

    /**
     * The absolute path of the csv file
     * @var string 
     */
    private $filePath;

    /**
     * @param string $filePath 
     */
    function __construct($filePath) {
        $this->filePath = $filePath;
    }

    public function getFilePath() {
        return $this->filePath;
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
     * @return array list of all events in csv file 
     */
    public function getEventList() {
        $list = array();
        /*
         * event csv structure
         * ---------------
         * 0 => ID
         * 1 => Title
         * 2 => Start Unix Timestamp
         * 3 => Image
         * 4 => Image Thumbnail
         * 5 => Description
         */
        $handle = fopen($this->filePath, "r");
        if ($handle !== false) {
            while (!feof($handle)) {
                $entry = fgetcsv($handle);
                $artist = new Artist($entry[1], $entry[3], $entry[4], $entry[5]);
                $event = new MusicEvent($entry[0]);
                $event->setName($artist->getName());
                $event->setStarttime($entry[2]);
                $event->setArtist($artist);
                $list[$event->getId()] = $event;
            }
            fclose($handle);
        }
        return $list;
    }

}

