<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {

	 public function __construct()
	 {
	  parent::__construct();
	  $this->load->model('common_model');
	  $this->load->library('SendMail');
		$this->login = $this->session->userdata('login');
		$this->user_id = $this->login->id;
		$this->user_type = $this->login->user_type;
	 }

	 function index()
	 {
	 	$this->load->view('common/header');
	  	$this->load->view('Event/event');
	  //	$this->load->view('common/footer');
	 }

	 function load()
	 {
	 	$query = "select * from tbl_events";
	  $event_data = $this->common_model->coreQuery($query);
	  foreach($event_data as $row)
	  {
	   $data[] = array(
	    'id' => $row['id'],
	    'title' => $row['title'],
	    'place' => $row['place'],
	    'eventdescription' => $row['eventdescription'],
	    'start' => $row['start_event'],
	    'end' => $row['end_event']
	   );
	  }
	  echo json_encode($data);
	}

	function insert()
	{
	  	if($this->input->post('title'))
	  	{
		   $data = array(
		    'title'  => $this->input->post('title'),
		    'place'  => $this->input->post('place'),
		    'eventdescription'=> $this->input->post('description'),
		    'start_event'=> $this->input->post('startdate'),
		    'end_event' => $this->input->post('enddate')
		   );
	   		$this->common_model->insertData('tbl_events',$data);
	  	}
	}

	 function delete()
	 {
	  if($this->input->post('id'))
	  {
	  	   $whereArr = array('id'=>$this->input->post('id'));

	   $this->common_model->deleteData('tbl_events',$whereArr);
	  }
	 }

}

?>
