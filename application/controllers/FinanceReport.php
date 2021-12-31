<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FinanceReport extends CI_Controller {

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
		$startdate=date('Y-m-d',strtotime('-1 month'));
		$enddate=date('Y-m-d');
		$data['allProjectData'] = $this->common_model->getData('tbl_project_info');
	    $data['allClients'] = $this->common_model->getData('tbl_clients');
	   	$data['sdate']=$startdate;
		$data['edate']=$enddate;
		$this->load->view('common/header');
		$this->load->view('report/financereport',$data);
		$this->load->view('common/footer');
	}

	public function getPostData($post){
		//print_r($post);die;
		if(!empty($post)){
			$sdate=$post['start_date'];
	    	$edate=$post['deadline'];
	    	$project=$post['project'];
	    	$client=$post['clientData'];
	    	
			if (!empty($sdate) AND !empty($edate)){
				$startdate=$post['start_date'];
			    $enddate=$post['deadline'];
			}
			else{
			
				$startdate=date('Y-m-d',strtotime('-1 month'));
				$enddate=date('Y-m-d');
			}
			//$data['dateRange']= $this->createDateRangeArray($startdate,$enddate);
			$sWhere= '';
			if(!empty($startdate)){						
				$sWhere.=' AND invoicedate>="'.trim($startdate).'"';
			}
			if(!empty($enddate)){						
				$sWhere.=' AND duedate<="'.trim($enddate).'"';
			}
			if(!empty($project)){						
				$sWhere.=' AND tbl_invoice.project='.$project;
			}
			if(!empty($client)){						
				$sWhere.=' AND tbl_invoice.client='.$client;
			}
			
			$sWhere = " WHERE tbl_invoice.status=1 ".$sWhere;
			$query = "SELECT total , SUM(total) as total ,project, client,duedate, invoicedate, Month(invoicedate) as month , status from tbl_invoice".$sWhere." 
	 		group by Month(invoicedate) ";
	 		//echo $query;die;
	 		$data['getAmount'] = $this->common_model->coreQueryObject($query);
	 		//print_r($data['getAmount']);die;
	 		$temp = array();
			foreach($data['getAmount'] as $amount){

    			$string = $amount->total;
    			if($amount->month == 1){
    				$month = 'January';
    			}
    			else if($amount->month == 2){
    				$month = 'February';
    			}
    			else if($amount->month == 3){
    				$month = 'March';
    			}
    			else if($amount->month == 4){
    				$month = 'April';
    			}
    			else if($amount->month == 5){
    				$month = 'May';
    			}
    			else if($amount->month == 6){
    				$month = 'June';
    			}
    			else if($amount->month == 7){
    				$month = 'July';
    			}
    			else if($amount->month == 8){
    				$month = 'Augest';
    			}
    			else if($amount->month == 9){
    				$month = 'September';
    			}
    			else if($amount->month == 10){
    				$month = 'October';
    			}
    			else if($amount->month == 11){
    				$month = 'November';
    			}
    			else if($amount->month == 12){
    				$month = 'December';
    			}
				
		$temp[$month] = $string;
			}

			//echo "<PRE>";print_r($temp);die;
			$str=array();
			foreach($temp as $key=>$value){
				$str['xdata'][] = $key;
				$str['ydata'][]= (int)$value;
			}
			return $str;
		}
	}


	/*function createDateRangeArray($strDateFrom,$strDateTo)
	{
	    $aryRange=array();
	    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),  substr($strDateFrom,8,2),substr($strDateFrom,0,4));
	    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),  substr($strDateTo,8,2),substr($strDateTo,0,4));

	    if ($iDateTo>=$iDateFrom)
	    {
	        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
	        while ($iDateFrom<$iDateTo)
	        {
	            $iDateFrom+=86400; // add 24 hours
	            array_push($aryRange,date('Y-m-d',$iDateFrom));
	        }
	    }
	    return $aryRange;
	}
*/
	public function fianancereportlist(){
		if(!empty($_POST)){
			$_GET = $_POST;
			$defaultOrderClause = "";
			$sWhere = "";
			$sOrder = '';
			$aColumns = array( 'id', 'project', 'invoice', 'total', 'invoicedate','status');
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
				$sWhere.= ' AND (tbl_project_info.projectname like "%'.$searchTerm.'%")';
			}
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
			$project=!empty($_POST['project']) ? $_POST['project'] : '';
			$client=!empty($_POST['clientData']) ? $_POST['clientData'] : '';
			//echo $startdate.''.$enddate;die;
			if(!empty($startdate)){						
				$sWhere.=' AND invoicedate>="'.trim($startdate).'"';
			}
			if(!empty($enddate)){						
				$sWhere.=' AND duedate<="'.trim($enddate).'"';
			}
			if(!empty($project)){						
				$sWhere.=' AND tbl_invoice.project='.$project;
			}
			if(!empty($client)){						
				$sWhere.=' AND tbl_invoice.client='.$client;
			}
			
			$sWhere = " WHERE tbl_invoice.status=1 ".$sWhere;
			
		}
		
		$query = "SELECT tbl_invoice.*,projectname,tbl_project_info.id as pid FROM `tbl_invoice` inner join tbl_project_info on tbl_invoice.project= tbl_project_info.id".$sWhere.' '.$sOrder.' limit '.$sOffset.', '.$sLimit;
		
		$FinanceArr = $this->common_model->coreQueryObject($query);
		$query = "SELECT tbl_invoice.*,projectname FROM `tbl_invoice` inner join tbl_project_info on tbl_invoice.project= tbl_project_info.id".$sWhere;
		$FinanceFilterArr = $this->common_model->coreQueryObject($query);
		$iFilteredTotal = count($FinanceFilterArr);
		$FinanceAllArr = $this->common_model->getData('tbl_invoice');
		//print_r($FinanceAllArr);die;
		$iTotal = count($FinanceAllArr);
		
		/** Output */
		$datarow = array();
		$i = 1;
		foreach($FinanceArr as $row) {
			$rowid = $row->id;
			$mystatus=$row->status;
			//$showStatus;
			if($row->status==1){
					$status=$row->status='paid';
					$showStatus = '<label class="label label-success">'.$status.'</label>';
			}
			//echo($row->status);die;
			$projectname = "<a href=".base_url()."Project/overView/".base64_encode($row->pid).">".$row->projectname."</a>";
			$datarow[] = array(
				$id = $i,
				$projectname,
				$row->invoice,
				$row->total,
				date('d-m-Y', strtotime($row->invoicedate)),
				$showStatus
			);
				$i++;
			}
			//print_r($datarow);die;
			$dataGraph = $this->getPostData($_POST);
			//print_r($dataGraph);die;  
			$output = array
			(
			   	"sEcho" => intval($_GET['sEcho']),
		        "iTotalRecords" => $iTotal,
		        "iTotalRecordsFormatted" => number_format($iTotal), //ShowLargeNumber($iTotal),
		        "graphData"=>$dataGraph,
		        "iTotalDisplayRecords" => $iFilteredTotal,
		        "aaData" => $datarow
			);
		  	echo json_encode($output);
	      	exit();
	}

}

    