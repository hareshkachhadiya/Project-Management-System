<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
		ini_set('display_errors',1);
		error_reporting(E_ALL);
		func_check_login();
	}
	
	public function index(){
		//$data['clients']=$this->common_model->getData('tbl_clients');
		$this->load->view('common/header');
		$this->load->view('settings/sidebarSettings');
		$this->load->view('settings/companySettings');
		$this->load->view('common/footer');
	}
}
?>