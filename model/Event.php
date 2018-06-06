<?php

class Event {

    function __construct($id = 0) {
        $this->id = $id;
    }

    /**
     * Event ID
     * @var int 
     */
    protected $id;

    /**
     * Name of the event
     * @var string 
     */
    protected $name;

    /**
     * Event start time, Unix Timestamp Format
     * @var int 
     */
    protected $starttime;

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

}
