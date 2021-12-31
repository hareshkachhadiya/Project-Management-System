<nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="icon-user"></i> Employees</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                            <li class="active">Employees</li>
                        </ol>
                    </div>
                </div>
            </nav>

            <!-- contetn-wrap -->
            <div class="content-in">  
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-box bg-black">
			                <h3 class="box-title text-white">Total Employees</h3>
			                <ul class="list-inline two-wrap">
			                    <li><i class="icon-user text-white"></i></li>
			                    <?php 
			                        $empArr = $this->common_model->getData('tbl_employee');
			                        $total_Emp = count($empArr);
			                    ?>
			                    <li class="text-right"><span id="" class="counter text-white"><?php echo $total_Emp;?></span></li>
			                </ul>
			            </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-box bg-danger">
			                <h3 class="box-title text-white">Not working on project</h3>
			                <ul class="list-inline two-wrap">
			                    <li><i class="icon-user text-white"></i></li>
			                    <?php 
			                    	$sql = "SELECT * from tbl_employee where is_deleted = 0 AND  tbl_employee.id not in(SELECT emp_id from tbl_project_member)";
										$empsAllArr = $this->common_model->coreQueryObject($sql);
			                    ?>
			                    <li class="text-right"><span id="" class="counter text-white"><?php echo count($empsAllArr); ?></span></li>
			                </ul>
			            </div>
                    </div>
                </div>
                <div class="row">
                	<div class="col-md-12">
                		<div class="stats-box">
                			<div class="row">
                				<?php if(!empty($freeEmp) == 1){ ?>
                				<div class="col-md-6">
                					<div class="form-group">
			                            <a href="<?php echo base_url().'employee'?>" class="btn btn-outline-success btn-sm">View All</a>
			                        </div>
                				</div>
                				<?php } else { ?>
                				<div class="col-md-6">
                					<div class="form-group">
			                            <a href="<?php echo base_url().'employee/addemployee'?>" class="btn btn-outline-success btn-sm">Add New Employee <i class="fa fa-plus" aria-hidden="true"></i></a>

			                            <a href="javascript:;" id="toggle-filter" class="btn btn-outline-danger btn-sm toggle-filter"><i class="fa fa-sliders"></i> Filter Results</a>

			                            <a href="<?php echo base_url().'Employee/index/'.base64_encode(1); ?>"  class="btn btn-outline-info btn-sm text-capitalize">Not working on project</a>
			                        </div>
                				</div>
                			<?php } ?>
                			</div>
                			<div style="background: rgb(251, 251, 251); display: none;" id="filterdiv">
                				<div class="col-md-12">
                        			<h4>Filter by <a href="javascript:;" class="pull-right toggle-filter"><i class="fa fa-times-circle-o"></i></a></h4>
                    			</div>
                    			<form>
                    				<div class="row">
	                    				<div class="col-md-4">
	                            			<div class="form-group">
				                                <label class="control-label">Status</label>
				                                <select class="form-control" name="status" id="status" data-style="form-control">
				                                    <option value="All">All</option>
				                                    <option value="0">Active</option>
				                                    <option value="1">Inactive</option>
				                                </select>
			                            	</div>
	                        			</div>
	                        			<div class="col-md-4">
	                            			<div class="form-group">
				                                <label class="control-label">Select Employee</label>
				                                <select class="form-control" name="employeename" id="employeename" data-style="form-control">
				                                    <option value="">All</option>
				                                    <?php foreach($employee as $row){
									            	?>
									            	<option value="<?php echo $row->id?>"><?php echo $row->employeename;?></option>
									            	<?php
									            	}
									            	?> 
				                                </select>
			                            	</div>
	                        			</div>
	                        			<div class="col-md-4">
	                            			<div class="form-group">
				                                <label class="control-label">Skills</label>
				                                <select class="form-control" multiple name="skill[]" id="skill" data-style="form-control">
				                                    <option value="">All</option>
				                                    <?php
														foreach($skillArr as $k=>$v)
														{
															echo '<option value="'.$v.'" >'.$v.'</option>';
														}
													?>
				                                </select>
			                            	</div>
	                        			</div>
	                        		</div>
	                        	<div class="row">
	                    				<!--<div class="col-md-4">
	                            			<div class="form-group">
				                                <label class="control-label">Role</label>
				                                <select class="form-control" name="role" id="role" data-style="form-control">
				                                    <option value="all">All</option>
				                                    <option value="active">Active</option>
				                                    <option value="deactive">Inactive</option>
				                                </select>
			                            	</div>
	                        			</div>-->
	                        			<div class="col-md-4">
	                            			<div class="form-group">
				                                <label class="control-label">Designation</label>
				                                <select class="form-control" name="designation" id="designation" data-style="form-control">
				                                    <option value="">All</option>
									            	<?php foreach($designation as $row){
									            	?>
									            	<option value="<?php echo $row->id?>"><?php echo $row->name;?></option>
									            	<?php
									            	}
									            	?>
				                                </select>
			                            	</div>
	                        			</div>
	                        			<div class="col-md-4">
	                            			<div class="form-group">
				                                <label class="control-label">Department</label>
				                                <select class="form-control" name="department" id="department" data-style="form-control">
				                                   <option value="">All</option>
									            	<?php foreach($department as $row){
									            	?>
									            	<option value="<?php echo $row->id?>"><?php echo $row->name;?></option>
									            	<?php
									            	}
									            	?> 
				                                </select>
			                            	</div>
	                        			</div>
	                        		</div>
	                        		<div class="col-md-12">
		                            	<div class="form-group pull-right">
			                               <button type="button" id="btnapplyEmp" class="btn btn-success col-md-6" ><i class="fa fa-check"></i> Apply</button>
				                            <button type="reset" id="reset_filters" class="btn btn-inverse col-md-5 col-md-offset-1"><i class="fa fa-refresh"></i> Reset</button>
		                            	</div>
                       			 </div>
                       			 <?php if(!empty($freeEmp)) { ?>
                       			 <input type="hidden" id="Not-Working-Emp" value="<?php echo $freeEmp;?>" > 
                       			<?php } ?>
                    			</form>
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
			                	<table class="table table-bordered table-hover" id="employee">
								   	<thead>
								      	<tr role="row">
									         <th>Id</th>
									         <th>Name</th>
									         <th>Email</th>
									         <!--<th>User Role</th>-->
									         <th>Status</th>
									         <th>Created At</th>
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
