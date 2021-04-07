<?php

class Artist {

    const THUMB_WIDTH = 200;
    const THUMB_HEIGHT = 140;

    private $name;
    private $image;
    private $imageThumb;
    private $description;
    private $videos = array();

    function __construct($name = "", $image = "", $description = "") {
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

//    public function getImageThumb() {
//        return $this->imageThumb;
//    }

    public function getImageThumb() {
        $imagePath = "{$_SERVER['DOCUMENT_ROOT']}/resources/$this->image";
        $thumbName = preg_replace('/\-600x420\./', "-" . self::THUMB_WIDTH . "x" . self::THUMB_HEIGHT . ".", $this->image);
        $thumbPath = "{$_SERVER['DOCUMENT_ROOT']}/resources/$thumbName";
        if (file_exists($thumbPath)) {
            return $thumbName;
        } elseif (file_exists($imagePath)) {
            $imgSize = getimagesize($imagePath);
            if (!empty($imgSize)) {
                if ($imgSize['mime'] == 'image/jpeg') {
                    $image = imagecreatefromjpeg($imagePath);
                    $thumbnail = imagecreatetruecolor(self::THUMB_WIDTH, self::THUMB_HEIGHT);
                    imagecopyresampled($thumbnail, $image, 0, 0, 0, 0, self::THUMB_WIDTH, self::THUMB_HEIGHT, $imgSize[0], $imgSize[1]);
                    imagejpeg($thumbnail, $thumbPath, 100);
                    imagedestroy($image);
                    imagedestroy($thumbnail);
                    return $thumbName;
                }
            }
        }
        return "";
    }

    public function setImageThumb($imageThumb) {
        $this->imageThumb = $imageThumb;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getShortDescription($maxLength = 40) {
        if (strlen($this->description) > $maxLength) {
            return substr($this->description, 0, $maxLength - 3). "...";
        }
        return $this->description;
    }

    public function getVideos() {
        return $this->videos;
    }

    public function setVideos(array $videos) {
        $this->videos = $videos;
    }

    public function addVideo(Video $video) {
        $this->videos[] = $video;
    }

    public function hasVideos() {
        return !empty($this->videos);
    }

    public function __toString() {
        return "Name: {$this->name}, Description: {$this->getShortDescription()}, Videos: " . (($this->hasVideos()) ? 'yes' : 'no');
    }

}

