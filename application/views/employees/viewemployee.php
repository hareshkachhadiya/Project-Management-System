 <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="icon-user"></i> Employees</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'; ?>">Home</a></li>
                            <li class="active">Employees</li>
                        </ol>
                    </div>
                </div>
            </nav>

            <!-- contetn-wrap -->
            <div class="content-in">  
                <div class="row">
                	<div class="col-md-5">
                		<div class="stats-box">
		                	<div class="user-bkg">
		                		<img src="images/default-profile-2.png" alt="user" class="img-circle">
		                		<div class="overlay-box">
				                    <div class="user-content"> <a href="javascript:void(0)">
				                        <img src="images/default-profile-2.png" alt="user" class="thumb-lg img-circle">
				                            </a>
				                        <h4 class="text-white"><?php echo $empData[0]->employeename;?></h4>
				                        <h5 class="text-white"><?php echo $empUser[0]->emailid;?></h5>
				                    </div>
				                </div>
		                	</div>
		                	<div class="user-btm-box">
				                <div class="row row-in">
				                    <div class="col-md-6 b-r">
				                        <div class="col-in">
			                                <h3 class="box-title">Tasks Done</h3>
			                               	<div class="row">
				                                <div class="col-4"><i class="ti-check-box text-success"></i></div>
				                                <div class="col-8 text-right counter">1</div>
				                            </div>
				                        </div>
				                    </div>
				                    <div class="col-md-6 b-r-none">
				                        <div class="col-in">
				                            <h3 class="box-title">Hours Logged</h3>
				                           	<div class="row">
					                            <div class="col-sm-2"><i class="icon-clock text-info"></i></div>
					                            <div class="col-sm-10 text-right counter" style="font-size: 13px">763 hrs </div>
					                        </div>
				                        </div>
				                    </div>
				                </div>
				                <div class="row row-in">
				                    <div class="col-md-6 b-r row-in-br">
			                        	<div class="col-in">
			                                <h3 class="box-title">Leaves Taken</h3>
			                                <div class="row">
			                                	<div class="col-sm-4"><i class="icon-logout text-warning"></i></div>
			                                	<?php 
			                                	$whereLeave = array('empid' => $empData[0]->id , 'status' => 0);
												$approveLeaves = $this->common_model->getData('tbl_leaves',$whereLeave);
			                                	?>
			                                	<div class="col-sm-8 text-right counter"><?php echo count($approveLeaves); ?></div>
			                                </div>
				                        </div>
				                    </div>
				                    <div class="col-md-6 row-in-br b-r-none">
				                        <div class="col-in">
				                            <h3 class="box-title">Remaining Leaves</h3>
				                            <div class="row">
					                            <div class="col-sm-4"><i class="icon-logout text-danger"></i></div>
					                            <?php 
			                                	$whereLeave = array('empid' => $empData[0]->id , 'status' => 1);
												$remainLeaves = $this->common_model->getData('tbl_leaves',$whereLeave);
			                                	?>
					                            <div class="col-sm-8 text-right counter"><?php echo count($remainLeaves); ?></div>
					                        </div>
				                        </div>
				                    </div>
				                </div>
				            </div>
		                </div>
                	</div>
                	<div class="col-md-7">
                		<div class="stats-box">
		                	<ul class="nav nav-tabs theme-tabsamp" id="myTab" role="tablist">
							 <!--  <li class="nav-item">
							    <a class="nav-link active" id="activity-tab" data-toggle="tab" href="#activity" role="tab" aria-controls="activity" aria-selected="true">Activity</a>
							  </li> -->
							  <li class="nav-item">
							    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="projects-tab" data-toggle="tab" href="#projects" role="tab" aria-controls="projects" aria-selected="false">Project</a>
							  </li>

							  <li class="nav-item">
							    <a class="nav-link" id="tasks-tab" data-toggle="tab" href="#tasks" role="tab" aria-controls="tasks" aria-selected="true">Tasks</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="leaves-tab" data-toggle="tab" href="#leaves" role="tab" aria-controls="leaves" aria-selected="false">Leaves</a>
							  </li>
							  <li class="nav-item">
							    <a class="nav-link" id="timelogs-tab" data-toggle="tab" href="#timelogs" role="tab" aria-controls="timelogs" aria-selected="false">Time Logs</a>
							  </li>
							<!--   <li class="nav-item">
							    <a class="nav-link" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">Documents</a>
							  </li> -->
							</ul>
							<div class="tab-content mt-4" id="myTabContent">
								<!-- 1 -->
							  	<!-- <div class="tab-pane fade show active" id="activity" role="tabpanel" aria-labelledby="activity-tab">
						  			No activity by the user.
							  	</div> -->
							  	<!-- 2 -->
							  	<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							  		<div class="row">
				                        <div class="col-sm-6 b-r"> <strong>Full Name</strong> <br>
				                            <p class="text-muted"><?php echo $empData[0]->employeename; ?></p>
				                        </div>
				                        <div class="col-sm-6"> <strong>Mobile</strong> <br>
				                            <p class="text-muted"><?php echo $empUser[0]->mobile; ?></p>
				                        </div>
				                    </div>
				                    <hr>
				                    <div class="row">
				                        <div class="col-md-6 col-sm-6 b-r"> <strong>Email</strong> <br>
				                            <p class="text-muted"><?php echo $empUser[0]->emailid; ?></p>
				                        </div>
				                        <div class="col-md-3 col-sm-6"> <strong>Address</strong> <br>
				                            <p class="text-muted"><?php echo $empData[0]->address; ?></p>
				                        </div>
				                    </div>
				                    <hr>
				                    <div class="row">
				                        <div class="col-md-6 col-sm-6 b-r"> <strong>Job Title</strong> <br>
				                            <p class="text-muted">Project Manager</p>
				                        </div>
				                        <div class="col-md-3 col-sm-6"> <strong>Hourly Rate</strong> <br>
				                            <p class="text-muted">20</p>
				                        </div>
				                    </div>
				                    <hr>
				                    <div class="row">
				                        <div class="col-md-6 col-xs-6 b-r"> <strong>Slack Username</strong> <br>
				                            <p class="text-muted"><?php echo $empData[0]->slackusername; ?></p>
				                        </div>
				                        <div class="col-md-6 col-xs-6"> <strong>Joining Date</strong> <br>
				                            <p class="text-muted"><?php echo $empData[0]->joingdate; ?></p>
				                        </div>
				                    </div>
				                    <hr>
				                    <div class="row">
				                        <div class="col-md-6 col-xs-6 b-r"> <strong>Gender</strong> <br>
				                        	<?php if($empData[0]->gender == 0){
				                        		$gender = 'Male';
				                        	}else{
				                        		$gender = 'Female';
				                        	}?>	
				                            <p class="text-muted"><?php echo $gender; ?></p>
				                        </div>
				                        <div class="col-md-6 col-xs-6"> Skills<br/><strong><?php echo $empData[0]->skills; ?></strong> <br>
				                        </div>
				                    </div>
				                    <hr>
							  	</div>
							  	<!-- 3 -->
							  	<?php 
							  	$projectQuery = "select tbl_project_info.*,tbl_project_member.project_id,
							  			tbl_project_member.emp_id from tbl_project_info inner join tbl_project_member on tbl_project_info.id = tbl_project_member.project_id where emp_id=".$empData[0]->id;
							  	$memberData = $this->common_model->coreQueryObject($projectQuery);

							  	?>
							  	<div class="tab-pane fade" id="projects" role="tabpanel" aria-labelledby="projects-tab">
							  		<div class="table-responsive">
									    <table class="table">
									        <thead>
									            <tr>
									                <th>#</th>
									                <th>Project</th>
									                <th>Deadline</th>
									                <th>Completion</th>
									            </tr>
									        </thead>
									        <tbody>
									        	<?php 
									        	$j=1;
									        	for($i=0;$i<count($memberData);$i++){ ?>
									            <tr>
									                <td><?php echo $j; ?></td>
									                <td><a href="<?php echo base_url().'Project/overView/'.base64_encode($memberData[$i]->id)?>"><?php echo $memberData[$i]->projectname; ?></a></td>
									                <td><?php echo $memberData[$i]->deadline; ?></td>
									                <td>

									                    <h5>Completed<span class="pull-right">76%</span></h5>
									                    <div class="progress hight-4px">
									                        <div class="progress-bar bg-success" role="progressbar" style="width: 76%" aria-valuenow="76" aria-valuemin="0" aria-valuemax="100"></div>
									                    </div>
									                </td>
									            </tr>
									        <?php $j++; } ?>
									            
									        </tbody>
									    </table>
									</div>
							  	</div>
							  	<!-- 4 -->
							  	<div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
							  		<div class="row">
				                        <div class="col-md-6">
				                            <div class="custom-control custom-checkbox checkbox-info">
				                                <input type="checkbox" class="custom-control-input" id="hide-completed-tasks">
				                                <label class="custom-control-label" for="hide-completed-tasks" margin-top: 2px;>Hide Completed Tasks</label>
				                            </div>
				                        </div>
				                    </div>
				                    <hr>
				                    <div class="table-responsive">
									    <table class="table table-bordered" id="emplo-tasks-table">
									        <thead>
									            <tr role="row">
									                 <th>Id</th>
									                 <th>Project</th>
									                 <th>Task</th>
									                 <th>Due Date</th>
									                 <th>Status</th>
									            </tr>
									        </thead>
									        <tbody>
									        	<?php 
									        	$taskQuery = "select tbl_task.*,tbl_project_info.id , tbl_project_info.projectname from tbl_task inner join tbl_project_info on tbl_task.projectid = tbl_project_info.id where assignedto =".$empData[0]->id;
									        	$taskData = $this->common_model->coreQueryObject($taskQuery);
									        	//echo "<PRE>";print_r($taskData);die;
									        	?>
									        	<?php 
									        	$j=1;
									        	for($i=0;$i<count($taskData);$i++){ ?>
									            <tr role="row" class="odd">
									                <td class="" tabindex="0"><?php echo $j; ?></td>
									                <td><a href="#"><?php echo $taskData[$i]->projectname; ?></a></td>
									                <td><?php echo $taskData[$i]->title; ?></td>
									                <td><span class="text-danger"><?php echo $taskData[$i]->duedate; ?></span></td>
									                <?php 
									                if($taskData[$i]->status = 0){ 
									                	$status = 'Incomplete'; 
									                }
									                else if($taskData[$i]->status = 1){
									                	$status = 'To Do';
									                }
									                else if($taskData[$i]->status = 2){
									                	$status = 'Doing';
									                }
									                else if($taskData[$i]->status = 3){
									                	$status = 'Completed';
									                }
									                ?>
									                <td><label class="label label-danger"><?php echo $status; ?></label></td>
									            </tr>
									            <?php $j++; } ?>
									        </tbody>
									    </table>
									</div>
							  	</div>
							  	<!-- 5 -->
							  	<div class="tab-pane fade" id="leaves" role="tabpanel" aria-labelledby="leaves-tab">
							  		<div class="row">
				                        <div class="col-md-6">
				                        	<?php 
				                        	$whereLeaveArr = array('empid' => $empData[0]->id);
				                        	$leaveData =  $this->common_model->getData('tbl_leaves',$whereLeaveArr);
			                        		$whereCasual = array('empid' => $empData[0]->id , 'leavetypeid' => 3);
			                        		$LeaveTypeCasual = $this->common_model->getData('tbl_leaves', $whereCasual);
			                        		$whereSick = array('empid' => $empData[0]->id , 'leavetypeid' =>1);
			                        		$LeaveTypeSick = $this->common_model->getData('tbl_leaves', $whereSick);
			                        		$whereEarned = array('empid' => $empData[0]->id , 'leavetypeid' =>2);
			                        		$LeaveTypeEarned = $this->common_model->getData('tbl_leaves', $whereEarned);	
				                        	?>
				                            <ul class="basic-list">
				                                <li>Casual
				                                    <span class="pull-right bg-success label"><?php echo count($LeaveTypeCasual); ?></span>
				                                </li>
				                                <li>Sick
				                                    <span class="pull-right bg-danger label"><?php echo count($LeaveTypeSick); ?></span>
				                                </li>
				                                <li>Earned
				                                    <span class="pull-right bg-info label"><?php echo count($LeaveTypeEarned); ?></span>
				                                </li>
				                           	</ul>
				                        </div>
				                    </div>
				                    <hr>
				                    <div class="table-responsive">
									    <table class="table table-bordered " id="emplo-tasks-table">
									        <thead>
									            <tr role="row">
									                 <th>Leave Type</th>
									                 <th>Date</th>
									                 <th>Reason for absence</th>
									            </tr>
									        </thead>
									        <tbody>
									        	<?php 
									        	
									        	for($i=0;$i<count($leaveData);$i++){ 
									        		if($leaveData[$i]->leavetypeid == 1){
									        		$leave = 'Sick';

										        	}elseif($leaveData[$i]->leavetypeid == 2){
										        		$leave = 'Earned';

										        	}elseif($leaveData[$i]->leavetypeid == 3){
										        		$leave = 'Casual';
										        	}
									        	?>
									            <tr>
									                <td><?php echo $leave;?></td>
									                <td><?php echo $leaveData[$i]->date; ?></td>
									                <td><?php echo $leaveData[$i]->reasonforabsence; ?></td>
									            </tr>
									            <?php }
									            ?>
									        </tbody>
									    </table>
									</div>
							  	</div>
							  	<!-- 6 -->
							  	<div class="tab-pane fade" id="timelogs" role="tabpanel" aria-labelledby="timelogs-tab">
							  		<div class="table-responsive">
									    <table class="table table-bordered" id="timelogs-table">
									        <thead>
									            <tr role="row">
									               <th>Id</th>
									               <th>Project</th>
									               <th>Start Time</th>
									               <th>End Time</th>
									               <th>Total Hours</th>
									               <th>Memo</th>
									            </tr>
									        </thead>
									        <tbody>
									        	<?php 
									        	$timelogQuery = "SELECT `tbl_timelog`.*,tbl_project_info.id as pid ,tbl_project_info.projectname from tbl_timelog inner join tbl_project_info on  tbl_project_info.id = tbl_timelog.timelogprojectid where timelogemployeeid=".$empData[0]->id;
									        	$timelogData = $this->common_model->coreQueryObject($timelogQuery);
									        	//echo "<PRE>";print_r($timelogData);die;
									        	$j=1;
									        	for($i=0;$i<count($timelogData);$i++) {	
									        	?>
									            <tr role="row" class="odd">
									               <td class="" tabindex="0"><?php echo $j;  ?></td>
									               <td><a href="<?php echo base_url().'Project/overView/'.base64_encode($timelogData[$i]->pid)?>"><?php echo $timelogData[$i]->projectname; ?></a></td>
									               <td><?php echo $timelogData[$i]->timelogstarttime; ?></td>
									               <td><?php echo $timelogData[$i]->timelogendtime; ?></td>
									               <td><?php echo $timelogData[$i]->totalhours; ?></td>
									               <td><?php echo $timelogData[$i]->timelogmemo; ?></td>
									            </tr>
									           <?php $j++; } ?> 
									        </tbody>
									    </table>
									</div>
							  	</div>
							  	<!-- 7 -->
							  	<!-- <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
							  		<button class="btn btn-sm btn-info addDocs" onclick="" data-toggle="modal" data-target="#emp-docs"><i class="fa fa-plus"></i> Add</button>
							  		<br><br>
							  		<div class="table-responsive">
				                        <table class="table">
				                            <thead>
				                            <tr>
				                                <th>#</th>
				                                <th width="70%">Name</th>
				                                <th>Action</th>
				                            </tr>
				                            </thead>
				                            <tbody id="employeeDocsList">
				                            	<tr>
											        <td>1</td>
											        <td>Mahesh</td>
											        <td>
											            <a href="javascript:;" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
											            <a target="_blank" href="javascript:;" data-toggle="tooltip" data-original-title="View" class="btn btn-info btn-circle"><i class="fa fa-search"></i></a>
											            <a href="javascript:;" data-toggle="tooltip" data-original-title="Delete" data-file-id="1" data-pk="list" class="btn btn-danger btn-circle sa-params"><i class="fa fa-times"></i></a>
											        </td>
											    </tr>
											</tbody>
				                        </table>
                    				</div>
							  	</div> -->
							</div>
		                </div>
                	</div>
                </div>
            </div>
            <!-- ends of contentwrap -->
 <div class="modal fade" id="emp-docs" tabindex="-1" role="dialog" aria-labelledby="emp-docstitle" aria-hidden="true">
			    <div class="modal-dialog modal-md" role="document">
			        <div class="modal-content">
			            <div class="modal-header">
			                <h4 class="modal-title"><i class="fa fa-plus"></i>  Employee Documents</h4>
			                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                    <span aria-hidden="true">&times;</span>
			                </button>
			            </div>
			            <div class="modal-body">
			                <form class="employe-docs">
			                    <div class="form-body">
			                        <div class="row">
			                            <div class="col-md-5">
			                                <div class="form-group">
			                                    <label class="control-label">Name</label>
			                                    <input type="text" id="name" placeholder="Name" class="form-control" name="name">
			                                </div>
			                            </div>
			                            <div class="col-md-5">
			                                <div class="form-group">
			                                    <label class="control-label">Phone</label>
			                                    <input type="file" id="docs" class="form-control" name="docs" placeholder="Docs">
			                                </div>
			                            </div>
			                            <div class="col-md-1">
			                                <button type="button" onclick="" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
			                            </div>
			                        </div>
			                        <button type="button" id="plusButton" class="btn btn-sm btn-info" style="margin-bottom: 20px"> Add More <i class="fa fa-plus"></i> </button> 
			                        <div class="alert alert-info"><i class="fa fa-info-circle"></i> Allowed file formats: jpg, png, gif, doc, docx, xls, xlsx, pdf, txt.</div>
			                    </div>
			                </form>
			            </div>
			            <div class="modal-footer text-left">
			                <button type="submit" id="save-form" class="btn btn-info"> <i class="fa fa-check"></i> Save</button>
			                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
			            </div>
			        </div>
			    </div>
			</div>
        </div>
    </div>