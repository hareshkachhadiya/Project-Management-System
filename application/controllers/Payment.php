<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payment extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
		ini_set('display_errors',0);
		//error_reporting(E_ALL);
		$this->login = $this->session->userdata('login');
		$this->user_type = $this->login->user_type;
		$this->user_id = $this->login->id;	
		func_check_login();
	}

	public function index(){

        $query = "select tbl_invoice.*,tbl_project_info.id,tbl_project_info.projectname from tbl_invoice INNER JOIN tbl_project_info on tbl_invoice.project = tbl_project_info.id where tbl_invoice.status=0 GROUP BY tbl_project_info.projectname";
        $data['allProjectData'] = $this->common_model->coreQueryObject($query);
      
		/*$whereArr = array('status'=>0);
		$project=$this->common_model->getData('tbl_invoice',$whereArr);
        $projectArr = array();
        //$srray = array();
        for($i=0;$i<=count($project)-1;$i++){
            $whereArr = array('id'=>$project[$i]->project);
            $projectData = $this->common_model->getData('tbl_project_info',$whereArr);

            array_push($projectArr, $projectData[0]);
        }
        //srrayecho"<PRE>";print_r($projectArr);
        $srray = array_unique($projectArr);
       );

        $data['allProjectData'] = $srray;
       // print_r($data['allProjectData']);
       */
		$this->load->view('common/header');
		$this->load->view('Payment/payment',$data);
		$this->load->view('common/footer');
	}

	public function razorPaySuccess(){
        $razorpay_payment_id = $this->input->post('razorpay_payment_id');
        $project = $this->input->post('project');
        $paidon = $this->input->post('paidon');
        $currency = $this->input->post('currency');
        $amount = $this->input->post('amount');
        $remark = $this->input->post('remark');
      // $mobileNo = $this->input->post('mobileNo');
        $userid = $this->input->post('userid');
        $invoiceid = $this->input->post('invoiceid');
        $insArr = array('user_id' => $userid , 'project' => $project , 'paidon' => $paidon , 'currency' => $currency , 'amount' => $amount , 'remark' => $remark , 'successkey' => $razorpay_payment_id);
       // print_r($insArr);
        $this->common_model->insertData('tbl_payment', $insArr);
        $arr = array('msg' => 'Payment Successfully Credited');
        $userarray = array();
        $userarray['userId'] = base64_encode($userid);
        $userarray['invoiceid'] = base64_encode($invoiceid);

        echo json_encode($userarray);exit();
        echo  json_encode($arr);exit(); 
    }

    public function response($page = null)
    {
        $invoiceid = base64_decode($this->uri->segment(3));
       //    echo $invoiceid;die;
        $whereArrI = array('id'=>$invoiceid);
        $updateArrI = array('payment_done'=>1,'status'=>1);
        $this->common_model->updateData('tbl_invoice',$updateArrI,$whereArrI);
        $whereArr = array('id'=>$this->user_id);
        $updateArr = array('payment_verify'=>1);
        $this->common_model->updateData('tbl_user',$updateArr,$whereArr);
        $this->load->view('common/header');
        $this->load->view('Payment/response');
        $this->load->view('common/footer');
        redirect('finance/invoice');
    }  

   public function assignAmount(){
    $AmountArr = array();
        $whereArr = array('project'=>$_POST['project'],'status'=>0);
        $amountData = $this->common_model->getData('tbl_invoice',$whereArr);
        $total = 0;
        for($i=0;$i<=count($amountData)-1;$i++){
             $data = $amountData[$i]->total;
             $total = $total+$data;
        }
       

        $amountArr['amountdata'] = $total;
        echo json_encode($amountArr);exit();
   }
}
?>  