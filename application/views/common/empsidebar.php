<?php
$loginName="";
if($this->session->userdata('login')){
    $login=$this->session->userdata('login');

    if($login->user_type==0){
        $loginName = substr($login->emailid,0,8);
    }
   /* else if($login->user_type == 1){
        $where = array('user_id'=>$login->id);
        $getClient = $this->common_model->getData('tbl_clients',$where);
        $loginName = trim($getClient[0]->companyname);
    }*/
    else if($login->user_type == 2){
        $where = array('user_id'=>$login->id);
        $getEmp = $this->common_model->getData('tbl_employee',$where);
       // print_r($getEmp);die;
        if(!empty($getEmp)){
            $loginName = trim($getEmp[0]->employeename);
        }
    }
}
?>
 <?php
   // $data=$this->common_model->getData('tbl_user');
   /* $loginiddata=$this->session->userdata('login');
    $login=$loginiddata->id;
    print_r($login);die;*/
    /*$where = array('id'=> $loginiddata->id);

    $loginid=$this->common_model->getData('tbl_user',$where);*/
         /*$sWhere.=' where id='.$loginiddata;
         $query = "SELECT id  FROM `tbl_user` where id =".$sWhere;
         echo $this->db->last_query();die;
        $data = $this->common_model->coreQueryObject($query);*/

 
?> 
<div id="sidebar-scroll" class="slim-nav">
    <ul class="list-unstyled components user">
        <li>
            <a href="#user-ico" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                <?php 
                $where = array('id'=>$this->user_id);
                //echo $this->user_id;die;
                $userdata = $this->common_model->getData('tbl_user',$where);
                if(!empty($userdata[0]->profileimg)){
                    $url = base_url().'upload/'.$userdata[0]->profileimg;
                }
                else{
                    $url = base_url().'assets/images/default-profile-3.png';
                }
                ?>
                <img class="img-circle" src="<?php echo $url; ?>" alt="user-img">
                <span><?php echo !empty($loginName)?$loginName:'User';?></span>
            </a>
            <ul class="collapse list-unstyled" id="user-ico">
                 <li>
                    <a href="<?php echo base_url().'ProfileSetting/editprofile';?>"><i class="ti-user"></i> <span>Profile Settings</span></a>
                </li> 
                <li>
                    <a href="<?php echo base_url().'Login/logout'; ?>"><i class="fa fa-power-off"></i> <span>Logout</span></a>
                </li>
            </ul>
            <ul class="collapse list-unstyled" id="user-ico">
                <!-- <li>
                    <a href="#"><i class="fas fa-sign-in-alt"></i> <span>Login As Employee</span></a>
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
        <li <?php if($controller == 'empdashboard'){ echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'EmpDashboard'; ?>" class="nav-link-s" >
                <i class="icon-speedometer"></i>
                <span>Dashbord</span>
            </a>
        </li>
    
         <li <?php if($controller == 'project' && ($functionName == 'project' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'project'?>" class="nav-link-s">
                <i class="icon-layers"></i>
                <span>Projects</span>
            </a>
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
        <li <?php if($controller == 'timelog' && ($functionName == 'timelog' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'timelog'?>" class="nav-link-s">
                <i class="icon-clock"></i>
                <span>Time Logs</span>
            </a>
        </li>
        <li <?php if($controller == 'attendance' && ($functionName == 'attendance' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'Attendance'?>" class="nav-link-s">
                <i class="icon-clock"></i>
                <span>Attendance</span>
            </a>
        </li>
        <li <?php if($controller == 'holiday' && ($functionName == 'holiday' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'holiday'?>" class="nav-link-s">
                <i class="icon-calender"></i>
                <span>Holiday</span>
            </a>
        </li>
        <li <?php if($controller == 'ticket' && ($functionName == 'ticket' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'ticket'?>" class="nav-link-s">
                <i class="ti-ticket"></i>
                <span>Tickets</span>
            </a>
        </li>
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
        <li <?php if($controller == 'noticeboard' && ($functionName == 'noticeboard' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'noticeboard'?>" class="nav-link-s">
                <i class="ti-layout-media-overlay"></i>
                <span>Notice Board</span>
            </a>
        </li>
      
    </ul>
</div>