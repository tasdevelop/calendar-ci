<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->table  = 'events';
        $this->load->model('Mcalendar');
    }
    /**
     * tampilan awal calendar
     * @AclName index calendar
     */
    public function index()
    {
        // if ($this->hakakses('calendar') == "000000") {
            // $this->load->view('calendar/view');
        // } else {
            $this->load->view('calendar/index');
        // }
    }
    /**
     * tampilan get event
     * @AclName get event
     */
    public function getEvents()
    {
        $result=$this->Mcalendar->getEvents();
        echo json_encode($result);
    }
    /**
     * tampilan add event
     * @AclName add event
     */
    public function addEvent()
    {
        $result=$this->Mcalendar->addEvent();
        echo $result;
    }
    /**
     * tampilan update event
     * @AclName update event
     */
    public function updateEvent()
    {
        $result=$this->Mcalendar->updateEvent();
        echo $result;
    }
    /**
     * tampilan delete event
     * @AclName delete event
     */
    public function deleteEvent()
    {
        $result=$this->Mcalendar->deleteEvent();
        echo $result;
    }
    /**
     * tampilan dragUpdateEvent
     * @AclName dragUpdateEvent
     */
    public function dragUpdateEvent()
    {
        $result=$this->Mcalendar->dragUpdateEvent();
        echo $result;
    }

}
