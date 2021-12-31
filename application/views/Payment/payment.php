<nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="ti-receipt"></i>Payment</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                            <li><a href="<?php echo base_url().'Payment'?>">Payment</a></li>
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
								ADD PAYMENT
		                	</div>
		                	<div class="card-wrapper collapse show">
		                		<div class="card-body">
		                			<form class="aj-form" method="post" name="payment" id="payment">
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
												<div class="col-md-6">
													<div class="form-group">
													<label class="control-label">Select Project<span class="astric">*</span></label>
													<?php if($invoiceData[0]->project == ''){ ?>
			                                            <select name="project" id="project" class="form-control">
															<option value="">select</option>
																<?php
																	
																	foreach($allProjectData as $row)
																	{
																		
																		echo '<option value="'.$row->id.'">'.$row->projectname.'</option>';
																	}
																?>
														</select>
													<?php }else{ 
														$whereArr = array('id'=>$invoiceData[0]->project);
														$project = $this->common_model->getData('tbl_project_info',$whereArr);
														?>
														<input type="text" name="project" id="project" class="form-control"  value="<?php echo  !empty($invoiceData[0]->project) ? $project[0]->projectname : '' ?>" readonly>
													<?php } ?>
													</div>
												</div>
												
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Paid On<span class="astric">*</span></label>
			                                            <input type="text" name="paidon" id="paidon" class="form-control" data-date-format='yyyy-mm-dd' value="<?php echo date('Y-m-d'); ?>" readonly>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
		                							<div class="form-group">
		                								<label class="control-label">Currency<span class="astric">*</span></label>
		                								<?php if($invoiceData[0]->currency == ''){ ?>
														<select name="currency" id="currency" class="form-control">
															<option value="">select</option>
															<option value="1" <?php if($invoiceData[0]->currency=='1'){ echo 'selected'; } ?>>$(USD)</option>
															<option value="2" <?php if($invoiceData[0]->currency=='2'){ echo 'selected'; } ?>>R(IND)</option>

														</select>
													<?php }else{ 
														$currency = '';
														if($invoiceData[0]->currency == 1){
																	$currency='$(USD)';
															}
														elseif($invoiceData[0]->currency == 2){
																$currency='R(IND)';
														}
														?>
														<input type="text" name="currency" id="currency" class="form-control"  value="<?php echo  !empty($invoiceData[0]->currency) ? $currency : '' ?>" readonly>

													<?php } ?>
													</div>
		                						</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label">Amount<span class="astric">*</span></label>
														<div class="row">
														<div class="col-md-12">
															<?php $total = (float)trim($invoiceData[0]->total); ?>
															<div class="input-icon">
																<input type="text" class="form-control" name="amount" id="amount" value="<?php echo  !empty($invoiceData[0]->total) ? $total : '' ?>" readonly >
															</div>
														</div>
														</div>
													</div>
												</div>
		                					</div>
											<div class= "row">
												<div class="col-sm-12">
													<div class="form-group">
														<label class="control-label">Remark</label>
													<textarea name="remark" class="form-control" id="remark" rows="5"></textarea>
													</div>
												</div>
											</div>
											<input type="hidden" name="userid" id="userid" value="<?php echo $this->user_id; ?>">
											<input type="hidden" name="invoiceid" id="invoiceid" value="<?php echo $invoiceid; ?>">
											<div class="row">
												<div class="col-md-12">
													<input type="submit" id="pay" class="btn btn-success" name="btnsubmit" value="Pay" > <i class="fa fa-check"></i>
												</div>
											</div>
													
		                				</div>
		                			</form>
		                		</div>
		                	</div>
		                </div>
		            </div>
                </div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>



            <!-- ends of contentwrap -->

		