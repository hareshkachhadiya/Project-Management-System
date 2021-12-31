<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="ti-layout-list-thumb"></i> Tasks</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                <li class="active">Tasks</li>
            </ol>
        </div>
    </div>
</nav>

            <!-- contetn-wrap -->
<h6 id="sucesmsg" class="text-success"></h6>
    <div class="content-in">  
    	<h2>Filter Results</h2>
        <div class="stats-box">
        	<form class="storepayment">
            	<div class="row mb-2">
        			<div class="col-md-5">
		                <div class="form-group">
		                    <label class="box-title mt-3">Select Date Range</label>
		                    <div class="input-group input-daterange">
							    <input type="text" class="start-date form-control br-0" id="start_date" value="">
							    <div class="input-group-prepend">
							      <span class="input-group-text bg-info text-white">To</span>
							    </div>
							    <input type="text" class="end-date form-control br-0" id="deadline" value="">
							</div>
		                </div>
		            </div>
		            <div class="col-md-3">
		            	<div class="form-group">
							<label class="box-title mt-3">Select Project</label>
							<select id='selproject' class="custom-select search-select" name="selproject">
								<option value="all">All</option>
					            <?php
								foreach($project as $pj){
								?>
								<option value="<?php echo $pj->id; ?>"><?php echo $pj->projectname; ?></option>
    							<?php
    								}
    							?>	 
					        </select> 
		            	</div>
		            </div>
		              <?php if($this->user_type == 0) { ?>
		            <div class="col-md-3">
		            	<div class="form-group">
		            		<label class="box-title mt-3">Select Client</label>
		            		<select id='selclient' class="custom-select search-select">
					            <option value="all">All</option>
					            <?php foreach($clientData as $row){
			            		?>
			            		<option value="<?php echo $row->id?>"><?php echo $row->clientname;?></option>
			            		<?php
			            		}
			            		?>   
					        </select> 
		            	</div>
		            </div>
		          
		            <div class="col-md-3">
		            	<div class="form-group">
							<label class="box-title mt-3">Select Assigned To</label>
							<select id='selassto' class="custom-select search-select">
								<option value="all">All</option>
					            <?php foreach($employee as $row){
			            		?>
			            		<option value="<?php echo $row->id?>"><?php echo $row->employeename;?></option>
			            		<?php
			            		}
			            		?>  
					        </select> 
		            	</div>
		            </div>
		        <?php } ?>
		           <!--  <div class="col-md-3">
		            	<div class="form-group">
		            		<label class="box-title mt-3">Select Assigned By</label>
		            		<select id='selassby' class="custom-select search-select">
					            <option value='0'>All</option>          
					            <option value='1'>Yogesh singh</option>  
					            <option value='2'>Sonarika Bhadoria</option>   
					            <option value='3'>Anil Singh</option>        
					            <option value='4'>Vishal Sahu</option>        
					            <option value='5'>Mayank Patidar</option>        
					            <option value='6'>Vijay Mourya</option>        
					            <option value='7'>Rakesh sahu</option> 
					        </select> 
		            	</div>
		            </div> -->
		            <div class="col-md-3">
		            	<div class="form-group">
							<label class="box-title mt-3">Select Status</label>
							<select id='selstatus' class="custom-select search-select">
								<option value="all">All</option>
					            <option value="1">To Do</option>
                                <option value="2">Doing</option>
                                <option value="3">Completed</option>
                                <option value="0">Incomplete</option> 
					        </select> 
		            	</div>
		            </div>
		            <div class="col-md-3">
		            	<div class="form-group">
		            		<label class="box-title mt-3">Task Category</label>
		            		<select id='taskcategory' class="custom-select search-select">
					            <option value='all'>All</option>          
					            <?php
								foreach($taskCat as $task){
								?>
								<option value="<?php echo $task->id; ?>"><?php echo $task->task_category_name; ?></option>
    							<?php
    								}
    							?>	 
					        </select> 
		            	</div>
		            </div>
		            <div class="col-md-12 mb-2">
		            	<div class="form-group">
				            <div class="custom-control custom-checkbox my-1 mr-sm-2">
							    <input type="checkbox" class="custom-control-input" name="hide-complete" id="hide-complete" value="0">
							    <input type="hidden" id="chk-complete" name="chk-complete" value="">
							    <label class="custom-control-label" for="hide-complete" style="padding-top: 2px;">Hide Completed Tasks</label>
							</div>
				        </div>
		            </div>
		            <div class="col-md-12">
		                <div class="form-action">
		                	<button type="button" class="btn btn-success" id="filter-results"><i class="fa fa-check"></i> Apply</button>
		                </div>
		            </div>
		            
            	</div>
        	</form>
        	<input type="hidden" id="userType" name="userType" value="<?php echo $this->user_type; ?>">
        </div>
        <div class="row">
        	<div class="col-md-12">
        		<div class="stats-box">
        			<h2>Tasks</h2>
        			<div class="row">
	                    <div class="col-sm-6">
	                        <div class="form-group">
	                        	<?php if($this->user_type == 0){
	                        	?>
	                        	<a href="<?php echo base_url().'task/addTask'?>" class="btn btn-outline-success btn-sm">New Task <i class="fa fa-plus" aria-hidden="true"></i></a>
	                            <a href="<?php echo base_url().'task/taskBoard'?>" class="btn btn-inverse btn-sm hidden-sm hidden-xs"><i class="ti-layout-column3" aria-hidden="true"></i> Task Board</a>
	                            <a href="javascript:void(0);" class="btn btn-sm btn-outline-success ml-1" data-original-title="Edit" data-toggle="modal" data-target="#add-task-categ">Add Task Category <i class="fa fa-plus" aria-hidden="true"></i></a>

	                        	<?php 
	                        	}else if($this->user_type == 2){
	                        	?>
	                        		
	                        	<?php 
	                        	}
	                        	?>
	                           
	                        </div>
	                    </div>
	                    <div class="col-sm-6 text-right hidden-xs">
	                        
	                    </div>
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
	                <div class="row">
	                	<div class="col-md-12">
	                		<div class="table-responsive">
			                    <table class="table table-bordered table-hover" id="tasks-table">
			                        <thead>
				                        <tr>
				                            <th>Id</th>
				                            <th>Task</th>
				                            <th>Project</th>
				                             <?php if($this->user_type == 0){ ?>
				                            <th>Assigned To</th>
				                           	<?php } ?>
				                            <th>Client</th>
				                            <th>Due Date</th>
				                            <th>Status</th>
				                            <th>Action</th>
				                        </tr>
			                        </thead>
			                        <tbody>
			                        	
			                        </tbody>
			                        
			                    </table>
			                </div>
	                	</div>
	                </div>
        		</div>
        	</div>
        </div>
    </div>
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