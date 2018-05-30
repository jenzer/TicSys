<?php

class Video {

    private $width;
    private $height;
    private $controls = true;
    private $autoplay = false;
    private $loop = false;
    private $preload = 'none';
    private $poster;

    /**
     * key -> type of source
     * value -> path of source file
     * @var array 
     */
    private $sources = array();
    private $altContent;

    public function getWidth() {
        return $this->width;
    }

    public function setWidth($width) {
        $this->width = $width;
    }

    public function getHeight() {
        return $this->height;
    }

    public function setHeight($height) {
        $this->height = $height;
    }

    public function getControls() {
        return $this->controls;
    }

    public function setControls($controls) {
        $this->controls = $controls;
    }

    public function getAutoplay() {
        return $this->autoplay;
    }

    public function setAutoplay($autoplay) {
        $this->autoplay = $autoplay;
    }

    public function getLoop() {
        return $this->loop;
    }

    public function setLoop($loop) {
        $this->loop = $loop;
    }

    public function getPreload() {
        return $this->preload;
    }

    public function setPreload($preload) {
        $this->preload = $preload;
    }

    public function getPoster() {
        return $this->poster;
    }

    public function setPoster($poster) {
        $this->poster = $poster;
    }

    public function getSources() {
        return $this->sources;
    }

    public function setSources(array $sources) {
        $this->sources = $sources;
    }

    public function addSource($type, $path) {
        $this->sources[$type] = $path;
    }

    public function getAltContent() {
        return $this->altContent;
    }

    public function setAltContent($altContent) {
        $this->altContent = $altContent;
    }

}

