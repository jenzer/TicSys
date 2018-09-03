<?php

class Price {

    private $sector;
    private $currency;
    private $value;

    function __construct($sector, $currency, $value) {
        $this->sector = $sector;
        $this->currency = $currency;
        $this->value = $value;
    }

    public function getSector() {
        return $this->sector;
    }

    public function setSector($sector) {
        $this->sector = $sector;
    }

    public function getCurrency() {
        return $this->currency;
    }

    public function setCurrency($currency) {
        $this->currency = $currency;
    }

    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
    }

}

