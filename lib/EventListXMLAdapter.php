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
            
        }
        return $list;
    }

}

