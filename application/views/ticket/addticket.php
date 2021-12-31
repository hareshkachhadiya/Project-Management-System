<nav aria-label="breadcrumb" class="breadcrumb-nav">
   	<div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="ti-ticket"></i> Tickets</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="clients.html">Tickets</a></li>
                <li class="active">Add New</li>
            </ol>
        </div>
    </div>
</nav>
<!-- contetn-wrap -->
<div class="content-in">
	<form id="addticket" class="aj-form" method="post" action="<?php echo base_url().'ticket/insertticket'; ?>" enctype="multipart/form-data">  
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
            <div class="row">
                <div class="col-md-8">
	                <div class="card br-0">
	                	<div class="card-header br-0 text-right text-black">
	                		Ticket # 31
	                	</div>
	                	<div class="card-wrapper collapse show">
	                		<div class="card-body">
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
                								<label class="control-label">Ticket Subject<span class="astric">*</span></label>
                								<input id="ticket_subject" class="form-control" type="text" name="ticket_subject" value="">
                							</div>
                						</div>
                					</div>
									<div class="row">
                                		<div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Ticket Description<span class="astric">*</span></label>
                                                <textarea name="editor2" id="editor1"></textarea>
                                            </div>
                                        </div>
                        			</div>
                        			<?php 
                        				if ($this->user_type == 0) {
                        				?>
                        					<div class="row">
				                    			<div class="col-md-6">
				            						<div class="form-group type">
				            							<label>Status<span class="astric">*</span></label>
				            							<select class="custom-select br-0" name="status" id="status">
				            								
				            								<option  value="1">Open</option>
				            								<option value="2">Pending</option>
				            								<option value="3">Resolved</option>
				            								<option value="4">Close</option>
				            							</select>
				            						</div>
				            					</div>
			            					</div>
			            				<?php 
                        				} ?>
                        			
                        			<div class="row">
                                		<div class="col-md-12">
                                            <div class="form-group">
                                            	<label class="control-label">Ticket Image 
                                            	</label><br/>
                                            	<input type='file'class="file-upload-input" name="ticket_Image" id="ticket_Image"/>
                                            	<input type="hidden" name="hidden_Image" value="<?php echo !empty($expense[0]->invoicefile) ? $expense[0]->invoicefile : '' ?>" >
                                                
                                            </div>
                                        </div>
                        			</div>
                				</div>
	                		</div>
	                		<dl id="diff">
							</dl>
	                		<div class="card-footer text-right">
	                			<!-- action btn -->
                                <div class="form-actions">
	                                <div class="btn-group">
									  	<!-- <button type="submit" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" name="submitticket">
									    	Submit
									  	</button> -->
									  	<button type="submit" class="btn btn-success" aria-haspopup="true" aria-expanded="false" name="submitticket">
									    	Submit
									  	</button> 
									  <!-- 	<div class="dropdown-menu">
										    <a class="dropdown-item" href="#">Submit Open <span style="width: 15px; height: 15px;" class="btn btn-danger btn-small btn-circle">&nbsp;</span></a>
										    <a class="dropdown-item" href="#">Submit Pending <span style="width: 15px; height: 15px;" class="btn btn-warning btn-small btn-circle">&nbsp;</span></a>
										    <a class="dropdown-item" href="#">Submit Resolved <span style="width: 15px; height: 15px;" class="btn btn-info btn-small btn-circle">&nbsp;</span></a>
										    <a class="dropdown-item" href="#">Submit Close <span style="width: 15px; height: 15px;" class="btn btn-success btn-small btn-circle">&nbsp;</span></a>
									  	</div> -->
									</div>
	                            </div>
	                		</div>

	                	</div>
	                </div>
	            </div>
	            <div class="col-md-4">
	            	<div class="card br-0">
	            		<div class="card-wrapper collapse show">
	            			<div class="card-body">
	            				<div class="row">
	            					<div class="col-md-12">
										<p id="succmsg" class="text-success"></p>
	            						<div class="form-group">
	            							
	            							<?php 
	            							if($this->user_type == 0){
	            							?>
	            								<label class="control-label">Requester Name<span class="astric">*</span></label>
		            								<select class="custom-select br-0" name="requestername" id="requestername">
			            								<option value="">--SELECT--</option>
			            								 <?php
			            								 foreach($getclient as $client){
															?>
																<option value="<?php echo $client->id?>"><?php echo $client->clientname;?></option>
															
															<?php
															} 
														?> 	
		            								</select>
	            							<?php 
	            							}else if($this->user_type == 1){
	            							?>
	            								<input type="hidden" name="requestername" value="<?php echo $this->user_id;?>">

	            							<?php }else if($this->user_type == 2){
	            							?>	
	            								<input type="hidden" name="requestername" value="-">
		            						<?php } ?>
	            						</div>
	            					</div>
	            					<div class="col-md-12">
										<p id="succmsg" class="text-success"></p>
										<?php 
	            							if($this->user_type == 0){
	            							?>
	            								<div class="form-group">
		            								<label class="control-label">Agent Name<span class="astric">*</span></label>
			            							<select class="custom-select br-0" name="agentname" id="agentname">
			            								<option value="">--SELECT--</option>
			            								<?php
														foreach($getemployee as $emp){
														?>
															
															<option value="<?php echo $emp->id?>"><?php echo $emp->employeename;?></option>
															<?php
															} 
														?> 	
			            							</select>
	            								</div>
	            							<?php }else if($this->user_type == 1){ ?>
	            								<input type="hidden" name="agentname" value="-"> 
	            							<?php }else if($this->user_type == 2){ ?>
	            								<input type="hidden" name="agentname" value="-">
	            							<?php } ?>
	            					</div>
	            					<?php 
	            							if($this->user_type == 0){ ?> 
	            								<div class="col-md-6">
	            									<div class="form-group type">
				            							<label>Type <a class="btn btn-sm btn-outline-info  ml-1" href="javascript:;" data-toggle="modal" data-target="#type1"><i class="fa fa-plus"></i> Add Type</a></label>
			            								<select class="custom-select br-0" name="question" id="question">
				            								<?php
															foreach($tickettype as $type){
															?>
																<option value="<?php echo $type->id?>"><?php echo $type->name;?></option>
															<?php } ?> 		
            											</select>
	            									</div>
	            								</div>
	            								<div class="col-md-6">
				            						<div class="form-group type">
				            							<label>Priority <span class="text-danger">*</span></label>
				            							<select class="custom-select br-0" name="priority" id="priority">
				            								<option value="">--SELECT--</option>
				            								<option  value="1">Low</option>
				            								<option value="2">High</option>
				            								<option value="3">Medium</option>
				            								<option value="4">Urgent</option>
				            							</select>
				            						</div>
	            								</div>
	            								<div class="col-md-12">
				            						<div class="form-group channel">
				            							<label class="control-label">Channel Name <a class="btn btn-sm btn-outline-info  ml-1" href="javascript:;" data-toggle="modal" data-target="#channel1"><i class="fa fa-plus"></i> Add channel</a></label>
				            							<select class="custom-select br-0" name="channel" id="channel">
				            								<?php
																foreach($ticketchannel as $tchannel){
																?>
																	
																<option value="<?php echo $tchannel->id?>"><?php echo $tchannel->name;?></option>
															<?php
																} 
															?> 		
				            							</select>
				            						</div>
				            					</div>
				            					<div class="col-md-12">
				            						<div class="form-group">
				            							<label class="control-label">Tags</label>
				            							<input type="text" id="tags" class="form-control" name="tags">
				            						</div>
	            							</div>
		            						<?php }else { ?>
		            							<input type="hidden" name="question" value="-">
		            							<input type="hidden" name="priority" value="-">
		            							<input type="hidden" name="channel" value="-">
		            							<input type="hidden" name="tags" value="-">
		            							<?php
		            						}?>
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            </div> 
            </div>
        </div>
    </form>
</div>	
<!-- ends of contentwrap -->

<!--For +addtype-->

<div class="modal fade project-category" id="type1" tabindex="-1" role="dialog" aria-labelledby="project-category" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content br-0">
			<div class="modal-header">
				<h4 class="modal-title">Add New Ticket Type</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
			</div>
			<div class="modal-body">
				<form class="" id="ticket" name="ticket" method="post">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12 ">
								<div class="form-group">
									<label>Ticket Type</label>
									<input type="text" name="ticket_type" id="ticket_type" class="form-control">
									<p id="errormsg" class="text-danger"></p>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<input type="button" id="save_ticket" class="btn btn-success" value="Save"> <i class="fa fa-check"></i>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- For +addchannel-->

<div class="modal fade project-category" id="channel1" tabindex="-1" role="dialog" aria-labelledby="project-category" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content br-0">
			<div class="modal-header">
				<h4 class="modal-title"> Add New Ticket Channel</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
					</button>
			</div>
			<div class="modal-body">
				<form class="" id="ticketchannel" name="ticketchannel" method="post">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12 ">
								<div class="form-group">
									<label>Channel Name</label>
									<input type="text" name="channel_name" id="channel_name" class="form-control">
									<p id="errormsgc" class="text-danger"></p>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<input type="button" id="save_tchannel" class="btn btn-success" value="Save"> <i class="fa fa-check"></i>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>