<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Attendance extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('common_model');
		ini_set('display_errors',1);
		error_reporting(E_ALL);
		$this->login = $this->session->userdata('login');
		$this->user_type = $this->login->user_type;
		$this->user_id = $this->login->id;
		if(!$this->session->userdata('year_data')){          
			$this->year =date('Y');
			$this->department = $this->session->userdata('department_data');
            $this->employee = $this->session->userdata('employee_data');
		}
		else{
            $this->year = $this->session->userdata('year_data');
            $this->department = $this->session->userdata('department_data');
            $this->employee = $this->session->userdata('employee_data');
		}
		if(!$this->session->userdata('month_data')){
          	$this->month =date('m');
          	$this->department = $this->session->userdata('department_data');
            $this->employee = $this->session->userdata('employee_data');
		}
		else{
            $this->month = $this->session->userdata('month_data');
            $this->department = $this->session->userdata('department_data');
            $this->employee = $this->session->userdata('employee_data');
		}
      func_check_login();
	}
	
	public function index(){
		$data['selMonth'] =  $this->month;
		$data['selYear'] =  $this->year;
		$data['selDepartment'] =  $this->department;
		$data['selEmployee'] =  $this->employee;
		$whereArr = array('is_deleted'=>0);
		$data['employee'] =$this->common_model->getData('tbl_employee',$whereArr);
		$data['department'] =$this->common_model->getData('tbl_department');
		if(!empty($data['selEmployee']) && !empty($data['selDepartment'])){	
			$checkempid=$data['selEmployee'];
			$checkdept=$data['selDepartment'];
			$whereArr=array('id'=>$checkempid,'department'=>$checkdept,'is_deleted'=>0);
			$data['selEmployeeArr'] =$this->common_model->getData('tbl_employee',$whereArr);
		}
		elseif(!empty($data['selDepartment'])){
			$checkdept=$data['selDepartment'];
			//echo $checkdept;die;
			$whereArr=array('department'=>$checkdept,'is_deleted'=>0);
			$data['selEmployeeArr'] =$this->common_model->getData('tbl_employee',$whereArr);
			//print_r($data['selEmployeeArr'] );die;

		}
		elseif(!empty($data['selEmployee'])){
			$checkempid=$data['selEmployee'];
			$whereArr=array('id'=>$checkempid,'is_deleted'=>0);
			$data['selEmployeeArr'] =$this->common_model->getData('tbl_employee',$whereArr);
		}
		elseif($this->user_type == 0){
			$whereArr = array('is_deleted'=>0);
			$data['selEmployeeArr'] =$this->common_model->getData('tbl_employee',$whereArr);
			//echo "<PRE>";print_r($data['selEmployeeArr']);
		}
		elseif($this->user_type == 2){
			
				$whereArr= array('user_id'=>$this->user_id,'is_deleted'=>0);
				$data['selEmployeeArr'] =$this->common_model->getData('tbl_employee',$whereArr);
			
		}
		$this->load->view('common/header');
		$this->load->view('Attendance/attendance',$data);
		$this->load->view('common/footer');
	}
	
	public function AttendanceByMember(){
		$selSdate='';
		$selEdate='';
		$selMember='';

		$year=date('Y');
		$month=date('m');
		//$month=date('d');
		$selSdate=$year.'-'.$month.'-01';
		$selEdate=date('Y-m-d');
		$whereArr = array('is_deleted'=>0);
		$data['employee'] =$this->common_model->getData('tbl_employee',$whereArr);
		$selMember=$data['employee'][0]->id;
		
		$query="select * from tbl_attendance where employee=".$selMember." AND attendancedate>='".$selSdate."' AND attendancedate<='".$selEdate."'  ORDER BY attendancedate";
		$data['membersArr'] = $this->common_model->coreQueryObject($query);

		if(!empty($_POST)){
			$selSdate= $this->input->post('startdate');
			$selEdate= $this->input->post('enddate');
			$selMember= $this->input->post('member');
			$this->session->set_userdata('selSdate',$selSdate);
			$this->session->set_userdata('selEdate',$selEdate);
			$this->session->set_userdata('selMember',$selMember);
			$query="select * from tbl_attendance where employee=".$selMember." AND attendancedate>='".$selSdate."' AND attendancedate<='".$selEdate."'  ORDER BY attendancedate"; 
			$data['membersArr'] = $this->common_model->coreQueryObject($query);
		}

		$pquery="select * from tbl_attendance where employee=".$selMember." AND attendancedate>='".$selSdate."' AND attendancedate<='".$selEdate."'and attendance=1" ; 
		$data['present'] = $this->common_model->coreQueryObject($pquery);
		$data['pday']=count($data['present']);

		$lquery="select * from tbl_attendance where employee=".$selMember." AND attendancedate>='".$selSdate."' AND attendancedate<='".$selEdate."'and attendance=2" ; 
		$data['late'] = $this->common_model->coreQueryObject($lquery);
		$data['lday']=count($data['late']);
		

		$aquery="select * from tbl_attendance where employee=".$selMember." AND attendancedate>='".$selSdate."' AND attendancedate<='".$selEdate."'and attendance=3" ; 
		$data['absent'] = $this->common_model->coreQueryObject($aquery);
		$data['aday']=count($data['absent']);


		$tquery="select * from tbl_attendance where employee=".$selMember." AND attendancedate>='".$selSdate."' AND attendancedate<='".$selEdate."'" ; 
		$data['tday'] = $this->common_model->coreQueryObject($tquery);
		$data['totalday']=count($data['tday']);

		function getDatesFromRange($start, $end){
    		$dates = array($start);
    		while(end($dates) < $end){
        		$dates[] = date('Y-m-d', strtotime(end($dates).' +1 day'));
   		 	}
    		return $dates;
		}
		$data['total']=getDatesFromRange($selSdate,$selEdate);
		$totalday=count($data['total']);
		$daysun=0;$daysat=0;

		for($i=0;$i<=$totalday-1;$i++) {
			$date=$data['total'][$i];
			$dateDay = date('l', strtotime($date));
			if($dateDay == 'Sunday'){
			$daysun=$daysun+1;
			}
			elseif($dateDay == 'Saturday'){
			$daysat=$daysat+1;
			}
		}
	
		$oquery="select * from tbl_holiday where date>='".$selSdate."' AND date<='".$selEdate."'";
		$data['oday'] = $this->common_model->coreQueryObject($oquery);
		$data['ocday']=count($data['oday']);


		$hquery="select * from tbl_holiday_settings";
		$data['hday'] = $this->common_model->coreQueryObject($hquery);
		if(!empty($data['hday'])){
		if($data['hday'][0]->saturday == 1 &&  $data['hday'][0]->sunday == 1){
			$data['holiday']=$data['ocday']+$daysat+$daysun;
			$data['wday']=$totalday-$data['holiday'];
		}
		elseif($data['hday'][0]->saturday == 1){
			$data['holiday']=$data['ocday']+$daysat;
			$data['wday']=$totalday-$data['holiday'];
		}
		elseif($data['hday'][0]->sunday == 1){
			$data['holiday']=$data['ocday']+$daysun;
			$data['wday']=$totalday-$data['holiday'];
		}
		else
		{
			$data['holiday']=$data['ocday'];
			$data['wday']=$totalday-$data['holiday'];
		}
	}
		$this->load->view('common/header');
		$this->load->view('Attendance/attendance',$data);
		$this->load->view('common/footer');
	}
	public function addattendance(){
		if($this->user_type == 0)
		{
		$whereArr = array('is_deleted'=>0);
		$data['employee'] =$this->common_model->getData('tbl_employee',$whereArr);
		}
		elseif($this->user_type == 2)
		{
		$whereArr=array('user_id'=>$this->user_id,'is_deleted'=>0);
		$data['employee'] =$this->common_model->getData('tbl_employee',$whereArr);
		}
		$data['countemp']=count($data['employee']);
		$date = date('Y-m-d');
		$this->load->view('common/header');
		$this->load->view('Attendance/addattendance',$data);
		$this->load->view('common/footer');
	}

	public function insertattendance(){
		if(!empty($_POST)){
			$attendancedate = $_POST['attendancedate'];
			$employee = $_POST['employee'];
			$attendance = $_POST['attendance'];
			$whereArr = array('attendancedate' => $attendancedate,'employee'=>$employee);
			$data = $this->common_model->getData('tbl_attendance',$whereArr);
			if(count($data)==1){
				$updateArr=array('attendance'=>$attendance);
				$this->common_model->updateData('tbl_attendance',$updateArr,$whereArr);
			}
			else{
				$insertArr=array('attendancedate'=>$attendancedate,'employee'=> $employee,'attendance'=>$attendance);
				$this->common_model->insertData('tbl_attendance',$insertArr);
			}
		}
	}

	public function getfilterdata(){
		if(!empty($_POST)){
			$month = $_POST['month'];
			$year = $_POST['year'];
			$department = $_POST['department'];
			$employee = $_POST['employee'];
			if($department != 'all'){
				$this->session->set_userdata('department_data',$department);
			}
			else{
				$this->session->set_userdata('department_data', '');
			}
			if($employee != 'all'){
				$this->session->set_userdata('employee_data',$employee);
			}
			else{
				$this->session->set_userdata('employee_data', '');
			}
			$this->session->set_userdata('month_data',$month);
			$this->session->set_userdata('year_data',$year);
		}
	}
	
	public function insertallattendance(){
		$attendance_array=array();
		$employee_array=array();
		if(!empty($_POST)){
			$attendancedate=$this->input->post('attendancedate');
			$totalatt=$this->input->post('totalatten');
			for($i=1;$i<=$totalatt;$i++){
				if(isset($_POST['attendance'.$i])){
					array_push($attendance_array,$_POST['attendance'.$i]);
					array_push($employee_array,$_POST['employee'.$i]);
				}
			}
			$totalemployee=count($employee_array);
			for($j=0;$j<=$totalemployee-1;$j++){
				$whereArr = array('attendancedate' => $attendancedate,'employee'=>$employee_array[$j]);
				$data = $this->common_model->getData('tbl_attendance',$whereArr);
				if(count($data)	== 1){
					$updateArr=array('attendance'=>$attendance_array[$j]);
					$this->common_model->updateData('tbl_attendance',$updateArr,$whereArr);
				}
				else{
					$insertArr=array('attendancedate'=>$attendancedate,'employee'=>$employee_array[$j],'attendance'=>$attendance_array[$j]);
					$this->common_model->insertData('tbl_attendance',$insertArr);
				}

			}
			$this->session->set_flashdata('message_name', "All Attendance Saved Succeessfully");
			redirect('Attendance/addattendance');
		}
	}

	public function destroydata(){
		$this->session->unset_userdata('department_data');
	 	$this->session->unset_userdata('employee_data');
	 	$this->session->unset_userdata('month_data');
	 	$this->session->unset_userdata('year_data');
	 }

	 public function timelog()
	 {
	 	$this->load->view('common/header');
	 	$this->load->view('Attendance/timediff');
	 	$this->load->view('common/footer');
	 }
}