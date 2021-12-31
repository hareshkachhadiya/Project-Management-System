<nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="ti-receipt"></i>Expenses</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                            <li><a href="<?php echo base_url().'Finance'?>">Expenses</a></li>
                            <li class="active">Update</li>
                        </ol>
                    </div>
                </div>
            </nav>

            <!-- contetn-wrap -->
            <div class="content-in">  
                <div class="row">
                    <div class="col-md-12">
		                <div class="card br-0">
		                	
								UPDATE EXPENSE				
		                	<div class="card-wrapper collapse show">
		                		<div class="card-body">
		                			<form class="aj-form" method="post" name="expense" enctype="multipart/form-data">
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
																		$str='';
																		if($row->id==$expense[0]->employee)
																		{
																			$str="selected";
																		
																		}
																		echo '<option value="'.$row->id.'"'.$str.'>'.$row->employeename.'</option>';
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
																		$str='';
																		if($row->id==$expense[0]->project)
																		{
																			$str="selected";
																		
																		}
																		echo '<option value="'.$row->id.'"'.$str.'>'.$row->projectname.'</option>';
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
															<option value="1" <?php if($expense[0]->currency=='1'){ echo 'selected'; } ?>>$(USD)</option>
															<option value="2" <?php if($expense[0]->currency=='2'){ echo 'selected'; } ?>>R(IND)</option>
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
															<input type="text" class="form-control" name="itemname" id="itemname" value="<?php echo !empty($expense[0]->item) ? $expense[0]->item : '' ?>">
														</div>
		                							</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 ">
													<div class="col-md-12">
		                								<div class="form-group">
		                									<label class="control-label">Price<span class="astric">*</span></label>
															<input type="text" class="form-control" name="price" id="price" value="<?php echo !empty($expense[0]->price) ? $expense[0]->price : '' ?>">
														</div>
		                							</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 ">
													<div class="col-md-12">
		                								<div class="form-group">
		                									<label class="control-label">Purchased From<span class="astric">*</span></label>
															<input type="text" class="form-control" name="purchasedfrom" id="purchasedfrom" value="<?php echo !empty($expense[0]->purchasedform) ? $expense[0]->purchasedform : '' ?>">
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
																<input type="text" class="form-control" name="purchasedate" id="startdate" value="<?php echo !empty($expense[0]->purchasedate) ? $expense[0]->purchasedate : '' ?>" data-date-format='yyyy-mm-dd'>
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
																<input type="file" name="file" id="file"  >
																<input type="hidden" name="image_name" value="<?php echo !empty($expense[0]->invoicefile) ? $expense[0]->invoicefile : '' ?>" >
														
															</div>
														</div>
		                							</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 ">
													<div class="col-md-12">
		                								<div class="form-group">
		                									<label class="control-label">Status</label>
															<select name="status" id="status" class="form-control">
															<option value="">--</option>
															<option value="0" <?php if($expense[0]->status=='0'){ echo 'selected'; } ?>>Pending</option>
															<option value="1" <?php if($expense[0]->status=='1'){ echo 'selected'; } ?>>Approved</option>
															<option value="2" <?php if($expense[0]->status=='2'){ echo 'selected'; } ?>>Rejected</option>
															</select>
														</div>
		                							</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<button type="submit" id="save-form" class="btn btn-success" name="btnupdate"> <i class="fa fa-check"></i>Update</button>
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
            <!-- ends of contentwrap -->