
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
<?php
//echo "<PRE>";print_r($projectinfo);die;
$sessData = "";

if($this->session->flashdata('sessData')){
	//echo "<PRE>";print_r($sessData);die;
    $sessData = $this->session->flashdata('sessData');
}
?>
 <!-- contetn-wrap -->
<div class="content-in">  
	<div class="row">
		<div class="col-md-12">
			<div class="card br-0">
				<div class="card-header br-0 card-header-inverse">
					Edit Project 
				</div>
				<div class="card-wrapper collapse show">
					<div class="card-body">
						<form id="creatclient" class="aj-form" method="post" action="<?php echo base_url().'Project/editproject/'.base64_encode($editId);?>">
							<?php
								$mess = $this->session->flashdata('message_name');
								if(!empty($mess)){
									//warning 
                            ?>
							<div class="submit-alerts">
            					<div class="alert alert-success" role="alert" style="display:block;"></div>
                            </div>
                            <div class="submit-alerts">
								<div class="alert alert-danger" role="alert" style="display:block;">
									<?php echo $mess; ?>
								</div>
                            </div>
									<?php  } ?>
                            <div class="submit-alerts">
								<div class="alert alert-warning" role="alert"> This is a warning alert</div>
            				</div>
							<div class="form-body">
								<h3 class="box-title">Project Info</h3>
								<hr>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Project Name<span class="astric">*</span></label>
											<input id="project_name" class="form-control" type="text" name="project_name" value="<?php if(!empty($sessData)) { echo $sessData['project_name']; } elseif(!empty($projectinfo[0]->projectname)) { echo $projectinfo[0]->projectname; } else{ }?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group project-category">
										<label class="control-label" for="project-category">Project Category
										<a href="#project-category1" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#project-category1"><i class="fa fa-plus" aria-hidden="true"></i>Add Project Category </a>
										</label>
																										
											<select class="custom-select br-0" id="project-category" name="project-category">
							
												<?php
													foreach($category as $cat)
													{
														if(!empty($sessData)){
														$str='';
													if(!empty($sessData['project-category'])){
														if($sessData['project-category'] == $cat->id){
															$str='selected';
														}
														}}
														else{
														$str='';
													if(!empty($projectinfo[0]->projectcategoryid)){
														if($projectinfo[0]->projectcategoryid == $cat->id){
															$str='selected';
														}
														}
													}
												}

													
												?>
												<option value="<?php echo $cat->id?>" <?php echo $str;?>><?php echo $cat->name;?></option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Start Date<span class="astric">*</span></label>
											<input type="text" name="start_date" id="start_date" autocomplete="off" class="form-control" value="<?php if(!empty($sessData)) { echo $sessData['start_date']; } elseif(!empty($projectinfo[0]->startdate)) { echo $projectinfo[0]->startdate; } else{ }?>">
										</div>
									</div>
									<?php
										if(!empty($sessData)){
											if(!empty($sessData['without_deadline'])){
												if($sessData['without_deadline'] == 'on'){

														$style= 'display:none;';
														
													}
													else{
													$style= 'display:block;';
													}	
												}
												else{
													$style='display:block;';
												}
												
											}
											
										
										else
										{
											if($projectinfo[0]->withoutdeadline == '1'){
											
												$style= 'display:none;';
											}
											else{
												
												$style= 'display:block;';
											}
										}
										?>
									<div class="col-md-4" id="deadlineBox" style="<?php echo $style; ?>">
										<div class="form-group">
											<label class="control-label">Deadline<span class="astric">*</span></label>
											<input type="text" name="deadline" id="deadline" autocomplete="off" class="form-control" value="<?php if(!empty($sessData)) { echo $sessData['deadline']; } elseif(!empty($projectinfo[0]->deadline)) { echo $projectinfo[0]->deadline; } else{ }?>">
										</div>
									</div>
									<?php
									
									
										if(!empty($sessData)){
											if(!empty($sessData['without_deadline'])){
											if($sessData['without_deadline'] == 'on'){
												$checked = 'checked';
											}	
											}
											else{
												$checked = 'unchecked';
											}
										}
										else
										{
											if($projectinfo[0]->withoutdeadline == '1'){
												$checked = 'checked';
											}
											else{
												$checked = 'unchecked';
											}
										}
									?>
									<div class="col-md-4" >
										<div class="form-group" style="padding-top: 25px;">
											<div class="custom-control custom-checkbox my-1 mr-sm-2">
												<input type="checkbox" class="custom-control-input" name="without_deadline" id="without_deadline" <?php echo $checked; ?> onclick="checkUncheck()">
												<label class="custom-control-label" for="without_deadline" style="padding-top: 2px;">Add project without deadline?</label>
											</div>
										</div>
									</div>
									<?php
									
									
										if(!empty($sessData)){
											if(!empty($sessData['manual_timelog'])){
											if($sessData['manual_timelog'] == 'on'){
												$checked = 'checked';
												
											}}
											else{
												$checked = 'unchecked';
											}
										}
										else
										{
											if($projectinfo[0]->manualtimelog == '1'){
												$checked = 'checked';
											}
											else{
												$checked = 'unchecked';
											}
										}
									?>
									<!-- <div class="col-md-4">
										<div class="form-group">
											<div class="custom-control custom-checkbox my-1 mr-sm-2">
												<input type="checkbox" class="custom-control-input" name="manual_timelog" id="manual_timelog" <?php echo $checked; ?>>
												<label class="custom-control-label" for="manual_timelog" style="padding-top: 2px;">Allow manual time logs?</label>
											</div>
										</div>
									</div> -->		
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Project Summary</label>
											<textarea name="editor1"><?php if(!empty($sessData)) { echo $sessData['editor1']; } elseif(!empty($projectinfo[0]->projectsummary)) { echo $projectinfo[0]->projectsummary; } else{ }?></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Note</label>
											<textarea id="notes" class="form-control" name="notes" rows="5"><?php if(!empty($sessData)) { echo $sessData['notes']; } elseif(!empty($projectinfo[0]->note)) { echo $projectinfo[0]->note; } else{ }?></textarea>
										</div>
									</div>
								</div>
								
								<h3 class="box-title mb-3 mt-2">Client Info<span class="astric">*</span></h3>
                    			<div class="row">
                    				<div class="col-md-12">
                    					<div class="form-group">
                    						
                    						<select class="custom-select" id="select-client" name="select-client" value="<?php echo !empty($projectinfo[0]->clientid) ? $projectinfo[0]->clientid : '' ?>">
                    							  
														<?php
															foreach($client as $row)
															{
																if(!empty($sessData['select-client'])){
																	$str='';
																if($row->id==$sessData['select-client'])
																{
																	$str='selected';
																	?>	
																	<?php
																}
																echo '<option value="'.$row->id.'"'.$str.'>'.$row->clientname.'</option>';
																}
																else{
																	$str='';
																if($row->id==$projectinfo->clientid)
																{
																	$str='selected';
																	?>	
																	<?php
																}
																echo '<option value="'.$row->id.'"'.$str.'>'.$row->clientname.'</option>';
																}
																
															}
														?>
                    						</select>
                    					</div>
                    				</div>
                    			</div>
                    			
									<!-- <?php
										if(!empty($sessData)){
											if(!empty($sessData['client-view-tasks'])){
											if($sessData['client-view-tasks'] == 'on'){
												
												$checked = 'checked';
												
											}}
											else{
												$checked = 'unchecked';
											}
										}
										else
										{
											if($projectinfo[0]->viewtask == '1'){
												$checked = 'checked';
											}
											else{
												$checked = 'unchecked';
											}
										}
										?> -->
								<!--<div class="row" style="">
									 <div class="col-md-4">
										<div class="form-group">
											<div class="custom-control custom-checkbox my-1 mr-sm-2">                                                                      
												<input type="checkbox" class="custom-control-input" name="client-view-tasks" id="client-view-tasks" onclick="viewtask()" <?php echo $checked; ?> >
												<label class="custom-control-label" for="client-view-tasks" style="padding-top: 2px;">Client can view tasks of this project</label>
											</div>
										</div>
									</div> -->	
									<!-- <div class="col-md-8">
										<?php
										if(!empty($sessData)){
											if(!empty($sessData['client-view-tasks'])){
												if($sessData['client-view-tasks'] == 'on'){
														$style= 'display:block;';
													}else{
														$style= 'display:none;';	
													}
												}	
											}
										else
										{
											if($projectinfo[0]->viewtask == '1'){$style= 'display:block;';
											}
											else{
												$style= 'display:none;';
											}
										}
										?>
										<?php
										if(!empty($sessData)){
											if(!empty($sessData['client-view-tasks'])){
												if($sessData['client-view-tasks'] == 'on'){
														$checked = 'checked';
													}
													else { $checked = 'unchecked'; }
												}
										}
										else{
											if($projectinfo[0]->tasknotification == '1'){
												$checked = 'checked';
											}
											else{
												$checked = 'unchecked';
											}
										}
										?>
										 <div class="form-group"  id="viewnotification" style="<?php echo $style;?>">
											<div class="custom-control custom-checkbox my-1 mr-sm-2">
												<input type="checkbox" class="custom-control-input" name="tasks-notification" id="tasks-notification" value="1" <?php echo $checked; ?> >
												<label class="custom-control-label" for="tasks-notification" style="padding-top: 2px;">Send task notification to client?</label>
											</div>
										</div> 
									</div>
								</div> -->	
								<h3 class="box-title mb-3 mt-2">Budget Info</h3>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Project Budget</label>
											<input type="text" class="form-control" name="project-budget" value="<?php if(!empty($sessData)) { echo $sessData['project-budget']; } elseif(!empty($projectinfo[0]->projectbudget)) { echo $projectinfo[0]->projectbudget; } else{ }?>">
										</div>
									</div>
									<?php
                                    $optst1=$optst2=$optst3=$optst4="";
                                //echo "<PRE>";print_r($sessData);exit();
                                if(isset($sessData['currency-id'])){ 
                                    if(trim($sessData['currency-id'])=='0'){
                                        $optst1="selected";
                                    }else if(trim($sessData['currency-id'])=='1'){
                                        $optst2="selected";
                                    }else if(trim($sessData['currency-id'])=='2'){
                                        $optst3="selected";
                                    }else if(trim($sessData['currency-id'])=='3'){
                                        $optst4="selected";
                                    }
                                }else if(isset($projectinfo[0]->currency)){
                                    if(trim($projectinfo[0]->currency)=='0'){
                                        $optst1="selected";
                                    }else if(trim($projectinfo[0]->currency)=='1'){
                                        $optst2="selected";
                                    }
                                    else if(trim($projectinfo[0]->currency)=='2'){
                                        $optst3="selected";
                                    }
                                    else if(trim($projectinfo[0]->currency)=='3'){
                                        $optst4="selected";
                                    }
                                    
                                }
                                ?>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Currency</label>
											<select id="" class="form-control" name="currency-id">
												
												<option value="1" <?php echo $optst1; ?>>Dollars (USD)</option>
												<option value="2" <?php echo $optst2;?>>Pounds (GBP)</option>
												<option value="3" <?php echo $optst3; ?>>Euros (EUR)</option>
												<option value="4" <?php echo $optst4; ?>>Rupee (INR)</option>
											</select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Hours Allocated</label>
											<input type="text" class="form-control" name="hours-allocated" value="<?php if(!empty($sessData)) { echo $sessData['hours-allocated']; } elseif(!empty($projectinfo[0]->hoursallocated)) { echo $projectinfo[0]->hoursallocated; } else{ }?>">
										</div>
									</div>
								</div>
								    <?php
                                    $optst1=$optst2=$optst3=$optst4=$optst5="";
                                //echo "<PRE>";print_r($sessData);exit();
                                if(isset($sessData['status'])){ 
                                    if(trim($sessData['status'])=='0'){
                                        $optst1="selected";
                                    }else if(trim($sessData['status'])=='1'){
                                        $optst2="selected";
                                    }else if(trim($sessData['status'])=='2'){
                                        $optst3="selected";
                                    }else if(trim($sessData['status'])=='3'){
                                        $optst4="selected";
                                    }else if(trim($sessData['status'])=='4'){
                                        $optst5="selected";
                                    }
                                }else if(isset($projectinfo[0]->status)){
                                    if(trim($projectinfo[0]->status)=='0'){
                                        $optst1="selected";
                                    }else if(trim($projectinfo[0]->status)=='1'){
                                        $optst2="selected";
                                    }
                                    else if(trim($projectinfo[0]->status)=='2'){
                                        $optst3="selected";
                                    }
                                    else if(trim($projectinfo[0]->status)=='3'){
                                        $optst4="selected";
                                    }
                                    else if(trim($projectinfo[0]->status)=='4'){
                                        $optst5="selected";
                                    }
                                }
                                ?>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
										<label class="control-label">Project Status</label>
											<select name="status" id="" class="form-control">
												<option value="0" <?= $optst1;?>>Incomplete </option>
												<option value="1" <?= $optst2;?>>Complete </option>
												<option value="2" <?= $optst3;?>>In Progress </option>
												<option value="3" <?= $optst4;?>>On Hold  </option>
												<option value="4" <?= $optst5;?>>Canceled </option>
										   </select>
									   </div>
                                   </div>
                                </div>
								<!-- action btn -->
								<div class="form-actions">
									<button type="submit" name="btnsave" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
									<!-- <i class="fa fa-check"><input type="submit" id="save-form" class="btn btn-success" name="btnedit" value="Update"> </i>  -->
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
 