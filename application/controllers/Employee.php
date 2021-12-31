<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('common_model');
		func_check_login();
		$this->load->library('SendMail');
	}
	
	public function index(){
		if(!empty($this->uri->segment(3))){
			$data['freeEmp'] = base64_decode($this->uri->segment(3));
		}
		$data['designation'] = $this->common_model->getData('tbl_designation');
		$data['department'] = $this->common_model->getData('tbl_department');
		$whereArr = array('is_deleted'=>0);
		$data['employee'] = $this->common_model->getData('tbl_employee',$whereArr);
		$tempArr=array();
		foreach($data['employee'] as $row){
			$skill = $row->skills;
			$array = explode(",",$skill);
			if(!empty($tempArr)){
				$tempArr = array_merge($array,$tempArr);
			}
			else{
				$tempArr = $array;
			}
		}
		$data['skillArr'] = array_unique($tempArr);
		$this->load->view('common/header');
		$this->load->view('employees/employees',$data);
		$this->load->view('common/footer');
	}

	public function addemployee(){
		$this->load->view('common/header');
		$data['sessData'] = $this->session->flashdata('emp_data');
		$data['error_msg'] = $this->session->flashdata('error');
		$data['designation'] = $this->common_model->getData('tbl_designation');
		$data['department'] = $this->common_model->getData('tbl_department');
		$this->load->view('employees/addemployee',$data);
		$this->load->view('common/footer');
	}

	public function insertemployee(){
		if(!empty($_POST)){
			$employee_name = $this->input->post('employee_name');
			$employee_email = $this->input->post('employee_email');
			$orgpassword=$this->input->post('password');
			$password=md5($this->input->post('password'));
			if($this->input->post('randompassword')=='on'){
				$randompassword='1';
			}
			else{ 
				$randompassword='0';
			}
			$grp = $randompassword;
			$mobile = $this->input->post('mobile');
			$username = $this->input->post('username');
			$joiningdate = $this->input->post('joining-date');
			$lastdate = $this->input->post('last-date');
			$gender = $this->input->post('gender');
			$address = $this->input->post('address');
			$skills = $this->input->post('skills');
			$designation = $this->input->post('designation');
			$department = $this->input->post('department');
			$hourlyrate = $this->input->post('hourly_rate');
			$login = $this->input->post('login');
			$whereArr = array('emailid' => $employee_email);
			$data = $this->common_model->getData("tbl_user",$whereArr);
			if(count($data) == 1){
				#echo "hi";exit;
				$error = array('error' =>'Email is already exits' );
				$this->session->set_flashdata("error",$error);
				$this->session->set_flashdata("emp_data",$_POST);
				redirect('employee/addemployee');			
			}
			else{
			$userinsArr =  array('user_type' => 2,'name'=>$employee_name, 'emailid' => $employee_email,'password'=>$password,'original_password'=>$orgpassword,'generaterandompassword' => $grp,'mobile' => $mobile,'status' => '0','login' => $login,'is_deleted'=>0);
			$this->common_model->insertData('tbl_user',$userinsArr);
			}
			$last_inserted = $this->db->insert_id();
			//$profilepicture = $this->input->post('imagename');
			/*$config = array(
							'upload_path' => './uploads/',
							'allowed_types' => 'gif|jpg|png',
							'max_size' =>'1000',
							'max_width'=>'1024',
							'max_height' => '768'
							);
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			$profilepicture = '';
			if($this->upload->do_upload('profilepicture')){
				$profilepicture = array('upload_data'=>$this->upload->data());*/
			$insArr = array('user_id' =>$last_inserted,'employeename'=>$employee_name,'slackusername'=>$username,'joingdate'=>$joiningdate,'lastdate'=>$lastdate,'gender'=>$gender,'address'=>$address,'skills'=>$skills,'designation'=>$designation,'department'=>$department,'hourlyrate'=>$hourlyrate,'is_deleted'=>0);
				$this->common_model->insertData('tbl_employee',$insArr);

				 $subject = 'Congratulation,You are successfully register on PMS.com';
                if(!empty($employee_email)){
                    
                    $msg="Dear ".$employee_name."<br/>";
                    $msg.="You are successfully registered please verify your email address ";
                }
                $msg.="<a href=".base_url().'Users/verify_email/'.base64_encode($employee_email)."> Click here </a>";
                $result = $this->sendmail->sendTo($employee_email, 'Dear Customer',$subject,$msg);

				$this->session->set_flashdata('message_name', 'Employee Insert sucessfully');
			/*}
			else{
				$error = array('error' => $this->upload->display_errors());
				//print_r($error);die;
				$this->session->set_flashdata("error",$error);
				$this->session->set_flashdata("data",$_POST);
				redirect('employee/addemployee');			
			}*/
			redirect('employee');
		}			
	}

	public function checkDesignation(){
		$status = 0;
		if(!empty($_POST['name'])){
			$where = array('name'=>$_POST['name']);
			$checkData = $this->common_model->getData('tbl_designation',$where);
			if(!empty($checkData)){
				$status = 1;
			}
		}
		echo $status;exit();
	}

	public function insert_designation(){
		if(!empty($_POST)){
			$designName = $this->input->post('name');
			$insArr = array('name'=>$designName);
			$this->common_model->insertData('tbl_designation',$insArr);
			$designationArray = $this->common_model->getData('tbl_designation');
			$str = '';
			foreach($designationArray as $row){
				$str.='<option value="'.$row->id.'">'.$row->name.'</option>'; 
			}
			$desArr = array();
			$desArr['desData'] = $str;
			echo  json_encode($desArr);exit; 
		}
	}

	public function checkDepartment(){
		$status = 0;
		if(!empty($_POST['name'])){
			$where = array('name'=>$_POST['name']);
			$checkData = $this->common_model->getData('tbl_department',$where);
			if(!empty($checkData)){
				$status = 1;
			}
		}
		echo $status;exit();
	}
	public function insert_department(){
		if(!empty($_POST)){
			$desName = $this->input->post('name');
			$insArr = array('name'=>$desName);
			$this->common_model->insertData('tbl_department',$insArr);
			$designationArray = $this->common_model->getData('tbl_department');
			$str = '';
			foreach($designationArray as $row){
				$str.='<option value="'.$row->id.'">'.$row->name.'</option>'; 
			}
			$depArr = array();
			$depArr['depData'] = $str;
			echo  json_encode($depArr);exit; 
		}
	}

/* image upload through ajax
	public function do_upload(){
		if(!empty($_FILES))
		{
			$config['upload_path']= './uploads/';
			$config['allowed_types']='gif|jpg|png';
			$config['encrypt_name'] = TRUE;
			 
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
				if(!$this->upload->do_upload('profilepicture'))  
				{  
					$data['error']= $this->upload->display_errors();  
				}
				else
				{
					$data['error']='';
					$image= array('upload_data' => $this->upload->data());
					$data['image']= $image['upload_data']['file_name']; 
				}
		}
		else
		{
			$data['error']='Not select photo';
		}
        echo json_encode($data);
    }*/

    public function employee_list(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'employeename', 'employeeemail', 'status','createdat');
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
            	$sWhere .= ' AND (employeename like "%'.$searchTerm.'%" OR address like "%'.$searchTerm.'%" OR skills like "%'.$searchTerm.'%" OR slackusername like "%'.$searchTerm.'%" OR tbl_user.emailid like "%'.$searchTerm.'%")';
            }
			$status = $_POST['status'];
			//echo $status;die;
			$employee = !empty($_POST['employeename']) ? $_POST['employeename'] : '';
			$skill = !empty($_POST['skill']) ? $_POST['skill'] : '';
			$designation = !empty($_POST['designation']) ? $_POST['designation'] : '';
			$department = !empty($_POST['department']) ? $_POST['department'] : '';

			if(!empty($employee)){
				$sWhere.=' AND  tbl_employee.id="'.$employee.'"';
			}
			if($status == 'All'){
			}
			else{
				$sWhere.=' AND  status='.$status;
			}
			if(!empty($designation)){
				$sWhere.=' AND  designation='.$designation;
			}
			if(!empty($department)){
				$sWhere.=' AND  department='.$department;
			}
			if(!empty($skill)){
				$sk = 'FIND_IN_SET("'.$skill.'",skills)';
				//echo $sk;die;
				$sWhere.=' AND '.$sk;
			}
			$sWhere.=' AND tbl_user.is_deleted = 0';	
            if(!empty($sWhere)){
            	$sWhere = " WHERE 1 ".$sWhere;
            }
            /** Filtering End */
		}
		if($this->uri->segment(3)== 1){
			$query = "SELECT tbl_user.id,tbl_user.is_deleted,tbl_employee.employeename,tbl_user.emailid,tbl_user.status,tbl_user.created_at from tbl_employee inner join  tbl_user on tbl_employee.user_id = tbl_user.id AND tbl_employee.id not in(SELECT emp_id from tbl_project_member)".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
			//echo $query;die;
		}
		else{
			$query = "SELECT tbl_user.id,tbl_user.is_deleted,tbl_employee.employeename,tbl_user.emailid,tbl_user.status,tbl_user.created_at from tbl_employee inner join  tbl_user on tbl_employee.user_id = tbl_user.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		}
	    
		$empsArr = $this->common_model->coreQueryObject($query);
		//echo $this->db->last_query();die;
		if($this->uri->segment(3) == 1){
			$Filterquery = "SELECT tbl_user.id,tbl_user.is_deleted,tbl_employee.employeename,tbl_user.emailid,tbl_user.status,tbl_user.created_at from tbl_employee inner join  tbl_user on tbl_employee.user_id = tbl_user.id AND tbl_employee.id not in(SELECT emp_id from tbl_project_member)".$sWhere;
		}
		else{
			$Filterquery = "SELECT tbl_user.id,tbl_user.is_deleted,tbl_employee.employeename,tbl_user.emailid,tbl_user.status,tbl_user.created_at from tbl_employee inner join  tbl_user on tbl_employee.user_id = tbl_user.id".$sWhere;
			
		}
		$empsFilterArr = $this->common_model->coreQueryObject($Filterquery);
		$iFilteredTotal = count($empsFilterArr);
		if($this->uri->segment(3) == 1){
			$sql = "SELECT * from tbl_employee where is_deleted = 0 AND  tbl_employee.id not in(SELECT emp_id from tbl_project_member)";
			$empsAllArr = $this->common_model->coreQueryObject($sql);
		}
		else{
			$where = array('is_deleted'=>0);
			$empsAllArr = $this->common_model->getData('tbl_employee',$where);
		}
		
		
		//print_r($empsAllArr);die;
		$iTotal = count($empsAllArr);

		/** Output */
		$datarow = array();
		$i = 1;
		foreach($empsArr as $row) {
			$id = $row->id;
			if($row->status == '0'){
				$st = $row->status = 'Active';
				$status = '<label class="label label-success">'.$st.'</label>';
			}
			else{
				$st = $row->status = 'Inactive';
				$status = '<label class="label label-danger">'.$st.'</label>';
			}
			$create_date = date('d-m-Y', strtotime($row->created_at));
			$actionStr = "<abbr title=\"Edit\"><a class=\"btn btn-info btn-circle\" data-toggle=\"tooltip\" data-original-title=\"Edit\" href='".base_url()."employee/editemployee/".base64_encode($row->id)."'><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a></abbr>
				<abbr title=\"View Employee Detail\"><a class=\"btn btn-success btn-circle\" data-toggle=\"tooltip\" data-original-title=\"search\" href='".base_url()."employee/viewemployee/".base64_encode($row->id)."'><i class=\"fa fa-search\" aria-hidden=\"true\"></i></a></abbr>
				<abbr title=\"Delete\"><a  class=\"btn btn-danger btn-circle sa-params\" data-toggle=\"tooltip\"  data-original-title=\"Delete\" href=\"javascript:void(0);\" onClick='deleteemployee(\"".base64_encode($row->id)."\");'><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a></abbr>";
				$employeename = "<a href=".base_url()."employee/viewemployee/".base64_encode($row->id).">".$row->employeename."</a>";
			$datarow[] = array(
				$id = $i,
                $employeename,
                $row->emailid,
				$status,
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

	public function editemployee(){
		$id = base64_decode($this->uri->segment(3));
		$whereArr = array('id'=>$id,'is_deleted'=>0);
		$whereArr1 = array('user_id'=>$id,'is_deleted'=>0);
		$data['user'] = $this->common_model->getData('tbl_user',$whereArr);
		$data['employee'] = $this->common_model->getData('tbl_employee',$whereArr1);
		$data['sessData'] = $this->session->flashdata('data');
		$data['designation'] = $this->common_model->getData('tbl_designation');
		$data['department'] = $this->common_model->getData('tbl_department');
		if(!empty($_POST)){
			$employee_name = $this->input->post('employee_name');
			$employee_email = $this->input->post('employee_email');
			$updateArr=array();
			if($this->input->post('password') != ''){
				$updateArr['original_password'] = $this->input->post('password');
				$updateArr['password'] = md5($this->input->post('password'));
			}
			if($this->input->post('randompassword')=='on'){
				$randompassword='1';
			}
			else{ 
				$randompassword='0';
			}
			$grp = $randompassword;
			$mobile = $this->input->post('mobile');
			$username = $this->input->post('username');
			$joiningdate = $this->input->post('joining-date');
			$lastdate = $this->input->post('last-date');
			$gender = $this->input->post('gender');
			$address = $this->input->post('address');
			$skills = $this->input->post('skills');
			$designation = $this->input->post('designation');
			$department = $this->input->post('department');
			$hourlyrate = $this->input->post('hourly_rate');
			$status = $this->input->post('status');
			$login = $this->input->post('login');
				
			$updateArr['emailid'] = $employee_email;
			$updateArr['generaterandompassword'] = $grp;
			$updateArr['mobile'] = $mobile;
			$updateArr['status'] = $status;
			$updateArr['login'] = $login;

			$updateArr1['employeename'] = $employee_name;
			$updateArr1['slackusername'] = $username;
			$updateArr1['joingdate'] = $joiningdate;
			$updateArr1['lastdate'] = $lastdate;
			$updateArr1['gender'] = $gender;
			$updateArr1['address'] = $address;
			$updateArr1['skills'] = $skills;
			$updateArr1['designation'] = $designation;
			$updateArr1['department'] = $department;
			$updateArr1['hourlyrate'] = $hourlyrate;
			$whereck = array('emailid'=>$_POST['employee_email'],'id !='=>$id);
			$checkEmail = $this->common_model->getData('tbl_user',$whereck);
			if(empty($checkEmail)){
				$this->common_model->updateData('tbl_employee',$updateArr1,$whereArr1);
				$this->session->set_flashdata('message_name', 'Employee Update sucessfully');
				$this->common_model->updateData('tbl_user',$updateArr,$whereArr);
				redirect('employee');
			}
			else{
				$error = array('error' =>'Email is already exits' );
				$this->session->set_flashdata('error', $error);
				//echo "ghdvc";die;
				$this->session->set_flashdata("sessDataEmp",$_POST);
			}
		}
		$data['error_msg'] = $this->session->flashdata('error');
		$this->load->view('common/header');
		$this->load->view('employees/editemployee',$data);
		$this->load->view('common/footer');			
	}

	public function deleteemployee(){
		$id = base64_decode($_POST['id']);
		$whereArr = array('id'=>$id);
		$whereArrEmployee = array('user_id'=>$id);
		$updateArr = array('is_deleted' => '1');
		$this->common_model->updateData('tbl_user',$updateArr,$whereArr);
		$this->common_model->updateData('tbl_employee',$updateArr,$whereArrEmployee);
		redirect('employee');
	}

	public function viewemployee(){
		$id = base64_decode($this->uri->segment(3));
		$whereArr = array('user_id'=>$id , 'is_deleted' => 0);
		$data['empData'] = $this->common_model->getData('tbl_employee',$whereArr);
		$whereUSer = array('id'=>$id , 'is_deleted' => 0);
		$data['empUser'] = $this->common_model->getData('tbl_user',$whereUSer);
		$whereLeave = array('empid' => $data['empData'][0]->id);
		$data['empLeaves'] = $this->common_model->getData('tbl_leaves',$whereLeave);
		$this->load->view('common/header');
		$this->load->view('employees/viewemployee',$data);
		$this->load->view('common/footer');
	}	

}
?>