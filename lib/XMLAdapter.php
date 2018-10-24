<?php

abstract class XMLAdapter {

    /**
     * The absolute path of the xml file
     * @var string 
     */
    protected $filePath;

    /**
     * @param string $filePath 
     */
    function __construct($filePath) {
        $this->filePath = $filePath;
    }

    public function getFilePath() {
        return $this->filePath;
    }

}

