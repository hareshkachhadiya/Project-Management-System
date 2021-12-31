<?php
$loginName="";
if($this->session->userdata('login')){
    $login=$this->session->userdata('login');
    if($login->user_type==0){
        $loginName = substr($login->emailid,0,8);
    }else if($login->user_type == 1){
        $where = array('user_id'=>$login->id);
        $getClient = $this->common_model->getData('tbl_clients',$where);
       // echo $this->db->last_query();die;
        if(!empty($getClient)){
            $loginName = trim($getClient[0]->companyname);
        }
    }
}
?>
<div id="sidebar-scroll" class="slim-nav">
	<ul class="list-unstyled components user">
        <li>
            <a href="#user-ico" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                <?php 
                $where = array('id' => $this->user_id);
                //echo $this->login;die;
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
        </li>
    </ul>
    <?php
    $controller = strtolower($this->uri->segment(1));
    $functionName = strtolower($this->uri->segment(2));
    ?>
    <ul class="list-unstyled components">
        <li>
            <a href="<?php echo base_url().'ClientDashboard'; ?>" class="nav-link-s">
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
     
       
        <li <?php if($controller == 'finance' && ($functionName == 'finance' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'finance'?>" class="nav-link-s">
                <i class="icon-doc"></i>
                <span>Estimates</span>
            </a>
        </li>
        <li <?php if($controller == 'finance' && ($functionName == 'invoice')) 
        { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'finance/invoice'?>" class="nav-link-s">
                <i class="ti-receipt"></i>
                <span>Invoices</span>
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
        <li <?php if($controller == 'holiday' && ($functionName == 'holiday' || $functionName == '')) { echo 'class="active"'; } ?>>
            <a href="<?php echo base_url().'holiday'?>" class="nav-link-s">
                <i class="ti-calendar"></i>
                <span>Holiday</span>
            </a>
        </li>
         <li>
            <a href="<?php echo base_url().'NoticeBoard'?>" class="nav-link-s">
                <i class="ti-layout-media-overlay"></i>
                <span>Notice Board</span>
            </a>
        </li>
       
    </ul>
</div>