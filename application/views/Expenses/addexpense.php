<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
	    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
	        <h4 class="page-title"><i class="ti-receipt"></i>Expenses</h4>
	    </div>
	    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
	        <ol class="breadcrumb">
	            <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
	            <li><a href="<?php echo base_url().'Finance'?>">Expenses</a></li>
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
	        	
					ADD EXPENSE				
	        	<div class="card-wrapper collapse show">
	        		<div class="card-body">
	        			<form class="aj-form" method="post" action="<?php echo base_url().'Finance/insertexpense' ?>" name="expense" enctype="multipart/form-data">
								 <?php
									$mess = $this->session->flashdata('message_name');
									if(!empty($mess)){
										//warning 
								?>
				
							<div class="submit-alerts">
	        					<div class="alert alert-success" role="alert" style="display:block;">
								
								  This is a success alert
								</div>
							</div>
							<div class="submit-alerts">
								<div class="alert alert-danger" role="alert" style="display:block;">
									<?php echo $mess; ?>
								</div>
							</div>
									<?php } ?>
						
							<div class="submit-alerts">
								<div class="alert alert-warning" role="alert">
								  This is a warning alert
								</div>
	        				</div>
	        				<div class="form-body">
	        					<div class="row">
									<div class="col-md-12 ">
										<div class="col-md-12">
	        								<div class="form-group">
	        									<label class="control-label">Choose Member<span class="astric">*</span></label>
												<select name="employee" id="employee" class="form-control">
												<option value="">--</option>
													<?php
														foreach($employee as $row)
														{
															echo '<option value="'.$row->id.'">'.$row->employeename.'</option>';
														}
													?>
												</select>
											</div>
	        							</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 ">
										<div class="col-md-12">
	        								<div class="form-group">
	        									<label class="control-label">Project<span class="astric">*</span></label>
												<select name="project" id="project" class="form-control">
												<option value="">--</option>
													<?php
														foreach($project as $row)
														{
															echo '<option value="'.$row->id.'">'.$row->projectname.'</option>';
														}
													?>
												</select>
											</div>
	        							</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 ">
										<div class="col-md-12">
	        								<div class="form-group">
	        									<label class="control-label">Currency<span class="astric">*</span></label>
												<select name="currency" id="currency" class="form-control">
												<option value="">--</option>
												<option value="1">$(USD)</option>
												<option value="2">R(IND)</option>
												</select>
											</div>
	        							</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 ">
										<div class="col-md-12">
	        								<div class="form-group">
	        									<label class="control-label">Item Name<span class="astric">*</span></label>
												<input type="text" class="form-control" name="itemname" id="itemname">
											</div>
	        							</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 ">
										<div class="col-md-12">
	        								<div class="form-group">
	        									<label class="control-label">Price<span class="astric">*</span></label>
												<input type="text" class="form-control" name="price" id="price">
											</div>
	        							</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 ">
										<div class="col-md-12">
	        								<div class="form-group">
	        									<label class="control-label">Purchased From<span class="astric">*</span></label>
												<input type="text" class="form-control" name="purchasedfrom" id="purchasedfrom">
											</div>
	        							</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 ">
										<div class="col-md-12">
	        								<div class="form-group">
	        									<label class="control-label">Purchase Date<span class="astric">*</span></label>
												<div class="input-icon">
													<input type="text" class="form-control" name="purchasedate" id="start_date" value="<?php echo date('Y-m-d'); ?>">
												</div>
											</div>
	        							</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 ">
										<div class="col-md-12">
	        								<div class="form-group">
	        									<label class="control-label"> Invoice
												</label>
												<div class="input-icon">
													<input type="file" name="file" id="file">
												</div>
											</div>
	        							</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<button type="submit" id="save-form" class="btn btn-success" name="btnsubmit"> <i class="fa fa-check"></i>Save</button>
										<button type="Reset" name="btnreset" id="btnreset" class="btn btn-inverse"> <i class="fa fa-check"></i> Reset</button>
									</div>
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