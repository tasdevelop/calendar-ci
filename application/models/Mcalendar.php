<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mcalendar extends MY_Model {
    public function __construct()
    {
        parent::__construct();
        $this->dbcalendar = $this->load->database('calendar', TRUE);
    }
    public function getEvents()
    {
        $sql = "SELECT * FROM events WHERE events.start BETWEEN ? AND ? ORDER BY events.start ASC";
        return $this->dbcalendar->query($sql, array($_GET['start'], $_GET['end']))->result();
    }
    public function addEvent()
    {
        $sql = "INSERT INTO events (title,events.start,events.end,description, color) VALUES (?,?,?,?,?)";
        $this->dbcalendar->query($sql, array($_POST['title'], $_POST['start'],$_POST['end'], $_POST['description'], $_POST['color']));
        return ($this->dbcalendar->affected_rows()!=1)?false:true;
    }
    public function updateEvent()
    {
        $sql = "UPDATE events SET title = ?, description = ?, color = ? WHERE id = ?";
        $this->dbcalendar->query($sql, array($_POST['title'],$_POST['description'], $_POST['color'], $_POST['id']));
            return ($this->dbcalendar->affected_rows()!=1)?false:true;
    }
    public function deleteEvent()
    {
        $sql = "DELETE FROM events WHERE id = ?";
        $this->dbcalendar->query($sql, array($_GET['id']));
        return ($this->dbcalendar->affected_rows()!=1)?false:true;
    }
    public function dragUpdateEvent()
    {
        //$date=date('Y-m-d h:i:s',strtotime($_POST['date']));
        $sql = "UPDATE events SET  events.start = ? ,events.end = ?  WHERE id = ?";
        $this->dbcalendar->query($sql, array($_POST['start'],$_POST['end'], $_POST['id']));
        return ($this->dbcalendar->affected_rows()!=1)?false:true;
    }

}