<?php
$loginName="";
if($this->session->userdata('login')){
    $login=$this->session->userdata('login');
    if($login->user_type==0){
        $loginName = substr($login->emailid,0,8);
    }else if($login->user_type == 1){
        $where = array('user_id'=>$login->id);
        $getClient = $this->common_model->getData('tbl_clients',$where);
        $loginName = trim($getClient[0]->companyname);
    }
}
?>

<div id="sidebar-scroll" class="slim-nav">

	<ul class="list-unstyled components user">

        <li>
            <a href="#user-ico" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                <img class="img-circle" src="<?php echo base_url();?>assets/images/default-profile-3.png" alt="user-img">
                <span><?php echo !empty($loginName)?$loginName:'User';?></span>
            </a>
            <ul class="collapse list-unstyled" id="user-ico">
                <!--  <li>
                    <a href="<?php echo base_url().'EmpDashboard'; ?>"><i class="fa fa-sign-in"></i> <span>Login As Employee</span></a>
                </li> -->
                <li>
                    <a href="<?php echo base_url().'Login/logout'; ?>"><i class="fa fa-power-off"></i> <span>Logout</span></a>
                </li>
            </ul>
        </li>
    </ul>
    <?php
    $controller = strtolower($this->uri->segment(1));
    $functionName = strtolower($this->uri->segment(2));
    ?>
    <ul class="list-unstyled components">
        <li <?php if($controller == 'dashboard'){ echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'Dashboard'; ?>" class="nav-link-s">
                <i class="icon-speedometer"></i>
                <span>Dashbord</span>
            </a>
        </li>
        <li <?php if($controller == 'clients' && ($functionName == 'index' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'clients'?>" class="nav-link-s">
                <i class="icon-people"></i>
                <span>Clients</span>
            </a>
        </li>
        <li <?php if($controller == 'leads' && ($functionName == 'index' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'leads'?>" class="nav-link-s">
                <i class="ti-receipt"></i>
                <span>Leads</span>
            </a>
        </li>
        <li <?php if($controller == 'project' && ($functionName == 'project' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'project'?>" class="nav-link-s">
                <i class="icon-layers"></i>
                <span>Projects</span>
            </a>
        </li>
        <li>
            <a href="#employees" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
               <i class="ti-user"></i>
               <span> Employees </span>
            </a>
            <ul class="collapse list-unstyled <?php if($controller == 'employee') {echo 'show'; }?>" id="employees">
                <li <?php if($controller == 'employee' && ($functionName == 'employee' || $functionName == '')) { echo 'class="active"'; }  ?>>
                    <a href="<?php echo base_url().'employee'?>">Employees List</a>
                </li>
                
            </ul>
        </li>
        <li>
            <a href="#taskmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                <i class="ti-layout-list-thumb"></i>
                <span>Tasks</span>
            </a>
            <ul class="collapse list-unstyled <?php if($controller == 'task') {echo 'show'; }?>" id="taskmenu">
                <li <?php if($controller == 'task' && ($functionName == 'task' || $functionName == '')) { echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url().'task'?>">Tasks</a>
                </li>
                <li <?php if($controller == 'task' && $functionName == 'taskboard') { echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url().'task/taskBoard'?>">Task Board</a>
                </li>
                    
            </ul>
        </li>
       <!--  <li <?php if($controller == 'products' && ($functionName == 'products' || $functionName == '')) { echo 'class="active"'; } ?>  >
            <a href="<?php echo base_url().'products'?>" class="nav-link-s">
                <i class="icon-layers"></i>
                <span>Products</span>
            </a>
        </li> -->
        <li>
            <a href="#finance" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                <i class="fa fa-money"></i>
                <span>Finance</span>
            </a>
            <ul class="collapse list-unstyled <?php if($controller == 'finance' || $controller == 'payment'){ echo 'show'; } ?>" id="finance">
                <li <?php if($controller == 'finance' && ($functionName == 'finance' || $functionName == '')) { echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url().'finance' ?>">Estimates</a>
                </li>
                <li <?php if($controller == 'finance' && $functionName == 'invoice'){ echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url().'finance/invoice' ?>">Invoices</a>
                </li>
                <li <?php if($controller == 'payment' && ($functionName == 'payment' || $functionName == '')) { echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url().'payment'?>" class="nav-link-s">
                        <span>Payment</span>
                    </a>
                </li>
                <li <?php if($controller == 'finance' && $functionName == 'expense'){ echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url().'finance/expense' ?>">Expenses</a>
                </li>
            </ul>
        </li>
        <li <?php if($controller == 'timelog' && ($functionName == 'index' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'timelog/'?>" class="nav-link-s">
                <i class="icon-clock"></i>
                <span>Time Logs</span>
            </a>
        </li>
        <li <?php if($controller == 'ticket' && ($functionName == 'ticket' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'ticket'?>" class="nav-link-s">
                <i class="ti-ticket"></i>
                <span>Tickets</span>
            </a>
        </li>
   
        
          <li <?php if($controller == 'attendance' && ($functionName == 'index' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'Attendance'?>" class="nav-link-s">
                <i class="icon-clock"></i>
                <span>Attendance</span>
            </a>
        </li>
      <!--   <li>
            <a href="<?php echo base_url().'Attendance'?>" class="nav-link-s">
                <i class="icon-clock"></i>
                <span>Attendance</span>
            </a>
        </li> -->
        <li <?php if($controller == 'holiday' && ($functionName == 'holiday' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'holiday'?>" class="nav-link-s">
                <i class="ti-calendar"></i>
                <span>Holiday</span>
            </a>
        </li>
      <!--   <li>
            <a href="#" class="nav-link-s">
                <i class="ti-envelope"></i>
                <span>Messages</span>
            </a>
        </li> -->
       <li <?php if($controller == 'events' && ($functionName == 'events' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'events'?>" class="nav-link-s">
                <i class="icon-calender"></i>
                <span>Events</span>
            </a>
        </li>
        <li <?php if($controller == 'leaves' && ($functionName == 'leaves' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'leaves'?>" class="nav-link-s">
                <i class="icon-logout"></i>
                <span>Leaves</span>
            </a>
        </li>
        <li <?php if($controller == 'noticeboard' && ($functionName == 'index' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'NoticeBoard'?>" class="nav-link-s">
                <i class="ti-layout-media-overlay"></i>
                <span>Notice Board</span>
            </a>
        </li>
        <li>
            <a href="#reports" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
               <i class="ti-pie-chart"></i>
               <span> Reports </span>
            </a>

            <ul class="collapse list-unstyled <?php if($controller == 'reports' || $controller == 'taskreport' || $controller == 'timelogreport' || $controller == 'financereport' || $controller == 'incomeexpensereport' || $controller == 'leavereport' || $controller == 'attandancereport') { echo 'show'; } ?>" id="reports" >
                <li <?php if($controller == 'taskreport' && ($functionName == 'index' || $functionName == '')){ echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url().'TaskReport/index'?>">Task Report</a>
                </li>
                <li <?php if($controller == 'timelogreport' && ($functionName == 'index' || $functionName == '')){ echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url().'TimeLogReport/index'?>">Time Log Report</a>
                </li>
                <li <?php if($controller == 'financereport' && ($functionName == 'index' || $functionName == '')){ echo 'class="active"'; } ?>>
                	<a href="<?php echo base_url().'FinanceReport/index'?>">Finance Report</a>
                </li>
                <li <?php if($controller == 'incomeexpensereport' && ($functionName == 'index' || $functionName == '')){ echo 'class="active"'; } ?>>
                	<a href="<?php echo base_url().'IncomeExpenseReport/index'?>">Income vs Expense Report</a>
                </li>
                <li <?php if($controller == 'leavereport' && ($functionName == 'index' || $functionName == '')){ echo 'class="active"'; } ?>>
                	<a href="<?php echo base_url().'LeaveReport/index'?>">Leave Report</a>
                </li>
                 <li <?php if($controller == 'attandancereport' && ($functionName == 'index' || $functionName == '')){ echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url().'AttandanceReport/index'?>">Attandance Report</a>
                </li>
             
            </ul>
        </li>
        <!-- <li>
        	<a href="#" class="nav-link-s">
        		<i class="ti-settings"></i> 
        		<span> Settings</span>
        	</a>
    	</li> -->
    </ul>
</div>