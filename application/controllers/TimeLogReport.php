<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TimeLogReport extends CI_Controller {

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
		$sdate=date('Y-m-d',strtotime('-1 month'));
		$edate=date('Y-m-d');
		$data['sdate']=$sdate;
		$data['edate']=$edate;
		$whereArr = array('is_deleted' => 0);
		$data['allProjectData'] = $this->common_model->getData('tbl_project_info',$whereArr);
		$this->load->view('common/header');
		$this->load->view('report/timelogreport',$data);
		$this->load->view('common/footer');
    }
	

	public function getTimelogPostData(){
		if(!empty($_POST))
		{
			$sdate=$this->input->post('start_date');
	    	$edate=$this->input->post('deadline');
	    	$project=$this->input->post('pname');
	    	//echo $project;die;
	    	if (!empty($sdate) AND !empty($edate)){
				$startdate=$this->input->post('start_date');
			    $enddate=$this->input->post('deadline');
			}
			else{
			
				$startdate=date('Y-m-d',strtotime('-1 month'));
				$enddate=date('Y-m-d');
			}
			$sWhere = '';
			if(!empty(trim($_GET['sSearch']))){
				$searchTerm = trim($_GET['sSearch']);
				$sWhere.= ' AND (tbl_project_info.projectname like "%'.$searchTerm.'%" OR tbl_timelog.timelogstartdate like "%'.$searchTerm.'%" OR tbl_timelog.timelogendtime like "%'.$searchTerm.'%" OR tbl_timelog.totalhours like "%'.$searchTerm.'%" OR tbl_project_info.projectbudget like "%'.$searchTerm.'%" OR tbl_employee.employeename like "%'.$searchTerm.'%")';
			}
	    	if(!empty($project)){
				$sWhere.=' AND tbl_timelog.timelogprojectid='.$project;
			}
			
			if(!empty($startdate)){						
				$sWhere.=' AND tbl_timelog.timelogstartdate>="'.$startdate.'"';
			}
			if(!empty($enddate)){						
				$sWhere.=' AND tbl_timelog.timelogenddate<="'.$enddate.'"';
			}
	    	$sWhere = " WHERE 1".$sWhere;
	    	$query = "SELECT tbl_project_info.projectbudget,tbl_project_info.*,tbl_timelog.*,tbl_employee.* FROM `tbl_timelog` inner join tbl_project_info on tbl_timelog.timelogprojectid = tbl_project_info.id 
		    inner join tbl_employee on tbl_employee.id = tbl_timelog.timelogemployeeid".$sWhere;
	    	//echo $query;die;
	    	$data['getHours'] = $this->common_model->coreQueryObject($query);
			$temp = array();
			$stri='';
			foreach($data['getHours'] as $hour){
					$find = [" Hrs ", " Mins"];
	    			$replace = ['.', ''];
	    			$string = str_replace($find,$replace,$hour->totalhours);

				if(array_key_exists($hour->timelogstartdate,$temp)){
				//	echo "Exist";
					$temp[$hour->timelogstartdate]=$string+$temp[$hour->timelogstartdate];
				}
				else{
						//echo "NOt Exist";
					$temp[$hour->timelogstartdate]=$string;
				}
			}
			$str=array();
			foreach($temp as $key=>$value){
				$str['xdata'][] = $key;
				$str['ydata'][]= (int)$value;
			}
			return $str;

		}
	}


    
	public function timelog_list(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'timelogprojectid','timelogstartdate', 'timelogenddate', 'timelogemployeeid', 'timelogstarttime' ,'timelogendtime' , 'totalhours' ,'timelogmemo');
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
				$sWhere.= ' AND (tbl_project_info.projectname like "%'.$searchTerm.'%" OR tbl_timelog.timelogstartdate like "%'.$searchTerm.'%" OR tbl_timelog.timelogendtime like "%'.$searchTerm.'%" OR tbl_timelog.totalhours like "%'.$searchTerm.'%" OR tbl_project_info.projectbudget like "%'.$searchTerm.'%" OR tbl_employee.employeename like "%'.$searchTerm.'%")';
			}
		
			$pname=!empty($_POST['pname']) ? $_POST['pname'] : '';	
			//$ename=!empty($_POST['ename']) ? $_POST['ename'] : '';
			if(!empty(trim($_POST['start_date']))){
				$startdate=!empty($_POST['start_date']) ? $_POST['start_date'] : '';
			}else{
				$startdate=date('Y-m-d',strtotime('-1 month'));
			}
			if(!empty(trim($_POST['deadline']))){ 
				$enddate=!empty($_POST['deadline']) ? $_POST['deadline'] : '';
			}else{
				$enddate=date('Y-m-d');
			}
			if(!empty($pname)){
					$sWhere.=' AND tbl_timelog.timelogprojectid='.$pname;
			}
			//echo $pname;die;
			if(!empty($startdate)){						
				$sWhere.=' AND tbl_timelog.timelogstartdate>="'.$startdate.'"';
			}
			if(!empty($enddate)){						
				$sWhere.=' AND tbl_timelog.timelogenddate<="'.$enddate.'"';
			}
			if(!empty($sWhere)){
				$sWhere = " ".$sWhere;
			}
			
		}
		
		$query = "SELECT tbl_project_info.projectbudget,tbl_project_info.id as pid,tbl_project_info.*,tbl_timelog.*,tbl_employee.user_id as empid,tbl_employee.* FROM `tbl_timelog` inner join tbl_project_info on tbl_timelog.timelogprojectid = tbl_project_info.id inner join tbl_employee on tbl_employee.id = tbl_timelog.timelogemployeeid".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		//echo $query;die;
		$timeArr = $this->common_model->coreQueryObject($query);

		$query = "SELECT tbl_project_info.projectbudget,tbl_project_info.*,tbl_timelog.*,tbl_employee.* FROM `tbl_timelog` inner join tbl_project_info on tbl_timelog.timelogprojectid = tbl_project_info.id 
		    inner join tbl_employee on tbl_employee.id = tbl_timelog.timelogemployeeid".$sWhere;

			$TimeFilterArr = $this->common_model->coreQueryObject($query);
			$iFilteredTotal = count($TimeFilterArr);
			$TimeAllArr = $this->common_model->getData('tbl_timelog');
			$iTotal = count($TimeAllArr);

			/** Output */
			$datarow = array();
			$i = 1;
			foreach($timeArr as $row) {
				$rowid = $row->id;
				$projectid =$row->timelogprojectid;
		        $projectname = "<a href=".base_url()."Project/overView/".base64_encode($row->pid).">".$row->projectname."</a>";
		        $employeename = "<a href=".base_url()."employee/viewemployee/".base64_encode($row->empid).">".$row->employeename."</a>";
				$datarow[] = array(
					$id = $i,
					$projectname,
					$employeename,
					date('d-m-Y', strtotime($row->timelogstartdate)).'<br/>'.$row->timelogstarttime,
					date('d-m-Y', strtotime($row->timelogenddate)).'<br/>'.$row->timelogendtime,
					$row->totalhours,
					$row->projectbudget,
					
					);
				$i++;
			}
			//print_r($_POST);die;
			$timelogGraph = $this->getTimelogPostData($_POST);
			$output = array
			(
			   "sEcho" => intval($_POST['sEcho']),
			   "iTotalRecords" => $iTotal,
			   "timeloggraphData"=>$timelogGraph,
			   "iTotalRecordsFormatted" => number_format($iTotal), 
			   "iTotalDisplayRecords" => $iFilteredTotal,
			   "aaData" => $datarow
			);
		
	
		echo json_encode($output);
		exit();
	}
}