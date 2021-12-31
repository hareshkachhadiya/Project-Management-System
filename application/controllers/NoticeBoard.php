<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class NoticeBoard extends CI_Controller{
	public function __construct(){
		parent::__construct();
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
		$this->load->view('Notice/notice',$data);
		$this->load->view('common/footer');
	}
	
	public function addNotice(){
		$data['department']=$this->common_model->getData('tbl_department');		
		$this->load->view('common/header');
		$this->load->view('Notice/addnotice',$data);
		$this->load->view('common/footer');
	}
	
	public function insertNotice(){
		if(!empty($_POST)){
			$heading=$this->input->post('heading');
			$noticeto=$this->input->post('noticeto');
			$department=$this->input->post('department');
			//echo $heading.''.$department;die;
			$desc=$this->input->post('desc');
	
				$insertArr=array('heading'=>$heading,'noticeto' => $noticeto,'department' => $department,'description' => $desc);
				$this->common_model->insertdata('tbl_notice',$insertArr);
				
				$this->session->set_flashdata('message_name', "Data Inserted Successfully");
				redirect('NoticeBoard/index');
		}
	}

	public function notice_list(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';	
			$aColumns = array('id','heading','noticeto','department','description', 'created_at');
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
            		$sWhere .= ' AND (heading like "%'.$searchTerm.'%" OR description like "%'.$searchTerm.'%")';
            	}
				$startdate=!empty($_POST['startdate']) ? $_POST['startdate'] : '';
				$enddate=!empty($_POST['enddate']) ? $_POST['enddate'] : '';
					if(!empty($startdate)){						
						$sWhere.=' AND created_at>="'.$startdate.' 00:00:00'.'"';
					}
					if(!empty($enddate)){						
						$sWhere.=' AND created_at<="'.$enddate.'"';
					}
					/*$sWhere.=' AND tbl_user.is_deleted=0';*/
					if($this->user_type == 1){
						$sWhere.=' AND noticeto=1';
					}
					elseif($this->user_type == 2){
						$sWhere.=' AND noticeto=2';
					}
					if(!empty($sWhere)){
						$sWhere = " WHERE 1 ".$sWhere;
					}
					/** Filtering End */
		}
		if($this->user_type == 0){
			$query = "select * from tbl_notice".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
	    	$noticesArr = $this->common_model->coreQueryObject($query);
			$query =  "select * from tbl_notice".$sWhere;	
		    $noticesFilterArr = $this->common_model->coreQueryObject($query);
			$iFilteredTotal = count($noticesFilterArr);
			$noticesAllarr = $this->common_model->getData('tbl_notice');
			$iTotal = count($noticesAllarr);
		}
		elseif($this->user_type == 1){
			$query = "select * from tbl_notice".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
	    	$noticesArr = $this->common_model->coreQueryObject($query);
			$query =  "select * from tbl_notice".$sWhere;	
		    $noticesFilterArr = $this->common_model->coreQueryObject($query);
			$iFilteredTotal = count($noticesFilterArr);

			$query = "select * from tbl_notice".$sWhere;
			$noticesAllarr = $this->common_model->coreQueryObject($query);
			$iTotal = count($noticesAllarr);
		}
		elseif($this->user_type == 2){
			$query = "select * from tbl_notice".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
	    	$noticesArr = $this->common_model->coreQueryObject($query);
			$query =  "select * from tbl_notice".$sWhere;	
		    $noticesFilterArr = $this->common_model->coreQueryObject($query);
			$iFilteredTotal = count($noticesFilterArr);
			
			$query = "select * from tbl_notice".$sWhere;
			$noticesAllarr = $this->common_model->coreQueryObject($query);
			$iTotal = count($noticesAllarr);
		}
		
		/** Output */

		$datarow = array();
		$i = 1;
		foreach($noticesArr as $row) {
			if($row->noticeto == '1'){
				$to = $row->status = 'Client';
				

			}
			elseif($row->noticeto == '2'){
				$to = $row->status = 'Employee';
				

			}
			$noticeid = $row->id;
			$create_date = date('d-m-Y', strtotime($row->created_at));

			if($this->user_type == 0){

				$actionStr =  

			    '<div class="dropdown action m-r-10">
			        <button type="button" class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">Action <span class="caret"></span></button>
			            <div class="dropdown-menu">
		                    <a  class="dropdown-item" href="'.base_url().'NoticeBoard/editnotices/'.base64_encode($noticeid).'/"><i class="fa fa-edit"></i> Edit</a>
		                    <a  class="dropdown-item" href="javascript:void()" onclick="deletenotices(\''.base64_encode($noticeid).'\')"><i class="fa fa-trash "></i> Delete</a>
			            </div>
			    </div>';

				$datarow[] = array(
					$id = $i,
	                $row->heading,
	                $create_date,
		            $to,	
					$actionStr
	           	);
           		$i++;

      		}elseif ($this->user_type == 1) {

				$datarow[] = array(
					$id = $i,
		            $row->heading,
		            $create_date,
		            $to	
		       	);
	       		$i++;
  			}
  			elseif ($this->user_type == 2) {

				$datarow[] = array(
					$id = $i,
		            $row->heading,
		            $create_date,
		            $to	
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

	public function editnotices(){
		$noticeid = base64_decode($this->uri->segment(3));
		$whereArr=array('id'=>$noticeid);
		$data['department']=$this->common_model->getData('tbl_department');	
		$data['notices']=$this->common_model->getData('tbl_notice',$whereArr);
		if(!empty($_POST)){
			$heading=$this->input->post('heading');
			$noticeto=$this->input->post('noticeto');
			$department=$this->input->post('department');
			$desc=$this->input->post('desc');
			
				$updateArr=array('heading'=>$heading,'noticeto' => $noticeto,'department' => $department,'description' => $desc);
				$data['query']=$this->common_model->updateData('tbl_notice',$updateArr,$whereArr);

				$this->session->set_flashdata('message_name', "Data Update Succeessfully");
				redirect('NoticeBoard/index');
			}
		$this->load->view('common/header');
		$this->load->view('Notice/editnotice',$data);
		$this->load->view('common/footer');
	}
	
	public function deletenotice(){
		$noticeid=base64_decode($_POST['noticeid']);
		$whereArr=array('id'=>$noticeid);
		$this->common_model->deleteData('tbl_notice',$whereArr);
		redirect('NoticeBoard/index');
	}
	
}