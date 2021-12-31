 <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="icon-layers"></i> Project Template</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="clients.html">Project Template</a></li>
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
		                		UPDATE TEMPLATE DETAILS
		                	</div>
		                	<div class="card-wrapper collapse show">
		                		<div class="card-body">
		                			<form id="creatclient" class="aj-form" name="creatclient" method="post" action="<?php echo base_url().'Project/edittemplate/'.base64_encode($editId);?>">
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
		                								<label class="control-label">Project Name</label>
		                								<input id="project_name" class="form-control" type="text" name="project_name" value="<?php echo !empty($templateinfo[0]->projectname) ? $templateinfo[0]->projectname : '' ?>">
		                							</div>
		                						</div>
												<div class="col-md-6">
													<div class="form-group project-category">
															<label class="control-label" for="project-category">Project Category <a class="btn btn-sm btn-outline-success ml-1" href="javascript:;" data-toggle="modal" data-target="#project-category1"><i class="fa fa-plus"></i> Add Project Category</a></label>											
														<!--<label class="control-label" for="project-category">Project Category <a class="btn btn-sm btn-outline-success ml-1" href="#"><i class="fa fa-plus"></i> Add Project Category</a></label>-->
														<select class="custom-select br-0" id="project-category" name="project-category">
																<?php
																	foreach($category as $cat){
																		echo '<option value="'.$cat->id.'">'.$cat->name.'</option> ';
																	}
																	?>
														</select>
													</div>
												</div>
										    </div>
		                					<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<div class="custom-control custom-checkbox my-1 mr-sm-2">
															<input type="checkbox" class="custom-control-input" name="client-view-tasks" id="client-view-tasks" onclick="viewtask()"  <?php if(($templateinfo[0]->viewtask)=='1'){ echo 'checked';}?> >
															<label class="custom-control-label" for="client-view-tasks" style="padding-top: 2px;">Client can view tasks of this project</label>
														</div>
													</div>
												</div>	
												<?php
													if(($templateinfo[0]->viewtask)=='1'){
														$status= 'display:block;';
													}
													else{
														$status= 'display:none;';
													}
												?>
												<div class="col-md-4">
													<div class="form-group"  id="viewnotification" style="<?php echo $status;?>">
														<div class="custom-control custom-checkbox my-1 mr-sm-2">
															<input type="checkbox" class="custom-control-input" name="tasks-notification" id="tasks-notification" <?php if(($templateinfo[0]->tasknotification)=='1'){ echo 'checked';}?>>
															<label class="custom-control-label" for="tasks-notification" style="padding-top: 2px;">Send task notification to client?</label>
														</div>
													</div>
												</div>	
												<div class="col-md-4">
													<div class="form-group">
														<div class="custom-control custom-checkbox my-1 mr-sm-2">
															<input type="checkbox" class="custom-control-input" name="manual_timelog" id="manual_timelog" value="1" <?php if(($templateinfo[0]->manualtimelog)=='1'){ echo 'checked';}?>>
															<label class="custom-control-label" for="manual_timelog" style="padding-top: 2px;">Allow manual time logs?</label>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label">Project Summary</label>
													<textarea name="editor1"><?php echo !empty($templateinfo[0]->projectname) ? $templateinfo[0]->projectname : '' ?></textarea>
												</div>
											</div>
                                		</div>
											<!--<div class="row">
                                        		<div class="col-md-12"> 
		                                            <div class="form-group">
		                                                <label class="control-label">Project Summary</label>
		                                                <textarea name="summary"></textarea>
		                                            </div>
		                                        </div>
                                			</div>-->

                                		<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label">Note</label>
													<textarea id="notes" class="form-control" name="notes" rows="5"><?php echo !empty($templateinfo[0]->note) ? $templateinfo[0]->note : '' ?></textarea>
												</div>
											</div>
                                		</div>
										<!-- action btn -->
			                            <div class="form-actions">
				                               <i class="fa fa-check"></i> <input type="submit" id="save-form" class="btn btn-success" name="btnupdate" value="UPDATE">  </button>
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
			<!--project category--!-->
			<?php
				$this->load->view('common/projectcategory');
			?>
			<!--end category--> 
