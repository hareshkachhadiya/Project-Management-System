<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Leaves extends CI_Controller {

	public function __construct(){
		parent::__construct();
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		$this->load->model('common_model');
		$this->login = $this->session->userdata('login');
		$this->user_id = $this->login->id;
        $this->user_type = $this->login->user_type;
		func_check_login();
	}

	public function index(){
		$data['startdate']=date('Y-m-d',strtotime('-1 month'));
		$data['enddate']=date('Y-m-d');
		$data['leavecategory']=$this->common_model->getData('tbl_leavetype');
		$whereArr = array('is_deleted'=>0);
		$data['employee']=$this->common_model->getData('tbl_employee',$whereArr); 
		$this->load->view('common/header');
		$this->load->view('leaves/leaves',$data);
		$this->load->view('common/footer');
	} 

	public function addleaves(){
		$whereArr = array('is_deleted'=>0);
		$data['employee']=$this->common_model->getData('tbl_employee',$whereArr);
		$data['leavecategory']=$this->common_model->getData('tbl_leavetype');
		$this->load->view('common/header');
		$this->load->view('leaves/addleaves',$data);
		$this->load->view('common/footer');
	}

	public function insertleaves(){
		if($this->user_type == 0){
			if(!empty($_POST))
			{	
				$mem = $this->input->post('choose_mem');
				$type  = $this->input->post('leave_type');
				$radio = $this->input->post('duration_radio');
				$date = $this->input->post('date');
				$leavedate = date("Y-m-d", strtotime($date));
				$abs  = $this->input->post('absence');
				$status = $this->input->post('status');

				$whereArr = array('empid'=>$mem,'leavetypeid'=>$type,'duration'=>$radio,'date'=>$leavedate,'reasonforabsence'=>$abs,'status'=>$status);

				$this->common_model->insertData('tbl_leaves',$whereArr);
				$this->session->set_flashdata('message_name', 'Leaves Insert sucessfully');
				redirect('Leaves/index');
			}
		}else if($this->user_type == 2){

			if(!empty($_POST))
			{	
				$whereArr = array('user_id' => $this->user_id);
				$query=$this->common_model->getData('tbl_employee',$whereArr);
				$mem=$query[0]->id;
				$type  = $this->input->post('leave_type');
				$radio = $this->input->post('duration_radio');
				$date = $this->input->post('date');
				$abs  = $this->input->post('absence');
				$status = $this->input->post('status');

				$whereArr = array('empid'=>$mem ,'leavetypeid'=>$type,'duration'=>$radio,'date'=>$date,'reasonforabsence'=>$abs,'status'=> 0);
			
				$this->common_model->insertData('tbl_leaves',$whereArr);
				//echo $this->db->last_query();die;
				$this->session->set_flashdata('message_name', 'Leaves Insert sucessfully');
				redirect('Leaves/index');
			}	
		}
			
	}
		
	public function leavelist(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'empid', 'leaveid', 'duration', 'date','reasonforabsence','status');
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
				$sWhere.= ' AND (tbl_employee.employeename like "%'.$searchTerm.'%" OR  tbl_leavetype.name like "%'.$searchTerm.'%")';
			}
			/*if(!empty(trim($_POST['startdate']))){
				$startdate=!empty($_POST['startdate']) ? $_POST['startdate'] : '';
			}else{
				$startdate=date('Y-m-d',strtotime('-1 month'));
			}
			if(!empty(trim($_POST['enddate']))){ 
				$enddate=!empty($_POST['enddate']) ? $_POST['enddate'] : '';
			}else{
				$enddate=date('Y-m-d');
			}*/
			$startdate=!empty($_POST['startdate']) ? $_POST['startdate'] : '';
			$enddate=!empty($_POST['enddate']) ? $_POST['enddate'] : '';
			$empname=!empty($_POST['ename']) ? $_POST['ename'] : '';

			if(!empty($startdate)){						
				$sWhere.=' AND date>="'.$startdate.'"';
			}
			if(!empty($enddate)){						
				$sWhere.=' AND date<="'.$enddate.'"';
			}
			if(!empty($empname)){						
				$sWhere.=' AND tbl_leaves.empid='.$empname;
			}
			if(!empty($sWhere)){
				$sWhere = " ".$sWhere;
			}
		}

		if($this->user_type == 0){
	
		$query = "SELECT tbl_leaves.*,tbl_employee.employeename as empname,tbl_employee.user_id as empid,tbl_leavetype.name as leavetype from tbl_leaves INNER JOIN tbl_employee on tbl_leaves.empid = tbl_employee.id INNER JOIN tbl_leavetype ON tbl_leavetype.id = tbl_leaves.leavetypeid".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
	
		$LeavesArr = $this->common_model->coreQueryObject($query);
	
		$query = "SELECT tbl_leaves.*,tbl_employee.employeename as empname,tbl_leavetype.name as leavetype from tbl_leaves INNER JOIN tbl_employee on tbl_leaves.empid = tbl_employee.id INNER JOIN tbl_leavetype ON tbl_leavetype.id = tbl_leaves.leavetypeid".$sWhere;
		//echo $query;die;
		}else if($this->user_type == 2){
	
			$query = "SELECT tbl_leaves.*,tbl_employee.employeename as empname,tbl_leavetype.name as leavetype from tbl_leaves INNER JOIN tbl_employee on tbl_leaves.empid = tbl_employee.id INNER JOIN tbl_leavetype ON tbl_leavetype.id = tbl_leaves.leavetypeid where tbl_employee.user_id=".$this->user_id.''.$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
	
			$LeavesArr = $this->common_model->coreQueryObject($query);
		//echo $this->db->last_query();die;
			$query = "SELECT tbl_leaves.*,tbl_employee.employeename as empname,tbl_leavetype.name as leavetype from tbl_leaves INNER JOIN tbl_employee on tbl_leaves.empid = tbl_employee.id INNER JOIN tbl_leavetype ON tbl_leavetype.id = tbl_leaves.leavetypeid where tbl_employee.user_id=".$this->user_id.''.$sWhere;
			//echo $query;die;
		}

		$LeavesFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($LeavesFilterArr);
		$ProjectAllArr = $this->common_model->getData('tbl_leaves');
		$iTotal = count($ProjectAllArr);
		
		/** Output */
		$datarow = array();
		$i = 1;
		foreach($LeavesArr as $row) {
			$rowid = $row->id;
			$mystatus=$row->status;
			
			if($row->status=='1'){
					$status=$row->status='Approved';
					$showStatus = '<label class="label label-success">'.$status.'</label>';
			}
			else{
					$status=$row->status='Pending';
					$showStatus = '<label class="label label-danger">'.$status.'</label>';
			}
					
			if($mystatus=='1'){
		
					$actionstring = '<a href="javascript:;" onclick="searchleaves(\''.base64_encode($rowid).'\');"  class="btn btn-success btn-circle" data-toggle="modal" data-target="#leaves-popup" data-original-title="View Project Details"><i class="fa fa-search" aria-hidden="true"></i></a>';				 
			}
			else{
				if($this->user_type == 2){

					$actionstring= 

				/*	'<a href='.base_url().'Leaves/approveleaves/'.base64_encode($row->id). ' class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Project Details"><i class="fa fa-check" aria-hidden="true"></i></a>*/

					'<a href="javascript:void();" onclick="deleteleaves(\''.base64_encode($rowid).'\');"  class="btn btn-danger btn-circle sa-params" data-toggle="tooltip"  data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>

				    <a href="javascript:;" onclick="searchleaves(\''.base64_encode($rowid).'\');"  class="btn btn-success btn-circle" data-toggle="modal" data-target="#leaves-popup" data-original-title="View Project Details"><i class="fa fa-search" aria-hidden="true"></i></a>';
				    //test

					
				}else if($this->user_type == 0){
						
					$actionstring= 

					'<a href='.base_url().'Leaves/approveleaves/'.base64_encode($row->id). ' class="btn btn-success btn-circle" data-toggle="tooltip" data-original-title="View Project Details"><i class="fa fa-check" aria-hidden="true"></i></a>

					<a href="javascript:void();" onclick="deleteleaves(\''.base64_encode($rowid).'\');"  class="btn btn-danger btn-circle sa-params" data-toggle="tooltip"  data-original-title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>

				    <a href="javascript:;" onclick="searchleaves(\''.base64_encode($rowid).'\');"  class="btn btn-success btn-circle" data-toggle="modal" data-target="#leaves-popup" data-original-title="View Project Details"><i class="fa fa-search" aria-hidden="true"></i></a>';
				}
								
			}
			if($this->user_type == 0){
				$employeename = "<a href=".base_url()."employee/viewemployee/".base64_encode($row->empid).">".$row->empname."</a>";
			}else{
				$employeename = $row->empname;
			}
			$datarow[] = array(
				$id = $i,
				$employeename,
				$row->date,
				$showStatus,
				$row->leavetype,
				$actionstring
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

	public function searchleaves(){
		$id=base64_decode($_POST['id']);
		$whereArr=array('id'=>$id);
		$data =$this->common_model->getData('tbl_leaves',$whereArr);
		$id= $data[0]->id;
		$str = '';
		$str.= '<p><b>Date</b></p>';
		$str.= '<p>'.$data[0]->date.'</p>';
		$str.= '<p><b>Reason for absence</b></p>';
		$str.= '<p>'.$data[0]->reasonforabsence.'</p>';
		$str.= '<p><b>Status</b></p>'; 
		if($data[0]->status == 0)
		{
			$status='Pending';
		}
		else if($data[0]->status == 1)
		{
			$status='Approved';
		}
		$str.= '<p>'.$status.'</p>';
		$str.= '<p><button onclick="closeleaves()" class="btn btn-white waves-effect" >Close</button>  </p>'; 
		
		if($data[0]->status == 0){

			$str.= '<p><button onclick="editleaves(\''.base64_encode($id).'\')" class="btn btn-success"><i class="fa fa-edit">Edit</i> </button></p>';
			$str.= '<p><button onclick="deleteSearchLeaves(\''.base64_encode($id).'\')" class="btn btn-danger"><i class="fa fa-times">Delete</i> </button></p>';

		
		}else if($data[0]->status == 1){

				$str.= '<p><button onclick="deleteSearchLeaves(\''.base64_encode($id).'\')" class="btn btn-danger"><i class="fa fa-times">Delete</i> </button></p>';


		}
			
		
		echo json_encode($str);exit;
	}

	public function editleavesbtn(){
		$id=base64_decode($_POST['id']);
		$whereArr=array('id'=>$id);
		$whereEmp = array('is_deleted'=>0);
		$leaves =$this->common_model->getData('tbl_leaves',$whereArr);
		$emp['employee'] =$this->common_model->getData('tbl_employee',$whereEmp);
		$leavetype['leave'] =$this->common_model->getData('tbl_leavetype');
		$id= $leaves[0]->id;

		if($this->user_type == 0){
			$string = '';
		$string.= '<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label" for="choosemem">Choose Member</label>
									<select class="custom-select br-0" id="choose_mem" name="choose_mem" value="">';
										foreach($emp['employee'] as $emp){
											$str='';
												if($emp->id==$leaves[0]->empid){	
													$str='selected';
												}
													$string.= '<option value="'.$emp->id.'" '.$str.'>'.$emp->employeename.'</option>';
										}

		$string.= 	               '</select>
						   	</div>
						</div>
					</div>';
		$string.= '	<div class="row">
						<div class="col-md-12">
							<div class="form-group project-category">
								<label class="control-label" for="leave_type">Leave Type</label> 
									<select class="custom-select br-0" id="leave_type" name="leave_type">';	
									    foreach($leavetype['leave'] as $lea){

											$str='';

											if($lea->id==$leaves[0]->leavetypeid){
												$str='selected';
												}  
												$string.= '<option value="'.$lea->id.'"'.$str.'>'. 
									       	  	$lea->name.'</option>';
								        }
																							
		$string.=	               '</select>
							</div>
						</div>
				</div>';

		//For Date
		$date='';
		if(	!empty($leaves[0]->date)){
			 $leaves[0]->date;
		}

		//$leaves[0]->date;die;
		$string.=   '<div class="row">
						<div class="col-md-4" id="deadlineBox">
							<div class="form-group">
								<label class="control-label">Date</label>
									<input type="text" name="date" id="date" class="form-control" value="'.$leaves[0]->date.'">


								</div>
							</div>
				     </div>';

		//For Reason for absence
		if(	!empty($leaves[0]->reasonforabsence)){
			$reasonforabsence = $leaves[0]->reasonforabsence;
		}

		$string.=  '<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Reason for absence</label>
								<textarea id="absence" class="form-control" name="absence" rows="5">'.$reasonforabsence.'
								</textarea>
							</div>
						</div>';
	      
		$string.=      '<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Status</label>
									<select id="status" class="form-control" name="status">'

									   .$str=''.';

										<option value="1"';
											if($leaves[0]->status==1)
											{ 
												 $str= 'selected';
											}
									       $string.=''.$str.'>Approved</option>';
											
		$string.=                      '<option value="0" ';
											if($leaves[0]->status==0)
											{
												 $str= 'selected';
											}
											$string.= ''.$str.'>Pending</option>
									</select>
								</div>
							</div>

					</div>';

		}else if($this->user_type == 2){
		
		$string = '';
		$string.= '<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label" for="choosemem" style="display: none">Choose Member</label>
									<select class="custom-select br-0" id="choose_mem" name="choose_mem" value="" style="display: none">';
										foreach($emp['employee'] as $emp){
											$str='';
												if($emp->id==$leaves[0]->empid){	
													$str='selected';
												}
													$string.= '<option value="'.$emp->id.'" '.$str.'>'.$emp->employeename.'</option>';
										}

		$string.= 	               '</select>
						   	</div>
						</div>
					</div>';
		$string.= '	<div class="row">
						<div class="col-md-12">
							<div class="form-group project-category">
								<label class="control-label" for="leave_type">Leave Type</label> 
									<select class="custom-select br-0" id="leave_type" name="leave_type">';	
									    foreach($leavetype['leave'] as $lea){

											$str='';

											if($lea->id==$leaves[0]->leavetypeid){
												$str='selected';
												}  
												$string.= '<option value="'.$lea->id.'"'.$str.'>'. 
									       	  	$lea->name.'</option>';
								        }
																							
		$string.=	               '</select>
							</div>
						</div>
				</div>';

		//For Date
		$date='';
		if(	!empty($leaves[0]->date)){
			 $leaves[0]->date;
		}

		//$leaves[0]->date;die;
		$string.=   '<div class="row">
						<div class="col-md-4" id="deadlineBox">
							<div class="form-group">
								<label class="control-label">Date</label>
									<input type="text" name="date" id="date" class="form-control" value="'.$leaves[0]->date.'">


								</div>
							</div>
				     </div>';

		//For Reason for absence
		if(	!empty($leaves[0]->reasonforabsence)){
			$reasonforabsence = $leaves[0]->reasonforabsence;
		}

		$string.=  '<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Reason for absence</label>
								<textarea id="absence" class="form-control" name="absence" rows="5">'.$reasonforabsence.'
								</textarea>
							</div>
						</div>';
	      
		$string.=      '<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" style="display: none">Status</label>
									<select id="status" class="form-control" name="status" style="display: none">'

									   .$str=''.';

										<option value="1"';
											if($leaves[0]->status==1)
											{ 
												 $str= 'selected';
											}
									       $string.=''.$str.'>Approved</option>';
											
		$string.=                      '<option value="0" ';
											if($leaves[0]->status==0)
											{
												 $str= 'selected';
											}
											$string.= ''.$str.'>Pending</option>
									</select>
								</div>
							</div>

					</div>';
		}
		

		$string.=   '<div class="form-actions">
						<button type="button" onclick="editdata(\''.base64_encode($id).'\')" name="btnupdate" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>		
						<input type="button" onclick="closeleaves()" class="btn btn-default" value="Close">
					</div>';
	            
		 echo json_encode($string);exit;
 	
	}

	//leaves list approveleaves
	public function approveleaves(){

		$id = base64_decode($this->uri->segment(3));
		$whereArr = array('id'=>$id);
		$updateArr= array('status'=>1);
		$this->common_model->updateData('tbl_leaves',$updateArr,$whereArr);
		redirect('Leaves/index');
		
	}

	//leaves list updateleaves
	public function updateleaves(){

		$id=base64_decode($_POST['id']);
		$whereArr=array('id'=>$id);
		$mem  =   $this->input->post('mem');
		$type =   $this->input->post('ltype');
		$date =   $this->input->post('date');
		$abs  =   $this->input->post('abs');
		$status =   $this->input->post('sta');
		$updateArr = array('empid'=>$mem,'leavetypeid'=>$type,'date'=>$date,'reasonforabsence'=>
			$abs,'status'=>$status);
		$whereArr=array('id'=>$id);
		$this->common_model->updateData('tbl_leaves',$updateArr,$whereArr);
		$this->session->set_flashdata('message_name', 'Leaves Update sucessfully');
	}

	//Leave list search button click->After deleteSearchLeaves
	public function deleteSearchLeaves(){

		$id=base64_decode($_POST['id']);
		$whereArr=array('id'=>$id);
		$this->common_model->deleteData('tbl_leaves',$whereArr);
		$this->session->set_flashdata('message','Delete Succesfully....');
		redirect('Leaves/index');
	}

	//leave list deleteleaves 
	public function deleteleaves(){

		$id=base64_decode($_POST['id']);
		$whereArr=array('id'=>$id);
		$this->common_model->deleteData('tbl_leaves',$whereArr);
		$this->session->set_flashdata('message','Delete Succesfully....');
		redirect('Leaves/index');
	}

    //leave list insertleavestype 
	public function insertleavestype(){

		if(!empty($_POST)){
			$leaveName = $this->input->post('name');
			$insArr = array('name'=>$leaveName);
			$leaveData=$this->common_model->insertData('tbl_leavetype',$insArr);

			$leaveArray = $this->common_model->getData('tbl_leavetype');
			$str = '';
			foreach($leaveArray as $row){
				$str.='<option value="'.$row->id.'">'.$row->name.'</option>'; 
			}
			$totaldata = count($leaveArray);
			$leaveArr = array();
			$leaveArr['count'] = $totaldata;
			$leaveArr['deleteleavetype'] = $str;
			$leaveArr['leaveData'] = $leaveData;
			
			echo json_encode($leaveArr);exit; 
		}
	}

	public function checkleaves(){
				$status = 0;
		if(!empty($_POST['leave'])){
			$where = array('name'=>$_POST['leave']);
			$checkData = $this->common_model->getData('tbl_leavetype',$where);
			if(!empty($checkData)){
				$status = 1;
			}
		}
		echo $status;exit();
	}

	public function deleteleavetype(){
		
		$status = 0;
		if(!empty($_POST['id'])){
			$id=$this->input->post('id');
			$deleteArr=array('id'=>$id);
			$this->common_model->deleteData('tbl_leavetype',$deleteArr);
			$status = 1;
		}
		echo $status;exit();
	}

}
