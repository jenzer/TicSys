<?php

class Event {

    function __construct($id = 0) {
        $this->id = $id;
    }

    /**
     * Event ID
     * @var int 
     */
    private $id;

    /**
     * Name of the event
     * @var string 
     */
    private $name;

    /**
     * Event start time, Unix Timestamp Format
     * @var int 
     */
    private $starttime;

    /**
     * The artist object
     * @var Artist 
     */
    private $artist;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getStarttime() {
        return $this->starttime;
    }

    public function setStarttime($starttime) {
        $this->starttime = $starttime;
    }

    public function getArtist() {
        return $this->artist;
    }

    public function setArtist(Artist $artist) {
        $this->artist = $artist;
    }

}
