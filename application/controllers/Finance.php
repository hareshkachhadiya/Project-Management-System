<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*require_once('vendor/autoload.php');*/
// reference the Dompdf namespace

class Finance extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
		ini_set('display_errors',1);
		error_reporting(E_ALL);
		$this->login = $this->session->userdata('login');
		$this->user_type = $this->login->user_type;
		$this->user_id = $this->login->id;	
		func_check_login();
	}

	public function index(){
		$data['startdate']=date('Y-m-d',strtotime('-1 month'));
		$data['enddate']=date('Y-m-d');
		$this->load->view('common/header');
		$this->load->view('Estimates/estimate',$data);
		$this->load->view('common/footer');
	}
	
	public function addestimates(){
		$data['tax']=$this->common_model->getData('tbl_tax');
		$whereArr = array('is_deleted'=>0);
		$data['client']=$this->common_model->getData('tbl_clients',$whereArr);
		$this->load->view('common/header');
		$this->load->view('Estimates/addestimate',$data);
		$this->load->view('common/footer');
	}
	
	public function insertEstimates(){
		
		if(!empty($_POST)){
			
			$client=$this->input->post('client');
			$project=$this->input->post('project1');
			$currency=$this->input->post('currency');
			$valid_till=$this->input->post('valid_till');				
			$total=$this->input->post('finaltotal');
			$note=$this->input->post('note');
			
			$insertArr=array('client' => $client,'project'=>$project,'currency' => $currency,'validtill' => $valid_till,'note' => $note,'status'=>'0','total'=>$total);
			
			$this->common_model->insertData('tbl_estimates',$insertArr);
			$estimateid=$this->db->insert_id();
				
			$item_name=$this->input->post('item_name');
			$quantity=$this->input->post('quantity');
			$cost_per_item=$this->input->post('cost_per_item');
			$taxes=$this->input->post('tax');
			$amount=$this->input->post('amount');
			$item_Description=$this->input->post('item_Description');
			
			$count=count($this->input->post('item_name'));
			for($i=0;$i<$count;$i++){
				$insertArr1=array('estimateid'=>$estimateid,'item' => $item_name[$i],'qtyhrs' => $quantity[$i], 'unitprice' => $cost_per_item[$i], 'tax' => $taxes[$i],'amount'=>$amount[$i],'description' => $item_Description[$i]);
				$this->common_model->insertData('tbl_products',$insertArr1);
			}
			$this->session->set_flashdata('message_name', "Estimate Insert Successfully..");
			redirect('Finance');	
		}
	}
	
	public function estimate_list(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';	
			$aColumns = array( 'id', 'client', 'total', 'created_at','validtill', 'status');
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
            } 
            else{
                $sOrder = $defaultOrderClause;
            }
			if(!empty($sOrder)){
            	$sOrder = " ORDER BY ".$sOrder;
            }
            /** Ordering End **/

            /** Filtering Start */
            if(!empty(trim($_GET['sSearch']))){
            	$searchTerm = trim($_GET['sSearch']);
            	$sWhere .= ' AND (c.clientname like "%'.$searchTerm.'%" OR p.projectname like "%'.$searchTerm.'%" OR e.total like "%'.$searchTerm.'%")';
            }

           
            	$startdate=!empty($_POST['startdate']) ? $_POST['startdate'] : '';
				$enddate=!empty($_POST['enddate']) ? $_POST['enddate'] : '';
				$status=$_POST['status'];
				//echo $status;die;
					if($status == 'all'){
					}
					else{
						$sWhere.=' AND e.status='.$status;
					}
					if(!empty($startdate)){						
						$sWhere.=' AND validtill >= "'.$startdate.'"';
					}
					if(!empty($enddate)){						
						$sWhere.=' AND validtill <= "'.$enddate.'"';
					}
					if($this->user_type == 1){
		            	$sWhere.= 'AND c.user_id='.$this->user_id;
		            }
					if(!empty($sWhere)){
						$sWhere = " WHERE 1 ".$sWhere;
					}
					/** Filtering End */
		
				
			 if($this->user_type == 0){
	    			/*$query = "select tbl_estimates.* , tbl_clients.clientname from tbl_estimates INNER JOIN tbl_clients ON tbl_clients.id=tbl_estimates.client".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;*/

	    			$query = "SELECT e.* , c.id as clientid,c.clientname,p.projectname,p.id as pid FROM tbl_estimates e INNER JOIN tbl_clients c ON c.id = e.client INNER JOIN tbl_project_info p ON p.id = e.project".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
	    			//echo $query;die;
					$estimatesArr = $this->common_model->coreQueryObject($query);

					$query1 = "SELECT e.* , c.id as clientid,c.clientname,p.projectname FROM tbl_estimates e INNER JOIN tbl_clients c ON c.id = e.client INNER JOIN tbl_project_info p ON p.id = e.project".$sWhere;
					$estimatesFilterArr = $this->common_model->coreQueryObject($query1);
					$iFilteredTotal = count($estimatesFilterArr);
					$estimatesAllArr = $this->common_model->getData('tbl_estimates');
					$iTotal = count($estimatesAllArr);

			}else if($this->user_type == 1){
    			$query = "SELECT e.* , c.id as clientid,c.clientname,p.projectname FROM tbl_estimates e INNER JOIN tbl_clients c ON c.id = e.client INNER JOIN tbl_project_info p ON p.id = e.project".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
    			//echo $query;die;
				$estimatesArr = $this->common_model->coreQueryObject($query);
				
				$query = "SELECT e.* , c.id as clientid,c.clientname,p.projectname FROM tbl_estimates e INNER JOIN tbl_clients c ON c.id = e.client INNER JOIN tbl_project_info p ON p.id = e.project".$sWhere;

				$estimatesFilterArr = $this->common_model->coreQueryObject($query);
				$iFilteredTotal = count($estimatesFilterArr);
				$queryAll = "SELECT e.* , c.id as clientid,c.clientname,p.projectname FROM tbl_estimates e INNER JOIN tbl_clients c ON c.id = e.client INNER JOIN tbl_project_info p ON p.id = e.project".$sWhere;
				$estimatesAllArr = $this->common_model->coreQueryObject($queryAll);
				$iTotal = count($estimatesAllArr);
			}
			//print_r($estimatesArr);die;

					/** Output */
					$datarow = array();
					$i = 1;
					
					foreach($estimatesArr as $row){
						$j=0;
						$id = $row->id;
						$clientid = $row->client;
						$whereArr = array('id'=>$clientid);
						$clientData = $this->common_model->getData('tbl_clients',$whereArr);
						$userid = $clientData[$j]->user_id;

						$checkstatus=$row->status;
						if($row->status == '0'){

							$status = $row->status = 'Waiting';
							$sta='<lable class="label label-danger">'.$status.'</label>';
						}
						else if($row->status == '1'){
							$status = $row->status = 'Accepted';
							$sta='<lable class="label label-success">'.$status.'</label>';
							//$sta='<lable class="label label-success">'.$status.'</label>';
						}
						else if($row->status == '2'){
							$status = $row->status = 'Declined';
							$sta='<lable class="label label-danger">'.$status.'</label>';
							//$sta='<lable class="label label-success">'.$status.'</label>';
						}
						$create_date = date('d-m-Y', strtotime($row->created_at));
						$validtill = date('d-m-Y', strtotime($row->validtill));

					if($this->user_type == 0){
						if($checkstatus =='1'){
							$actionStr = '<div class="dropdown action m-r-10">
						                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
						                		<div class="dropdown-menu">
								                   <a  class="dropdown-item" href="javascript:void(0)" onclick="deleteestimates(\''.base64_encode($row->id).'\')"><i class="fa fa-trash "></i> Delete</a>
												</div>
										</div>';
						}
						else{
							$actionStr = '<div class="dropdown action m-r-10">
						                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
						                		<div class="dropdown-menu">
								                    <a  class="dropdown-item" href='.base_url().'Finance/editestimate/'.base64_encode($id).'><i class="fa fa-pencil"></i> Edit</a>
													<a  class="dropdown-item" href="javascript:void(0)" onclick="deleteestimates(\''.base64_encode($row->id).'\')"><i class="fa fa-trash "></i> Delete</a>
													<a  class="dropdown-item" href="'.base_url().'Finance/createinvoice/'.base64_encode($id).'/'.base64_encode($clientid).'"><i class="ti-receipt"></i>Create Invoice</a>
						               			 </div>
											</div>';
						}
					}elseif($this->user_type == 1){
						$actionStr = '<div class="dropdown action m-r-10">
			                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
			                		<div class="dropdown-menu">
			                		 <a  class="dropdown-item" href='.base_url().'Finance/downloadEstimates/'.base64_encode($row->id).'><i class="fa fa-download"></i> Download</a>
									</div>
						</div>';
					}

					if($this->user_type == 0){
						$clientname = "<a href=".base_url()."Clients/viewclientdetail/".base64_encode($userid)."/".base64_encode($clientid).">".$row->clientname."</a>";
						$projectname = "<a href=".base_url()."Project/overView/".base64_encode($row->pid).">".$row->projectname."</a>";
						$datarow[] = array(
							$id = $i,

			               /*"<a href="echo base_url().'Clients/viewclientdetail/'.base64_encode($userid).'/'.base64_encode($clientid)?>">"*/
			               //'<a href="'.base_url().'Clients/viewclientdetail/"'.base64_encode($userid)."/".base64_encode($clientid).'>'.$row->clientname.'</a>',
			                $clientname,
			                $projectname,
			                $row->total,
							$create_date,
							$validtill,
			                $sta,	
							$actionStr
			           	);
					}
					elseif($this->user_type == 1){
						$datarow[] = array(
							$id = $i,
			                $row->projectname,
			                $row->total,
							$create_date,
							$validtill,
			                $sta,	
							$actionStr
			           	);
					}
						
		           		$i++;
		           		$j++;

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
}
	public function editestimate(){
		$id=$this->uri->segment(3);
		$id1=base64_decode($id);
		$whereArr=array('id'=>$id1);
		$whereArr1=array('estimateid'=>$id1);
		$data['client'] =$this->common_model->getData('tbl_clients');
		$data['tax'] =$this->common_model->getData('tbl_tax');
		$data['estimate']=$this->common_model->getData('tbl_estimates',$whereArr);
		$data['product']=$this->common_model->getData('tbl_products',$whereArr1);
		$this->load->view('common/header');
		$this->load->view('Estimates/editestimate',$data);
		$this->load->view('common/footer');

		if($this->input->post('btnupdate')){
				$client=$this->input->post('client');
				$currency=$this->input->post('currency');
				$valid_till=$this->input->post('valid_till');
				$status=$this->input->post('status');
				$total=$this->input->post('finaltotal');
				$note=$this->input->post('note');

				$updateArr=array('client' => $client,'currency' => $currency,'validtill' => $valid_till,'note' => $note,'status'=>$status,'total'=>$total);
				$this->common_model->updateData('tbl_estimates',$updateArr,$whereArr);
				$this->common_model->deleteData('tbl_products',$whereArr1);
			
				$item_name=$this->input->post('item_name');
				$quantity=$this->input->post('quantity');
				$cost_per_item=$this->input->post('cost_per_item');
				$taxes=$this->input->post('tax');
				$amount=$this->input->post('amount');
				$item_Description=$this->input->post('item_Description');
				
				$count=count($this->input->post('item_name'));
				for($i=0;$i<$count;$i++){
					$insertArr1=array('estimateid'=>$id1,'item' => $item_name[$i],'qtyhrs' => $quantity[$i], 'unitprice' => $cost_per_item[$i], 'tax' => $taxes[$i],'amount'=>$amount[$i],'description' => $item_Description[$i]);
					$this->common_model->insertData('tbl_products',$insertArr1);
				}
				$this->session->set_flashdata('message_name', "Estimate Update Succeessfully");
				redirect('Finance');
		}
	}

	public function deleteestimate(){
		$estimateid=base64_decode($_POST['estimateid']);
		$whereArr=array('id'=>$estimateid);
		$this->common_model->deleteData('tbl_estimates',$whereArr);
		redirect('Finance');
	}
	
	public function createinvoice(){
		$id=base64_decode($this->uri->segment(3));
		$clientid=base64_decode($this->uri->segment(4));
		$whereArr=array('id'=>$id);
		$whereArr1=array('estimateid'=>$id);
		$data['EId']=$id;
		$data['CId']=$clientid;
		$data['tax'] =$this->common_model->getData('tbl_tax');
		$sql1='select id,projectname from tbl_project_info where clientid='.$clientid;
		$data['project'] =$this->common_model->coreQueryObject($sql1);	
		$data['estimate']=$this->common_model->getData('tbl_estimates',$whereArr);
		$data['product']=$this->common_model->getData('tbl_products',$whereArr1);
		$sql='SELECT * FROM tbl_invoice ORDER BY tbl_invoice.id DESC LIMIT 1';
		$data['invoice']=$this->common_model->coreQueryObject($sql);
		$this->load->view('common/header');
		$this->load->view('Invoices/createinvoice',$data);
		$this->load->view('common/footer');

		if(!empty($_POST)){
			$invoice=$this->input->post('invoice_number');
			$project=$this->input->post('project');
			$currency=$this->input->post('currency');
			$invoicedate=$this->input->post('invoice_date');
			$duedate=$this->input->post('due_date');
			$status=$this->input->post('status');
			$recuringpayment=$this->input->post('recurring_payment');
			$billingfrequency=$this->input->post('billing_frequency');
			$billinginterval=$this->input->post('billing_interval');
			$billingcycle=$this->input->post('billing_cycle');
			$total=$this->input->post('finaltotal');
			$note=$this->input->post('note');

			$updateArr=array('status'=>1);
			$this->common_model->updateData('tbl_estimates',$updateArr,$whereArr);

			if($project != ''){
			$sql="SELECT tbl_project_info.clientid,tbl_clients.clientname,tbl_clients.companyname FROM tbl_project_info INNER JOIN tbl_clients ON tbl_project_info.clientid = tbl_clients.id where tbl_project_info.id=".$project;	
			}
			$data['invoicedata']=$this->common_model->coreQueryObject($sql);

			
			$insertArr=array('invoice' => $invoice,'project' => $project,'client'=>$data['invoicedata'][0]->companyname,'client'=>$data['invoicedata'][0]->clientid,
				'currency' => $currency,'invoicedate' => $invoicedate,'duedate'=>$duedate,'status'=>0,'recuringpayment'=>$recuringpayment,'billingfrequency'=>$billingfrequency,'billinginterval'=>$billinginterval,'billingcycle'=>$billingcycle,'total'=>$total,'note'=>$note);
			$this->common_model->insertData('tbl_invoice',$insertArr);
			$invoiceid=$this->db->insert_id();
			
			$item=$this->input->post('item_name');
			$qtyhrs=$this->input->post('quantity');
			$unitprice=$this->input->post('cost_per_item');
			$tax=$this->input->post('tax');
			$amount=$this->input->post('amount');
			$description=$this->input->post('item_Description');
			$count=count($this->input->post('item_name'));
			for($i=0;$i<$count;$i++){
				$insertArr1=array('invoiceid'=>$invoiceid,'item' => $item[$i],'qtyhrs' => $qtyhrs[$i], 'unitprice' => $unitprice[$i], 'tax' => $tax[$i],'amount'=>$amount[$i],'description' => $description[$i]);
				$this->common_model->insertData('tbl_invoiceproduct',$insertArr1);
			}
				$this->session->set_flashdata('message_name', "Create Invoice Successfully");
				redirect('Finance/invoice');
		}
	}

	public function addinvoices(){
		$sql='SELECT * FROM tbl_invoice ORDER BY tbl_invoice.id DESC LIMIT 1';
		$data['invoice']=$this->common_model->coreQueryObject($sql);
		$whereArr = array('is_deleted'=>0);
		$data['client']=$this->common_model->getData('tbl_clients',$whereArr);
		$data['employee'] =$this->common_model->getData('tbl_employee',$whereArr);
		$data['project'] =$this->common_model->getData('tbl_project_info',$whereArr);
		$data['tax'] =$this->common_model->getData('tbl_tax');
		$this->load->view('common/header');
		$this->load->view('Invoices/addinvoice',$data);
		$this->load->view('common/footer');
	}
	
	public function insertinvoice(){
		//print_r($_POST);die;
		if(!empty($_POST)){
			//echo "gdsh";die;
			$invoice=$this->input->post('invoice_number');
			$client=$this->input->post('client');
			$project=$this->input->post('project1');
			$currency=$this->input->post('currency');
			$invoicedate=$this->input->post('invoice_date');
			$duedate=$this->input->post('due_date');
			$status=$this->input->post('status');
			$recuringpayment=$this->input->post('recurring_payment');
			$billingfrequency=$this->input->post('billing_frequency');
			$billinginterval=$this->input->post('billing_interval');
			$billingcycle=$this->input->post('billing_cycle');
			$total=$this->input->post('finaltotal');
			$note=$this->input->post('note');
		
			if($project != ''){
			$sql="SELECT tbl_project_info.clientid,tbl_clients.clientname,tbl_clients.companyname FROM tbl_project_info INNER JOIN tbl_clients ON tbl_project_info.clientid = tbl_clients.id where tbl_project_info.id=".$project;	
			$data['invoicedata']=$this->common_model->coreQueryObject($sql);
			$insertArr=array('invoice' => $invoice,'project' => $project,'companyname'=>$data['invoicedata'][0]->companyname,'client'=>$client,'currency' => $currency,'invoicedate' => $invoicedate,'duedate'=>$duedate,'status'=>0,'recuringpayment'=>$recuringpayment,'billingfrequency'=>$billingfrequency,'billinginterval'=>$billinginterval,'billingcycle'=>$billingcycle,'total'=>$total,'note'=>$note);
			$this->common_model->insertData('tbl_invoice',$insertArr);
			$invoiceid=$this->db->insert_id();
			//print_r($insertArr);die;
			$item=$this->input->post('item_name');
			$qtyhrs=$this->input->post('quantity');
			$unitprice=$this->input->post('cost_per_item');
			$tax=$this->input->post('tax');
			$amount=$this->input->post('amount');
			$description=$this->input->post('item_Description');
			$count=count($this->input->post('item_name'));
			for($i=0;$i<$count;$i++){
				$insertArr1=array('invoiceid'=>$invoiceid,'item' => $item[$i],'qtyhrs' => $qtyhrs[$i], 'unitprice' => $unitprice[$i], 'tax' => $tax[$i],'amount'=>$amount[$i],'description' => $description[$i]);
				$this->common_model->insertData('tbl_invoiceproduct',$insertArr1);
			}
		}
			$this->session->set_flashdata('message_name', "Invoice Insert Successfully");
			redirect('Finance/invoice');
		}
	}

	public function invoice(){
		$data['startdate']=date('Y-m-d',strtotime('-1 month'));
		$data['enddate']=date('Y-m-d');
		$data['project'] =$this->common_model->getData('tbl_project_info');
		$data['clients']=$this->common_model->getData('tbl_clients');
		$this->load->view('common/header');
		$this->load->view('Invoices/invoice',$data);
		$this->load->view('common/footer');
	}
	
	public function invoice_list(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';	
			$aColumns = array( 'id', 'invoice', 'project', 'client','total', 'invoicedate','status');
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
            } 
            else{
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
                        else{
                            $sOrder = $defaultOrderClause . " ";
                        }
							$sortColumnName = intval($_GET['iSortCol_' . $i]).'|'.$_GET['sSortDir_' . $i];
                    }
                }
				$sOrder = substr_replace($sOrder, "", -2);
                if ($sOrder == "ORDER BY") {
                    $sOrder = "";
                }
            } 
            else{
                $sOrder = $defaultOrderClause;
            }
			if(!empty($sOrder)){
            	$sOrder = " ORDER BY ".$sOrder;
            }
            /** Ordering End **/

         	/** Filtering Start */
           	if(!empty(trim($_GET['sSearch']))){
            	$searchTerm = trim($_GET['sSearch']);
            	$sWhere .= ' AND (c.clientname like "%'.$searchTerm.'%" OR c.companyname like "%'.$searchTerm.'%" OR i.note like "%'.$searchTerm.'%" OR p.projectname like "%'.$searchTerm.'%" OR i.total like "%'.$searchTerm.'%")';
            }
				$startdate=!empty($_POST['startdate']) ? $_POST['startdate'] : '';
				$enddate=!empty($_POST['enddate']) ? $_POST['enddate'] : '';
				$projectname=!empty($_POST['projectname']) ? $_POST['projectname'] : '';
				$clientname=!empty($_POST['clientname']) ? $_POST['clientname'] : '';
				$status=$_POST['status'];
			
				$whereclient = array('user_id'=>$this->user_id);
				$clientData = $this->common_model->getData('tbl_clients',$whereclient);
				if($this->user_type == 1){
					$sWhere.=' AND i.client='.$clientData[0]->id;
				}
				if(!empty($projectname)){
					$sWhere.=' AND  project="'.$projectname.'"';
				}
				if(!empty($clientname)){
					$sWhere.=' AND  client="'.$clientname.'"';
				}
				if($status=='all'){
				}
				else{
					$sWhere.=' AND i.status='.$status;
				}
				if(!empty($startdate)){						
					$sWhere.=' AND invoicedate>="'.$startdate.'"';
				}
				if(!empty($enddate)){						
					$sWhere.=' AND invoicedate<="'.$enddate.'"';
				}
				if(!empty($sWhere)){
					$sWhere = " WHERE 1 ".$sWhere;
				}
					/** Filtering End */

			$query = "SELECT i.* , c.id as clientid,c.clientname,p.projectname,p.id as pid FROM tbl_invoice i INNER JOIN tbl_clients c ON c.id = i.client INNER JOIN tbl_project_info p ON p.id = i.project".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
	   
		$invoicesArr = $this->common_model->coreQueryObject($query);
		//print_r($invoicesArr);die;
		if($this->user_type == 1){
			$query = "SELECT i.*, c.id as clientid,c.clientname,p.projectname FROM tbl_invoice i INNER JOIN tbl_clients c ON c.id = i.client INNER JOIN tbl_project_info p ON p.id = i.project".$sWhere;
		
			$invoicesFilterArr = $this->common_model->coreQueryObject($query);
		
			$iFilteredTotal = count($invoicesFilterArr);
			//$whereArr = array('client!=' => '');
			//$invoicesAllArr = $this->common_model->getData('tbl_invoice');
			$iTotal = count($invoicesFilterArr);
		}
		elseif($this->user_type == 0){

			$query = "SELECT i.*, c.id as clientid,c.clientname,p.projectname,p.id as pid FROM tbl_invoice i INNER JOIN tbl_clients c ON c.id = i.client INNER JOIN tbl_project_info p ON p.id = i.project".$sWhere;
		
			$invoicesFilterArr = $this->common_model->coreQueryObject($query);
		
			$iFilteredTotal = count($invoicesFilterArr);
			//$whereArr = array('client!=' => '');
			$invoicesAllArr = $this->common_model->getData('tbl_invoice');
			$iTotal = count($invoicesAllArr);
		}

		}
		
	    
		/** Output */
		$datarow = array();
		$i = 1;

		$sta = '';
		foreach($invoicesArr as $row) {
				$j = 0;
			$id = $row->id;
			$clientid = $row->clientid;
			$whereArr = array('id'=>$clientid);
						$clientData = $this->common_model->getData('tbl_clients',$whereArr);
						$userid = $clientData[$j]->user_id;
			if($row->status == '0'){
				$status = $row->status = 'Unpaid';
				$sta='<lable class="label label-danger">'.$status.'</label>';
			}
			else if($row->status == '1'){
				$status = $row->status = 'Paid';
				$sta='<lable class="label label-success">'.$status.'</label>';
			}
			else if($row->status == '2'){
				$status = $row->status = 'Partially Paid';
				$sta='<lable class="label label-info">'.$status.'</label>';
			}

			if($this->user_type == 0){
					
				if($row->payment_done == 0){
					$actionStr = '<div class="dropdown action m-r-10">
			                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
			                		<div class="dropdown-menu">
			                		 <a  class="dropdown-item" href='.base_url().'Finance/doPayment/'.base64_encode($id).'><i class="fa fa-credit-card custom"></i> Payment</a>
					       				<a  class="dropdown-item" href="javascript:void(0);" onclick="deleteinvoices(\''.base64_encode($id).'\')"><i class="fa fa-trash "></i> Delete</a>
									</div>
						</div>';
				}
				elseif($row->payment_done == 1){
					$actionStr = '<div class="dropdown action m-r-10">
			                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
			                		<div class="dropdown-menu">
			                		 <a  class="dropdown-item" href='.base_url().'Finance/downloadFiles/'.base64_encode($id).'><i class="fa fa-download"></i> Download</a>
					       				<a  class="dropdown-item" href="javascript:void(0);" onclick="deleteinvoices(\''.base64_encode($id).'\')"><i class="fa fa-trash "></i> Delete</a>
									</div>
						</div>';
				}

			}

			
			elseif($this->user_type == 1){
				if($row->payment_done == 0){
					$actionStr = '<div class="dropdown action m-r-10">
			                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
			                		<div class="dropdown-menu">
			                		 <a  class="dropdown-item" href='.base_url().'Finance/doPayment/'.base64_encode($id).'><i class="fa fa-credit-card custom"></i> Payment</a>
					       				<a  class="dropdown-item" href="javascript:void(0);" onclick="deleteinvoices(\''.base64_encode($id).'\')"><i class="fa fa-trash "></i> Delete</a>
									</div>
						</div>';
				}
				elseif($row->payment_done == 1){
					$actionStr = '<div class="dropdown action m-r-10">
			                <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
			                		<div class="dropdown-menu">
			                		 <a  class="dropdown-item" href='.base_url().'Finance/downloadFiles/'.base64_encode($id).'><i class="fa fa-download"></i> Download</a>
					       				<a  class="dropdown-item" href="javascript:void(0);" onclick="deleteinvoices(\''.base64_encode($id).'\')"><i class="fa fa-trash "></i> Delete</a>
									</div>
						</div>';
				}

			}
			//print_r($actionStr);die;	
			if($this->user_type == 0){
				$clientname = "<a href=".base_url()."Clients/viewclientdetail/".base64_encode($userid)."/".base64_encode($clientid).">".$row->clientname."</a>";
				$projectname = "<a href=".base_url()."Project/overView/".base64_encode($row->pid).">".$row->projectname."</a>";
				$datarow[] = array(
				$id = $i,
                $row->invoice,
                $projectname,
                $clientname,
                $row->total,
                date('d-m-Y', strtotime($row->invoicedate)),
                $sta,	
				$actionStr
           	);
			}elseif($this->user_type == 1){
				$datarow[] = array(
				$id = $i,
                $row->invoice,
                $row->projectname,
                $row->total,
             	 date('d-m-Y', strtotime($row->invoicedate)),
                $sta,	
				$actionStr
           	);
			}
			
           	$i++;
           	$j++;
      	}
        
		$output = array(
		   	"sEcho" => intval($_GET['sEcho']),
	        "iTotalRecords" => $iTotal,
	        "iTotalRecordsFormatted" => number_format($iTotal), //ShowLargeNumber($iTotal),
	        "iTotalDisplayRecords" => $iFilteredTotal,
	        "aaData" => $datarow
		);
	  	echo json_encode($output);
      	exit();
	}

	public function deleteinvoice(){
		$invoiceid=base64_decode($_POST['id']);
		$whereArr=array('id'=>$invoiceid);
		$this->common_model->deleteData('tbl_invoice',$whereArr);
		
		redirect('Finance/invoice');
	}

	public function addexpenses(){
		$whereArr = array('is_deleted'=>0);
		$data['employee'] =$this->common_model->getData('tbl_employee',$whereArr);
		$data['project'] =$this->common_model->getData('tbl_project_info',$whereArr);
		$this->load->view('common/header');
		$this->load->view('Expenses/addexpense',$data);
		$this->load->view('common/footer');
	}

	public function insertexpense(){
		if(!empty($_POST)){
			$employee=$this->input->post('employee');
			$project=$this->input->post('project');
			$currency=$this->input->post('currency');
			$item=$this->input->post('itemname');
			$price=$this->input->post('price');
			$purchasedform=$this->input->post('purchasedfrom');
			$purchasedate=$this->input->post('purchasedate');
			
			$file = rand(1000,100000)."-".$_FILES['file']['name'];
			$file_loc = $_FILES['file']['tmp_name'];
			$file_size = $_FILES['file']['size'];
			$file_type = $_FILES['file']['type'];
			$folder="uploads/";
			move_uploaded_file($file_loc,$folder.$file);

				$insertArr=array('employee'=>$employee,'project' => $project,'currency' => $currency,'item' => $item,'price' => $price,'purchasedform' => $purchasedform,'purchasedate' => $purchasedate,'invoicefile' => $file,'status' => '0');
				$this->common_model->insertdata('tbl_expense',$insertArr);
				$this->session->set_flashdata('message_name', "Data Inserted Succeessfully");
				redirect('Finance/expense');
		}
	}

	public function expense(){
		$data['startdate']=date('Y-m-d',strtotime('-1 month'));
		$data['enddate']=date('Y-m-d');
		$whereArr = array('is_deleted'=>0);
		$data['employee'] =$this->common_model->getData('tbl_employee',$whereArr);
		$this->load->view('common/header');
		$this->load->view('Expenses/expense',$data);
		$this->load->view('common/footer');
	}
	
	public function expense_list(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';	
			$aColumns = array( 'id', 'item', 'price', 'purchasedform','employee', 'purchasedate','status');
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
            } 
            else{
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
            } 
            else {
                $sOrder = $defaultOrderClause;
            }
			if(!empty($sOrder)){
            	$sOrder = " ORDER BY ".$sOrder;
            }
            /** Ordering End **/

         	/** Filtering Start */
           	if(!empty(trim($_GET['sSearch']))){
            	$searchTerm = trim($_GET['sSearch']);
            	$sWhere .= ' AND (item like "%'.$searchTerm.'%" OR price like "%'.$searchTerm.'%" OR purchasedform like "%'.$searchTerm.'%" OR tbl_employee.employeename like "%'.$searchTerm.'%"  OR purchasedate like "%'.$searchTerm.'%" OR tbl_expense.price like "%'.$searchTerm.'%" )';
            }
				$startdate=!empty($_POST['startdate']) ? $_POST['startdate'] : '';
				$enddate=!empty($_POST['enddate']) ? $_POST['enddate'] : '';
				$employee=!empty($_POST['employee']) ? $_POST['employee'] : '';
				$status=$_POST['status'];
				if(!empty($employee)){
					$sWhere.=' AND  employee="'.$employee.'"';
				}
				if($status=='all'){
				}
				else{
					$sWhere.=' AND status='.$status;
				}
				if(!empty($startdate)){						
					$sWhere.=' AND purchasedate>="'.$startdate.'"';
				}
				if(!empty($enddate)){						
					$sWhere.=' AND purchasedate<="'.$enddate.'"';
				}
				if(!empty($sWhere)){
						$sWhere = " WHERE 1 ".$sWhere;
				}
					/** Filtering End */
		}
				
			$query = "select tbl_expense.* , tbl_employee.employeename,tbl_employee.user_id as empid from tbl_expense INNER JOIN tbl_employee ON tbl_employee.id=tbl_expense.employee".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
	   		$expensesArr = $this->common_model->coreQueryObject($query);
	   		
			
			$query = "select tbl_expense.* , tbl_employee.employeename from tbl_expense INNER JOIN tbl_employee ON tbl_employee.id=tbl_expense.employee".$sWhere;
			$expensesFilterArr = $this->common_model->coreQueryObject($query);
			$iFilteredTotal = count($expensesFilterArr);

			$expensesAllArr = $this->common_model->getData('tbl_expense');
			$iTotal = count($expensesAllArr);

			/** Output */
			$datarow = array();
			$i = 1;
			foreach($expensesArr as $row) {
				$id = $row->id;
				if($row->status == '0'){
					$status = $row->status = 'Pending';
					$sta='<lable class="label label-danger">'.$status.'</label>';
				}
				else if($row->status == '1'){
					$status = $row->status = 'Approved';
					$sta='<lable class="label label-success">'.$status.'</label>';
				}
				else if($row->status == '2'){
					$status = $row->status = ' Rejected';
					$sta='<lable class="label label-danger">'.$status.'</label>';
				} 
						
				$actionStr = "<abbr title=\"Edit\"><a class=\"btn btn-info btn-circle\" data-toggle=\"tooltip\" data-original-title=\"Edit\" href='".base_url()."Finance/editexpenses/".base64_encode($id)."'><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a></abbr>

					<abbr title=\"Delete\"><a  class=\"btn btn-danger btn-circle sa-params\" data-toggle=\"tooltip\"  data-original-title=\"Delete\" href=\"javascript:void(0);\" onclick=\"deleteexpenses('".base64_encode($id)."');\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a></abbr>";

					$employeename = "<a href=".base_url()."employee/viewemployee/".base64_encode($row->empid).">".$row->employeename."</a>";
				$datarow[] = array(
					$id = $i,
	                $row->item,
	                $row->price,
	                $row->purchasedform,
	                $employeename,
	                date('d-m-Y', strtotime($row->purchasedate)),
	                $sta,	
					$actionStr,
	           	);
	           	$i++;
      		}
        		$output = array(
				   	"sEcho" => intval($_GET['sEcho']),
			        "iTotalRecords" => $iTotal,
			        "iTotalRecordsFormatted" => number_format($iTotal), //ShowLargeNumber($iTotal),
			        "iTotalDisplayRecords" => $iFilteredTotal,
			        "aaData" => $datarow
				);
			  	echo json_encode($output);
		      	exit();
	}

	public function editexpenses(){
		$id=base64_decode($this->uri->segment(3));
		$whereArr=array('id'=>$id);
		$whereArr1 = array('is_deleted'=>0);
		$data['employee'] =$this->common_model->getData('tbl_employee',$whereArr1);
		$data['project'] =$this->common_model->getData('tbl_project_info',$whereArr1);
		$data['expense']=$this->common_model->getData('tbl_expense',$whereArr);
		$this->load->view('common/header');
		$this->load->view('Expenses/editexpense',$data);
		$this->load->view('common/footer');
		if($this->input->post('btnupdate')){
			$employee=$this->input->post('employee');
			$project=$this->input->post('project');
			$currency=$this->input->post('currency');
			$item=$this->input->post('itemname');
			$price=$this->input->post('price');
			$purchasedform=$this->input->post('purchasedfrom');
			$purchasedate=$this->input->post('purchasedate');
	
				if(!empty($_FILES['file']['name'])){
					$file = rand(1000,100000)."-".$_FILES['file']['name'];
					$file_loc = $_FILES['file']['tmp_name'];
					$file_size = $_FILES['file']['size'];
					$file_type = $_FILES['file']['type'];
					$folder="uploads/";
					move_uploaded_file($file_loc,$folder.$file);
					$updateArr['invoicefile']=$file;
				}
				else{
					$updateArr['invoicefile']=$this->input->post('image_name');
				}
				$status=$this->input->post('status');	

				$updateArr['employee'] = $employee;
				$updateArr['project'] = $project;
				$updateArr['currency'] = $currency;
				$updateArr['item'] = $item;
				$updateArr['price'] = $price;
				$updateArr['purchasedform'] = $purchasedform;
				$updateArr['purchasedate'] = $purchasedate;
				$updateArr['status'] = $status;
				$this->common_model->updateData('tbl_expense',$updateArr,$whereArr);
				$this->session->set_flashdata('message_name', "Data Updated Succeessfully");
				redirect('Finance/expense');
		}
	}

	public function deleteexpense(){
		$expenseid=base64_decode($_POST['id']);
		$whereArr=array('id'=>$expenseid);
		$this->common_model->deleteData('tbl_expense',$whereArr);
		redirect('Finance/expense');
	}
	
	public function getproject(){
		$clientid=$_POST['id'];
		$whereArr=array('clientid'=>$clientid);
		$projectArr=$this->common_model->getData('tbl_project_info',$whereArr);
		$str = '';
		if(!empty($projectArr)){
			foreach($projectArr as $row){
				$str.='<option value="'.$row->id.'">'.$row->projectname.'</option>'; 
			}
			$projectArr = array();
			$projectArr['projectdata'] = $str;
		}
		else{
			$str = '';
			$projectArr = array();
			$str.='<option value=" ">--</option>';
			$projectArr['projectdata'] = $str;
			
		}
		echo json_encode($projectArr);exit();
	}

	public function inserttax(){
		if(!empty($_POST)){
			$taxname = $this->input->post('taxname');
			$rate = $this->input->post('rate');
			$insArr = array('taxname'=>$taxname,'rate'=>$rate);
			$this->common_model->insertData('tbl_tax',$insArr);
			$taxArray = $this->common_model->getData('tbl_tax');
			$str = '';
			$str1 = '';
			foreach($taxArray as $row){
				$str.='<option value="'.$row->rate.'">'.$row->taxname.'('.$row->rate.'%)</option>'; 
			}
			$str1.='<option value="'.$rate.'">'.$taxname.'('.$rate.'%)</option>'; 
			$totaldata = count($taxArray);
			$txtArr = array();
			$txtArr['count'] = $totaldata;
			$txtArr['taxdata'] = $str1;
			echo  json_encode($txtArr);exit; 
			echo  $totaldata; exit;
		}
	}

	public function doPayment(){
		$data['invoiceid']=base64_decode($this->uri->segment(3));
		$whereArr = array('is_deleted'=>0);
		$data['project']=$this->common_model->getData('tbl_project_info',$whereArr);
		$whereArr1 = array('id'=>$data['invoiceid']);
		$data['invoiceData'] = $this->common_model->getData('tbl_invoice',$whereArr1);
		$this->load->view('common/header');
		$this->load->view('Payment/payment',$data);
		$this->load->view('common/footer');
	}
	public function downloadFiles(){
		$invoiceid = base64_decode($this->uri->segment(3));
		$whereArr = array('id'=>$invoiceid);
		$invoiceData = $this->common_model->getData('tbl_invoice',$whereArr);
		$whereArrC = array('id'=>$invoiceData[0]->client);
		$clientData = $this->common_model->getData('tbl_clients',$whereArrC);
		$whereArrP = array('id'=>$invoiceData[0]->project);
		$projectData = $this->common_model->getData('tbl_project_info',$whereArrP);
		$whereArrU = array('id'=>$clientData[0]->user_id);
		$userData = $this->common_model->getData('tbl_user',$whereArrU);
		$whereArrI = array('invoiceid'=>$invoiceData[0]->id);
		$itemData = $this->common_model->getData('tbl_invoiceproduct',$whereArrI);
		$invoicdate = date("d-m-Y", strtotime($invoiceData[0]->invoicedate));
		if($invoiceData[0]->status == 0){
			$status = $invoiceData[0]->status = 'Unpaid';
			//$sta='<lable class="label label-danger">'.$status.'</label>';
		}
		elseif($invoiceData[0]->status == 1){
			$status = $invoiceData[0]->status = 'Paid';
			//$sta='<lable class="label label-danger">'.$status.'</label>';
		}
		elseif($invoiceData[0]->status == 2){
			$status = $invoiceData[0]->status = 'Partiaaly Paid';
			//$sta='<lable class="label label-danger">'.$status.'</label>';
		}
		$this->load->library('Pdf');
		$filecontent = '';
		/*$filecontent= '<div align="left" style="margin-left:50pt;min-height: 13pt;margin-top: 15pt; "></div>
 <div align="left" style="margin-left:50pt;min-height: 13pt; "><font face="Arial" color="#010101"></font></div>
      <p style="margin-left:10pt;margin-right:0mm; text-indent:0mm; margin-top:0.00mm; margin-bottom:2.11mm;padding-top:0.00mm; padding-bottom:0.00mm; min-height: 7pt; "><font face="Arial" color="#010101"><span dir="ltr" style=" font-size:12.0pt">&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;Billed To:&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;Generated By:</span></font></p>
      
      <p style="margin-left:10pt;margin-right:0mm; text-indent:0mm; margin-top:12pt; margin-bottom:2.11mm;padding-top:0.00mm; padding-bottom:0.00mm; min-height: 7pt; "><font face="Arial" color="#010101"><span dir="ltr" style=" font-size:15pt">&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<b>'.$clientData[0]->clientname.'</b>&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<b>'.$clientData[0]->companyname.'</b></span></font></p>
      
      <p style="margin-left:10pt;margin-right:0mm; text-indent:0mm; margin-top:12pt; margin-bottom:2.11mm;padding-top:0.00mm; padding-bottom:0.00mm; min-height: 7pt; "><font face="Arial" color="#010101"><span dir="ltr" style=" font-size:12.0pt">&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;'.$userData[0]->emailid.'&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;'.$clientData[0]->address.'</span></font></p>
      &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
      <div align="left" style="margin-left:80pt;margin-right:80pt;min-height: 13pt; "><font face="Arial" color="#010101"><span dir="ltr" style=" font-size:12.0pt">&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
      <hr>
<div align="left" style="margin-left:50pt;min-height: 13pt; "></div>
 <div align="left" style="margin-left:50pt;min-height: 13pt; "><font face="Arial" color="#010101"></font></div>
      <p style="margin-left:10pt;margin-right:0mm; text-indent:0mm; margin-top:0.00mm; margin-bottom:2.11mm;padding-top:0.00mm; padding-bottom:0.00mm; min-height: 7pt; "><font face="Arial" color="#005690"><span dir="ltr" style=" font-size:35pt">
      	&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<b>'.$invoiceData[0]->invoice.'</b>
<div align="left" style="margin-left:50pt;min-height: 13pt; "></div>
 <div align="left" style="margin-left:50pt;min-height: 13pt; "><font face="Arial" color="#010101"></font></div>
      <p style="margin-left:10pt;margin-right:0mm; text-indent:0mm; margin-top:0.00mm; margin-bottom:2.11mm;padding-top:0.00mm; padding-bottom:0.00mm; min-height: 7pt; "><font face="Arial" color="#010101"><span dir="ltr" style=" font-size:15pt">
&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;Project Name:'.$projectData[0]->projectname.'<br/>
&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;Invoice Date:'.$invoicdate.'<br/>
&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;Status:'.$status.'
<div align="left" style="margin-left:50pt;min-height: 13pt; "></div>
 <div align="left" style="margin-left:50pt;min-height: 13pt; "><font face="Arial" color="#010101"></font></div>
      <p style="margin-left:10pt;margin-right:0mm; text-indent:0mm; margin-top:0.00mm; margin-bottom:2.11mm;padding-top:0.00mm; padding-bottom:0.00mm; min-height: 7pt; "><font face="Arial" color="#010101"><span dir="ltr" style=" font-size:15pt">
&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
<table style=" border-collapse: collapse;width:80%;margin-left: 80pt;margin-right: 50pt;font-size: 18pt;text-align: left;">
<tr style=" padding: 6px;text-align: left;border-bottom: 1px solid #ddd;">
<th style="background-color: #4CAF50;
  color: white;padding: 15px;">SR No</th>
<th style="padding-left: 20px;">Item</th>
<th>Qty/Hrs</th>
<th>Unit Price</th>
<th style="background-color: gray;
  color: black;padding: 15px;">Amount</th>
</tr>';
$a=1;
for($i=0;$i<=count($itemData)-1;$i++) {
$filecontent.='<tr style=" padding: 8px;text-align: left;border-bottom: 1px solid #ddd;color:#4CAF50;">
<td style="background-color: #4CAF50;
  color: white;padding: 15px;">'.$a.'</td>
<td style="padding-left: 20px;">'.$itemData[$i]->item.'</td>
<td>'.$itemData[$i]->qtyhrs.'</td>
<td>'.$itemData[$i]->unitprice.'</td>
<td style="background-color: gray;
  color: black;padding: 15px;">'.$itemData[$i]->amount.'</td>
</tr>';
	$a++;
}
$filecontent.='</table>
<div align="left" style="margin-left:50pt;min-height: 13pt; "></div>
 
      <p style="margin-left:10pt;margin-right:0mm; text-indent:0mm; margin-top:0.00mm; margin-bottom:2.11mm;padding-top:0.00mm; padding-bottom:0.00mm; min-height: 7pt; "><font face="Arial" color="#010101"><span dir="ltr" style=" font-size:20pt">
&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;Total &#160;&#160;'.$invoiceData[0]->total.'.
 <div align="left" style="margin-left:-25pt;min-height: 13pt; "><font face="Arial" color="#010101"><span dir="ltr" style=" font-size:12.0pt">&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;<b>__________________</b>
 <div align="left" style="min-height: 13pt; border-radius: 10px;"><font face="Arial" color="#010101"><span dir="ltr" style=" font-size:12.0pt">&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;	
<hr/>';*/
	 	

	 	$filecontent.= '<h1 align="center">INVOICE</h1>
	 	<table>
			<tr> 
				<th><h3><b>Invoice To:</b></h3></th>
				<th style="text-align:right"><h3><b>Generated By:</b></h3></th>
			</tr><br/>
			<tr>
				<td>'.$clientData[0]->clientname.'</td>
				<td style="text-align:right">'.$clientData[0]->companyname.'</td>
			</tr>
			<tr>
				<td >'.$userData[0]->emailid.'</td>
				<td style="text-align:right">'.$clientData[0]->address.'</td>
			</tr>
			<tr>
				<td>'.$userData[0]->mobile.'</td>
			</tr>
			
		</table>
		&#160;
		<hr>
		<div class="row">
			<div class="col-sm-6">
				<p style="margin-left:10pt;margin-right:0mm; text-indent:0mm; margin-top:0.00mm; margin-bottom:2.11mm;padding-top:0.00mm; padding-bottom:0.00mm; min-height: 7pt; "><font face="Arial" color="#005690"><span dir="ltr" style=" font-size:35pt">'.$invoiceData[0]->invoice.'</span></font></p>
				 <p style="margin-left:10pt;margin-right:0mm; text-indent:0mm; margin-top:0.00mm; margin-bottom:2.11mm;padding-top:0.00mm; padding-bottom:0.00mm; min-height: 7pt; "><font face="Arial" color="#010101"><span dir="ltr" style=" font-size:15pt">Project Name: '.$projectData[0]->projectname.'<br/>
				Invoice Date: '.$invoicdate.'<br/>
				Status: '.$status.'</span></font></p>
			</div>
		</div>
		&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
				<table style="padding-left:20pt;border-collapse: collapse;width:80%;margin-left: 80pt;margin-right: 50pt;font-size: 18pt;text-align: left;">
					<tr style=" padding: 6px;border-bottom: 1px solid #ddd;">
						<th style="background-color: #4CAF50;
  color: white;padding: 15px;">SR No</th>
						<th style="padding-left: 20px;">Item</th>
						<th>Qty/Hrs</th>
						<th>Unit Price</th>
						<th style="background-color: gray;
  color: black;padding: 15px;">Amount</th>
					</tr>';
					$a=1;
		for($i=0;$i<=count($itemData)-1;$i++) {
			
		$filecontent.=	'<tr style=" padding: 8px;text-align: left;border-bottom: 1px solid #ddd;color:#4CAF50;">
						<td style="background-color: #4CAF50;
  color: white;padding: 15px;">'.$a.'</td>
						<td style="padding-left: 20px;">'.$itemData[$i]->item.'</td>
						<td>'.$itemData[$i]->qtyhrs.'</td>
						<td>'.$itemData[$i]->unitprice.'</td>
						<td style="background-color: gray;
  color: black;padding: 15px;">'.$itemData[$i]->amount.'</td>
					</tr>';
			$a++;
			}
		
		$filecontent.=	'<br/>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>Total:</td>
						<td>'.$invoiceData[0]->total.'</td>
					</tr>
				</table>';
		
		
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('INVOICE');
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(20);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');

		$pdf->AddPage();

		$pdf->WriteHTML($filecontent);
		$pdf->Output('invoice.pdf', 'D');

	}	

	public function downloadEstimates(){
		$estimateid = base64_decode($this->uri->segment(3));
		//echo $estimateid;die;
		$whereArr = array('id'=>$estimateid);
		$estimateData = $this->common_model->getData('tbl_estimates',$whereArr);
		$whereArrC = array('id'=>$estimateData[0]->client);
		$clientData = $this->common_model->getData('tbl_clients',$whereArrC);
		$whereArrP = array('id'=>$estimateData[0]->project);
		$projectData = $this->common_model->getData('tbl_project_info',$whereArrP);
		$whereArrU = array('id'=>$clientData[0]->user_id);
		$userData = $this->common_model->getData('tbl_user',$whereArrU);
		$whereArrE = array('estimateid'=>$estimateData[0]->id);
		$itemData = $this->common_model->getData('tbl_products',$whereArrE);
		$estimateDate = date("d-m-Y", strtotime($estimateData[0]->created_at));
		if($estimateData[0]->status == 0){
			$status = $estimateData[0]->status = 'Waiting';
	
		}
		elseif($estimateData[0]->status == 1){
			$status = $estimateData[0]->status = 'Accepted';
			
		}
		elseif($estimateData[0]->status == 2){
			$status = $estimateData[0]->status = 'Declined';
		}
		$this->load->library('Pdf');
		$filecontent = '';
		
	 	

	 	$filecontent.= '<h1 align="center">ESTIMATE</h1>
	 	<table>
			<tr> 
				<th><h3><b>Estimate To:</b></h3></th>
				<th style="text-align:right"><h3><b>Generated By:</b></h3></th>
			</tr><br/>
			<tr>
				<td>'.$clientData[0]->clientname.'</td>
				<td style="text-align:right">'.$clientData[0]->companyname.'</td>
			</tr>
			<tr>
				<td >'.$userData[0]->emailid.'</td>
				<td style="text-align:right">'.$clientData[0]->address.'</td>
			</tr>
			<tr>
				<td>'.$userData[0]->mobile.'</td>
			</tr>	
		</table>
		&#160;
		<hr>  
		&#160;
		<div class="row">
			<div class="col-sm-6">
			<p style="margin-left:10pt;margin-right:0mm; text-indent:0mm; margin-top:0.00mm; margin-bottom:2.11mm;padding-top:0.00mm; padding-bottom:0.00mm; min-height: 7pt; "><font face="Arial" color="#010101"><span dir="ltr" style=" font-size:15pt">Project Name: '.$projectData[0]->projectname.'<br/>
				Estimate Date: '.$estimateDate.'<br/>
				Status: '.$status.'</span></font></p>
			</div>
		</div>
		&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
				<table style="padding-left:20pt;border-collapse: collapse;width:80%;margin-left: 80pt;margin-right: 50pt;font-size: 18pt;text-align: left;">
					<tr style=" padding: 6px;border-bottom: 1px solid #ddd;">
						<th style="background-color: #4CAF50;
  color: white;padding: 15px;">SR No</th>
						<th style="padding-left: 20px;">Item</th>
						<th>Qty/Hrs</th>
						<th>Unit Price</th>
						<th style="background-color: gray;
  color: black;padding: 15px;">Amount</th>
					</tr>';
					$a=1;
		for($i=0;$i<=count($itemData)-1;$i++) {
			
		$filecontent.=	'<tr style=" padding: 8px;text-align: left;border-bottom: 1px solid #ddd;color:#4CAF50;">
						<td style="background-color: #4CAF50;
  color: white;padding: 15px;">'.$a.'</td>
						<td style="padding-left: 20px;">'.$itemData[$i]->item.'</td>
						<td>'.$itemData[$i]->qtyhrs.'</td>
						<td>'.$itemData[$i]->unitprice.'</td>
						<td style="background-color: gray;
  color: black;padding: 15px;">'.$itemData[$i]->amount.'</td>
					</tr>';
			$a++;
			}
		
		$filecontent.=	'<br/>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>Total:</td>
						<td>'.$estimateData[0]->total.'</td>
					</tr>
				</table>';
		
		
		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('Estimate');
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(20);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');

		$pdf->AddPage();

		$pdf->WriteHTML($filecontent);
		$pdf->Output('estimate.pdf', 'D');
	}
}
?>