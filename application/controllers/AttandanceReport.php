<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AttandanceReport extends CI_Controller {

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
		$whereArr = array('is_deleted'=>0);
		$data['employee'] = $this->common_model->getData('tbl_employee',$whereArr);
		$data['startdate']=date('Y-m-d',strtotime('-1 month'));
		$data['enddate']=date('Y-m-d');
		$this->load->view('common/header');
		$this->load->view('report/attandancereport',$data);
		$this->load->view('common/footer');
	}


	public function attandancelistreport(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'employee', 'attendance');
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
			//print_r($_POST);
			if(!empty(trim($_GET['sSearch']))){
				$searchTerm = trim($_GET['sSearch']);
				$sWhere.= ' AND (tbl_employee.employeename like "%'.$searchTerm.'%")';
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
			$empname=!empty($_POST['ename']) ? $_POST['ename'] : '';
			//$this->session->set_userdata('s_date',$startdate);
			//$this->session->set_userdata('e_date',$enddate);
			//$this->session->userdata('s_date');die;
			///echo $enddate.''.$startdate;die;
			if(!empty($startdate)){						
				$sWhere.=' AND attendancedate>="'.$startdate.'"';
			}
			if(!empty($enddate)){						
				$sWhere.=' AND attendancedate<="'.$enddate.'"';
			}
			if(!empty($empname)){						
				$sWhere.=' AND tbl_employee.id='.$empname;
			}
			if(!empty($sWhere)){
				$sWhere = " WHERE 1 ".$sWhere;
			}
		}
		$query = "SELECT tbl_employee.employeename,tbl_employee.user_id as empid,tbl_attendance.* FROM `tbl_attendance` inner join tbl_employee on tbl_attendance.employee=tbl_employee.id".$sWhere.' Group by employeename'.$sOrder.' limit '.$sOffset.', '.$sLimit;

		$AttendanceArr = $this->common_model->coreQueryObject($query);
		$query = "SELECT tbl_employee.employeename,tbl_attendance.* FROM `tbl_attendance` inner join tbl_employee on tbl_attendance.employee=tbl_employee.id".$sWhere;
		

		$AttendanceFilterArr = $this->common_model->coreQueryObject($query);
		//echo $this->db->last_query();die;
		$iFilteredTotal = count($AttendanceFilterArr);
		$AttendanceAllArr = $this->common_model->getData('tbl_attendance');
		$iTotal = count($AttendanceAllArr);
		
		/** Output */
		$datarow = array();
		$i = 1;
		foreach($AttendanceArr as $row) {
			$rowid = $row->id;
			$myattandance=$row->attendance;

			$sql="SELECT tbl_employee.employeename,tbl_attendance.* FROM `tbl_attendance`inner join tbl_employee on tbl_attendance.employee=tbl_employee.id where tbl_attendance.employee = ".$row->employee." AND tbl_attendance.attendance = 1 ";
			$sql1="SELECT tbl_employee.employeename,tbl_attendance.* FROM `tbl_attendance` inner join tbl_employee on tbl_attendance.employee=tbl_employee.id where tbl_attendance.employee = ".$row->employee." AND tbl_attendance.attendance = 3";

			$sql2="SELECT tbl_employee.employeename,tbl_attendance.* FROM `tbl_attendance`inner join tbl_employee on tbl_attendance.employee=tbl_employee.id where tbl_attendance.employee = ".$row->employee." AND tbl_attendance.attendance = 2";


			

			$getCountPresent = $this->common_model->coreQueryObject($sql);
			$getCountAbsent = $this->common_model->coreQueryObject($sql1);
			$getCountLate = $this->common_model->coreQueryObject($sql2);

//echo $sql;echo $sql1;die;
			$presentStatus=$absStatus=$lateStatus="";
			if($row->attendance=='1'){
					$attendance=$row->attendance='Present';
					$presentStatus = '<label class="label label-success">'.$attendance.'</label>';
			}else if($row->attendance=='3'){ 
					$attendance=$row->attendance='Absent';
					$absStatus = '<label class="label label-danger">'.$attendance.'</label>';
			}else if($row->attendance=='2'){ 
					$attendance=$row->attendance='Late';
					$lateStatus = '<label class="label label-success">'.$attendance.'</label>';
			}
			
			$employeename = "<a href=".base_url()."employee/viewemployee/".base64_encode($row->empid).">".$row->employeename."</a>";
			
			$datarow[] = array(
				$id = $i,
				$employeename,
				'<p class="btn btn-info btn-circle">'.count($getCountPresent).'</p><br/>',
				'<p class="btn btn-info btn-circle">'.count($getCountAbsent).'</p><br/>',
				'<p class="btn btn-info btn-circle">'.count($getCountLate).'</p><br/>'
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
}