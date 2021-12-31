<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leads extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
		$this->login = $this->session->userdata('login');
		$this->user_type = $this->login->user_type;
		$this->user_id = $this->login->id;
		func_check_login();
	}
	
	public function index(){
		$this->load->view('common/header');
		$this->load->view('leads/leads');
		$this->load->view('common/footer');
	}

	public function lead_list(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'clientname', 'companyname', 'createdat', 'status');
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
                        } 
                        else {
                            $sOrder = $defaultOrderClause . " ";
                        }

                        $sortColumnName = intval($_GET['iSortCol_' . $i]).'|'.$_GET['sSortDir_' . $i];
                    }
                }

                $sOrder = substr_replace($sOrder, "", -2);
                if ($sOrder == "ORDER BY") {
                    $sOrder = "";
                }
            } else {
                $sOrder = $defaultOrderClause;
            }

            if(!empty($sOrder)){
            	$sOrder = " ORDER BY ".$sOrder;
            }
            /** Ordering End **/

            /** Filtering Start */
            if(!empty(trim($_GET['sSearch']))){
            	$searchTerm = trim($_GET['sSearch']);
            	$sWhere .= ' AND (companyname like "%'.$searchTerm.'%" OR website like "%'.$searchTerm.'%" OR address like "%'.$searchTerm.'%" OR clientname like "%'.$searchTerm.'%" OR clientemail like "%'.$searchTerm.'%" OR note like "%'.$searchTerm.'%")';
            }
            if(!empty($sWhere)){
            	$sWhere = " WHERE 1 ".$sWhere;
            }
            /** Filtering End */
		}
		
	    $query = "SELECT * from tbl_leads ".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		$leadsArr = $this->common_model->coreQueryObject($query);

		$query = "SELECT * from tbl_leads ".$sWhere;
		$leadsFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($leadsFilterArr);

		$leadsAllArr = $this->common_model->getData('tbl_leads');
		$iTotal = count($leadsAllArr);

		/** Output */
		$datarow = array();
		$i = 1;
		foreach($leadsArr as $row) {
			$id = $row->id;
			if($row->nextfollowup == '0'){
				$next= $row->nextfollowup='No';
			}
			else{
				$next = $row->nextfollowup='Yes';
			}
			if($row->status == '0'){
				$status = $row->status = 'Pending';
			}
			else if($row->status == '1'){
				$status = $row->status = 'Overview';
			}
			else{
				$status = $row->status = 'Confirmed';
			}
			$clientid = $row->clientid;
			if($clientid == '0'){
				$st = 'Lead' ;
				$str = '<label class="label label-danger">'.$st.'</label>';
			}
			else{
				$st = 'Client' ;
				$str = '<label class="label label-success">'.$st.'</label>';
			}
			$create_date = date('d-m-Y', strtotime($row->created_at));
			if($clientid == '0'){
				$actionStr = '<div class="dropdown action m-r-10">
				                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
				                		<div class="dropdown-menu">
						                    <a  class="dropdown-item" href='.base_url().'leads/viewleadsdetail/'.base64_encode($id).'><i class="fa fa-search"></i> View</a>
						                    <a  class="dropdown-item" href='.base_url().'leads/editleads/'.base64_encode($id).'><i class="fa fa-edit"></i> Edit</a>
						                    <a  class="dropdown-item" href="javascript:void()" onclick="deleteLeadClient(\''.base64_encode($row->id).'\',\''.base64_encode($clientid).'\', \'lead\')"><i class="fa fa-trash "></i> Delete</a>
						                    <a  class="dropdown-item" href='.base_url().'clients/addclients/'.base64_encode($id).'><i class="fa fa-user"></i> Change To Client</a>
				               			 </div>
							</div>';
			}
			else{
					$whereget = array('id'=>$clientid);
					$getClient = $this->common_model->getData('tbl_clients',$whereget);
					if(!empty($getClient)){
						$clientid = $getClient[0]->user_id;	
					}
					
					$actionStr = '<div class="dropdown action m-r-10">
				                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
				               		 <div class="dropdown-menu">
						                    <a  class="dropdown-item" href='.base_url().'leads/viewleadsdetail/'.base64_encode($id).'><i class="fa fa-search"></i> View</a>
						                    <a  class="dropdown-item" href="'.base_url().'Clients/editclients/'.base64_encode($clientid).'/ltoc"><i class="fa fa-edit"></i> Edit</a>
						                    <a  class="dropdown-item" href="javascript:void()" onclick="deleteLeadClient(\''.base64_encode($row->id).'\',\''.base64_encode($clientid).'\', \'client\')"><i class="fa fa-trash "></i> Delete</a>
				                	</div>
				            </div>';
			}
			$datarow[] = array(
				$id = $i,
                $row->clientname.'<br/>'.$str,
                $row->companyname,
                $create_date,
				$next,
				$status,
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

	public function addleads(){
		$data['sessData'] = $this->session->flashdata('LeadData');
		//print_r($data);die;
		$this->load->view('common/header');
		$this->load->view('leads/addleads',$data);
		$this->load->view('common/footer');
	}

	public function insertleads(){
		if(!empty($_POST)){
			$companyname = $this->input->post('company_name');
			$website = $this->input->post('website');
			$address = $this->input->post('address');
			$clientname = $this->input->post('name');
			$clientemail = $this->input->post('email');
			$mobile = $this->input->post('mobile');
			$nextfollowup = $this->input->post('follow_up');
			$note = $this->input->post('note');
			$whereArr = array('clientemail' => $clientemail);
			$data = $this->common_model->getData("tbl_leads",$whereArr);
			#echo "<pre>";print_r($data);die;
			if(count($data) == 1){
				#echo "hi";exit;
				$this->session->set_flashdata('message_name', 'Email is already exits');
				//print_r($_POST);die;
				$this->session->set_flashdata("sessData",$_POST);
				redirect('leads/addleads');
			}
			else{
			$insArr = array('clientid'=>0,'companyname'=>$companyname,'website'=>$website,'address'=>$address,'clientname'=>$clientname,'clientemail'=>$clientemail,'mobile'=>$mobile,'nextfollowup'=>$nextfollowup,'status'=>'0','note'=>$note);
			$this->common_model->insertData('tbl_leads',$insArr);
			$this->session->set_flashdata('message_name', 'Lead Insert sucessfully');
			redirect('Leads');
			}
		}
	}

	public function editleads(){
		$id = base64_decode($this->uri->segment(3));
		//echo $id;die;
		$whereArr=array('id'=>$id);
		$data['leads'] = $this->common_model->getData('tbl_leads',$whereArr);
		if(!empty($_POST))
		{
			$id = base64_decode($this->input->post('leadid'));
			$companyname = $this->input->post('company_name');
			$website = $this->input->post('website');
			$address = $this->input->post('address');
			$clientname = $this->input->post('name');
			$clientemail = $this->input->post('email');
			$mobile = $this->input->post('mobile');
			$nextfollowup = $this->input->post('follow_up');
			$status = $this->input->post('status');
			$source = $this->input->post('source');
			$note = $this->input->post('note');
			$updateArr = array('clientid'=>0,'companyname'=>$companyname,'website'=>$website,'address'=>$address,'clientname'=>$clientname,'clientemail'=>$clientemail,'mobile'=>$mobile,'nextfollowup'=>$nextfollowup,'status'=>$status,'source'=>$source,'note'=>$note);
			$whereArr = array('id'=>$id);
			//print_r($whereArr);die;
			$checkArr = array('clientemail'=>$clientemail,'id !='=>$id);
			$checkEmail = $this->common_model->getData("tbl_leads",$checkArr);
			if(empty($checkEmail)){
				$this->common_model->updatedata('tbl_leads',$updateArr,$whereArr);
				$this->session->set_flashdata('message_name', 'Leads Updated sucessfully');
				redirect('Leads');
			}else{
				$this->session->set_flashdata('message_name', 'Email address already exists');
				$this->session->set_flashdata("sessData",$_POST);
				//$data['editData'] = $updateArr;
				//print_r($data['editData']);die;
				redirect('leads/editleads/'.base64_encode($id),$data);
			}
		}
		$this->load->view('common/header');
		$this->load->view('leads/editleads',$data);
		$this->load->view('common/footer');
	}

	public function deleteleads(){
		$leadId = base64_decode($_POST['leadId']);
		$clientId = base64_decode($_POST['clientId']);
		$type = $_POST['type'];
		$whereArr = array('id'=>$leadId);
		//print_r($whereArr);die;
		$this->common_model->deleteData('tbl_leads',$whereArr);
	} 

	/*public function changeleadtoclient(){
		$id = base64_decode($this->uri->segment(3));
		$whereArr = array('id'=>$id);
		$data['leads'] = $this->common_model->getData('tbl_leads',$whereArr);
		$data['editID'] = $id;
		$this->load->view('common/header');
		$this->load->view('leads/leadstoclient',$data);
		$this->load->view('common/footer');
		if(!empty($_POST))
		{
			$companyname = $this->input->post('company_name');
			$website = $this->input->post('website');
			$address = $this->input->post('address');
			$clientname = $this->input->post('name');
			$clientemail = $this->input->post('email');
			$password = $this->input->post('password');
			if($this->input->post('randompassword')=='on'){
				$randompassword='1';
			}
			else{ 
				$randompassword='0';
			}
			$grp = $randompassword;
			$mobile = $this->input->post('mobile');
			$skype = $this->input->post('skype');
			$linkedin = $this->input->post('linkedin');
			$twitter = $this->input->post('twitter');
			$facebook = $this->input->post('facebook');
			$gst_number = $this->input->post('gst_number');
			$note = $this->input->post('note');
			$login = $this->input->post('login');
			$whereArr = array('emailid' => $clientemail);
			$data = $this->common_model->getData('tbl_user',$whereArr);
			if(count($data)==1){
				$this->session->set_flashdata('message_name','Email already exits');
				$this->session->set_flashdata("data",$_POST);
				redirect('Clients/addclients');
			}
			else{
				$userinsertArr=array('user_type'=>1,'emailid'=>$clientemail,'password'=>$password,'generaterandompassword'=>$grp,'mobile'=>$mobile,'status'=>1,'login'=>$login);
				$this->common_model->insertdata('tbl_user',$userinsertArr);
				$userid=$this->db->insert_id();

				$insertArr=array('user_id'=>$userid,'companyname' => $companyname,'website' => $website,'address' => $address,'clientname' => $clientname,'skype' => $skype,'linkedin' => $linkedin,'twitter' => $twitter,'facebook' => $facebook,'gstnumber' => $gstnumber,'note' => $note);
				$this->common_model->insertData('tbl_clients',$insertArr);
				$last_inserted = $this->db->insert_id();
				$updateArr = array('clientid'=>$last_inserted);
				$whereArr = array('id'=>$id);
				$this->common_model->updateData('tbl_leads',$updateArr,$whereArr);
				$this->session->set_flashdata('message_name', "Lead Change Succeessfully");
				redirect('Leads');
			}
		}
	}*/

	
	public function viewleadsdetail(){
		$id = base64_decode($this->uri->segment(3));
		$whereArr = array('id'=>$id);
		$data['leads'] = $this->common_model->getData('tbl_leads',$whereArr);
		$this->load->view('common/header');
		$this->load->view('leads/viewlead',$data);
		$this->load->view('common/footer');
	}
}							