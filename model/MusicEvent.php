<?php

class MusicEvent extends Event {

    /**
     * The artist object
     * @var Artist 
     */
    private $artist;

    function __construct($id = 0) {
        parent::__construct($id);
    }

    public function getArtist() {
        return $this->artist;
    }

    public function setArtist(Artist $artist) {
        $this->artist = $artist;
    }
    
    public function __toString() {
        return "ID: {$this->getId()}, Name: {$this->getName()}, StartTime: {$this->getStarttime()}, Artist -> {$this->getArtist()}";
    }
    
}

