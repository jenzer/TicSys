<?php

class Customer {

    const PASS_SALT = "TS";
    const USERNAME_REGEX = "^[a-zA-z0-9_\-]{3,10}$";

    private $id;
    private $userName;
    private $password;
    private $cipherPassword;
    private $lastName;
    private $firstName;
    private $phone;
    private $email;
    private $state;
    private $registrationDate;

    public function __construct($id = 0) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function setUserName($userName) {
        $this->userName = $userName;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getCipherPassword() {
        if ((empty($this->cipherPassword)) && (!empty($this->password))) {
            $this->cipherPassword = md5(self::PASS_SALT . $this->password . self::PASS_SALT);
        }
        return $this->cipherPassword;
    }

    public function setCipherPassword($cipherPassword) {
        $this->cipherPassword = $cipherPassword;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
    }

    public function getRegistrationDate() {
        return $this->registrationDate;
    }

    public function setRegistrationDate($registrationDate) {
        $this->registrationDate = $registrationDate;
    }

    public function __toString() {
        return "ID: {$this->id}, Username: {$this->userName}, Name: {$this->lastName} {$this->firstName}, Email: {$this->email}";
    }

}

