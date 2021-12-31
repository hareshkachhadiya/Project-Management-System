 <nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="icon-layers"></i> Leaves</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'Dashboard/';?>">Home</a></li>
				<li><a href="<?php echo base_url().'Leaves/';?>">Leaves</a></li>
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
					ASSIGN LEAVE 
				</div>
				<div class="card-wrapper collapse show">
					<div class="card-body">
						<form id="creatleave" class="aj-form" name="creatleave" method="post" action="<?php echo base_url().'Leaves/insertleaves';?>">
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
							<!-- 	<h3 class="box-title">ASSIGN LEAVE</h3> -->
								<hr>
								<p id="succmsg" class="text-success"></p>
							<?php if($this->user_type == 0) { ?>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Choose Member<span class="astric">*</span></label>
											
											<select class="custom-select br-0" id="choose_mem" name="choose_mem">
											
												<?php
												foreach($employee as $emp){
													$str='';
													if(!empty($sessData['choose_mem'])){
														if($sessData['choose_mem'] == $emp->id){
															$str='selected';
														}
													}
													?>
													<option value="<?php echo $emp->id?>" <?php echo $str;?>><?php echo $emp->employeename;?></option>



													<?php
													} 
													?> 											
											</select>

										</div>
									</div>
								</div>
							<?php } ?>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group project-category">
											<label class="control-label" for="leave_type">
											Leave Type
											<?php if($this->user_type == 0) { ?>
												<a class="btn btn-sm btn-outline-success ml-1" href="javascript:;" data-toggle="modal" data-target="#leave_type1" name="leave-category"><i class="fa fa-plus"></i> Add Leave Type</a></label>
											<?php } ?>
											<br/>
											<select id="leave_type" name="leave_type" class="form-control">
											
												<?php
												foreach($leavecategory as $leave){
												?>
													
													<option value="<?php echo $leave->id?>"><?php echo $leave->name;?></option>
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
											<label class="control-label">Select Duration
											</label>
											<div>
											 <input type="radio" id="radio_group1" name="duration_radio" value="0"> Single Day<br>
											 <input type="radio" id="radio_group2" name="duration_radio" value="1"> Multiple Day<br>
											 <input type="radio" id="radio_group3" name="duration_radio" value="2"> Half Day<br>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2" id="deadlineBox">
										<div class="form-group">
											<label class="control-label">Date<span class="astric">*</span></label>
											<input type="text" name="date" id="startdate1" class="form-control" value="<?php if(!empty($sessData['date'])){echo $sessData['date'];}else{ }?>" >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Reason for absence<span class="astric">*</span></label>
											<textarea id="absence" class="form-control" name="absence" rows="5"><?php if(!empty($sessData['absence'])){echo $sessData['absence'];}else{ }?></textarea>
										</div>
									</div>
								<?php if($this->user_type == 0) { ?>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Status</label>
											<select id="" class="form-control" name="status">
												<option selected value="1" <?php if(!empty($sessData['status'])){
                                                            if($sessData['status'] == 1){
                                                                echo 'selected';    
                                                            }}
                                                            ?>>Approved</option>
												<option value="0" <?php if(!empty($sessData['status'])){
                                                            if($sessData['status'] == 0){
                                                                $str;    
                                                            }}
                                                            ?>>Pending</option>

											
											</select>
										</div>
									</div>
								<?php } ?>
								</div>
							
							
						
                     
								<!-- action btn -->
								<div class="form-actions">
									<button type="submit" name="btnsave" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
									<!-- <i class="fa fa-check"><input type="submit" id="save-form" class="btn btn-success" name="btnsave" value="Save"> </i>  -->
									<button type="reset" name="btnreset" class="btn btn-default" 
									>Reset</button>
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
<div class="modal fade project-category" id="leave_type1" tabindex="-1" role="dialog" aria-labelledby="leave_type" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content br-0">
			<div class="modal-header">
				<h4 class="modal-title"> Leave Type</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
						<tr>
							<th>#</th>
							<th>Leave Type</th>
							<th>Action</th>
						</tr>
						</thead>
						 <tbody>
								<?php 	
								$i=1;
									foreach($leavecategory as $leave) { ?>      
									    <tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $leave->name; ?></td>
											<td><a href="javascript:;" data-cat-id="1" class="btn btn-sm btn-danger btn-rounded delete-category" id="deletecat">Remove</a></td>
									    </tr>
							   <?php $i++; } ?>
						</tbody>
					</table>
				</div>
				<hr>
				<form id="leave" class=""  name="leave" method="post">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12 ">
								<div class="form-group">
									<label>Leave Type</label>
									<input type="text" name="leavename" id="leavename" class="form-control">
									<p id="errormsg" class="text-danger"></p>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<input type="button" id="save_leave" class="btn btn-success" value="Save"> <i class="fa fa-check"></i>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
