<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TaskReport extends CI_Controller {

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
		$data['startdate']=date('Y-m-d',strtotime('-1 month'));
		$data['enddate']=date('Y-m-d');
		$whereArr = array('is_deleted'=>0);
		$data['allEmpData'] = $this->common_model->getData('tbl_employee',$whereArr);
		$data['allProjectData'] = $this->common_model->getData('tbl_project_info',$whereArr);
		$data['Chart']=$this->common_model->getData('tbl_task');
		
		$this->load->view('common/header');
		$this->load->view('report/taskreport',$data);
		$this->load->view('common/footer');
	}
	
	public function taskreportlist(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'projectid', 'title', 'duedate', 'assignedto','status');
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
				$sWhere.= ' AND (tbl_project_info.projectname like "%'.$searchTerm.'%" OR tbl_task.duedate like "%'.$searchTerm.'%" OR tbl_task.assignedto like "%'.$searchTerm.'%" OR tbl_task.title like "%'.$searchTerm.'%" OR tbl_task.status like "%'.$searchTerm.'%")';
			}
			
			if(!empty(trim($_POST['startdate']))){
				$startdate=!empty($_POST['startdate']) ? $_POST['startdate'] : '';
			}else{
				$startdate=date('Y-m-d',strtotime('-1 month'));
			}
			if(!empty(trim($_POST['enddate']))){ 
				$enddate=!empty($_POST['enddate']) ? $_POST['enddate'] : '';
			}else{
				$enddate=date('Y-m-d');
			}
			/*
			$startdate=!empty($_POST['startdate']) ? $_POST['startdate'] : '';
			$enddate=!empty($_POST['enddate']) ? $_POST['enddate'] : '';*/
			$pname=!empty($_POST['project']) ? $_POST['project'] : '';	
			$ename=!empty($_POST['empdata']) ? $_POST['empdata'] : '';
		
			if(!empty($startdate)){						
				$sWhere.=' AND tbl_task.startdate>="'.$startdate.'"';
			}
			if(!empty($enddate)){						
				$sWhere.=' AND tbl_task.duedate <="'.$enddate.'"';
			}
			if(!empty($pname)){
				$sWhere.=' AND tbl_task.projectid='.$pname;
			}
			if(!empty($ename)){						
				$sWhere.=' AND tbl_task.assignedto='.$ename;
			}
			if(!empty($sWhere)){
				$sWhere = " WHERE 1 ".$sWhere;
			}
			
		}
		$query = "SELECT tbl_project_info.projectname,tbl_project_info.id as pid,tbl_task.*,tbl_employee.employeename,tbl_employee.user_id as empid FROM `tbl_task` inner join tbl_project_info on tbl_task.projectid = tbl_project_info.id inner join tbl_employee on tbl_task.assignedto =tbl_employee.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		//echo $query;
		$taskReportArr = $this->common_model->coreQueryObject($query);
		//print_r($taskReportArr);die;
		$query = "SELECT tbl_project_info.projectname,tbl_project_info.id as pid,tbl_task.*,tbl_employee.employeename FROM `tbl_task` inner join tbl_project_info on tbl_task.projectid = tbl_project_info.id inner join tbl_employee on tbl_task.assignedto =tbl_employee.id".$sWhere;

		$TimeFilterArr = $this->common_model->coreQueryObject($query);
		//echo $this->db->last_query();die;
		$iFilteredTotal = count($TimeFilterArr);
		$taskReportAllArr = $this->common_model->getData('tbl_task');
		$iTotal = count($taskReportAllArr);
		
		/** Output */
		$datarow = array();

		$i = 1;

		foreach($taskReportArr as $row) {
			$rowid = $row->id;

			if($row->status=='0'){
					$status=$row->status='Incomplete';
					$showStatus = '<label class="label label-danger">'.$status.'</label>';
			}
			else if($row->status=='1'){
					$status=$row->status='Todo';
					$showStatus = '<label class="label label-onhold">'.$status.'</label>';
			}
			else if($row->status=='2'){
					$status=$row->status='Doing';
					$showStatus = '<label class="label label-inprogress">'.$status.'</label>';
			}
			
			else if($row->status=='3'){
					$status=$row->status='Done';
					$showStatus = '<label class="label label-success">'.$status.'</label>';
			}
			
			else if($row->status=='4'){
					$status=$row->status='Completed';
					$showStatus = '<label class="label label-danger">'.$status.'</label>';
			}
			$employeename = "<a href=".base_url()."employee/viewemployee/".base64_encode($row->empid).">".$row->employeename."</a>";
			 $projectname = "<a href=".base_url()."Project/overView/".base64_encode($row->pid).">".$row->projectname."</a>";
		$datarow[] = array(
			$id = $i,
			$projectname,
			$row->title,
			date('d-m-Y', strtotime($row->duedate)),
			$employeename,
			$showStatus,
			);
			$i++;
		}
	$ChartQuery = "SELECT tbl_project_info.projectname,tbl_task.*,tbl_employee.employeename FROM `tbl_task` inner join tbl_project_info on tbl_task.projectid = tbl_project_info.id inner join tbl_employee on tbl_task.assignedto =tbl_employee.id".$sWhere;
	//echo $ChartQuery;die;
	$Chart = $this->common_model->coreQueryObject($ChartQuery);
	$incpm = $todo = $doing = $complete = 0;
		foreach ($Chart as $pie) {
			if($pie->status==0){
				$incpm = $incpm+1;
			}
			if($pie->status==1){
				$todo = $todo+1;
			}
			if($pie->status==2){
				$doing=$doing+1;
			}
			if($pie->status==3){
				$complete=$complete+1;
			}
		}
	$data['complete'] = $complete;
    $data['doing'] = $doing;
    $data['todo'] = $todo;
    $data['incpm'] = $incpm;
		$output = array
		(
			"sEcho" => intval($_POST['sEcho']),
			"graphstr"=> $data,
					//"corequery"=>$corequery,
				   "iTotalRecords" => $iTotal,
				   "iTotalRecordsFormatted" => number_format($iTotal), 
				   //ShowLargeNumber($iTotal),
				   "iTotalDisplayRecords" => $iFilteredTotal,
				   "aaData" => $datarow
		);
		echo json_encode($output);
		exit();
	}
	
}

  