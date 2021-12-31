<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="icon-speedometer"></i> Projects</h4>
		</div>
		 <div class="col-lg-9 col-sm -8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
				 <li class="active">Projects</li>
			</ol>
		</div>
	</div> 
</nav>
<input type="hidden" id="projectuserid" value="<?php echo $this->user_type;?>">
<!-- contetn-wrap -->
<div class="content-in">  
	<div class="row">
		<div class="col-md-2">
			<div class="stats-box bg-black pt-1 pb-1">
				<h3 class="box-title text-white">Total Projects</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-layers text-white"></i></li>
					<?php 

					 	if($this->user_type == 0){
						 	$whereArr = array('is_deleted'=>0);
							$Totals = $this->common_model->getData('tbl_project_info',$whereArr);
							$total_Project = count($Totals); 

						}elseif($this->user_type == 2){

							$total_Project = 0;
							$whereArr = array('user_id'=>$this->user_id);
							$Totals = $this->common_model->getData('tbl_employee',$whereArr);
							$whereArr1 = array('emp_id'=>$Totals[0]->id);
							$Totals = $this->common_model->getData('tbl_project_member',$whereArr1);
		
							if(!empty($Totals)){
								$whereArr2 = array('id'=>$Totals[0]->project_id,'is_deleted'=>0);
								$tProject = $this->common_model->getData('tbl_project_info',$whereArr2);
								$total_Project = count($tProject); 
							}

						}elseif($this->user_type == 1){
							$whereArr = array('user_id'=>$this->user_id);
							$Totals = $this->common_model->getData('tbl_clients',$whereArr);
							$whereArr1 = array('clientid'=>$Totals[0]->id,'is_deleted'=>0);
							$Totals = $this->common_model->getData('tbl_project_info',$whereArr1);
							$total_Project = count($Totals); 
						}
					?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $total_Project;?></span></li>
				</ul>
			</div>
		</div>
		<div class="col-md-2">
			<div class="stats-box bg-black pt-1 pb-1">
				<h3 class="box-title text-white">Incomplete Projects</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-layers text-white"></i></li>
					<?php 
						$total_ProjectIncom=0;
					  	if($this->user_type == 0){

							$whereArr=array('status'=>0,'is_deleted'=>0);
							$Totals = $this->common_model->getData('tbl_project_info',$whereArr);
							$total_ProjectIncom = count($Totals); 

						}else if($this->user_type == 2){

							$whereArr = array('user_id'=>$this->user_id);
							$Totals = $this->common_model->getData('tbl_employee',$whereArr);
							if(!empty($Totals)){
								$whereArr1 = array('emp_id'=>$Totals[0]->id);
								$Totals = $this->common_model->getData('tbl_project_member',$whereArr1);
								if(!empty($whereArr2)){
									$whereArr2 = array('id'=>$Totals[0]->project_id,'status'=>0,'is_deleted'=>0);
									$tProject = $this->common_model->getData('tbl_project_info',$whereArr2);
									$total_ProjectIncom = count($tProject); 
								}	
							}

						}else if($this->user_type == 1){

							$whereArr = array('user_id'=>$this->user_id);
							$Totals = $this->common_model->getData('tbl_clients',$whereArr);
							$whereArr1 = array('clientid'=>$Totals[0]->id,'status'=>0,'is_deleted'=>0);
							$Totals = $this->common_model->getData('tbl_project_info',$whereArr1);
							$total_ProjectIncom = count($Totals); 
						}
					 ?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $total_ProjectIncom;?></span></li>
				</ul>
			</div>
		</div>
		<div class="col-md-2">
			<div class="stats-box bg-success pt-1 pb-1">
				<h3 class="box-title text-white">Completed Projects</h3>
					<ul class="list-inline two-wrap">
						<li><i class="icon-layers text-white"></i></li>
						<?php 
							$total_Projectcom =0;
							if($this->user_type == 0){
								$whereArr=array('status'=>1,'is_deleted'=>0);
								$Totals = $this->common_model->getData('tbl_project_info',$whereArr);
								$total_Projectcom = count($Totals); 

							}elseif($this->user_type == 2){

								$whereArr = array('user_id'=>$this->user_id);
								$Totals = $this->common_model->getData('tbl_employee',$whereArr);
								if(!empty($Totals)){
									$whereArr1 = array('emp_id'=>$Totals[0]->id);
									$Totals = $this->common_model->getData('tbl_project_member',$whereArr1);
									if(!empty($Totals)){
									$whereArr2 = array('id'=>$Totals[0]->project_id,'status'=>1,'is_deleted'=>0);
									$tProject = $this->common_model->getData('tbl_project_info',$whereArr2);
									$total_Projectcom = count($tProject);
									}
								}

							}elseif($this->user_type == 1){

								$whereArr = array('user_id'=>$this->user_id);
								$Totals = $this->common_model->getData('tbl_clients',$whereArr);
								$whereArr1 = array('clientid'=>$Totals[0]->id,'status'=>1,'is_deleted'=>0);
								$Totals = $this->common_model->getData('tbl_project_info',$whereArr1);
								$total_Projectcom = count($Totals); 
							}
						?>
				   	<li class="text-right"><span id="" class="counter text-white"><?php echo $total_Projectcom;?></span></li>
				</ul>
			</div>
		</div>
		<div class="col-md-2">
			<div class="stats-box bg-info pt-1 pb-1">
				<h3 class="box-title text-white">In Process Projects</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-layers text-white"></i></li>
					<?php 
					$total_Projectpro = 0;
						if($this->user_type == 0){
							$whereArr=array('status'=>2,'is_deleted'=>0);
							$Totals = $this->common_model->getData('tbl_project_info',$whereArr);
							$total_Projectpro = count($Totals); 

						}elseif($this->user_type == 2){
							$whereArr = array('user_id'=>$this->user_id);
							$Totals = $this->common_model->getData('tbl_employee',$whereArr);
							//print_r($Totals);
							if(!empty($Totals)){
								$whereArr1 = array('emp_id'=>$Totals[0]->id);
								$Totals = $this->common_model->getData('tbl_project_member',$whereArr1);
								if(!empty($Totals)){
								$whereArr2 = array('id'=>$Totals[0]->project_id,'status'=>2,'is_deleted'=>0);
								$tProject = $this->common_model->getData('tbl_project_info',$whereArr2);
								$total_Projectpro = count($tProject);
								} 
							}

						}elseif($this->user_type == 1){
							$whereArr = array('user_id'=>$this->user_id);
							$Totals = $this->common_model->getData('tbl_clients',$whereArr);
							$whereArr1 = array('clientid'=>$Totals[0]->id,'status'=>2,'is_deleted'=>0);
							$Totals = $this->common_model->getData('tbl_project_info',$whereArr1);
							$total_Projectpro = count($Totals); 
						}
					?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $total_Projectpro;?></span></li>
				</ul>
			</div>
		</div>
		<div class="col-md-2">
			<div class="stats-box bg-black pt-1 pb-1">
				<h3 class="box-title text-white">OnHold Projects</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-layers text-white"></i></li>
					<?php 
					$total_Projecthold =0;
						if($this->user_type == 0){
							$whereArr=array('status'=>3,'is_deleted'=>0);
							$Totals = $this->common_model->getData('tbl_project_info',$whereArr);
							$total_Projecthold = count($Totals); 

						}elseif($this->user_type == 2){

							$whereArr = array('user_id'=>$this->user_id);
							$Totals = $this->common_model->getData('tbl_employee',$whereArr);
							if(!empty($Totals)){
								$whereArr1 = array('emp_id'=>$Totals[0]->id);
								$Totals = $this->common_model->getData('tbl_project_member',$whereArr1);
								if(!empty($Totals)){
								$whereArr2 = array('id'=>$Totals[0]->project_id,'status'=>3,'is_deleted'=>0);
								$tProject = $this->common_model->getData('tbl_project_info',$whereArr2);
								$total_Projecthold = count($tProject);
								} 
							}

						}elseif($this->user_type == 1){

							$whereArr = array('user_id'=>$this->user_id);
							$Totals = $this->common_model->getData('tbl_clients',$whereArr);
							$whereArr1 = array('clientid'=>$Totals[0]->id,'status'=>3,'is_deleted'=>0);
							$Totals = $this->common_model->getData('tbl_project_info',$whereArr1);
							$total_Projecthold = count($Totals); 
						}
					?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $total_Projecthold;?></span></li>
				</ul>
			</div>
		</div>
		<div class="col-md-2">
			<div class="stats-box bg-danger pt-1 pb-1">
				<h3 class="box-title text-white">Cancelled Projects</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-layers text-white"></i></li>
						<?php 
						$total_Projectcancel = 0;
							if($this->user_type == 0){
								$whereArr=array('status'=>4,'is_deleted'=>0);
								$Totals = $this->common_model->getData('tbl_project_info',$whereArr);
								$total_Projectcancel = count($Totals); 

							}else if($this->user_type == 2){
								$whereArr = array('user_id'=>$this->user_id);
								$Totals = $this->common_model->getData('tbl_employee',$whereArr);
								if(!empty($Totals)){
									$whereArr1 = array('emp_id'=>$Totals[0]->id);
									$Totals = $this->common_model->getData('tbl_project_member',$whereArr1);
									if(!empty($Totals)){
										$whereArr2 = array('id'=>$Totals[0]->project_id,'status'=>4,'is_deleted'=>0);
										$tProject = $this->common_model->getData('tbl_project_info',$whereArr2);
										$total_Projectcancel = count($tProject);
									} 
								}
							}elseif($this->user_type == 1){
								$whereArr = array('user_id'=>$this->user_id);
								$Totals = $this->common_model->getData('tbl_clients',$whereArr);
								$whereArr1 = array('clientid'=>$Totals[0]->id,'status'=>4,'is_deleted'=>0);
								$Totals = $this->common_model->getData('tbl_project_info',$whereArr1);
								$total_Projectcancel = count($Totals); 
							}
					 	?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $total_Projectcancel;?></span></li>
				</ul>
			</div>
		</div>
		<div class="col-md-12">
			<div class="stats-box">
				<?php 
					if($this->user_type == 0) { ?>
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group custom-action">
								<a href="<?php echo base_url().'Project/addproject'?>" class="btn btn-outline-success btn-sm">Add New Project <i class="fa fa-plus" aria-hidden="true"></i></a>

								<a href="javascript:;"  class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#project-category1">Add Project Category <i class="fa fa-plus" aria-hidden="true"></i></a>

								<a href="<?php echo base_url().'Project/projecttemplate';?>"  class="btn btn-outline-primary btn-sm">Project Templates <i class="fa fa-plus" aria-hidden="true"></i></a>
							
								<!--<a href="<?php echo base_url().'Project/viewarchiev';?>"  class="btn btn-outline-info btn-sm">View Archive <i class="fa fa-trash" aria-hidden="true"></i></a>-->
								
								<!--<a href="javascript:;" onclick="exportData()" class="btn btn-info btn-sm"><i class="ti-export" aria-hidden="true"></i> Export To Excel</a>-->
					  		</div>
				 		</div>
				 	</div>
			<?php }  ?>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
					<label class="control-label">Project Status</label>
						<select name="status" id="project_status" class="custom-select" name="status">
							<option value='all'>All</option> 
							<option value='0'>Incomplete </option>
							<option value='1'>Complete </option>
							<option value='2'>In Progress </option>
							<option value='3'>On Hold  </option>
							<option value='4'>Cancelled </option>
					   </select>
				   </div>
				</div>
				<?php 
					if($this->user_type == 0) { ?>
						<div class="col-lg-3 col-md-4">
							<div class="form-group">
								<label class="control-label">Client Name</label>
								<select id="clientname" class="custom-select" name="clientname">
									<option value="">--Select--</option>
										<?php
											foreach($client as $row)
											{
												echo '<option value="'.$row->id.'" >'.$row->clientname.'</option>';
											}
										?>
								</select>
							</div>
						</div>
				<?php } ?>
			</div>
				<?php
					$mess = $this->session->flashdata('message_name');
					if(!empty($mess)){
						//warning 
					?>
					<div class="col-md-12">
						<div class="submit-alerts">
							<div class="alert alert-success" role="alert" style="display:block;">
								<?php echo $mess; ?>
							</div>
						</div>
					</div>
				<?php } ?>
				<div class="table-responsive">
					<table class="table table-bordered table-hover" id="project">
						<thead>
							<tr role="row">
								<th>Id</th>
								<th>Project Name</th>
								<?php if($this->user_type == 0 || $this->user_type == 2) { ?>
								<th>Project Members</th>
								<?php } ?>
								<th>Deadline</th>
								<?php if($this->user_type == 0 || $this->user_type == 2) { ?>	
								<th>Client</th>
								<?php } ?>
								<th>Action</th>		    	
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ends of contentwrap -->
<?php 
	$this->load->view('common/projectcategory');
?>
