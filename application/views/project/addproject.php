<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="icon-layers"></i> Projects</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'Dashboard/';?>">Home</a></li>
				<li><a href="<?php echo base_url().'Project/';?>">Projects</a></li>
				<li class="active">Add New</li>
			</ol>
		</div>
	</div>
</nav>
 <!-- contetn-wrap -->
<div class="content-in">  
	<div class="row">
		<div class="col-md-12">
			<div class="card br-0">
				<div class="card-header br-0 card-header-inverse">
					Add Project 
				</div>
				<div class="card-wrapper collapse show">
					<div class="card-body">
						<form id="creatclient" class="aj-form" name="creatclient" method="post" action="<?php echo base_url().'Project/insertproject';?>" onsubmit="return changeDate();">
							<?php
                                    $mess = $this->session->flashdata('message_name');
                                    if(!empty($mess)){
                                        //warning 
                                    ?>
            				<div class="submit-alerts">
            					<div class="alert alert-success" role="alert" style="display:block;">
								</div>
                            </div>
                            <div class="submit-alerts">
								<div class="alert alert-danger" role="alert" style="display:block;">
								 <?php echo $mess; ?>
								</div>
                            </div>
                            <?php  } ?>
                            <div class="submit-alerts">
								<div class="alert alert-warning" role="alert">
								  This is a warning alert
								</div>
            				</div>
                            
							<div class="form-body">
								<h3 class="box-title">Project Info</h3>
								<hr>
								<p id="succmsg" class="text-success"></p>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Project Name<span class="astric">*</span></label>
											<input id="project_name" class="form-control" type="text" name="project_name" value="<?php if(!empty($sessData['project_name'])){echo $sessData['project_name'];}else{ }?>">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group project-category">
											
											<label class="control-label" for="project-category">Project Category <a class="btn btn-sm btn-outline-success ml-1" href="javascript:;" data-toggle="modal" data-target="#project-category1">

											<i class="fa fa-plus"></i> Add Project Category</a></label>
											<select class="custom-select br-0" id="project-category" name="project-category">
											
												<?php
												foreach($category as $cat){
													$str='';
													if(!empty($sessData['project-category'])){
														if($sessData['project-category'] == $cat->id){
															$str='selected';
														}
													}
													?>
													<option value="<?php echo $cat->id?>" <?php echo $str;?>><?php echo $cat->name;?></option>
													<?php
													} 
													?> 											
											</select>
										</div>
								</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Start Date<span class="astric">*</span></label>
											<input type="text" name="start_date" id="start_date" autocomplete="off" class="form-control" value="<?php if(!empty($sessData['start_date'])){echo $sessData['start_date'];}else{ }?>">
										</div>
									</div>
									<?php $style = 'style="display: block;"'; ?>
									<?php $style1 = 'style="display: none;"'; ?>

									<div class="col-md-4" id="deadlineBox" <?php if(!empty($sessData)) { if(!empty($sessData['without_deadline'])) { if($sessData['without_deadline'] == 'on')  { echo $style1; } else { echo $style; } } } else { echo $style; } ?>>
										<div class="form-group">
											<label class="control-label">Deadline<span class="astric">*</span></label>
											<input type="text" name="deadline" id="deadline" autocomplete="off" class="form-control" value="<?php if(!empty($sessData['deadline'])){echo $sessData['deadline'];}else{ }?>" >
										</div>
									</div>

									<div class="col-md-4" >
										<div class="form-group" style="padding-top: 25px;">
											<div class="custom-control custom-checkbox my-1 mr-sm-2">
												<input type="checkbox" class="custom-control-input" name="without_deadline" id="without_deadline" <?php 
												if(!empty($sessData['without_deadline'])){
													echo "checked";}else{ }?> onclick="checkUncheck()">
												<label class="custom-control-label" for="without_deadline" style="padding-top: 2px;">Add project without deadline?</label>
											</div>
										</div>
									</div>
									<!-- <div class="col-md-4">
										<div class="form-group">
											<div class="custom-control custom-checkbox my-1 mr-sm-2">
												<input type="checkbox" class="custom-control-input" name="manual_timelog" id="manual_timelog" <?php 
												if(!empty($sessData['manual_timelog'])){
													echo "checked";}else{ }?>>
												<label class="custom-control-label" for="manual_timelog" style="padding-top: 2px;" >Allow manual time logs?</label>
											</div>
										</div>
									</div> -->
									<div class="col-md-4">
										<div class="form-group">
											<div class="custom-control custom-checkbox my-1 mr-sm-2">
												<input type="checkbox" class="custom-control-input" name="project_member" id="project_member" <?php 
												if(!empty($sessData['project_member'])){
													echo "checked";}else{ }?>>
												<label class="custom-control-label" for="project_member" style="padding-top: 2px;">Add me as a project member</label>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Project Summary</label>
											<textarea name="editor1"><?php if(!empty($sessData['editor1'])){echo $sessData['editor1'];}else{ }?></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Note</label>
											<textarea id="notes" class="form-control" name="notes" rows="5"><?php if(!empty($sessData['notes'])){echo $sessData['notes'];}else{ }?></textarea>
										</div>
									</div>
								</div>
								<h3 class="box-title mb-3 mt-2">Client Info<span class="astric">*</span></h3>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<select class="custom-select" id="select-client" name="select_client">
											<option value="">--Select--</option>
											<?php
												foreach($client as $row)
												{
													if(!empty(trim($row->clientname))){
														$str='';
														if(!empty($sessData['select_client'])){
															if($sessData['select_client'] == $row->id){
																$str='selected';
															}
														}
														?>
														<option value="<?php echo $row->id?>" <?php echo $str;?>><?php echo $row->clientname;?></option>
													<?php
													}
												} 
												?> 		
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<!-- <div class="col-md-4">
										<div class="form-group">
											<div class="custom-control custom-checkbox my-1 mr-sm-2">
												<input type="checkbox" class="custom-control-input" name="client-view-tasks" id="client-view-tasks" onclick="viewtask()" <?php if(!empty($sessData['client-view-tasks'])){ echo "checked";}else{ }?>>
												<label class="custom-control-label" for="client-view-tasks" style="padding-top: 2px;">Client can view tasks of this project</label>
											</div>
										</div>
									</div> -->	
									<!-- <div class="col-md-8">
										<?php if(!empty($sessData['tasks-notification'])){ ?>
											<div class="form-group"  id="viewnotification">
												<div class="custom-control custom-checkbox my-1 mr-sm-2">
													<input type="checkbox" class="custom-control-input" name="tasks-notification" id="tasks-notification" <?php if(!empty($sessData['tasks-notification'])){ echo "checked";}else{ }?>>
													<label class="custom-control-label" for="tasks-notification" style="padding-top: 2px;">Send task notification to client?</label>
												</div>
											</div>	
										<?php } else{ ?>
											<div class="form-group"  id="viewnotification" style="display: none;">
												<div class="custom-control custom-checkbox my-1 mr-sm-2">
													<input type="checkbox" class="custom-control-input" name="tasks-notification" id="tasks-notification" <?php if(!empty($sessData['tasks-notification'])){ echo "checked";}else{ }?>>
													<label class="custom-control-label" for="tasks-notification" style="padding-top: 2px;">Send task notification to client?</label>
												</div>
											</div>
										<?php } ?>						
									</div> -->	
								</div>
								<h3 class="box-title mb-3 mt-2">Budget Info</h3>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Project Budget</label>
											<input type="text" class="form-control allow-no" name="project_budget" value="<?php if(!empty($sessData['project_budget'])){echo $sessData['project_budget'];}else{ }?>">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Currency</label>
											<select id="" class="form-control" name="currency-id">
												<option selected value="0" <?php if(!empty($sessData['currency-id'])){
                                                            if($sessData['currency-id'] == 0){
                                                                echo 'selected';    
                                                            }}
                                                            ?>>Dollars (USD)</option>
												<option value="1" <?php if(!empty($sessData['currency-id'])){
                                                            if($sessData['currency-id'] == 1){
                                                                echo 'selected';    
                                                            }}
                                                            ?>>Pounds (GBP)</option>
												<option value="2" <?php if(!empty($sessData['currency-id'])){
                                                            if($sessData['currency-id'] == 2){
                                                                echo 'selected';    
                                                            }}
                                                            ?>>Euros (EUR)</option>
												<option value="3" <?php if(!empty($sessData['currency-id'])){
                                                            if($sessData['currency-id'] == 3){
                                                                echo 'selected';    
                                                            }}
                                                            ?>>Rupee (INR)</option>
											
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Hours Allocated</label>
											<input type="text" class="form-control" name="hours_allocated" value="<?php if(!empty($sessData['hours_allocated'])){echo $sessData['hours_allocated'];}else{ }?>">
										</div>
									</div>
									
								</div>

                     
								<!-- action btn -->
								<div class="form-actions">
									<button type="submit" name="btnsave" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
									<!-- <i class="fa fa-check"><input type="submit" id="save-form" class="btn btn-success" name="btnsave" value="Save"> </i>  -->
									 <button type="Reset" name="btnreset" class="btn btn-inverse"> <i class="fa fa-check"></i> Reset</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ends of contentwrap -->
<!--project category--!-->
<?php 
	$this->load->view('common/projectcategory');
?>
<!--end category--> 
 