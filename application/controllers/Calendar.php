<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        session_start();
        $this->table  = 'events';
        $this->load->model('Mcalendar');
    }
    /*Home page Calendar view  */
    Public function index()
    {
        // if ($this->hakakses('calendar') == "000000") {
            // $this->load->view('calendar/view');
        // } else {
            $this->load->view('calendar/index');
        // }
    }
    /*Get all Events */
    Public function getEvents()
    {
        $result=$this->Mcalendar->getEvents();
        echo json_encode($result);
    }
    /*Add new event */
    Public function addEvent()
    {
        $result=$this->Mcalendar->addEvent();
        echo $result;
    }
    /*Update Event */
    Public function updateEvent()
    {
        $result=$this->Mcalendar->updateEvent();
        echo $result;
    }
    /*Delete Event*/
    Public function deleteEvent()
    {
        $result=$this->Mcalendar->deleteEvent();
        echo $result;
    }
    Public function dragUpdateEvent()
    {

        $result=$this->Mcalendar->dragUpdateEvent();
        echo $result;
    }

}
