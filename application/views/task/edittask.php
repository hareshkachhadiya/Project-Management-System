		 <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="ti-layout-list-thumb"></i> Tasks</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'; ?>">Home</a></li>
                            <li><a href="<?php echo base_url().'task'; ?>">Tasks</a></li>
                            <li class="active">Add New</li>
                        </ol>
                    </div>
                </div>
            </nav>

            <!-- contetn-wrap -->
            <?php if($this->user_type == 0){ 
            ?>
            <div class="content-in">  
                <div class="row">
                    <div class="col-md-8">
		                <div class="card br-0">
		                	<div class="card-header br-0 card-header-inverse">
		                		New Task
		                	</div>
		                	<div class="card-wrapper collapse show">
		                		<div class="card-body"><?php $c = 'task'; ?>
		                			<form name="task_category" class="aj-form" method="post">
		                				<div class="submit-alerts">
		                					<div class="alert alert-success" role="alert">
											  This is a success alert
											</div>
											<div class="alert alert-danger" role="alert">
											  This is a danger alert
											</div>
											<div class="alert alert-warning" role="alert">
											  This is a warning alert
											</div>
		                				</div>
		                				<div class="form-body">
		                					<div class="row">
		                						<div class="col-md-12">
		                							<div class="form-group">
		                								<label class="control-label">Project<span class="astric">*</span></label>
		                								<select class="custom-select br-0" name="projectid">
		                								<?php
			                								foreach($project as $pj){
			                									$str = '';
			                									if($pj->id == $taskData[0]->projectid){
			                										$str = 'selected';
			                									}
			                								echo '<option value="'.$pj->id.'" '.$str.'>'.$pj->projectname.'</option>';
			                								}
			                							?>	
		                								</select>
		                							</div>
		                						</div>
		                						<div class="col-md-12">
			                						<div class="form-group">
			                							<label class="control-label">
			                								Task Category
			                								<a href="javascript:void(0);" class="btn btn-sm btn-outline-success ml-1" data-original-title="Edit" data-toggle="modal" data-target="#add-task-categ">
												         		<i class="fa fa-plus"></i> Add Task Category</i>
												         	</a>
			                							</label>
			                							<select class="custom-select br-0" id="task-category" name="task-category">
			                							<?php
			                								foreach($taskCat as $catData){
			                										$str = '';
						                							if($catData->id == $taskData[0]->taskcategory){
						                								$str = 'selected';
						                							}
						                							echo '<option value="'.$catData->id.'" '.$str.'>'.$catData->task_category_name.'</option>';
					                							}
			                							?>	
			                							</select>
			                						</div>
			                					</div>
			                					<div class="col-md-6">
			                					</div>
		                						<div class="col-md-12">
		                							<div class="form-group">
			                							<label class="control-label">Title<span class="astric">*</span></label>
			                							<input type="text" class="form-control" id="title_task" name="title_task" value="<?php echo !empty($taskData[0]->title) ?  $taskData[0]->title : ' '?>">
			                						</div>
		                						</div>
		                						<div class="col-md-12">
		                							<div class="form-group">
		                							 	<label class="control-label">Description</label>
		                							 	<textarea name="editor1"><?php echo !empty($taskData[0]->description) ?  $taskData[0]->description : ' '?></textarea>
		                							</div>
		                						</div>
		                						<div class="col-md-12">
		                							<div class="form-group">
		                								<label class="control-label">Start Date<span class="astric">*</span></label>
		                								<input id="start_date" type="text" class="form-control" name="startdate" value="<?php echo !empty($taskData[0]->startdate) ?  $taskData[0]->startdate : ' '?>">
		                							</div>
		                						</div>
		                						<div class="col-md-12">
		                							<div class="form-group">
		                								<label class="control-label">Due Date<span class="astric">*</span></label>
		                								<input id="deadline" type="text" class="form-control" name="due_date" value="<?php echo !empty($taskData[0]->duedate) ?  $taskData[0]->duedate : ' '?>">
		                							</div>
		                						</div>
		                						<div class="col-md-12">
			                						<div class="form-group">
			                							<label class="control-label">Assigned To<span class="astric">*</span></label>
			                							<select id='selUser' class="custom-select" name="assignemp">
												            <?php foreach($employee as $row){
					            							$str = '';
				                							if($row->id == $taskData[0]->assignedto){
				                								$str = 'selected';
				                							}
				                							echo '<option value="'.$row->id.'" '.$str.'>'.$row->employeename.'</option>';
										            		}
										            		?>  
												        </select> 
			                						</div>
			                					</div>
			                					<div class="col-md-12">
			                						<div class="form-group">
			                							<label class="control-label">
			                							Status
			                							</label>
			                							<select name="status" id="status" class="form-control">
		                                                    <option value="1" <?php if($taskData[0]->status == 1){ echo 'selected'; }?>>To Do</option>
		                                                    <option value="2" <?php if($taskData[0]->status == 2){ echo 'selected'; }?>>Doing</option>
		                                                   <!--  <option value="3" <?php if($taskData[0]->status == 3){ echo 'selected'; }?>>Done</option> -->
		                                                    <option value="3" <?php if($taskData[0]->status == 3){ echo 'selected'; }?>>Completed</option>
		                                                    <option value="0" <?php if($taskData[0]->status == 0){ echo 'selected'; }?>>Incomplete</option>
                                					</select>
			                						</div>
			                					</div>
			                					<div class="col-md-12">
			                						<div class="form-group">
			                							<label class="control-label">Priority<span class="astric">*</span></label>
			                							<div class="custom-control custom-radio radio-danger">
														    <input type="radio" class="custom-control-input" id="high-rad" name="radio-stacked" value="0" <?php if($taskData[0]->priority == '0'){ echo 'checked'; }?> required>
														    <label class="custom-control-label text-danger" for="high-rad">High</label>
														</div>
														<div class="custom-control custom-radio radio-warning">
														    <input type="radio" class="custom-control-input" id="medium-rad" name="radio-stacked" value="1" <?php if($taskData[0]->priority == '1'){ echo 'checked'; }?> required>
														    <label class="custom-control-label text-warning" for="medium-rad">Medium</label>
														</div>
														<div class="custom-control custom-radio radio-success">
														    <input type="radio" class="custom-control-input" id="low-rad" name="radio-stacked" value="2" <?php if($taskData[0]->priority == '2'){ echo 'checked'; }?> required>
														    <label class="custom-control-label text-success" for="low-rad">Low</label>
														</div>
			                						</div>
			                					</div>
			                					
		                					</div>
		                					
											<!-- action btn -->
			                                <div class="form-actions">
				                                <button type="submit" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
				                            </div>
		                				</div>
		                			</form>
		                		</div>
		                	</div>
		                </div>
		            </div>
                </div>
            </div>
            <?php 
            }else if($this->user_type == 2){
            ?>
            <div class="content-in">  
                <div class="row">
                    <div class="col-md-8">
		                <div class="card br-0">
		                	<div class="card-header br-0 card-header-inverse">
		                		New Task
		                	</div>
		                	<div class="card-wrapper collapse show">
		                		<div class="card-body"><?php $c = 'task'; ?>
		                			<form name="task_category" class="aj-form" method="post">
		                				<div class="submit-alerts">
		                					<div class="alert alert-success" role="alert">
											  This is a success alert
											</div>
											<div class="alert alert-danger" role="alert">
											  This is a danger alert
											</div>
											<div class="alert alert-warning" role="alert">
											  This is a warning alert
											</div>
		                				</div>
		                				<div class="form-body">
		                					<div class="row">
		                						<div class="col-md-12">
		                							<div class="form-group">
		                								<label class="control-label">Project</label>
		                								<select class="custom-select br-0" name="projectid" disabled>
		                								<?php
			                								foreach($project as $pj){
			                									$str = '';
			                									if($pj->id == $taskData[0]->projectid){
			                										$str = 'selected';
			                									}
			                								echo '<option value="'.$pj->id.'" '.$str.'>'.$pj->projectname.'</option>';
			                								}
			                							?>	
		                								</select>
		                							</div>
		                						</div>
		                						<div class="col-md-12">
			                						<div class="form-group">
			                							<label class="control-label">
			                								Task Category
			                							</label>
			                							<select class="custom-select br-0" id="task-category" name="task-category" disabled>
			                							<?php
			                								foreach($taskCat as $catData){
			                										$str = '';
						                							if($catData->id == $taskData[0]->taskcategory){
						                								$str = 'selected';
						                							}
						                							echo '<option value="'.$catData->id.'" '.$str.'>'.$catData->task_category_name.'</option>';
					                							}
			                							?>	
			                							</select>
			                						</div>
			                					</div>
			                					<div class="col-md-6">
			                					</div>
		                						<div class="col-md-12">
		                							<div class="form-group">
			                							<label class="control-label">Title</label>
			                							<input type="text" class="form-control" id="title_task" name="title_task" value="<?php echo !empty($taskData[0]->title) ?  $taskData[0]->title : ' '?>" disabled>
			                						</div>
		                						</div>
		                						<div class="col-md-12">
		                							<div class="form-group">
		                							 	<label class="control-label">Description</label>
		                							 	<textarea name="editor1" disabled><?php echo !empty($taskData[0]->description) ?  $taskData[0]->description : ' '?></textarea>
		                							</div>
		                						</div>
		                						<div class="col-md-12">
		                							<div class="form-group">
		                								<label class="control-label">start Date</label>
		                								<input id="start_date" type="text" class="form-control" name="startdate" value="<?php echo !empty($taskData[0]->startdate) ?  $taskData[0]->startdate : ' '?>" disabled>
		                							</div>
		                						</div>
		                						<div class="col-md-12">
		                							<div class="form-group">
		                								<label class="control-label">Due Date</label>
		                								<input id="deadline" type="text" class="form-control" name="due_date" value="<?php echo !empty($taskData[0]->duedate) ?  $taskData[0]->duedate : ' '?>" disabled>
		                							</div>
		                						</div>
		                						<div class="col-md-12">
			                						<div class="form-group">
			                							<label class="control-label">Assigned To</label>
			                							<select id='selUser' class="custom-select" name="assignemp" disabled>
												            <?php foreach($employee as $row){
					            							$str = '';
				                							if($row->id == $taskData[0]->assignedto){
				                								$str = 'selected';
				                							}
				                							echo '<option value="'.$row->id.'" '.$str.'>'.$row->employeename.'</option>';
										            		}
										            		?>  
												        </select> 
			                						</div>
			                					</div>
			                					<div class="col-md-12">
			                						<div class="form-group">
			                							<label class="control-label">
			                							Status
			                							</label>
			                							<select name="status" id="status" class="form-control">
		                                                    <option value="1" <?php if($taskData[0]->status == 1){ echo 'selected'; }?>>To Do</option>
		                                                    <option value="2" <?php if($taskData[0]->status == 2){ echo 'selected'; }?>>Doing</option>
		                                                
		                                                    <option value="3" <?php if($taskData[0]->status == 3){ echo 'selected'; }?>>Completed</option>
		                                                    <option value="0" <?php if($taskData[0]->status == 0){ echo 'selected'; }?>>Incomplete</option>
                                					</select>
			                						</div>
			                					</div>
			                					<div class="col-md-12">
			                						<div class="form-group">
			                							<label class="control-label">Priority</label>
			                							<div class="custom-control custom-radio radio-danger">
														    <input type="radio" class="custom-control-input" id="high-rad" name="radio-stacked" value="0" <?php if($taskData[0]->priority == '0'){ echo 'checked'; }?> required disabled>
														    <label class="custom-control-label text-danger" for="high-rad">High</label>
														</div>
														<div class="custom-control custom-radio radio-warning">
														    <input type="radio" class="custom-control-input" id="medium-rad" name="radio-stacked" value="1" <?php if($taskData[0]->priority == '1'){ echo 'checked'; }?> required disabled>
														    <label class="custom-control-label text-warning" for="medium-rad">Medium</label>
														</div>
														<div class="custom-control custom-radio radio-success">
														    <input type="radio" class="custom-control-input" id="low-rad" name="radio-stacked" value="2" <?php if($taskData[0]->priority == '2'){ echo 'checked'; }?> required disabled> 
														    <label class="custom-control-label text-success" for="low-rad">Low</label>
														</div>
			                						</div>
			                					</div>
			                					
		                					</div>
		                					
											<!-- action btn -->
			                                <div class="form-actions">
				                                <button type="submit" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
				                            </div>
		                				</div>
		                			</form>
		                		</div>
		                	</div>
		                </div>
		            </div>
                </div>
            </div>
            <?php
            } 
            ?>
            <!-- ends of contentwrap -->

<!-- add task category -->
            <div class="modal fade" id="add-task-categ" tabindex="-1" role="dialog" aria-labelledby="add-task-categtitle" aria-hidden="true">
            	<div class="modal-dialog modal-md" role="document">
            		<div class="modal-content">
            			<div class="modal-header">
            				<h4 class="modal-title">Task Category</h4>
            				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
            					<span aria-hidden="true" id="close">&times;</span>
            				</button>
            			</div>
            			<div class="modal-body">
            				<div class="table-responsive">
					            <table class="table">
					                <thead>
						                <tr>
						                    <th>#</th>
						                    <th>Category Name</th>
						                    <th>Action</th>
						                </tr>
					                </thead>
					                <tbody id="taxCategory">
					                    <?php
					             			$i = 1; 
					                    	foreach($taskCat as $catData) { ?>
					                    		<tr id="taskCat_<?php echo $catData->id;?>">
					                    			<td><?php echo $i; ?></td>
					                    			<td><?php echo $catData->task_category_name?></td>
					                    			<td><a href="javascript:;" data-cat-id="1" class="btn btn-sm btn-danger btn-rounded delete-category" id='deletetaskCat' onclick="deletetaskCat('<?php echo $catData->id; ?>')">Remove</a></td>
					                    		</tr>
					                    <?php 
					                    	$i++;
					                    	}
					                    ?>
					                </tbody>
					            </table>
					        </div>
					        <hr>
					        <form id="createTaskCategoryForm" class="">
						        <div class="form-body">
						            <div class="row">
						                <div class="col-md-12 ">
						                    <div class="form-group">
						                        <label>Category Name</label>
						                        <input type="text" name="category_name" id="category_name" class="form-control">
						                        <p id="errormsg" class="text-danger"></p>
						                    </div>
						                </div>
						            </div>
						        </div>
						        <div class="form-actions">
						            <button type="button" id="save-task-category" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
						        </div>
						    </form>
            			</div>
            		</div>
            	</div>
            </div>
            <!-- end add task category. -->
        </div>
    </div> 