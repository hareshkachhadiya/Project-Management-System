<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
		ini_set('display_errors', 0);  


	}
	
	public function index(){
		$this->load->view('login/login');
	}
	
	public function checklogin(){
		if($this->input->post('btnlogin')){
			//echo "frgvfbg";die;
			$email = $this->input->post('email');	
			$password = md5($this->input->post('password'));	
			if(empty($email)){
                $this->session->set_flashdata('message', '<div id="message"> Please Enter Email Address.</div>');
                redirect('login');
            }
            else if(empty($password)){
                $this->session->set_flashdata('message', '<div id="message"> Please Enter Password.</div>');
                redirect('login');
            }
            else{
				$whereArr = array('emailid' => $email, 'password' => $password);
				$data = $this->common_model->getData('tbl_user',$whereArr);
				//echo $data[0]->id;
				
				
				$session = $data[0];
				$this->session->set_userdata('login',$session);
				if(count($data) == 1){
					if($data[0]->user_type == '0'){
						redirect('dashboard');
					}
					elseif($data[0]->user_type  == '1'){
						redirect('ClientDashboard');
					}
					else{
						redirect('EmpDashboard');
					}

				}
				else{
					$this->session->set_flashdata('failmsg', '<div id="message">Enter Valid Email Address and Password.</div>');
					$this->session->set_flashdata("sessData",$_POST);


					redirect('login');
				}
			}
		}
	}
	
	function insertforgotData(){
		$whereArr = array('emailid'=>$_POST['email']);
		$userData = $this->common_model->getData('tbl_user',$whereArr);
		if(!empty($userData)){
				$updateArr = array('password'=>md5($_POST['password']),'original_password'=>$_POST['password']);
				$this->common_model->updateData('tbl_user',$updateArr,$whereArr);
				$this->session->set_flashdata('successmsg', '<div id="message">Password Changed Successfully</div>');
				redirect('login');
		}
		else{
			$this->session->set_flashdata('failmsg', '<div id="message">User does not Exists..</div>');
			redirect('login');
		}

	}

	function logout(){
		$this->session->sess_destroy();
		
        redirect(base_url().'login');
	}

	
	
}