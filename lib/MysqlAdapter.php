<?php

final class MysqlAdapter {

    private $host;
    private $user;
    private $password;
    private $db;
    private $con;

    function __construct($host, $user, $password, $db) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;

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

}

