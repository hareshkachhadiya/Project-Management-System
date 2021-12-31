<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends CI_Controller {

	public function __construct(){
		parent::__construct();
		error_reporting(E_ALL);
		ini_set('display_errors', 0);
		$this->load->model('common_model');
		$this->login = $this->session->userdata('login');
		$this->user_type = $this->login->user_type;
		$this->user_id = $this->login->id;
		func_check_login();
	}

	public function index(){
		$data['s_date']=date('Y-m-d',strtotime('-1 month'));
		$data['e_date']=date('Y-m-d');
		$data['tickettype']=$this->common_model->getData('tbl_ticket_type');
		$data['ticketchannel']=$this->common_model->getData('tbl_ticket_channel');
		$whereArr = array('is_deleted'=>0);
		$data['getemployee']=$this->common_model->getData('tbl_employee',$whereArr);
		$this->load->view('common/header');
		$this->load->view('ticket/ticket',$data);
		$this->load->view('common/footer');
	}

	public function addticket(){
		$data['tickettype']=$this->common_model->getData('tbl_ticket_type');
		$data['ticketchannel']=$this->common_model->getData('tbl_ticket_channel');
	
		$whereArr = array('is_deleted'=>0);
		$data['getclient']  = $this->common_model->getData('tbl_clients',$whereArr);
		$whereArr = array('is_deleted'=>0);
		$data['getemployee']=$this->common_model->getData('tbl_employee',$whereArr);
		//echo '<pre>';print_r($data['getemployee']);
		$this->load->view('common/header');
		$this->load->view('ticket/addticket',$data);
		$this->load->view('common/footer');
	}

	public function insertticket(){
		if(!empty($_POST)){
			$t_subject = $this->input->post('ticket_subject');
			$t_editor  = $this->input->post('editor2');
			if($this->user_type == 0){
				$status = $this->input->post('status');
			}elseif($this->user_type == 1){
				$status =1;
			}elseif($this->user_type == 2){
				$status =1;
			}
			
			if($this->user_type == 0){
				$t_requestname = $this->input->post('requestername');
			}elseif($this->user_type == 1){
				$whereArr = array('user_id'=>$this->user_id);
				$clientData = $this->common_model->getData('tbl_clients',$whereArr);
				$t_requestname =$clientData[0]->id;
			}
			if($this->user_type == 0){
				$t_agentname = $this->input->post('agentname');
			}elseif($this->user_type == 2){
				$whereArr = array('user_id'=>$this->user_id);
				$empData = $this->common_model->getData('tbl_employee',$whereArr);
				$t_agentname =$empData[0]->id;
			}
			
			$t_question = $this->input->post('question');
			$t_priority = $this->input->post('priority');
			$t_channel = $this->input->post('channel');
			$t_tags =  $this->input->post('tags');
			//Image Upload
			$file = $_FILES['ticket_Image']['name'];
			$file_loc = $_FILES['ticket_Image']['tmp_name'];
			$file_size = $_FILES['ticket_Image']['size'];
			$file_type = $_FILES['ticket_Image']['type'];
			$folder="upload/";
			move_uploaded_file($file_loc,$folder.$file);
			if($this->user_type == 0){
				$insArr  = array('ticketsubject'=>$t_subject,'ticketdescription'=>$t_editor,'status'=>$status, 'ticketimage'=>$file,'requestername'=>$t_requestname,'agent'=>$t_agentname,'type'=>$t_question,'priority'=>$t_priority,'channelname'=>$t_channel,'tags'=>$t_tags,'assign_ticket'=>1);
			}
			else{
				$insArr  = array('ticketsubject'=>$t_subject,'ticketdescription'=>$t_editor,'status'=>$status, 'ticketimage'=>$file,'requestername'=>$t_requestname,'agent'=>$t_agentname,'type'=>$t_question,'priority'=>$t_priority,'channelname'=>$t_channel,'tags'=>$t_tags);
			}
			
			$query  =  $this->common_model->insertData('tbl_ticket',$insArr);
			$this->session->set_flashdata('message_name','Ticket Inserted Successfully...');
			redirect('ticket/index');
		}
	}

	public function ticketlist(){
		if(!empty($_POST)){
		$_GET = $_POST;
		$defaultOrderClause = "";
		$sWhere = "";
		$sOrder = '';
		$aColumns = array( 'id', 'ticketsubject', 'ticketdescription', 'ticketimage', 'requestername' ,'agent' , 'type' , 'priority' ,'status','channelname' , 'tags');
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
					}else {
						$sOrder = $defaultOrderClause . " ";
					}
					$sortColumnName = intval($_GET['iSortCol_' . $i]).'|'.$_GET['sSortDir_' . $i];
				}
			}

			$sOrder = substr_replace($sOrder, "", -2);
			if ($sOrder == "ORDER BY") {
				$sOrder = "";
			}
			}else {
				$sOrder = $defaultOrderClause;
			}

			if(!empty($sOrder)){
				$sOrder = " ORDER BY ".$sOrder;
			}
			/** Ordering End **/

			/** Filtering Start */
			if(!empty(trim($_GET['sSearch']))){
				$searchTerm = trim($_GET['sSearch']);
				$sWhere.= ' AND (ticketsubject like "%'.$searchTerm.'%" OR tbl_clients.clientname like "%'.$searchTerm.'%")';
			}
			$sdate=!empty($_POST['s_date'])?$_POST['s_date']:'';
			$enddate=!empty($_POST['e_date'])?$_POST['e_date']:'';
			$agent=!empty($_POST['agent'])?$_POST['agent']:'';

			$status=!empty($_POST['status1'])? $_POST['status1'] : '';
			$priority=!empty($_POST['priority']) ? $_POST['priority'] : '';
			$cname=!empty($_POST['channelname']) ? $_POST['channelname'] : '';
			$type=!empty($_POST['tickettype']) ? $_POST['tickettype'] : '';
			if(!empty($sdate)){
				$sWhere.= 'AND created_at >="'.$sdate.'"';
			}
			if(!empty($enddate)){
				$sWhere.= 'AND created_at<="'.$enddate.'"';
			}
			if($status =='all'){
			}
			else if(!empty($status)){
				$sWhere.=' AND tbl_ticket.status='.$status;
			}
			if($priority =='all'){
			}
			else if(!empty($priority)){
				$sWhere.=' AND tbl_ticket.priority='.$priority;
			}
			if($cname =='all'){
			}
			else if(!empty($cname)){
				$sWhere.=' AND tbl_ticket.channelname='.$cname;
			}
			if(!empty($agent)){
				$sWhere.=' AND tbl_ticket.agent='.$agent;
			}
			if($type =='all'){
			}
			else if(!empty($type)){
				$sWhere.=' AND tbl_ticket.type='.$type;
			}

				$sWhere.=' AND tbl_ticket.status!=4';
			
			$whereArr = array('user_id'=>$this->user_id);
			$empData = $this->common_model->getData('tbl_employee',$whereArr);
			$whereArr = array('user_id'=>$this->user_id);
			$clientData = $this->common_model->getData('tbl_clients',$whereArr);
			if($this->user_type == 1){
				$sWhere.=' AND tbl_ticket.requestername='.$clientData[0]->id;
			}
			
			$sWhere = " WHERE 1 ".$sWhere;
		}
	if($this->user_type == 0){

		$query = "SELECT tbl_ticket.*,tbl_clients.clientname,tbl_clients.id as client from tbl_ticket INNER JOIN tbl_clients on tbl_ticket.requestername=tbl_clients.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		//echo $query;die;
		$TicketArr = $this->common_model->coreQueryObject($query);

		$query1 = "SELECT tbl_ticket.*,tbl_clients.clientname from tbl_ticket INNER JOIN tbl_clients on tbl_ticket.requestername=tbl_clients.id".$sWhere;
		//echo $query1;die;
		$TicketFilterArr = $this->common_model->coreQueryObject($query1);
		$iFilteredTotal = count($TicketFilterArr);
		$TicketAllArr = $this->common_model->getData('tbl_ticket');
		$iTotal = count($TicketAllArr);

		}else if($this->user_type == 1){
		$query = "SELECT * FROM tbl_ticket".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		$TicketArr = $this->common_model->coreQueryObject($query);


		$query = "SELECT * from tbl_ticket".$sWhere;
		$TicketFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($TicketFilterArr);
		$queryAll ="SELECT * FROM tbl_ticket".$sWhere;
		//print_r($queryAll);die;
		$TicketAllArr = $this->common_model->coreQueryObject($queryAll);
		//print_r($TicketAllArr);die;
		$iTotal = count($TicketAllArr);

		}else if($this->user_type == 2){
		$query = "SELECT tbl_ticket.*,tbl_clients.clientname from tbl_ticket INNER JOIN tbl_clients on tbl_ticket.requestername=tbl_clients.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		
		$TicketArr = $this->common_model->coreQueryObject($query);

		$query = "SELECT tbl_ticket.*,tbl_clients.clientname from tbl_ticket INNER JOIN tbl_clients on tbl_ticket.requestername=tbl_clients.id".$sWhere;
		$TicketFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($TicketFilterArr);
		$queryAll ="SELECT tbl_ticket.*,tbl_clients.clientname from tbl_ticket INNER JOIN tbl_clients on tbl_ticket.requestername=tbl_clients.id".$sWhere;
		$TicketAllArr = $this->common_model->coreQueryObject($queryAll);
		$iTotal = count($TicketAllArr);
		}
		

		/** Output */
		$datarow = array();
		$i = 1;
	foreach($TicketArr as $row) {
		$j = 0;
		$clientid = $row->client;
						$whereArr = array('id'=>$clientid);
						$clientData = $this->common_model->getData('tbl_clients',$whereArr);
						$userid = $clientData[$j]->user_id;
		$rowid = $row->id;
			if($row->priority=='1'){
				$priority=$row->priority='Low';
				$showStatus = '<label class="label label-success">'.$priority.'</label>';
			}
			else if($row->priority=='2'){
				$priority=$row->priority='High';
				$showStatus = '<label class="label label-warning">'.$priority.'</label>';
			}
			else if($row->priority=='3'){
				$prioritypriority=$row->priority='Medium';
				$showStatus = '<label class="label label-warning">'.$priority.'</label>';
			}
			else if($row->priority=='4'){
				$priority=$row->priority='Urgent';
				$showStatus = '<label class="label label-warning">'.$priority.'</label>';
			}
			//For Status
			if($row->status=='1'){
				$status=$row->status='Open';
				$showStatus = '<label class="label label-success">'.$status.'</label>';
			}
			else if($row->status=='2'){
				$status=$row->status='Pending';
				$showStatus = '<label class="label label-success">'.$status.'</label>';
			}
			else if($row->status=='3'){
				$status=$row->status='Resolved';
				$showStatus = '<label class="label label-success">'.$status.'</label>';
			}
			else if($row->status=='4'){
				$status=$row->status='Close';
				$showStatus = '<label class="label label-success">'.$status.'</label>';
			}
		
			if($this->user_type == 0){
				$actionstring = '<div class="dropdown action m-r-10">
			           <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
			            <div class="dropdown-menu">
			                
			                 <a  class="dropdown-item" href="'.base_url().'ticket/viewticket/'.base64_encode($row->id).'";><i class="fa fa-eye"></i> View</a>
			                 <a  href="javascript:void();" onclick="deleteticket(\''.base64_encode($row->id).'\');" class="dropdown-item" href="javascript:void()"><i class="fa fa-trash" ></i> Delete</a>
			          </div>
					
					</div>';
		}elseif($this->user_type == 1){
			$actionstring = '<div class="dropdown action m-r-10">
			           <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
			            <div class="dropdown-menu">
			                
			                 <a  class="dropdown-item" href="'.base_url().'ticket/viewticket/'.base64_encode($row->id).'";><i class="fa fa-eye"></i> View</a>
			                 <a  href="javascript:void();" onclick="deleteticket(\''.base64_encode($row->id).'\');" class="dropdown-item" href="javascript:void()"><i class="fa fa-trash" ></i> Delete</a>
			                 <a  class="dropdown-item" href="'.base_url().'ticket/ticketclose/'.base64_encode($row->id).'";><i class="fa fa-close"></i>Close</a>
			          </div>
					
					</div>';

		}
		elseif($this->user_type == 2){
			$actionstring = '<div class="dropdown action m-r-10">
			           <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action  <span class="caret"></span></button>
			            <div class="dropdown-menu">
			                
			                 <a  class="dropdown-item" href="'.base_url().'ticket/viewticket/'.base64_encode($row->id).'";><i class="fa fa-eye"></i> View</a>
			              
			          </div>
					
					</div>';

		}
			
			if($row->requestername != ''){
				$query = "SELECT clientname from tbl_clients where id=".$row->requestername;
				$TicketArr = $this->common_model->coreQueryObject($query);
				for($i=0;$i<=count($TicketArr)-1;$i++){
				$cname = $TicketArr[$i]->clientname;
				}
			}
			else{
				$cname= '-';
			}
			
			//agent name 
			if($row->agent != ''){
				$query = "SELECT employeename from tbl_employee where id=".$row->agent;
				$empData = $this->common_model->coreQueryObject($query);
				for($i=0;$i<=count($empData)-1;$i++){
				$agent = $empData[$i]->employeename;
				}
			}
			else{
				$agent= '-';
			}
			
			
		if($this->user_type == 0 || $this->user_type == 2){	
			//For Priority
			if($this->user_type == 0){
				$clientname = "<a href=".base_url()."Clients/viewclientdetail/".base64_encode($userid)."/".base64_encode($clientid).">".$cname."</a>";
			}
			else{
				$clientname = $cname;
			}
			
			$datarow[] = array(
				$id = $i,
				$row->ticketsubject,
				$clientname,
				date('d-m-Y', strtotime($row->created_at)),
				'<b>Agent:  </b>'.$agent.
				'<br/> <b>Staus:</b> <label class="label label-success">'.$row->status.'</label><br/>
			   <label><b>Priority: </b></label>'.$row->priority,
			   	$actionstring
			);
			$i++;
			$j++;

		}else if($this->user_type == 1){

				$datarow[] = array(
				$id = $i,
				$row->ticketsubject,
				date('d-m-Y', strtotime($row->created_at)),
				'<b>Agent:</b>'.$agent.
				'<br/> <b>Staus:</b> <label class="label label-success">'.$row->status.'</label><br/>
			    <label><b>Priority:</b></label>'.$row->priority,
			    $actionstring
			);
			$i++;
		}
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

	public function viewticket(){
		$id=base64_decode($this->uri->segment(3));
		$whereArr=array('id'=>$id);
		$data['editticketId']=$id;
		$data['ticketinfo']=$this->common_model->getData('tbl_ticket',$whereArr);
		$data['tickettype']=$this->common_model->getData('tbl_ticket_type');
		$whereEmp = array('is_deleted'=>0);
		$data['getemployee']=$this->common_model->getData('tbl_employee',$whereEmp);
		$data['ticketchannel']=$this->common_model->getData('tbl_ticket_channel');
		/*$query= "Select tbl_ticket_comment.*,tbl_employee.user_id from tbl_ticket_comment inner join tbl_employee on tbl_ticket_comment.ticketemployeeid= tbl_employee.id inner join tbl_user on tbl_employee.user_id=tbl_user.id";*/
		$whereArr = array('ticketid'=>$id);
		$data['ticketcommenttest']=$this->common_model->getData('tbl_ticket_channel');

		$query = "Select * from tbl_ticket_comment where ticketid=".$id;
		//echo $query;die;
		$data['ticketcommenttest'] = $this->common_model->coreQueryObject($query);
		$this->load->view('common/header');
		$this->load->view('ticket/viewticket',$data);
		$this->load->view('common/footer');
	}

	public function deleteticket(){
		$id = base64_decode($_POST['id']);
		$whereArr = array('id' => $id);
		$this->common_model->deleteData('tbl_ticket',$whereArr);
		$this->session->set_flashdata('message','Delete Succesfully....');
		redirect('ticket/index');
	}

	public function insert_t_type(){

		if(!empty($_POST)){
		$tname = $this->input->post('name');
		$insArr = array('name'=>$tname);
		$typeid=$this->common_model->insertData('tbl_ticket_type',$insArr);
		$catArray = $this->common_model->getData('tbl_ticket_type');
		$str = '';
		foreach($catArray as $row){
		$str.='<option value="'.$row->id.'">'.$row->name.'</option>';
		}
		$totaldata = count($catArray);
		$catArr = array();
		$catArr['count'] = $totaldata;
		$catArr['ticketdata'] = $str;
		$catArr['typeid']= $typeid;
		echo json_encode($catArr);exit;
		}
		}

		public function check_t_type(){
		$status = 0;
		if(!empty($_POST['ticket'])){
		$where = array('name'=>$_POST['ticket']);
		$checkData = $this->common_model->getData('tbl_ticket_type',$where);
		if(!empty($checkData)){
		$status = 1;
		}
		}
		echo $status;exit();
	}

	public function insert_t_channel(){
		//echo('ds');die;
		if(!empty($_POST)){
		$cname = $this->input->post('name');
		$insArr = array('name'=>$cname);
		$this->common_model->insertData('tbl_ticket_channel',$insArr);
		$catArray = $this->common_model->getData('tbl_ticket_channel');

		//echo $image;die;
		$str = '';
		foreach($catArray as $row){
		$str.='<option value="'.$row->id.'">'.$row->name.'</option>';
		}
		$channelArr = array();
		$channelArr['ticketcdata'] = $str;
		echo json_encode($channelArr);exit;
		}
	}

	public function check_t_channel(){
		$status = 0;
		if(!empty($_POST['channel'])){
		$where = array('name'=>$_POST['channel']);
		$checkData = $this->common_model->getData('tbl_ticket_channel',$where);
		if(!empty($checkData)){
		$status = 1;
		}
		}
		echo $status;exit();
	}

	public function insert_comment(){
		//print_r($_FILES);die;
		if(!empty($_POST)){
		$ticket_comment = $this->input->post('editor');
		$ticketid = $this->input->post('ticketid');
		
		//$ticket_Image = $this->input->post('ticket_Image');
		/*$status = $this->input->post('status');
		$empid = $this->input->post('t_empid');*/
		//Image Upload
		
			$file = $_FILES['ticket_Image']['name'];
			$file_loc = $_FILES['ticket_Image']['tmp_name'];
			$file_size = $_FILES['ticket_Image']['size'];
			$file_type = $_FILES['ticket_Image']['type'];
			$folder="upload/";
			move_uploaded_file($file_loc,$folder.$file);
		$whereArr = array('id'=>$this->user_id);
		$data = $this->common_model->getData('tbl_user',$whereArr);
		$whereArrEmp = array('user_id'=>$data[0]->id);
		$empData = $this->common_model->getData('tbl_employee',$whereArrEmp);
		
		if($this->user_type == 0){
			$replierId = 1;
		}
		else{
					$replierId = $empData[0]->id;

		}
		$insArr = array('ticketid'=>$ticketid,'ticketemployeeid'=>$replierId,'profileimg'=>$file,'comment' => $ticket_comment);
		//print_r($insArr);
		$ticketArr =$this->common_model->insertData('tbl_ticket_comment',$insArr);
		$tArray = $this->common_model->getData('tbl_ticket_comment');

		/*$query= "Select tbl_ticket_comment.*,tbl_employee.user_id,tbl_user.profileimg from tbl_ticket_comment inner join tbl_employee on tbl_ticket_comment.ticketemployeeid= tbl_employee.id inner join tbl_user on tbl_employee.user_id=tbl_user.id";*/

		//$img_corequery= $this->common_model->coreQueryObject($query);
		//$image=$img_corequery[0]->profileimg;
		/*$image=$tArray[0]->profileimg;
		$created = $tArray[0]->created_at;
		$replay =  $tArray[0]->comment;;
		$totaldata = count($tArray);
		$commentArr = array();
		$commentArr['count'] = $totaldata;
		$commentArr['create'] = $created;
		$commentArr['replay'] = $replay;
		$commentArr['profileimg'] = $image;
		$commentArr['insCommentData'] = $ticketArr;

		echo json_encode($commentArr);exit;*/	
		redirect('ticket/viewticket/'.base64_encode($ticketid));	
		}
	}

	public function deletecomment(){

		$id=$_POST['id'];
		$whereArr=array('id'=>$id);
		$this->common_model->deleteData('tbl_ticket_comment',$whereArr);
		//echo $this->db->last_query();die;
		$this->session->set_flashdata('message','Delete Succesfully....');
		redirect('ticket/index');
	}

	public function ticketclose(){
		$ticketid = base64_decode($this->uri->segment(3));
		$whereArr = array('id'=>$ticketid);
		//print_r($whereArr);die;
		$updateArr = array('status'=>4);
		$this->common_model->updateData('tbl_ticket',$updateArr,$whereArr);
		$this->session->set_flashdata('message_name','Ticket Close Succesfully..');
		redirect('ticket/index');
	}
}


