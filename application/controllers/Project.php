<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	public function __construct(){
		parent::__construct();
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$this->load->model('common_model');
		$this->login = $this->session->userdata('login');
		$this->user_type = $this->login->user_type;
		$this->user_id = $this->login->id;	
		func_check_login();
	}
			
	public function index(){
		$data['category']=$this->common_model->getData('tbl_project_category');
		$whereArr = array('is_deleted'=>0);
		$data['client']=$this->common_model->getData('tbl_clients',$whereArr);

		$this->load->view('common/header');
		$this->load->view('project/project',$data);
		$this->load->view('common/footer');
	}
			
	public function addproject(){
		$data['sessData'] = $this->session->flashdata('data');
		$whereArr = array('is_deleted'=>0);
		$data['client']=$this->common_model->getData('tbl_clients',$whereArr);
		$data['category']=$this->common_model->getData('tbl_project_category');
		$this->load->view('common/header');
		$this->load->view('project/addproject',$data);
		$this->load->view('common/footer');
	}
			
	public function insertproject(){
		if(!empty($_POST))
		{	
			if($this->input->post('manual_timelog')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$timelog=$chk_value;
			
			if($this->input->post('without_deadline')=='on'){
					$without='1';
			}
			else{ $without='0';
			}
			if($this->input->post('project_member')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$member=$chk_value;
			
			/*if($this->input->post('client-view-tasks')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$view=$chk_value;
			
			if($this->input->post('tasks-notification')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}*/
			$tasks=$chk_value;
			$name=$this->input->post('project_name');
			$cat=$this->input->post('project-category');
			$date=$this->input->post('start_date');
			$deadline=$this->input->post('deadline');
			//$without=$this->input->post('without_deadline');
			$editor1=$this->input->post('editor1');
			$notes=$this->input->post('notes');
			$client=$this->input->post('select_client');
			$budget=$this->input->post('project_budget');
			$currency=$this->input->post('currency-id');
			$hours=$this->input->post('hours_allocated');	
			
			$whereArr=array('projectname'=>$name);
			$query=$this->common_model->getData('tbl_project_info',$whereArr);
				if(count($query) == 1){
					$this->session->set_flashdata('message_name', 'Projectname is already exists..');
					$this->session->set_flashdata("data",$_POST);
					redirect('Project/addproject');
				}	
			else{
				$store=array('projectname'=>$name,'projectcategoryid'=>$cat,'startdate'=>$date,'manualtimelog'=>$timelog,
				'projectmember'=>$member,'deadline'=>$deadline,'clientid'=>$client,'withoutdeadline'=>$without,'status'=>0,'projectsummary'=>$editor1,'note'=>$notes,
				'projectbudget'=>$budget,'currency'=>$currency,'hoursallocated'=>$hours,'archive'=>0,'is_deleted'=>0);
				$this->common_model->insertData('tbl_project_info',$store);
				$this->session->set_flashdata('message_name', 'Project Insert sucessfully');
				redirect('Project/index');
			}	
		}
	}
			
	public function projectlist(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'projectname', 'deadline', 'clientid', 'status');
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
				$sWhere.= ' AND (tbl_project_info.projectname like "%'.$searchTerm.'%" OR tbl_project_info.note like "%'.$searchTerm.'%" OR tbl_project_info.clientid like "%'.$searchTerm.'%" OR tbl_project_info.projectsummary like "%'.$searchTerm.'%" OR clientname like "%'.$searchTerm.'%")';
			}
			$status=$_POST['status1'];	
			$client=!empty($_POST['clientname1']) ? $_POST['clientname1'] : '';		
			$category=!empty($_POST['categoryname1']) ? $_POST['categoryname1'] : '';
			if($this->user_type == 1){
			$sWhere.='AND tbl_clients.user_id='.$this->user_id;
			}	
			if(!empty($client)){
					$sWhere.=' AND tbl_project_info.clientid='.$client;
			}
			if(!empty($category)){						
				$sWhere.=' AND projectcategoryid='.$category;
			}
			if($status=='all'){
				}else{
						$sWhere.=' AND tbl_project_info.status='.$status;
				}
				$sWhere.=' AND tbl_project_info.is_deleted=0';
			if(!empty($sWhere)){
				$sWhere = " ".$sWhere;
			}
		}
		if($this->user_type == 0){

			$query = "SELECT tbl_project_info.*,tbl_clients.clientname as clientname,tbl_clients.id as client from tbl_project_info inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
			$projectArr = $this->common_model->coreQueryObject($query);
			$query = "SELECT tbl_project_info.*,tbl_clients.clientname as clientname from tbl_project_info inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id".$sWhere;
			$ProjectFilterArr = $this->common_model->coreQueryObject($query);
			$iFilteredTotal = count($ProjectFilterArr);
			$whereArr = array('is_deleted'=>0);
			$ProjectAllArr = $this->common_model->getData('tbl_project_info',$whereArr);
			$iTotal = count($ProjectAllArr);

		}else if($this->user_type == 1){

			$query = "SELECT tbl_project_info.*,tbl_clients.clientname as clientname from tbl_project_info inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
			$projectArr = $this->common_model->coreQueryObject($query);
			$ProjectFilterArr = $this->common_model->coreQueryObject($query);
			$iFilteredTotal = count($ProjectFilterArr);
			$whereArr = array('is_deleted'=>0);
			$query1 = "SELECT tbl_project_info.*,tbl_clients.clientname as clientname from tbl_project_info inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id".$sWhere;
			$ProjectAllArr = $this->common_model->coreQueryObject($query1);
			$iTotal = count($ProjectAllArr);

			
		}
		else if($this->user_type == 2){
			$whereArr= array('user_id'=>$this->user_id);
			$data['empData']=$this->common_model->getData('tbl_employee',$whereArr);
			//print_r($data['empData']);die;
			$empid=$data['empData']['0']->id;
			$WhereArr1=array('emp_id'=>$empid);
			$data['projectData']=$this->common_model->getData('tbl_project_member',$WhereArr1);	
			//print_r($data['projectData']);die;
			$projectData=$projectallData=array();
			for($i=0;$i<=count($data['projectData'])-1;$i++){
				$pid=$data['projectData'][$i]->project_id;
				$query = "SELECT tbl_project_info.*,tbl_clients.clientname as clientname from tbl_project_info inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id where tbl_project_info.id=".$pid.$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
				//echo $query;die;
								$project = $this->common_model->coreQueryObject($query);
						//$ProjectFilterArr = $this->common_model->coreQueryObject($query);
				if(!empty($project)){
					array_push($projectData,$project[0]);
				}

				$whereArr = array('is_deleted'=>0);
				$query1 ="SELECT tbl_project_info.*,tbl_clients.clientname as clientname from tbl_project_info inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id where tbl_project_info.id=".$pid.$sWhere;
				$project1 = $this->common_model->coreQueryObject($query1);
				if(!empty($project1)){
					array_push($projectallData,$project1[0]);
				}
				
			}
			$projectArr = $projectData;
			$ProjectFilterArr = $projectArr;
			$iFilteredTotal = count($ProjectFilterArr);

			$ProjectAllArr = $projectallData;
			$iTotal = count($ProjectAllArr);

		}
		
		/** Output */
		$datarow = array();
		$i = 1;
		foreach($projectArr as $row) {
			$j=0;
			$clientid = $row->client;
			$whereArr = array('id'=>$clientid);
						$clientData = $this->common_model->getData('tbl_clients',$whereArr);
						$userid = $clientData[$j]->user_id;
			$rowid = $row->id;
			$whereArr = array('project_id' => $rowid);
			$p_member = $this->common_model->getData('tbl_project_member',$whereArr);
			$emp_str = '';

			foreach($p_member as $pm){
				$emp_id = $pm->emp_id;
				$whereArrEmp = array('id' => $emp_id);
				$emp_arr = $this->common_model->getData('tbl_employee',$whereArrEmp);

				if(!empty($emp_arr)){
					$emp_name = substr($emp_arr[0]->employeename,0,1);
					$empfull_name = $emp_arr[0]->employeename;
					$emp_str.= '<abbr title="'.$empfull_name.'"><p class="btn btn-info btn-circle" style="margin:5px;">'.ucfirst($emp_name).'</p></abbr>';
				}
			}

			if($row->status=='1'){
				$status=$row->status='Complete';
				$showStatus = '<label class="label label-success">'.$status.'</label>';
			}
			else if($row->status=='0'){
				$status=$row->status='InComplete';
				$showStatus = '<label class="label label-warning">'.$status.'</label>';
			}
			else if($row->status=='2'){
				$status=$row->status='InProgress';
				$showStatus = '<label class="label label-inprogress">'.$status.'</label>';
			}
			else if($row->status=='3'){
				$status=$row->status='OnHold';
				$showStatus = '<label class="label label-onhold">'.$status.'</label>';
			}
			else{
				$status=$row->status='Canceled';
				$showStatus = '<label class="label label-danger">'.$status.'</label>';
			}

			$archive=$row->archive;
			$st = '';
			$string = '';
			if($archive == '1'){

				$st = 'Archive';
				$string = '<label class="label label-archieve">'.ucfirst($st).'</label>';
				$showStatus='';
			}
			if($this->user_type == 0) { 
				if($archive == '1'){
					$actionstring = 

					'<abbr title="Restore"><a href="javascript:void();" onclick="archivetoproject(\''.base64_encode($rowid).'\');" class="btn btn-info btn-circle revert" data-toggle="tooltip" data-user-id="14" data-original-title="Restore"><i class="fa fa-undo" aria-hidden="true"></i></a></abbr>
					<abbr title="Delete"><a href="javascript:void();" onclick="deleteproject(\''.base64_encode($rowid).'\');"  class="btn btn-danger btn-circle sa-params" data-toggle="tooltip"  data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a></abbr>';
				
				}
				else{
					$actionstring = 

						'<abbr title="Edit"><a href='.base_url().'Project/editproject/'.base64_encode($row->id). ' class="btn btn-info btn-circle" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></abbr>
						<abbr title="View Project Details"><a href='.base_url().'Project/showproject/'.base64_encode($row->id). ' class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Project Details"><i class="fa fa-search" aria-hidden="true"></i></a></abbr>
						<abbr title="Archive"><a href="javascript:void();" onclick="archivedata(\''.base64_encode($rowid).'\');" class="btn btn-warning  btn-circle archive" data-toggle="tooltip" data-user-id="14" data-original-title="Archive"><i class="fa fa-archive" aria-hidden="true"></i></a></abbr>
						<abbr title="Delete"><a href="javascript:void();" onclick="deleteproject(\''.base64_encode($rowid).'\');"  class="btn btn-danger btn-circle sa-params" data-toggle="tooltip"  data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a></abbr>';
				}
			}
			else if($this->user_type == 2) { 
			 	$actionstring = 

			 			'<abbr title="View Project Details"><a href='.base_url().'project/showproject/'.base64_encode($row->id). ' class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Project Details"><i class="fa fa-search" aria-hidden="true"></i></a></abbr>';
			}
			else if($this->user_type == 1){
			 	$actionstring =

			 			'<p><abbr title="View Project Details"><a href='.base_url().'Project/showproject/'.base64_encode($row->id). ' class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Project Details"><i class="fa fa-search" aria-hidden="true"></i></a></abbr></p>';
			}
			if($this->user_type == 0){
				$addMember = "<a href='".base_url()."Project/member/".base64_encode($rowid)."'> <i class='fa fa-plus'></i> Add Project  Members</a>"
				.'<br/>'.$emp_str.'</p>';
			}
			else{
				$addMember = $emp_str;
			}
			if($this->user_type == 0 || $this->user_type == 2){
				if($this->user_type == 0){
					$clientname = "<a href=".base_url()."Clients/viewclientdetail/".base64_encode($userid)."/".base64_encode($clientid).">".$row->clientname."</a>";
					$projectname = "<a href=".base_url()."Project/overView/".base64_encode($row->id).">".$row->projectname."</a>";
				}
				else{
					$clientname = $row->clientname;
					$projectname = $row->projectname;
				}
				
				$datarow[] = array(
				$id = $i,
				$projectname.'<br/>'.$string.'<br/>'.$showStatus,
				$addMember,
				date('d-m-Y', strtotime($row->deadline)),
				$clientname,
				$actionstring
				);
			}else{
				$datarow[] = array(
				$id = $i,
				$row->projectname.'<br/>'.$string.'<br/>'.$showStatus,
				//$addMember,
				date('d-m-Y', strtotime($row->deadline)),
				$actionstring
				);
			}
			$i++;
			$j++;
		}
		$output = array
		(
			"sEcho" => intval($_POST['sEcho']),
				   "iTotalRecords" => $iTotal,
				   "iTotalRecordsFormatted" => number_format($iTotal), //ShowLargeNumber($iTotal),
				   "iTotalDisplayRecords" => $iFilteredTotal,
				   "aaData" => $datarow
		);
		echo json_encode($output);
		exit();
	}
				
	public function deleteproject(){
		$id=base64_decode($_POST['id']);
		$whereArr=array('id'=>$id);
		$updateArr=array('is_deleted'=>1);
		$this->common_model->updateData('tbl_project_info',$updateArr,$whereArr);
		$this->session->set_flashdata('message','Project Delete Succesfully....');
		redirect('project/index');
	}
			
	public function deletetemplate(){
		$id=base64_decode($_POST['id']);
		$whereArr=array('id'=>$id);
		$this->common_model->deleteData('tbl_project_template',$whereArr);
		$this->session->set_flashdata('message','Delete Succesfully....');
		redirect('project/projecttemplate');
	}
			
	public function archivedata(){
		$id=base64_decode($_POST['id']);
		$updateArr = array('archive'=>1);
		$whereArr=array('id'=>$id);
		$data['query']=$this->common_model->updateData('tbl_project_info',$updateArr,$whereArr);
		$this->session->set_flashdata('message_name', 'Archive Sucessfully');
		redirect('project/index');
	}
			
    public function archivetoproject(){
		$id=base64_decode($_POST['id']);
		$updateArr = array('archive'=>0);
		$whereArr=array('id'=>$id);
		$data['query']=$this->common_model->updateData('tbl_project_info',$updateArr,$whereArr);
		redirect('project/index');
	}
	
	public function viewarchiev(){
		$id=base64_decode($_POST['id']);
		$updateArr = array('archive'=>1);
		$whereArr=array('id'=>$id);
		$data['query']=$this->common_model->updateData('tbl_project_info',$updateArr,$whereArr);
		redirect('project/index');
    }


	public function editproject(){	
		$id=base64_decode($this->uri->segment(3));
		$whereArr=array('id'=>$id);
		$data['editId']=$id;
		$data['projectinfo']=$this->common_model->getData('tbl_project_info',$whereArr);
		$data['category']=$this->common_model->getData('tbl_project_category');
		$data['client']=$this->common_model->getData('tbl_clients');
		$this->load->view('common/header');
		$this->load->view('project/editproject',$data);
		$this->load->view('common/footer');
		//echo $this->input->post('manual_timelog');die;
		if($this->input->post('manual_timelog')=='on'){
				$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$timelog=$chk_value;
			if($this->input->post('without_deadline')=='on'){
				$without='1';
			}
			else{ $without='0';
			}
			$timelog=$chk_value;
			if($this->input->post('project_member')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$member=$chk_value;
			
			/*if($this->input->post('client-view-tasks')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$view=$chk_value;*/
			
			/*if($this->input->post('tasks-notification')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$tasks=$chk_value;
			*/
			if(!empty($_POST))
			{	
			$name=$this->input->post('project_name');
			$cat=$this->input->post('project-category');
			$date=$this->input->post('start_date');
			$deadline=$this->input->post('deadline');
			//$without=$this->input->post('without_deadline');
			$editor1=$this->input->post('editor1');
			$notes=$this->input->post('notes');
			$client=$this->input->post('select-client');
			$budget=$this->input->post('project-budget');
			$currency=$this->input->post('currency-id');
			$hours=$this->input->post('hours-allocated');	
			$status=$this->input->post('status');
			$whereArr=array('projectname'=>$name ,'is_deleted!='=>1 ,'id !='=>$id);
			$projectdata=$this->common_model->getData('tbl_project_info',$whereArr);
				
				if(empty($projectdata)){
					$updateArr=array('projectname'=>$name,'projectcategoryid'=>$cat,'startdate'=>$date,'manualtimelog'=>$timelog,
					'projectmember'=>$member,'deadline'=>$deadline,'clientid'=>$client,'withoutdeadline'=>$without,'status'=>$status,'projectsummary'=>$editor1,'note'=>$notes,
					'projectbudget'=>$budget,'currency'=>$currency,'hoursallocated'=>$hours,'archive'=>0);
					$whereArr=array('id'=>$id);
					//print_r($updateArr);
					//echo "<PRE>";print_r($updateArr);die;
					$this->common_model->updateData('tbl_project_info',$updateArr,$whereArr);
					$this->session->set_flashdata('message_name', 'Projects Updated sucessfully');
					redirect('project/index');
					
				}	
				else{
					$this->session->set_flashdata('message_name', 'Projectname is already exists..');
					$this->session->set_flashdata("sessData",$_POST);
					redirect('Project/editproject/'.$this->uri->segment(3));
				}
			
			
		}			
	}

	public function showproject(){
		$id=base64_decode($this->uri->segment(3));
		//$id1=base64_decode($this->uri->segment(4));
		$whereArr=array('id'=>$id);
		//$whereArr1=array('id'=>$id1);
		$data['projectlist']=$this->common_model->getData('tbl_project_info',$whereArr);
		$data['pro_category']=$this->common_model->getData('tbl_project_category',$whereArr);
		$query = "SELECT * FROM tbl_project_info inner join tbl_clients on tbl_project_info.clientid =tbl_clients.id where tbl_project_info.id=".$id;
		$data['pro_client']=$this->common_model->coreQueryObject($query,$whereArr);
		$this->load->view('common/header');
		$this->load->view('project/viewproject',$data);
		$this->load->view('common/footer');
	}
		
	public function edittemplate(){
		$id=base64_decode($this->uri->segment(3));
		$whereArr=array('id'=>$id);
		$data['editId']=$id;
		$data['templateinfo']=$this->common_model->getData('tbl_project_template',$whereArr);
		$data['category']=$this->common_model->getData('tbl_project_category');
		$this->load->view('common/header');
		$this->load->view('project/edittemplate',$data);
		$this->load->view('common/footer');
		if($this->input->post('manual_timelog')=='1'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$timelog=$chk_value;
			
			if($this->input->post('client-view-tasks')=='1'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$view=$chk_value;
			
			if($this->input->post('tasks-notification')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$tasks=$chk_value;
		
		if($this->input->post('btnupdate')){
			$name=$this->input->post('project_name');
			$cat=$this->input->post('project-category');
			$summary=$this->input->post('editor1');
			$note=$this->input->post('notes');
			$updateArr=array('projectname'=>$name,'projectcategory'=>$cat,'manualtimelog'=>$timelog,'viewtask'=>$view,'projectsummary'=>$summary,'note'=>$note,'tasknotification'=>$tasks);
			$whereArr=array('id'=>$id);
			//echo "<pre>";print_r($_POST);die;
			$this->common_model->updateData('tbl_project_template',$updateArr,$whereArr);
			$this->session->set_flashdata('message_name', 'Template Update sucessfully');
			redirect('project/projecttemplate');
		}
	}
			
	public function deletearchiev(){
		$id=base64_decode($this->uri->segment(3));
		$deleteArr=array('id'=>$id);
		$this->common_model->deleteData('tbl_project_info',$deleteArr);
		$this->session->set_flashdata('message','Delete Succesfully....');
		redirect('project/viewarchiev');
	}
	
	public function projecttemplate(){
			$this->load->view('common/header');
			$this->load->view('project/projecttemplate');
			$this->load->view('common/footer');	
	}
		
	public function addtemplate(){
			$data['category']=$this->common_model->getData('tbl_project_category');
			$this->load->view('common/header');
			$this->load->view('project/addtemplate',$data);
			$this->load->view('common/footer');	
	}
			
	public function inserttemplate(){
		if(!empty($_POST)){
			if($this->input->post('manual_timelog')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$timelog=$chk_value;
			
			if($this->input->post('client-view-tasks')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$view=$chk_value;
			
			if($this->input->post('tasks-notification')=='on'){
					$chk_value='1';
			}
			else{ $chk_value='0';
			}
			$tasks=$chk_value;
			$name=$this->input->post('project_name');
			$cat=$this->input->post('project-category');
			$editor=$this->input->post('editor1');
			$note=$this->input->post('notes');
			$insertArr=array('projectname'=>$name,'projectcategory'=>$cat,'manualtimelog'=>$timelog,
			'viewtask'=>$view,'projectsummary'=>$editor,'note'=>$note,'tasknotification'=>$tasks);
			$this->common_model->insertData('tbl_project_template',$insertArr);
			$whereArr=array('id'=>$id);
			$this->session->set_flashdata('message_name','Template Inserted Succesfully....');
			redirect('Project/projecttemplate');				
		}
	}
			
	public function templatelist(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'projectname', 'projectmember' , 'projectcategory');
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
					//$sWhere .= ' AND (companyname like "%'.$searchTerm.'%" OR website like "%'.$searchTerm.'%" OR address like "%'.$searchTerm.'%" OR clientname like "%'.$searchTerm.'%" OR clientemail like "%'.$searchTerm.'%" OR note like "%'.$searchTerm.'%")';
					$sWhere.= ' AND (tbl_project_template.projectname like "%'.$searchTerm.'%" OR tbl_project_category.name like "%'.$searchTerm.'%")';
				}
				if(!empty($sWhere)){
					$sWhere = " WHERE 1 ".$sWhere;
				}
				/** Filtering End */
				}
			
				$query = "SELECT tbl_project_template.*,tbl_project_category.name from tbl_project_template INNER JOIN tbl_project_category on tbl_project_template.projectcategory = tbl_project_category.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
				$templateArr = $this->common_model->coreQueryObject($query);
				//echo($query);die;
				$query = "SELECT tbl_project_template.*,tbl_project_category.name from tbl_project_template INNER JOIN tbl_project_category on tbl_project_template.projectcategory = tbl_project_category.id".$sWhere;
				$TemplateFilterArr = $this->common_model->coreQueryObject($query);
				$iFilteredTotal = count($TemplateFilterArr);
				$TemplateAllArr = $this->common_model->getData('tbl_project_template');
				$iTotal = count($TemplateAllArr);
			
				/** Output */
				$datarow = array();
				$i = 1;
				//$empFullname = '';
				foreach($templateArr as $row) {
					$rowid = $row->id;
					$whereArr = array('template_id' => $rowid);
					$temp_member = $this->common_model->getData('tbl_template_member',$whereArr);
					$emp_str = '';
					foreach($temp_member as $temp){
					$emp_id = $temp->emp_id;
					$whereArrEmp = array('id' => $emp_id);
					$emp_arr = $this->common_model->getData('tbl_employee',$whereArrEmp);
					$emp_name = substr($emp_arr[0]->employeename,0,1);
					//echo $emp_name;
					$empFullname = $emp_arr[0]->employeename;
					//echo $empFullname;
					$emp_str.= '<abbr title="'.$empFullname.'"><p class="btn btn-info btn-circle" style="margin:5px;">'.ucfirst($emp_name).'</p></abbr>';
					}	
					$datarow[] = array(
						$id = $i,
						$row->projectname,
						"<a href='".base_url()."Project/templateMember/".base64_encode($rowid)."'> <i class='fa fa-plus'></i> Add Template  Members</a>".'<br/>'.$emp_str,
						$row->name,
						'<a href='.base_url().'Project/edittemplate/'.base64_encode($row->id). ' class="btn btn-info btn-circle" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						 <a href='.base_url().'Project/searchproject/'.base64_encode($row->id). ' class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Project Details"><i class="fa fa-search" aria-hidden="true"></i></a>
						 <a href="javascript:void();" onclick="deletetemplate(\''.base64_encode($rowid).'\');"  class="btn btn-danger btn-circle sa-params" data-toggle="tooltip"  data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>'
					);
					$i++;
					}
					$output = array(
							   "sEcho" => intval($_POST['sEcho']),
							   "iTotalRecords" => $iTotal,
							   "iTotalRecordsFormatted" => number_format($iTotal), //ShowLargeNumber($iTotal),
							   "iTotalDisplayRecords" => $iFilteredTotal,
							   "aaData" => $datarow
							);
		echo json_encode($output);
		exit();
	}

	public function templateOverView(){
		$data['id'] = base64_decode($this->uri->segment(3));
		$where = array('id' => $data['id']);
		$data['template'] = $this->common_model->getData('tbl_project_template',$where);
		$memberQue = "SELECT tbl_employee.*,tbl_template_member.*,tbl_user.* from tbl_employee inner join  tbl_template_member on tbl_employee.id = tbl_template_member.emp_id 
			inner join tbl_user on tbl_employee.user_id = tbl_user.id 
			where tbl_template_member.template_id=".$data['id'];
		$data['templateMember'] = $this->common_model->coreQueryObject($memberQue);
		$this->load->view('common/header');
		$this->load->view('project/searchtemplate',$data);
		$this->load->view('common/footer');
	}

	public function templateMember(){
		$data['id'] = base64_decode($this->uri->segment(3));
		//echo $data['id'];die;
		$sql = "SELECT tbl_template_member.id as memberid,tbl_template_member.emp_id, tbl_employee.id ,tbl_employee.employeename,tbl_employee.user_id as empid from tbl_template_member inner join tbl_employee on tbl_template_member.emp_id = tbl_employee.id where template_id =".$data['id'];
		$data['temp_member'] = $this->common_model->coreQueryObject($sql);
		$data['emp_count'] = count($data['temp_member']);
		$data['employee'] = $this->common_model->getData('tbl_employee');
		$this->load->view('common/header');
		$this->load->view('project/searchtemplate',$data);
		$this->load->view('common/footer');
	}

	public function insertcat(){
		if(!empty($_POST)){
			$catname = $this->input->post('name');
			$insArr = array('name'=>$catname);
			$lastinsertid=$this->common_model->insertData('tbl_project_category',$insArr);
			$catArray = $this->common_model->getData('tbl_project_category');
			$str = '';
			foreach($catArray as $row){
				$str.='<option value="'.$row->id.'">'.$row->name.'</option>'; 
			}
			$sucessmsg = 'Category Added Succesfully';
			$totaldata = count($catArray);
			$catArr = array();
			$catArr['count'] = $totaldata;
			$catArr['catdata'] = $str;
			$catArr['sucessmsg'] = $sucessmsg;
			$catArr['lastinsertid']= $lastinsertid;
			//print_r($catArr);die;
			echo json_encode($catArr);exit; 
		}
	}
			
	public function deletecat(){
		$status = 0;
		if(!empty($_POST['id'])){
			$id=$this->input->post('id');
			$deleteArr=array('id'=>$id);
			$this->common_model->deleteData('tbl_project_category',$deleteArr);
			$status = 1;
		}
		echo $status;exit();
	}	

	public function checkcategory(){
		$status = 0;
		if(!empty($_POST['category'])){
			$where = array('name'=>$_POST['category']);
			$checkData = $this->common_model->getData('tbl_project_category',$where);
			if(!empty($checkData)){
				$status = 1;
			}
		}
		echo $status;exit();
	}

	public function insertProjectMember(){
		if(!empty($_POST)){
			$data['employee'] = $this->input->post('choose_member');
			 
			$emp_count = count($data['employee']);
			$project_id = $this->input->post('projectid');
			for($i=0 ; $i<$emp_count; $i++){
				$emp_id = $data['employee'][$i];
				$whereEmp = array('id' => $emp_id);
				$empname = $this->common_model->getData('tbl_employee', $whereEmp);
				$whereArr = array('emp_id' => $emp_id , 'project_id' => $project_id);
				$projectM = $this->common_model->getData('tbl_project_member', $whereArr);
				if(count($projectM) == 1){
					$this->session->set_flashdata('message_name', 'Alredy add '.$empname[0]->employeename);
				}
				else{
					$insArr = array('project_id' => $project_id , 'emp_id' => $emp_id);
					$this->common_model->insertData('tbl_project_member',$insArr);
				}

			}
			redirect('Project/member/'.$this->uri->segment(3));
		}
		redirect('Project/member/'.$this->uri->segment(3));
	}

	public function insertTemplateMember(){
		if(!empty($_POST)){
			$data['employee'] = $this->input->post('choose_member');
			$emp_count = count($data['employee']);
			$template_id = $this->input->post('templateid');
			for($i=0 ; $i<$emp_count; $i++){
				$emp_id = $data['employee'][$i];
				$whereEmp = array('id' => $emp_id);
				$empname = $this->common_model->getData('tbl_employee', $whereEmp);
				$whereArr = array('emp_id' => $emp_id , 'template_id' => $template_id);
				$projectM = $this->common_model->getData('tbl_template_member', $whereArr);
				if(count($projectM) == 1){
					$this->session->set_flashdata('message_name', 'Already add '.$empname[0]->employeename);
					
				}
				else{
					$insArr = array('template_id' => $template_id , 'emp_id' => $emp_id);
					$this->common_model->insertData('tbl_template_member',$insArr);
				}
			}
			redirect('Project/templateMember/'.$this->uri->segment(3));
		}
		redirect('Project/templateMember/'.$this->uri->segment(3));
	}

	public function deletetemplateM(){
		$id = base64_decode($_POST['id']);
		$whereArr = array('id' => $id);
		$this->common_model->deleteData('tbl_template_member',$whereArr);
	}
	
	public function deleteprojectM(){
		$id = base64_decode($_POST['id']);
		$whereArr = array('id' => $id);
		$this->common_model->deleteData('tbl_project_member',$whereArr);
	}

	public function overView(){
		$data['id'] = base64_decode($this->uri->segment(3));
		$sql = "SELECT tbl_project_info.*,tbl_clients.* from tbl_project_info inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id where tbl_project_info.id=".$data['id'];
		$data['client'] = $this->common_model->coreQueryObject($sql);
		$where = array('id'=>$data['client'][0]->user_id);
		$data['clientEmail'] = $this->common_model->getData('tbl_user',$where);
		$memberQue = "SELECT tbl_employee.*,tbl_project_member.*,tbl_user.* from tbl_employee inner join  tbl_project_member on tbl_employee.id = tbl_project_member.emp_id 
			inner join tbl_user on tbl_employee.user_id = tbl_user.id 
			where tbl_project_member.project_id=".$data['id'];
		$whereArr = array('projectid'=>$data['id'],'status!='=>3);
		$data['taskArr'] = $this->common_model->getData('tbl_task',$whereArr);
		$data['projectMember'] = $this->common_model->coreQueryObject($memberQue);
		$this->load->view('common/header');
		$this->load->view('project/searchproject',$data);
		$this->load->view('common/footer');
	}


	public function member(){
		$data['id'] = base64_decode($this->uri->segment(3));
		$sql = "SELECT tbl_project_member.id as memberid , tbl_project_member.emp_id , tbl_employee.id ,tbl_employee.employeename,tbl_employee.designation,tbl_employee.user_id as empid from tbl_project_member inner join tbl_employee on tbl_project_member.emp_id = tbl_employee.id where project_id =".$data['id'];
		$data['member'] = $this->common_model->coreQueryObject($sql);
		$designationData = array();
		for($i=0;$i<=count($data['member'])-1;$i++){
			$where = array('id'=>$data['member'][$i]->designation);
			$designation = $this->common_model->getData('tbl_designation',$where);
			array_push($designationData,$designation[0]);
		}
		$data['allDes'] = $designationData;
		//echo "<PRE>";print_r($data['allDes']);die;
		$data['emp_count'] = count($data['member']);
		$data['employee'] = $this->common_model->getData('tbl_employee');
		$this->load->view('common/header');
		$this->load->view('project/searchproject',$data);
		$this->load->view('common/footer');
	}

	public function task(){
		$data['id'] = base64_decode($this->uri->segment(3));
		$data['taskCat'] = $this->common_model->getData('tbl_task_category');
		$data['employee'] = $this->common_model->getData('tbl_employee');
		$this->load->view('common/header');
		$this->load->view('project/searchproject',$data);
		$this->load->view('common/footer');
	}

	public function insert_task_category(){
		if(!empty($_POST)){
			$task_cat = $this->input->post('task_cat_name');
			$insArr = array('task_category_name' => $task_cat);
			$lastTaskCatinsertid = $this->common_model->insertData('tbl_task_category',$insArr);
			$task_catArray = $this->common_model->getData('tbl_task_category');
			$str = '';
			foreach($task_catArray as $taskCat){
				$str.= '<option value="'.$taskCat->id.'">'.$taskCat->task_category_name.'</option>';
			}
			$sucessmsg = "Category Added Sucessfully";
			$totalCatdata = count($task_catArray);
			$task_CatArr = array();
			$task_CatArr['count'] = $totalCatdata;
			$task_CatArr['task_cat'] = $str;
			$task_CatArr['sucessmsg'] = $sucessmsg;
			$task_CatArr['lastTaskCatinsertid'] =  $lastTaskCatinsertid;
			echo json_encode($task_CatArr);exit();
		}
	}

	public function deletetaskCat(){
		$status = 0;
		if(!empty($_POST['id'])){
			$id=$this->input->post('id');
			$deleteArr=array('id'=>$id);
			$this->common_model->deleteData('tbl_task_category',$deleteArr);
			//echo $this->db->last_query();die;
			$status = 1;
		}
		echo $status;exit();
	}

	public function getTaskCategory(){
		$catArray = $this->common_model->getData('tbl_task_category');
			$str = '';
			foreach($catArray as $row){
				$str.='<option value="'.$row->id.'">'.$row->task_category_name.'</option>'; 
			}
			$catArr['catdata'] = $str;
			echo json_encode($catArr);exit; 
	}
	

	public function insertTask(){
		$test = base64_decode($this->uri->segment(3));
		if(!empty($_POST)){
			$title = $this->input->post('title_task');
			$projectid = $this->input->post('projectid');
			$description = $this->input->post('editor1');
			//echo $description;die;
			$startdate = $this->input->post('startdate');
			$duedate = $this->input->post('due_date');
			$assignemp = $this->input->post('assignemp');
			$taskcategory = $this->input->post('task-category');
			$priority = $this->input->post('radio-stacked');
			$insArr = array('projectid' => $projectid, 'title' => $title , 'description' => $description , 'startdate' => $startdate , 'duedate' => $duedate , 'assignedto' => $assignemp , 'taskcategory' => $taskcategory , 'status' => 0, 'priority' => $priority);
			$this->common_model->insertData('tbl_task',$insArr);
			$this->session->set_flashdata('message_name', 'Task Insert sucessfully');
			if($test == 'project'){
				redirect('project/task/'.base64_encode($projectid));
			}
			else{
				redirect('task');
			}
		}
	}

	public function task_list(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'title','projectid','assignedto', 'duedate', 'status');
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
                //echo $sLimit;die;
                $sOffset = (int) $_GET['iDisplayStart'];
                //echo $sOffset;die;
            } else {
                $sLimit = 10;
                //echo $sLimit;die;
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
            	$sWhere .= ' AND (title like "%'.$searchTerm.'%" OR description like "%'.$searchTerm.'%" OR tbl_task.startdate like "%'.$searchTerm.'%" OR tbl_task.duedate like "%'.$searchTerm.'%" OR tbl_employee.employeename like "%'.$searchTerm.'%" OR tbl_clients.clientname like "%'.$searchTerm.'%" OR tbl_project_info.projectname like "%'.$searchTerm.'%")';
            }
            $project = !empty($_POST['project']) ? $_POST['project'] : '';
            $employee = !empty($_POST['employee']) ? $_POST['employee'] : '';
            $status = $_POST['status'];
            $taskcategory = !empty($_POST['taskcategory']) ? $_POST['taskcategory'] : '';
            $clientName = !empty($_POST['client']) ? $_POST['client'] : ''; 
            $startdate = !empty($_POST['startdate']) ? $_POST['startdate'] : '';
            $enddate = !empty($_POST['enddate']) ? $_POST['enddate'] : '';
            $hideComplete = $_POST['hideComplete'];
            if(strtolower($this->uri->segment(3))=='task'){
	            if($project == 'all'){
	            }
	            else{
	            	$sWhere.=' AND  projectid='.$project;
	            }
	            if($this->user_type == 0){
	            	if($employee == 'all'){
	            }
		            else{
		            	$sWhere.=' AND  assignedto='.$employee;
		            }	
	            }
	            if(!empty($clientName)){
	            	if($clientName == 'all'){
	            	}
		            else {
		            	$sWhere.=' AND  clientid='.$clientName;
		            }
	            }
	            
	            if($status == 'all'){
	            }
	            else{
	            	$sWhere.=' AND  tbl_task.status='.$status;
	            }
	            if($taskcategory == 'all'){
	            }
	            else{
	            	$sWhere.=' AND  taskcategory='.$taskcategory;
	            }
	            if(!empty($startdate)){						
						$sWhere.=' AND tbl_task.startdate>="'.$startdate.'"';
				}
				if(!empty($enddate)){						
					$sWhere.=' AND tbl_task.duedate<="'.$enddate.' 23:59:00'.'"';
				}
				if($hideComplete == 1){
					$sWhere.=' AND tbl_task.status != 3';
				}
				
	        }
	        if($this->user_type == 2){
	        	$sWhere.= " AND tbl_employee.user_id =".$this->user_id;
	        }
            if(!empty($sWhere)){
            	$sWhere = " WHERE 1 ".$sWhere;
            }
            /** Filtering End */
		}
		if($this->user_type == 0){
			$query = "SELECT tbl_task.* , tbl_employee.employeename,tbl_employee.user_id as empid,tbl_clients.clientname,tbl_clients.id as client,tbl_project_info.clientid,tbl_project_info.projectname ,tbl_project_info.id as pid from tbl_task inner JOIN tbl_employee on tbl_task.assignedto = tbl_employee.id inner join tbl_project_info on tbl_task.projectid = tbl_project_info.id inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id ".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
	    
			$taskArr = $this->common_model->coreQueryObject($query);
			$query = "SELECT tbl_task.* , tbl_employee.employeename,tbl_employee.user_id as empid,tbl_clients.clientname,tbl_project_info.clientid,tbl_project_info.projectname,tbl_project_info.id as pid from tbl_task inner JOIN tbl_employee on tbl_task.assignedto = tbl_employee.id inner join tbl_project_info on tbl_task.projectid = tbl_project_info.id inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id ".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
			//echo $query;die;
		$taskFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($taskFilterArr);
		$taskAllArr = $this->common_model->getData('tbl_task');
		$iTotal = count($taskAllArr);
		}
		else if($this->user_type == 2){

			$query = "SELECT tbl_task.* , tbl_employee.employeename,tbl_employee.user_id as empid,tbl_clients.clientname,tbl_clients.clientname,tbl_clients.id as client,tbl_project_info.clientid,tbl_project_info.projectname ,tbl_project_info.id as pid from tbl_task inner JOIN tbl_employee on tbl_task.assignedto = tbl_employee.id inner join tbl_project_info on tbl_task.projectid = tbl_project_info.id inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
			//echo $query;die;
			$taskArr = $this->common_model->coreQueryObject($query);

			$filterQuery = "SELECT tbl_task.* , tbl_employee.employeename,tbl_employee.user_id as empid,tbl_clients.clientname,tbl_project_info.clientid,tbl_project_info.projectname ,tbl_project_info.id as pid from tbl_task inner JOIN tbl_employee on tbl_task.assignedto = tbl_employee.id inner join tbl_project_info on tbl_task.projectid = tbl_project_info.id inner join tbl_clients on tbl_project_info.clientid = tbl_clients.id ".$sWhere;

			$taskFilterArr = $this->common_model->coreQueryObject($filterQuery);
			$iFilteredTotal = count($taskFilterArr);
			$taskAllArr = $this->common_model->coreQueryObject($filterQuery);
			$iTotal = count($taskAllArr);
		}
		/** Output */
		$datarow = array();
		$i = 1;
		
		$str = '';
		foreach($taskArr as $row) {
			$j=0;
			$clientid = $row->client;
			$whereArr = array('id'=>$clientid);
						$clientData = $this->common_model->getData('tbl_clients',$whereArr);
						$userid = $clientData[$j]->user_id;
			if($row->status == 0){
				$status = $row->status = 'Incomplete';
				$str = '<label class="label label-warning">'.$status.'</label>';
			}
			elseif($row->status == 1){
				$status = $row->status = 'To Do';
				$str = '<label class="label label-onhold">'.$status.'</label>';
			}
			elseif($row->status == 2){
				$status = $row->status = 'Doing';
				$str = '<label class="label label-inprogress">'.$status.'</label>';
			}
			elseif($row->status == 3){
				$status = $row->status = 'Completed';
				$str = '<label class="label label-success">'.$status.'</label>';
			}
			$actionStr="";
				if(strtolower($this->uri->segment(3))=='project'){
					$actionStr.= '<abbr title="Edit"><a href="javascript:;" onclick="updateTask(\''.base64_encode($row->id).'\')" class="btn btn-info btn-circle edit-task" data-toggle="tooltip" data-task-id="69" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></abbr> &nbsp;';
				}else{
					$actionStr.= '<abbr title="Edit"><a href='.base_url().'task/edittask/'.base64_encode($row->id).' class="btn btn-info btn-circle edit-task" data-task-id="69" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></abbr> &nbsp;';
				}
				$actionStr.='<abbr title="Delete"><a href="javascript:;" class="btn btn-danger btn-circle sa-params" data-toggle="tooltip" data-task-id="69" data-original-title="Delete" onclick="deleteTask(\''.$row->id.'\')"><i class="fa fa-times" aria-hidden="true"></i></a></abbr>';
				//echo $actionStr;die;
				$projectname = "<a href=".base_url()."Project/overView/".base64_encode($row->pid).">".$row->projectname."</a>";
				$clientname = "<a href=".base_url()."Clients/viewclientdetail/".base64_encode($userid)."/".base64_encode($clientid).">".$row->clientname."</a>";
				//echo $row->empid;die;
				$employeename = "<a href=".base_url()."employee/viewemployee/".base64_encode($row->empid).">".$row->employeename."</a>";
			if($this->user_type == 0){
				$datarow[] = array(
					$id = $i,
	                $row->title,
	                $projectname,
	                $employeename,
	                $clientname,
	                date('d-m-Y', strtotime($row->duedate)),
					$str,
					$actionStr
	        );
			}
			else{
				$datarow[] = array(
					$id = $i,
	                $row->title,
	                $row->projectname,
	                $row->clientname,
					date('d-m-Y', strtotime($row->duedate)),
					$str,
					$actionStr
	        );
			}
	        
	        $i++;
	        $j++;
      	}
        //echo "<PRE>";print_r($datarow);die;
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

	public function checkTaskCategory(){
		$status = 0;
		if(!empty($_POST['task_cat_name'])){
			$where = array('task_category_name' => $_POST['task_cat_name']);
			$checkData = $this->common_model->getData('tbl_task_category',$where);
			if(!empty($checkData)){
				$status = 1;
			}
		}
		echo $status;exit();
	}	

	public function updateTask(){
		$id = base64_decode($_POST['id']);
		$whereArr = array('id' => $id);
		$taskData = $this->common_model->getData('tbl_task' , $whereArr);
		$data['EmpData'] = $this->common_model->getData('tbl_employee');
		$taskCat = $this->common_model->getData('tbl_task_category');
		$taskUpdateArr = array();
		$taskUpdateArr['id'] = $taskData[0]->id;
		$taskUpdateArr['title_task'] = $taskData[0]->title;
		$taskUpdateArr['description'] = $taskData[0]->description;
		$taskUpdateArr['startdate'] = $taskData[0]->startdate;
		$taskUpdateArr['duedate'] = $taskData[0]->duedate;
		$taskUpdateArr['SelEmp'] = $taskData[0]->assignedto;
		$taskUpdateArr['SelTaskCat'] = $taskData[0]->taskcategory;
		$taskUpdateArr['status'] = $taskData[0]->status;
		$taskUpdateArr['priority'] = $taskData[0]->priority;
		//print_r($taskUpdateArr['SelEmp']);die;
		echo json_encode($taskUpdateArr);exit;
	}

	public function updateTaskData(){
		$id = $_POST['id'];
		$title = $_POST['title_task'];		
		$projectid = $_POST['projectid'];
		$description = $_POST['description'];
		$startdate = $_POST['start_date'];
		$duedate = $_POST['deadline'];
		$assignemp = $_POST['assignemp'];
		$taskcategory = $_POST['task_category'];
		$status = $_POST['status'];
		$priority = $_POST['priority'];
		$whereArr = array('id' => $id);
		$updateArr = array('projectid' => $projectid, 'title' => $title , 'description' => $description , 'startdate' => $startdate , 'duedate' => $duedate , 'assignedto' => $assignemp , 'taskcategory' => $taskcategory , 'status' => $status, 'priority' => $priority);
		//print_r($updateArr);die;
		$this->common_model->updateData('tbl_task',$updateArr,$whereArr);
		redirect('project/task/'.base64_encode($projectid));
	}

	public function delete_Task(){
		if(!empty($_POST['id'])){	
			$id = $_POST['id'];
			$deleteArr = array('id'=>$id);
			$this->common_model->deleteData('tbl_task',$deleteArr);
		}
	}
	public function getcategory(){
		
		$catArray = $this->common_model->getData('tbl_project_category');
			$str = '';
			foreach($catArray as $row){
				$str.='<option value="'.$row->id.'">'.$row->name.'</option>'; 
			}
			
			
			$catArr['catdata'] = $str;
			
			//print_r($catArr);die;
			echo json_encode($catArr);exit; 
		}
	public function invoices(){
		$data['id'] = base64_decode($this->uri->segment(3));
		$whereArr = array('project'=>$data['id']);
		$data['invoiceData'] = $this->common_model->getData('tbl_invoice',$whereArr);
		$this->load->view('common/header');
		$this->load->view('project/searchproject',$data);
		$this->load->view('common/footer');
	}
	public function timelogs(){
		$data['id'] = base64_decode($this->uri->segment(3));
		$whereArr = array('timelogprojectid'=>$data['id']);
		$employeeData = array();
		$data['timelogData'] = $this->common_model->getData('tbl_timelog',$whereArr);
		for($i=0;$i<=count($data['timelogData'])-1;$i++){
			$where = array('id'=>$data['timelogData'][$i]->timelogemployeeid);
			$employee = $this->common_model->getData('tbl_employee',$where); 
			array_push($employeeData,$employee[0]);
		}
		$data['allEmployee'] = $employeeData;
		$this->load->view('common/header');
		$this->load->view('project/searchproject',$data);
		$this->load->view('common/footer');
	}


}

