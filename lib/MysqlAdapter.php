<?php

final class MysqlAdapter {

    private $host;
    private $user;
    private $password;
    private $db;
    private $con;
    private $log;

    function __construct($host, $user, $password, $db) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;
        $this->log = new KLogger($_SERVER['DOCUMENT_ROOT'] . '/logs/', KLogger::INFO);

        $this->open();
    }

    public function __destruct() {
        $this->close();
    }

    private function open() {
        $this->con = new mysqli($this->host, $this->user, $this->password, $this->db);
        if ($this->con->connect_errno) {
            echo 'DB Error: ' . $this->con->connect_error;
            $this->con = null;
        } else {
            $this->con->set_charset('utf8');
        }
    }

    private function close() {
        if ($this->con != null) {
            $this->con->close();
            $this->con = null;
        }
    }

    public function getFAQs($state = FAQ::STATE_ACTIVE) {
        $list = array();
        $res = $this->con->query("SELECT * FROM faqs WHERE state='$state' ORDER BY id");
        while ($row = $res->fetch_assoc()) {
            $faq = new FAQ($row['id'], $row['question'], $row['answer'], $row['state']);
            $list[] = $faq;
        }
        $res->free();
        return $list;
    }

    public function isUsernameAvailable($username) {
        $res = $this->con->query("SELECT username FROM customers WHERE username='$username'");
        if ($res->num_rows > 0) {
            $res->free();
            return false;
        }
        return true;
    }

    public function getUserByUsername($username) {
        $res = $this->con->query("SELECT * FROM customers WHERE username='$username' AND state='" . Customer::STATE_ACTIVE . "'");
        if ($row = $res->fetch_assoc()) {
            $customer = new Customer($row['id']);
            $customer->setUserName($row['username']);
            $customer->setCipherPassword($row['password']);
            $customer->setLastName($row['lastname']);
            $customer->setFirstName($row['firstname']);
            $customer->setPhone($row['phone']);
            $customer->setEmail($row['email']);
            $customer->setState($row['state']);
            $customer->setRegistrationDate($row['date']);
            
            $res->free();
            return $customer;
        }
        return null;
    }

    public function insertCustomer(Customer $customer) {
        $sql = "INSERT INTO customers ";
        $sql .= "(username, password, lastname, firstname, phone, email, date) ";
        $sql .= "VALUES (";
        $sql .= "'{$customer->getUserName()}', ";
        $sql .= "'{$customer->getCipherPassword()}', ";
        $sql .= "'" . addslashes($customer->getLastName()) . "', ";
        $sql .= "'" . addslashes($customer->getFirstName()) . "', ";
        $sql .= "'" . addslashes($customer->getPhone()) . "', ";
        $sql .= "'" . addslashes($customer->getEmail()) . "', ";
        $sql .= "now())";
        if ($this->con->query($sql)) {
            $id = $this->con->insert_id;
            $customer->setId($id);
            $this->log->logInfo("New customer successfully stored to database: $customer");
            return $id;
        } else {
            $this->log->logError("Error: {$this->con->error}, sql: {$sql}");
        }
        return 0;
    }

    public function __sleep() {
        return array('host', 'user', 'password', 'db');
    }

    public function __wakeup() {
        $this->open();
    }

    public function __toString() {
        return "Host: {$this->host}, DB: {$this->db}, user: {$this->user}";
    }

}

