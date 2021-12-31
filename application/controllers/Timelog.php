<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timelog extends CI_Controller {

	public function __construct(){
		parent::__construct();
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$this->load->model('common_model');
		$this->login = $this->session->userdata('login');
		$this->user_id = $this->login->id;
        $this->user_type = $this->login->user_type;
        //$this->name = $this->login->name;
		func_check_login();
	}

	public function index(){
		$whereArr = array('is_deleted'=>0);
		$data['projectinfo']=$this->common_model->getData('tbl_project_info',$whereArr);
		$data['empinfo'] = $this->common_model->getData('tbl_employee',$whereArr);
		$data['start_date']=date('Y-m-d',strtotime('-1 month'));
		$data['deadline']=date('Y-m-d');
		$this->load->view('common/header');
		$this->load->view('timelog/timelog',$data);
		$this->load->view('common/footer');
	}

	public function addtimelog(){
		$whereArr = array('is_deleted'=>0);
		$data['projectinfo']=$this->common_model->getData('tbl_project_info',$whereArr);
		$data['empinfo'] = $this->common_model->getData('tbl_employee',$whereArr);
		$this->load->view('common/header');
		$this->load->view('timelog/addtimelog',$data);
		$this->load->view('common/footer');
	
	}

	public function inserttimelog(){

			if(!empty($_POST)){
			$project = $this->input->post('project_name');
			$emp = $this->input->post('empname');
			$sdate = $this->input->post('timelog_d1');
			$edate = $this->input->post('timelog_d2');
			$stime = $this->input->post('timelog_t1');
			$etime = $this->input->post('timelog_t2');
			$hours = $this->input->post('hours1');
			$memo = $this->input->post('memo');
			
			$insArr = array('timelogprojectid'=>$project ,'timelogemployeeid'=>$emp ,'timelogstartdate'=>$sdate , 'timelogenddate'=>$edate ,'timelogstarttime'=>$stime ,'timelogendtime'=>$etime,'totalhours'=>$hours,'timelogmemo'=>$memo);
			$this->common_model->insertData('tbl_timelog',$insArr);
			$this->session->set_flashdata('message_name','Timelog Inserted Succesfully....');
			redirect('timelog/');
		}
	}

	public function timeloglist(){
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
			$ename=!empty($_POST['ename']) ? $_POST['ename'] : '';
			/*if(!empty(trim($_POST['start_date']))){
				$startdate=!empty($_POST['start_date']) ? $_POST['start_date'] : '';
			}else{
				$startdate=date('Y-m-d',strtotime('-1 month'));
			}
			if(!empty(trim($_POST['deadline']))){ 
				$enddate=!empty($_POST['deadline']) ? $_POST['deadline'] : '';
			}else{
				$enddate=date('Y-m-d');
			}*/
			$startdate=!empty($_POST['start_date']) ? $_POST['start_date'] : '';
			$enddate=!empty($_POST['deadline']) ? $_POST['deadline'] : '';
		

			if(!empty($pname)){
					$sWhere.=' AND tbl_timelog.timelogprojectid='.$pname;
			}
			if(!empty($ename)){						
				$sWhere.=' AND tbl_timelog.timelogemployeeid='.$ename;
			}
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
		if($this->user_type == 0){
			$query = "SELECT tbl_project_info.projectbudget,tbl_project_info.id as pid,tbl_project_info.*,tbl_timelog.*,tbl_timelog.id as tid,tbl_employee.user_id as empid,tbl_employee.* FROM `tbl_timelog` inner join tbl_project_info on tbl_timelog.timelogprojectid = tbl_project_info.id inner join tbl_employee on tbl_employee.id = tbl_timelog.timelogemployeeid".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;

				$timeArr = $this->common_model->coreQueryObject($query);
				//echo "<PRE>";print_r($timeArr);die;
				$query = "SELECT tbl_project_info.projectbudget,tbl_project_info.*,tbl_timelog.*,tbl_timelog.id as tid,tbl_employee.* FROM `tbl_timelog` inner join tbl_project_info on tbl_timelog.timelogprojectid = tbl_project_info.id 
				    inner join tbl_employee on tbl_employee.id = tbl_timelog.timelogemployeeid".$sWhere;

			$TimeFilterArr = $this->common_model->coreQueryObject($query);
			$iFilteredTotal = count($TimeFilterArr);
			$TimeAllArr = $this->common_model->getData('tbl_timelog');
			$iTotal = count($TimeAllArr);

			/** Output */
			$datarow = array();
			$i = 1;
			foreach($timeArr as $row) {
				$rowid = $row->tid;
				$projectid =$row->timelogprojectid;
		        $actionstring = 

							'<a href="javascript:;" onclick="edittimelog(\''.base64_encode($rowid).'\')" class="btn btn-info btn-circle" data-original-title="Edit" data-toggle="modal" data-target="#timelog-popup" ><i class="fa fa-pencil" aria-hidden="true"></i></a>

							 <a href="javascript:void();" onclick="deletetimelog(\''.base64_encode($rowid).'\');"  class="btn btn-danger btn-circle sa-params" data-toggle="tooltip"  data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>';
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
					$actionstring
					);
				$i++;
			}
			$output = array
			(
			   "sEcho" => intval($_POST['sEcho']),
			   "iTotalRecords" => $iTotal,
			   "iTotalRecordsFormatted" => number_format($iTotal), 
			   "iTotalDisplayRecords" => $iFilteredTotal,
			   "aaData" => $datarow
			);
		}else if($this->user_type == 2){
		
			$query = "SELECT tbl_project_info.projectbudget,tbl_project_info.*,tbl_employee.*,tbl_timelog.* FROM `tbl_timelog` inner join tbl_project_info on tbl_timelog.timelogprojectid = tbl_project_info.id  inner join tbl_employee on tbl_employee.id = tbl_timelog.timelogemployeeid where tbl_employee.user_id=".$this->user_id.''.$sWhere.''.$sOrder.' limit '.$sOffset.', '.$sLimit;
			$timeArr = $this->common_model->coreQueryObject($query);

			$query = "SELECT projectbudget,tbl_project_info.*,tbl_employee.*,tbl_timelog.* FROM `tbl_timelog` inner join tbl_project_info on tbl_timelog.timelogprojectid = tbl_project_info.id inner join tbl_employee on tbl_employee.id = tbl_timelog.timelogemployeeid where tbl_employee.user_id=".$this->user_id.''.$sWhere;
			$TimeFilterArr = $this->common_model->coreQueryObject($query);
			$iTotal = count($TimeFilterArr);
			$datarow = array();
			$i = 1;
			foreach($timeArr as $row) {
				$rowid = $row->id;
				$projectid =$row->timelogprojectid;
					// $actionstring ='<p>--</p>';
			

				$datarow[] = array(
					$id = $i,
					$row->projectname,
					$row->timelogstartdate.'<br/>'.$row->timelogstarttime,
					$row->timelogenddate.'<br/>'.$row->timelogendtime,
					$row->totalhours,
					$row->projectbudget,
					//$actionstring
					);

				$i++;
			}

			$output = array
			(
				"sEcho" => intval($_POST['sEcho']),
					   "iTotalRecords" => $iTotal,
					   "iTotalRecordsFormatted" => number_format($iTotal), 
					   //ShowLargeNumber($iTotal),
					   "iTotalDisplayRecords" => $iTotal,
					   "aaData" => $datarow
			);
	}
		echo json_encode($output);
		exit();
	}

	public function deletetimelog(){
		$id = base64_decode($_POST['id']);
		$whereArr = array('id' => $id);
		$this->common_model->deleteData('tbl_timelog',$whereArr);
		$this->session->set_flashdata('message','Delete Succesfully....');
		redirect('timelog/index');
	}

	Public function edittimelog(){

		$id=base64_decode($_POST['id']);
		//echo $id;die;
		$whereArr=array('id'=>$id);
		$timelog= $this->common_model->getData('tbl_timelog',$whereArr);
		//print_r($timelog);die;
		$query ="select tbl_project_member.*,tbl_employee.employeename from tbl_project_member inner join tbl_employee on tbl_project_member.emp_id = tbl_employee.id where project_id=".$timelog[0]->timelogprojectid;
	  	$getEmp=$this->common_model->coreQueryObject($query);
		$data['projectinfo']=$this->common_model->getData('tbl_project_info');
		$str= '';
		$str.='<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">Select Project</label>
								<select class="custom-select br-0" id="project_name" name="project_name" onchange="showEmployee();">';	
								foreach($data['projectinfo'] as $project){
									$string='';
										if($project->id == $timelog[0]->timelogprojectid){
												$string='selected';
										    }  
											$str.= '<option value="'.$project->id.'"'.$string.'>'.$project->projectname.'</option>';
								        }

		$str.=	                '</select>
						</div>
					</div>';


					$startdate='';
						if(	!empty($timelog[0]->timelogstartdate)){
							$startdate = $timelog[0]->timelogstartdate;
						}
		$str.=      '<div class="col-md-4">
						<div class="form-group">
							 <label for="date" class="control-label"> Start Date</label>
						   <input type="date" name="d1" id="d1" value="'.$startdate.'"  class="form-control" onchange="changeDate();"/></div>
					</div>';
					$enddate='';
						if(	!empty($timelog[0]->timelogenddate)){
							$enddate = $timelog[0]->timelogenddate;
						}

		$str.=	    '<div class="col-md-4">
						<div class="form-group">
							<label class="control-label">End Date</label>
							<input type="date" name="d2" id="d2" 
							value="'.$enddate.'" class="form-control" onchange="calculateHours();"/>
						</div>
					</div>
				</div>';

		$starttime='';
						if(	!empty($timelog[0]->timelogstarttime)){
							$starttime = $timelog[0]->timelogstarttime;
						}

		$str.=      '<div class="row">
						<div class="col-md-4">
							<div class="form-group" id="timeonly">
								<label class="control-label">Start Time</label>
							    <input type="time" name="t1" id="t1" value="'.$starttime.'"  class="form-control" onchange="calculateHours();"/>
							</div>
						</div>';

		$endtime='';
		if(	!empty($timelog[0]->timelogendtime)){
			$endtime = $timelog[0]->timelogendtime;
		}

	    $str.=      '<div class="col-md-4">
						<div class="form-group">
							<label class="control-label"> End Time</label>
							<input type="time" name="t2" id="t2" value="'.$endtime.'" class="form-control" onchange="calculateHours();"/>
						</div>
					</div>';

		$hour='';
		if(	!empty($timelog[0]->totalhours)){
			$hour = $timelog[0]->totalhours;
		}
			
		$str.=     '<div class="col-md-4">
						<label  class="control-label">Total Hours</label>
							<div id="diff">
								<dl id="hours_mins">'.$hour.'</dl>
							</div>
							<input type="hidden"  name="hours1" id="hours1" value="'.$hour.'">
					</div>';

		$str.=' </div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label class="control-label"> Employee Name</label>';
		$str.=		            '<select name="empname" id="empname" class="custom-select br-0">';
									foreach($getEmp as $emp){

									$string='';
									if($emp->id == $timelog[0]->timelogemployeeid){
										$string='selected';
									}
											$str.= '<option value="'.$emp->id.'"'.$string.'>'.$emp->employeename.'</option>';
								    }

		$str.=	             '</select>	
						</div>
					</div>';

		//For Memo
		$timelogmemo='';
		if(	!empty($timelog[0]->timelogmemo)){
			$timelogmemo = $timelog[0]->timelogmemo;
		}

		$str.=	   '<div class="col-md-4">
						<div class="form-group">
							<label class="control-label"> Memo</label>
								<input type="text" class="form-control" name="detail_memo" id="detail_memo" value="'.$timelogmemo.'">
						</div>
					</div>
				</div>';

		$str.=     '<div class="form-actions">
					     <button type="button" onclick="updatetimelog(\''.base64_encode($id).'\')" name="btnupdate" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
				    </div>';

		echo json_encode($str);exit;
}

public function update_timelog(){

		$id=base64_decode($_POST['id']);
		$whereArr=array('id'=>$id);

		if(!empty($_POST)){
			$project = $this->input->post('pname');
			$emp = $this->input->post('employee');
			$sdate = $this->input->post('d1');
			$edate = $this->input->post('d2');
			$stime = $this->input->post('t1');
			$etime = $this->input->post('t2');
			$hours = $this->input->post('hour');
			$memo = $this->input->post('demo');
			$updateArr = array('timelogprojectid'=>$project,'timelogemployeeid'=>$emp,'timelogstartdate'=>$sdate,'timelogenddate'=>$edate,'timelogstarttime'=>$stime,'timelogendtime'=>$etime,'totalhours'=>$hours,'timelogmemo'=>$memo);
			$this->common_model->updateData('tbl_timelog',$updateArr,$whereArr);
			$this->session->set_flashdata('message_name','Timelog Update Succesfully....');
			
		}
		
	}

	public function getEmployee(){
		$pname=$this->input->post('projectname');
		$query ="SELECT tbl_project_member.*,tbl_employee.employeename,tbl_employee.id as eid from tbl_project_member inner join tbl_employee on tbl_project_member.emp_id = tbl_employee.id where project_id=".$pname;
	//
		//ECHO $this->DB->last_query();DIE;
	  	$getEmp=$this->common_model->coreQueryObject($query);
		$str = '';
			foreach($getEmp as $row){
				$str.='<option value="'.$row->eid.'">'.$row->employeename.'</option>'; 
			}

		$timelogArr['empname'] = $str;
		echo json_encode($timelogArr);exit;
	}	 
}