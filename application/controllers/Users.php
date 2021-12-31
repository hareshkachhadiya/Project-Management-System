<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
		ini_set('display_errors',1);
		error_reporting(E_ALL);
		$this->load->library('SendMail');
		$this->load->helper('common_helper');
	}


 	public function verify_email(){
	    $email = base64_decode($this->uri->segment(3));
	    $whereArr = array('emailid'=>$email);
	    $data = $this->common_model->getData('tbl_user',$whereArr);
	    if(count($data) == 1){
		    $updateArr = array('verify_email'=>1);
		    $this->common_model->updateData('tbl_user',$updateArr,$whereArr);
		    $this->session->set_flashdata('successmsg', 'Your account is verify..Now login');
		    redirect('login');
		}
		else{
			 $this->session->set_flashdata('failmsg', 'Email does not Exists..');
		    redirect('login');
		}
	}
}

?>