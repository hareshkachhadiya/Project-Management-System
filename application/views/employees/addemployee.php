<nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="icon-user"></i>Employees</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                            <li><a href="<?php echo base_url().'employee'?>">Employees</a></li>
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
		                		Add Employee Info
		                	</div>
		                	<div class="card-wrapper collapse show">
		                		<div class="card-body">
		                			<form id="createemployee" name="createemployee" class="aj-form" enctype="multipart/form-data" action="<?php echo base_url().'employee/insertemployee'?>" method="post">
		                				<div class="submit-alerts">
		                					<?php
		                					$mess = $this->session->flashdata('message_name');
						                    if(!empty($mess)){
						                        //warning 
						                    ?>
		                					<div class="alert alert-success" role="alert" style="display:block;">
											  <?php echo $mess; ?>
											</div>
											<?php }
											if(!empty($error_msg['error'])) { ?>
											<div class="alert alert-danger" role="alert" style="display: block;">
											  <?php
											  		echo $error_msg['error'];
												?>
											</div>
											<?php  } ?>
											<div class="alert alert-warning" role="alert">
											  This is a warning alert
											</div>
		                				</div>
		                				<div class="form-body">
		                					<div class="row">
		                						<div class="col-md-6">
		                							<div class="form-group">
		                								<label class="control-label">Employee Name<span class="astric">*</span></label>
		                								<input id="name" class="form-control" type="text" name="employee_name" value="<?php if(!empty($sessData['employee_name'])){echo $sessData['employee_name'];}?>">
		                							</div>
		                						</div>
		                						<div class="col-md-6">
		                							<div class="form-group">
		                								<label class="control-label">Employee Email<span class="astric">*</span></label>
		                								<input id="employee_email" class="form-control" type="email" name="employee_email" value="<?php if(!empty($sessData['employee_email'])){echo $sessData['employee_email'];}?>">
		                								<span class="help-desk">Employee will login using this email.</span>
		                							</div>
		                						</div>
		                					</div>
		                					<div class="row">
		                						<div class="col-md-4">
		                							<div class="form-group required pass-eye">
		                								<label class="control-label pass-change">Password<span class="astric">*</span></label>
		                								<input type="password" name="password" id="password" class="form-control pass-change">
		                								<span class="hidden-eye">

                                            <span class="pass-view" onclick="passwordAction(1)"><i class="fa fa-eye"></i></span>
                                            <span class="pass-hide" onclick="passwordAction(0)"><i class="fa fa-eye-slash"></i></span></span>
		                								<span class="help-desk">Employee will login using this password. </span>
		                							</div>
		                						</div>
		                						<div class="col-md-4">
		                							<div class="form-group" style="padding-top: 25px;">
											            <div class="custom-control custom-checkbox my-1 mr-sm-2">
														    <input type="checkbox" class="custom-control-input" name="randompassword" id="randompassword" onclick="checkuncheck();">
														    <label class="custom-control-label" for="randompassword" style="padding-top: 2px;">Generate Random Password</label>
														</div>
											        </div>
		                						</div>
		                						<div class="col-md-4">
		                							<div class="form-group">
		                								<label class="control-label">Mobile<span class="astric">*</span></label>
		                								<input type="text" class="form-control allow-no" id="mobile" name="mobile" value="<?php if(!empty($sessData['mobile'])){echo $sessData['mobile'];}?>">
		                							</div>
		                						</div>
		                					</div>
		                					<div class="row">
		                						<div class="col-lg-3">
		                							<div class="form-group">
		                								<label class="control-label" for="inlineFormInputGroup">Username</label>
			                							<div class="input-group">
													        <div class="input-group-prepend">
													          	<div class="input-group-text br-0">@</div>
													        </div>
													        <input type="text" class="form-control" id="inlineFormInputGroup" name="username" placeholder="Username" value="<?php if(!empty($sessData['username'])){echo $sessData['username'];}?>">
													    </div>
		                							</div>
		                						</div>
											    <div class="col-lg-3">
											        <div class="form-group">
											            <label class="control-label">Joining Date</label>
											            <input type="text" name="joining-date" id="start_date" autocomplete="off" class="form-control" data-date-format='yyyy-mm-dd' value="<?php if(!empty($sessData['joining-date'])){echo $sessData['joining-date'];}?>">
											        </div>
											    </div>
											    <div class="col-lg-3" id="deadlineBox">
											        <div class="form-group">
											            <label class="control-label">Last date</label>
											            <input type="text" name="last-date" id="deadline" autocomplete="off" class="form-control" data-date-format='yyyy-mm-dd' value="<?php if(!empty($sessData['last-date'])){echo $sessData['last-date'];}?>">
											        </div>
											    </div>
											    <div class="col-lg-3">
											        <div class="form-group">
											            <label class="control-label">Gender</label>
											            <select class="form-control" name="gender">
											            	<option value="0" <?php if(!empty($sessData['gender'])){
																	if($sessData['gender'] == 0){
																echo 'selected';	
															}}?>>Male</option>
											            	<option value="1" <?php if(!empty($sessData['gender'])){
																	if($sessData['gender'] == 1){
																echo 'selected';	
															}}?>>Female</option>
											            	<option value="2" <?php if(!empty($sessData['gender'])){
																	if($sessData['gender'] == 2){
																echo 'selected';	
															}}?>>Others</option>
											            </select>
											        </div>
											    </div>
											</div>

											<div class="row">
                                        		<div class="col-md-12">
		                                            <div class="form-group">
		                                                <label class="control-label">Address</label>
		                                                <textarea name="address" class="form-control" rows="4"><?php if(!empty($sessData['address'])){echo $sessData['address'];}?></textarea>
		                                            </div>
		                                        </div>
                                			</div>
                                			<div class="row">
                                				<div class="col-md-12">
											        <div class="form-group">
											            <label class="control-label">Skills<span class="astric">*</span></label>
											            <input type="text" contenteditable data-placeholder="Skills" class="form-control" id="skills" name="skills" data-role="tagsinput" id="skills" value="<?php if(!empty($sessData['skills'])){echo $sessData['skills'];}?>">
											        </div>
											    </div>
                                			</div>
                                			<div class="row">
                                				<div class="col-md-6">
											        <div class="form-group">
											            <label class="control-label">Designation<span class="astric">*</span></label>
											            <a href="javascript:;" id="tax-settings" data-toggle="modal" data-target="#data-designation">
											            	<i class="ti-settings text-info"></i>
											            </a>
											            <select class="form-control" id="designation" name="designation" >
											            	
											            	<option>--</option>
											            	<?php foreach($designation as $row){
											            		$str = '';
											            		if(!empty($sessData['designation'])){
											            			if($sessData['designation'] == $row->id){
											            				$str = 'selected';
											            			}
											            		}
											            	?>
											            		<option value="<?php echo $row->id?>" <?php echo $str;?>>	<?php echo $row->name;?></option>
											            	<?php
											            	}
											            	?>
											            </select>
											        </div>
											    </div>
											    <div class="col-md-6">
											        <div class="form-group">
											            <label class="control-label">Department<span class="astric">*</span></label>
											            <a href="javascript:;" id="tax-settings" data-toggle="modal" data-target="#data-department">
											            	<i class="ti-settings text-info"></i>
											            	</a>
											            <select class="form-control" id="department" name="department" id="department">
											            	<option>--</option>
											            	<?php foreach($department as $row){
											            		$str = '';
											            		if(!empty($sessData['department'])){
											            			if($sessData['department'] == $row->id){
											            				$str = 'selected';
											            			}
											            		}
											            	?>
											            		<option value="<?php echo $row->id?>" <?php echo $str;?>><?php echo $row->name;?></option>
											            	<?php
											            	}
											            	?>
											            </select>
											            
											        </div>
											    </div>
                                			</div>
                                			<div class="row">
                                				<div class="col-md-6">
											        <div class="form-group">
											            <label class="control-label">Hourly Rate</label>
											            <input type="text" class="form-control" id="hourly-rate" name="hourly_rate" value="<?php if(!empty($sessData['hourly_rate'])){echo $sessData['hourly_rate'];}?>">
											        </div>
											    </div>
                                			</div>
                                			<div class="row">
			                                    <div class="col-md-6 ">
			                                        <div class="form-group">
			                                            <label>Log In</label>
			                                            <select name="login" id="login" class="form-control">
			                                                <option value="0" <?php if(!empty($sessData['login'])){
																		if($sessData['login'] == 0){
																echo 'selected';	
															}}?>>Enable</option>
			                                                <option value="1" <?php if(!empty($sessData['login'])){
																	if($sessData['login'] == 1){
																echo 'selected';	
															}}?>>Disable</option>
			                                            </select>
			                                        </div>
			                                    </div>
			                                </div>
			                                
											<!-- action btn -->
			                                <div class="form-actions">
				                                <button type="submit" id="save-form" class="btn btn-success" name="save"> <i class="fa fa-check">Save</i> 
				                                <button type="reset" class="btn btn-default">Reset</button>
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


<!-- Modal  for designation-->
			
			<div class="modal fade designation" id="data-designation" tabindex="-1" role="dialog" aria-labelledby="designation" aria-hidden="true">
            	<div class="modal-dialog modal-lg" role="document">
            		<div class="modal-content br-0">
            			<div class="modal-header">
            				<h4 class="modal-title">Designation</h4>
            				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            					<span aria-hidden="true" id="close">×</span>
            				</button>
            			</div>
            			<div class="modal-body">
					        <form id="modeldesignation" class="" name="modeldesignation" method="post" >
						        <div class="form-body">
						            <div class="row">
						                <div class="col-md-12">
						                    <div class="form-group">
						                        <label>Name</label>
						                        <input type="text" name="designation_name" id="designation_name" class="form-control">
						                    </div>
						                    <p id="errormsg" style="color: red;"></p>
						                </div>
						            </div>
						        </div>
						        
						        <div class="form-actions">
						            <input type="button" id="save-designation" class="btn btn-success" name="Save" value="Save"> <i class="fa fa-check"></i> 
						        </div>
							</form>
            			</div>
            		</div>
            	</div>
            </div>


  <!-- Modal  for department-->
			
			<div class="modal fade department" id="data-department" tabindex="-1" role="dialog" aria-labelledby="designation" aria-hidden="true">
            	<div class="modal-dialog modal-lg" role="document">
            		<div class="modal-content br-0">
            			<div class="modal-header">
            				<h4 class="modal-title">Department</h4>
            				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            					<span aria-hidden="true" id="close">×</span>
            				</button>
            			</div>
            			<div class="modal-body">
					        <form id="modaldepartment" class="" name="modaldepartment" method="post" >
						        <div class="form-body">
						            <div class="row">
						                <div class="col-md-12">
						                    <div class="form-group">
						                        <label>Name</label>
						                        <input type="text" name="department_name" id="department_name" class="form-control">
						                    </div>
						                    <p id="errormsg" style="color: red;"></p>
						                </div>
						            </div>
						        </div>
						        
						        <div class="form-actions">
						            <input type="button" id="save-department" class="btn btn-success" name="Save" value="Save"> <i class="fa fa-check"></i> 
						        </div>
							</form>
            			</div>
            		</div>
            	</div>
            </div>


<style type="text/css">
	.label-info {
  background-color: #5bc0de;
  padding: 3px;
}
  .bootstrap-tagsinput{
  	width:100%;
  }

</style>