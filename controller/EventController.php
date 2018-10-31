<?php

include_once 'lib/XMLAdapter.php';
include_once 'lib/EventListXMLAdapter.php';
include_once 'controller/Controller.php';
include_once 'model/Event.php';
include_once 'model/MusicEvent.php';
include_once 'model/Artist.php';
include_once 'model/Video.php';
include_once 'view/View.php';
include_once 'view/event/EventListView.php';
include_once 'view/event/EventDetailView.php';

class EventController extends Controller {

    private $dataAdapter;

    function __construct() {
        $this->dataAdapter = new EventListXMLAdapter("{$_SERVER['DOCUMENT_ROOT']}/resources/eventlist.xml");
    }

    protected function index() {
        $eventList = $this->dataAdapter->getEventList();
        $view = new EventListView();
        $view->assign('list', $eventList);
        $view->display();
    }

    protected function show() {
        $event = $this->dataAdapter->getEvent($this->resourceId);
        if (!empty($event)) { // Event with transmitted ID was found
            $view = new EventDetailView();
            $view->assign('event', $event);
            $view->display();
        }
    }

    protected function init() {
        echo "not implemented";
    }

    protected function create() {
        echo "not implemented";
    }

}

