<?php

include_once 'lib/XMLAdapter.php';
include_once 'lib/EventListXMLAdapter.php';
include_once 'controller/Controller.php';
include_once 'model/Event.php';
include_once 'model/MusicEvent.php';
include_once 'model/Artist.php';
include_once 'view/View.php';
include_once 'view/home/HomeView.php';

class HomeController extends Controller {

    private $adapter;

    function __construct() {
        $this->adapter = new EventListXMLAdapter("{$_SERVER['DOCUMENT_ROOT']}/resources/eventlist.xml");
    }

    protected function index() {
        $eventList = $this->adapter->getEventList();
        $view = new HomeView();
        $view->assign('list', $eventList);
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

