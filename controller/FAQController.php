<?php

include_once 'controller/Controller.php';
include_once 'model/FAQ.php';
include_once 'lib/MysqlAdapter.php';
include_once 'view/View.php';
include_once 'view/faq/FAQListView.php';

class FAQController extends Controller {

    private $mysqlAdapter;

    function __construct() {
        $this->mysqlAdapter = new MysqlAdapter(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    protected function index() {
        $view = new FAQListView();
        $view->list = $this->mysqlAdapter->getFAQs();
        $view->display();
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

