<?php

include_once 'controller/Controller.php';
include_once 'model/FAQ.php';
include_once 'lib/MysqlAdapter.php';

class FAQController extends Controller {

    private $mysqlAdapter;

    function __construct() {
        $this->mysqlAdapter = new MysqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function index() {
        $faqList = $this->mysqlAdapter->getFAQs();
        echo "<dl>\n";
        foreach ($faqList as $faq) {
            echo "<dt>{$faq->getQuestion()}</dt><dd>{$faq->getAnswer()}</dd>\n";
        }
        echo "</dl>\n";
    }

    protected function show() {
        echo "not implemented";
    }

    protected function init() {
        echo "not implemented";
    }

    protected function create() {
        echo "not implemented";
    }

}

