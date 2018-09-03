<?php

class Event {

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

    /**
     * Array of objects of type Price
     * 
     * @var array
     */
    protected $prices = array();

    function __construct($id = 0) {
        $this->id = $id;
    }

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

    public function getPrices() {
        return $this->prices;
    }

    public function setPrices($prices) {
        $this->prices = $prices;
    }

    public function addPrice(Price $price) {
        $this->prices[] = $price;
    }

}
