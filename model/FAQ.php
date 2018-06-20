<?php

class FAQ {
    
    const STATE_ACTIVE = 'active';
    const STATE_INACTIVE = 'inactive';

    private $id;
    private $question;
    private $answer;
    private $state;

    function __construct($id = 0, $question = '', $answer = '', $state = self::STATE_ACTIVE) {
        $this->id = $id;
        $this->question = $question;
        $this->answer = $answer;
        $this->state = $state;
    }

    public function getId() {
        return $this->id;
    }

    public function getQuestion() {
        return $this->question;
    }

    public function setQuestion($question) {
        $this->question = $question;
    }

    public function getAnswer() {
        return $this->answer;
    }

    public function setAnswer($answer) {
        $this->answer = $answer;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
    }

}

