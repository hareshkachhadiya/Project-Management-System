<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClientDashboard extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
		$this->login = $this->session->userdata('login');
		$this->user_id = $this->login->id;
		func_check_login();
	}
	public function index(){
		$this->load->view('common/header');
		$this->load->view('clientdashboard/cdashboard');
		$this->load->view('common/footer');
	}
	
}