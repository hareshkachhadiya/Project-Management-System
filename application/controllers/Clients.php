<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Clients extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
		ini_set('display_errors',1);
		error_reporting(E_ALL);
		func_check_login();
		$this->load->library('SendMail');
		$this->login = $this->session->userdata('login');
		$this->user_type = $this->login->user_type;
		$this->load->helper('common_helper');
	}
	
	public function index(){
		$whereArr = array('is_deleted'=>0);
		$data['startdate']=date('Y-m-d',strtotime('-1 month'));
		$data['enddate']=date('Y-m-d');
		$data['clients']=$this->common_model->getData('tbl_clients',$whereArr);
		$data['userData']=$this->common_model->getData('tbl_user');		
		$this->load->view('common/header');
		$this->load->view('clients/client',$data);
		$this->load->view('common/footer');
	}
	
	public function addclients(){
		$id = base64_decode($this->uri->segment(3));
		$whereArr = array('id'=>$id);
		$data['editID'] = $id;
		$data['sessData'] = $this->session->flashdata('data');
		$data['leads']=$this->common_model->getData('tbl_leads',$whereArr);
		$this->load->view('common/header');
		$this->load->view('clients/addclient',$data);
		$this->load->view('common/footer');
	}
	
	public function insertclients(){
		if(!empty($_POST)){
			$companyname=$this->input->post('company_name');
			$website=$this->input->post('website');
			$address=$this->input->post('address');
			$clientname=$this->input->post('name');
			$clientemail=$this->input->post('email');
			$orgpassword=$this->input->post('password');
			$password=md5($this->input->post('password'));
			if($this->input->post('randompassword')=='on')
			{$on='1';}
			else{ $on='0';}
			$grp=$on;
			$mobile=$this->input->post('mobile');
			$skype=$this->input->post('skype');
			$linkedin=$this->input->post('linkedin');
			$twitter=$this->input->post('twitter');
			$facebook=$this->input->post('facebook');
			$gstnumber=$this->input->post('gst_number');	
			$note=$this->input->post('note');
			$login=$this->input->post('login');
			$whereArr = array('emailid' => $clientemail);
			$data = $this->common_model->getData('tbl_user',$whereArr);
			if(count($data)==1){
				$this->session->set_flashdata('message_name','Email address already exists');
				$this->session->set_flashdata("data",$_POST);
				if(!empty($this->uri->segment(3))){
					redirect('Clients/addclients/'.$this->uri->segment(3));
				}else{
					redirect('Clients/addclients');
				}
			}
			else{
				$userinsertArr=array('user_type'=>1,'name'=>$clientname,'emailid'=>$clientemail,'password'=>$password,'original_password'=>$orgpassword,'generaterandompassword'=>$grp,'mobile'=>$mobile,'status'=>1,'login'=>$login,'is_deleted'=>0);
				$this->common_model->insertdata('tbl_user',$userinsertArr);
				$userid=$this->db->insert_id();

				$insertArr=array('user_id'=>$userid,'companyname' => $companyname,'website' => $website,'address' => $address,'clientname' => $clientname,'skype' => $skype,'linkedin' => $linkedin,'twitter' => $twitter,'facebook' => $facebook,'gstnumber' => $gstnumber,'note' => $note,'is_deleted'=>0);
				$this->common_model->insertdata('tbl_clients',$insertArr);
				$last_inserted = $this->db->insert_id();
				$updateArr = array('clientid'=>$last_inserted);
				$id = base64_decode($this->uri->segment(3));
				//echo $id;die;
				$data['editID'] = $id;
				$whereArr = array('id'=>$id);
				//print_r($whereArr);
				$this->common_model->updateData('tbl_leads',$updateArr,$whereArr);
				//$this->db->last_query();die;
				 $subject = 'Congratulation,You are successfully register on PMS';
                if(!empty($clientemail)){
                    
                    $msg="Dear ".$clientname."<br/>";
                    $msg.="You are successfully registered please verify your email address ";
                }
                $msg.="<a href=".base_url().'Users/verify_email/'.base64_encode($clientemail)."> Click here </a>";
               //echo $clientemail;die;
                $result = $this->sendmail->sendTo($clientemail, 'Dear Customer',$subject,$msg);

				$this->session->set_flashdata('message_name', "Data Inserted Succeessfully");
				redirect('Clients/index');
			}
		}
	}
	
	/*public function abc(){
		verify_email($clientemail);
	}*/
	public function client_list(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';	
			$aColumns = array('id','clientname','companyname','emailid','status', 'created_at');
			//'ahrefs_dr', 
            $totalColumns = count($aColumns);

			/** Paging Start **/
		$sLimit = "";
		$sOffset = "";
		if ($_GET['iDisplayStart'] < 0) {
			$_GET['iDisplayStart'] = 0;
		}
		if ($_GET['iDisplayLength'] < 0) {
			$_GET['iDisplayLength'] = 10;
		}
		if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
			$sLimit = (int) substr($_GET['iDisplayLength'], 0, 6);
			$sOffset = (int) $_GET['iDisplayStart'];
		} else {
			$sLimit = 10;
			$sOffset = (int) $_GET['iDisplayStart'];
		}
		/** Paging End **/

		/** Ordering Start **/
		$noOrderColumns = array('other_do_ext');
		if (isset($_GET['iSortCol_0']) && !in_array($aColumns[intval($_GET['iSortCol_0'])], $noOrderColumns)) {
		$sOrder = " ";
			for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
				if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {

					if ($aColumns[intval($_GET['iSortCol_' . $i])] != '') {
						$sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . " " . $_GET['sSortDir_' . $i] . ", ";
					}else {
						$sOrder = $defaultOrderClause . " ";
					}
					$sortColumnName = intval($_GET['iSortCol_' . $i]).'|'.$_GET['sSortDir_' . $i];
				}
			}

			$sOrder = substr_replace($sOrder, "", -2);
			if ($sOrder == "ORDER BY") {
				$sOrder = "";
			}
			}else {
				$sOrder = $defaultOrderClause;
			}

			if(!empty($sOrder)){
				$sOrder = " ORDER BY ".$sOrder;
			}
			/** Ordering End **/

        	 /** Filtering Start */
           		if(!empty(trim($_GET['sSearch']))){
            		$searchTerm = trim($_GET['sSearch']);
            		$sWhere .= ' AND (clientname like "%'.$searchTerm.'%" OR companyname like "%'.$searchTerm.'%" OR emailid like "%'.$searchTerm.'%" OR note like "%'.$searchTerm.'%")';
            	}
				$startdate=!empty($_POST['startdate']) ? $_POST['startdate'] : '';
				$enddate=!empty($_POST['enddate']) ? $_POST['enddate'] : '';
				$clientname=!empty($_POST['clientname']) ? $_POST['clientname'] : '';
				$status=$_POST['status'];
		
					if(!empty($clientname)){
						$sWhere.=' AND  clientname="'.$clientname.'"';
					}
					if($status=='all'){
					}
					else{
						$sWhere.=' AND status='.$status;
					}
					if(!empty($startdate)){						
						$sWhere.=' AND created_at >= "'.$startdate.' 00:00:00'.'"';
					}
					if(!empty($enddate)){						
						$sWhere.=' AND created_at <= "'.$enddate.' 23:59:00'.'"';
					}
					$sWhere.=' AND tbl_user.is_deleted=0';
					if(!empty($sWhere)){
						$sWhere = " WHERE 1 ".$sWhere;
					}
					/** Filtering End */
		}
				
		
	   	$query = "SELECT tbl_clients.id as clientId, tbl_user.id,tbl_user.is_deleted,tbl_clients.clientname,tbl_clients.companyname,tbl_user.emailid,tbl_user.status,tbl_user.created_at from tbl_clients INNER JOIN tbl_user ON tbl_clients.user_id=tbl_user.id ".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
	   	//echo $query;exit();
	    $clientsArr = $this->common_model->coreQueryObject($query);
		
		$query =  "SELECT tbl_clients.id as clientId, tbl_user.id,tbl_user.is_deleted,tbl_clients.clientname,tbl_clients.companyname,tbl_user.emailid,tbl_user.status,tbl_user.created_at from tbl_clients INNER JOIN tbl_user ON tbl_clients.user_id=tbl_user.id ".$sWhere;
		//echo $query;		
		$clientsFilterArr = $this->common_model->coreQueryObject($query);
	
		$iFilteredTotal = count($clientsFilterArr);
		$whereArr = array('is_deleted'=>0);
		$clientsAllarr = $this->common_model->getData('tbl_clients',$whereArr);
		$iTotal = count($clientsAllarr);

		/** Output */
		$datarow = array();
			$i = 1;
			foreach($clientsArr as $row) {
				$id = $row->id;
				if($row->status == '0'){
					$status = $row->status = 'Deactive';
					$sta='<lable class="label label-danger">'.$status.'</label>';

				}
				elseif($row->status == '1'){
					$status = $row->status = 'Active';
					$sta='<lable class="label label-success">'.$status.'</label>';

				}
				$clientid = $row->clientId;
				$create_date = date('d-m-Y', strtotime($row->created_at));
				
				if($this->user_type == 0) {
				$actionStr = "<abbr title=\"Edit\"><a class=\"btn btn-info btn-circle\" data-toggle=\"tooltip\" data-original-title=\"Edit\" href='".base_url()."Clients/editclients/".base64_encode($id)."'><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a></abbr>
				<abbr title=\"View Client Details\"><a class=\"btn btn-success btn-circle\" data-toggle=\"tooltip\" data-original-title=\"View Client Details\" href='".base_url()."Clients/viewclientdetail/".base64_encode($id)."/".base64_encode($clientid)."'><i class=\"fa fa-search\" aria-hidden=\"true\" ></i></a></abbr>
				<abbr title=\"Delete\"><a  class=\"btn btn-danger btn-circle sa-params\" data-toggle=\"tooltip\"  data-original-title=\"Delete\" href=\"javascript:void();\" onclick=\"deleteclients('".base64_encode($id)."');\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a></abbr>";	
				}
				if($this->user_type == 2) {
					$actionStr ="<abbr title=\"View Client Details\"><a class=\"btn btn-success btn-circle\" data-toggle=\"tooltip\" data-original-title=\"View Client Details\" href='".base_url()."Clients/viewclientdetail/".base64_encode($id)."/".base64_encode($clientid)."'><i class=\"fa fa-search\" aria-hidden=\"true\" ></i></a></abbr>";
				}
	          $clientname = "<a href=".base_url()."Clients/viewclientdetail/".base64_encode($id)."/".base64_encode($clientid).">".$row->clientname."</a>";
				$datarow[] = array(
					$id = $i,
	                $clientname,
	                $row->companyname,
		            $row->emailid,
	                $sta,	
					$create_date,
					$actionStr
	           	);
	           	$i++;
	      	}
	        
			$output = array
			(
			   	"sEcho" => intval($_GET['sEcho']),
		        "iTotalRecords" => $iTotal,
		        "iTotalRecordsFormatted" => number_format($iTotal), //ShowLargeNumber($iTotal),
		        "iTotalDisplayRecords" => $iFilteredTotal,
		        "aaData" => $datarow
			);
		  	echo json_encode($output);
	      	exit();
	}
	
	public function editclients(){
		$clientid = base64_decode($this->uri->segment(3));
		$ltoc = $this->uri->segment(4);
		$whereArr1=array('id'=>$clientid);
		$clientArr=array('user_id'=>$clientid,'is_deleted'=>0);
		$data['clients']=$this->common_model->getData('tbl_clients',$clientArr);
		if(!empty($data['clients'])){
			$clientmaniId = $data['clients'][0]->id;
			$whereArr=array('id'=>$clientmaniId);
		}
	
	
		$data['user']=$this->common_model->getData('tbl_user',$whereArr1);
		if(!empty($_POST)){
			$companyname=$this->input->post('company_name');
			$website=$this->input->post('website');
			$address=$this->input->post('address');
			$clientname=$this->input->post('name');
			$clientemail=$this->input->post('email');
			if($this->input->post('password')!=''){
					$updateArr['original_password']=$this->input->post('password');
					$updateArr['password']=md5($this->input->post('password'));
			}	
			$mobile=$this->input->post('mobile');
			$status=$this->input->post('status');
			$skype=$this->input->post('skype');
			$linkedin=$this->input->post('linkedin');
			$twitter=$this->input->post('twitter');
			$facebook=$this->input->post('facebook');
			$gstnumber=$this->input->post('gst_number');
			$note=$this->input->post('note');
			$login=$this->input->post('login');
			$clientid = base64_decode($this->input->post('clientid'));
			$updateArr1['companyname'] = $companyname;
			$updateArr1['website'] = $website;
			$updateArr1['address'] = $address;
			$updateArr1['clientname'] = $clientname;
			$updateArr['emailid'] = $clientemail;
			$updateArr[	'mobile'] = $mobile;
			$updateArr['status']=$status;
			$updateArr1['skype'] = $skype;
			$updateArr1['linkedin'] = $linkedin;
			$updateArr1['twitter'] = $twitter;
			$updateArr1['facebook'] = $facebook;
			$updateArr1['gstnumber'] = $gstnumber;
			$updateArr1['note'] = $note;
			$updateArr['login'] =$login;
			$whereck = array('emailid'=>$_POST['email'],'id !='=>$clientid);
			$checkEmail = $this->common_model->getData('tbl_user',$whereck);
			if(empty($checkEmail)){
				$data['query']=$this->common_model->updateData('tbl_user',$updateArr,$whereArr1);
				$data['query']=$this->common_model->updateData('tbl_clients',$updateArr1,$whereArr);

				$this->session->set_flashdata('message_name', "Data Update Succeessfully");

				if(!empty($ltoc)){
					redirect('leads');	
				}
				else{
					redirect('clients');
				}
			}
			else{
				$this->session->set_flashdata('message_name', "Email address already exists");
				$this->session->set_flashdata("sessData",$_POST);
				/*if(!empty($ltoc)){
					return redirect('Clients/editclients/'.base64_encode($clientid).'/'.$ltoc);
				}else{
					return redirect('Clients/editclients/'.base64_encode($clientid));
				}*/

			}
		}
		$this->load->view('common/header');
		$this->load->view('clients/editclient',$data);
		$this->load->view('common/footer');
	}
	
	public function deleteclient(){
		$clientid=base64_decode($_POST['clientid']);
		$whereArr=array('id'=>$clientid);
		$whereArrClient=array('user_id'=>$clientid);
		$updateArr=array('is_deleted'=>1);
		$this->common_model->updateData('tbl_user',$updateArr,$whereArr);
		$this->common_model->updateData('tbl_clients',$updateArr,$whereArrClient);
		redirect('Clients/index');
	}
	
	public function viewclientdetail(){
		$id=base64_decode($this->uri->segment(3));
		$id1=base64_decode($this->uri->segment(4));
		$whereArr=array('id'=>$id);
		$whereArr1=array('id'=>$id1);
		$data['clients']=$this->common_model->getData('tbl_clients',$whereArr1);
		$data['users']=$this->common_model->getData('tbl_user',$whereArr);

		$this->load->view('common/header');
		$this->load->view('clients/viewclientdetail',$data);
		$this->load->view('common/footer');
	}

	
}
?>