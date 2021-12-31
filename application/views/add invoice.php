<nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="ti-receipt"></i>Invoices</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                            <li><a href="<?php echo base_url().'Finance'?>">Invoices</a></li>
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
								ADD INVOICE
		                	</div>
		                	<div class="card-wrapper collapse show">
		                		<div class="card-body">
		                			<form class="aj-form" method="post" action="<?php echo base_url().'Finance/createinvoice' ?>" name="createinvoice" >
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
		                						<div class="col-md-4">
													<div class="form-group">
													<?php 
														$invoice1=$invoice[0]->invoice;
														$test=explode('#',$invoice1);
														$a=$test[1]+1;
														$inv='INV#'.$a;
													?>
														<label class="control-label">Invoice #</label>
														<div class="row">
															<div class="col-md-12">
																<div class="input-icon">
																	<input type="text" readonly="" class="form-control" name="invoice_number" id="invoice_number" value="<?php echo $inv ?>">
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">Project</label>
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
												<div class="col-md-4">
		                							<div class="form-group">
		                								<label class="control-label">Currency</label>
														<select name="currency" id="currency" class="form-control">
															<option value="">select</option>
															<option value="1" <?php if($estimate[0]->currency=='1'){ echo 'selected'; } ?>>$(USD)</option>
															<option value="2" <?php if($estimate[0]->currency=='2'){ echo 'selected'; } ?>>R(IND)</option>

														</select>
													</div>
		                						</div>
		                					</div>
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">Invoice Date</label>
														<div class="row">
														<div class="col-md-12">
															<div class="input-icon">
																<input type="text" class="form-control" name="invoice_date" id="start_date" value="<?php echo date('Y-m-d'); ?>">
															</div>
														</div>
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">Due Date</label>
														<div class="input-icon">
															<input type="text" class="form-control" name="due_date" id="deadline" value="<?php echo !empty($estimate[0]->validtill) ? $estimate[0]->validtill : ''?>">
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label class="control-label">Status</label>
														<select class="form-control" name="status" id="status">
															<option value="">select</option>
															<option value="1">Paid</option>
															<option value="0">Unpaid</option>                                           
														</select>
													</div>
												</div>
		                					</div>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Is it a recurring payments? </label>
														<div class="row">
															<div class="col-md-12">
																<select class="form-control" name="recurring_payment" id="recurring_payment" >
																	<option value="0">No</option>
																	<option value="1">Yes</option>
																</select>
															</div>
														</div>
													</div>
												</div>
							
												<div class="col-md-3 recurringPayment showdiv" style="display:none">
													<div class="form-group">
														<label class="control-label">Billing Frequency</label>
														<div class="row">
															<div class="col-md-12">
																<select class="form-control" name="billing_frequency" id="billing_frequency">
																	<option value="0">Day</option>
																	<option value="1">Week</option>
																	<option value="2">Month</option>
																	<option value="3">Year(s)</option>
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-3 recurringPayment showdiv"  style="display:none">
													<div class="form-group">
														<label class="control-label">Billing Interval</label>
														<div class="input-icon">
															<input type="text" class="form-control" name="billing_interval" id="billing_interval" value="">
														</div>
													</div>
												</div>
												<div class="col-md-3 recurringPayment showdiv"  style="display:none">
													<div class="form-group">
														<label class="control-label">Billing Cycle</label>
														<div class="input-icon">
															<input type="text" class="form-control" name="billing_cycle" id="billing_cycle" value="">
														</div>
													</div>
												</div>
											
											</div>
											<hr>
											<button aria-expanded="false" data-toggle="dropdown" class="btn btn-info dropdown-toggle waves-effect waves-light" type="button">Products <span class="caret"></span></button>
											<div id="dynamic">
											<?php
												$j=0;
												for($i=0;$i<count($product);$i++)
												{	
													$j++;
											?>
											<div class="row" >
												<div class="form-group">
                                                    <label class="control-label hidden-md hidden-lg">Item</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></div>
                                                        <input type="text" class="form-control item_name" name="item_name[]" value="<?php echo !empty($product[$i]->item) ? $product[$i]->item : '' ?>">
                                                    </div>
                                                </div>
												<div class="col-md-1">
													<div class="form-group">
														<label class="control-label hidden-md hidden-lg">Qty/Hrs</label>
														<input type="number" min="1" class="form-control quantity" name="quantity[]" id="quantity<?php echo $j; ?>" value="<?php echo !empty($product[$i]->qtyhrs) ? $product[$i]->qtyhrs : '' ?>">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label hidden-md hidden-lg">Unit Price</label>
														<input type="text" class="form-control cost_per_item" name="cost_per_item[]" id="cost_per_item<?php echo $j; ?>" value="<?php echo !empty($product[$i]->unitprice) ? $product[$i]->unitprice : '' ?>"  onblur="countamount(1);">
													</div>
												</div>
												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label hidden-md hidden-lg">Tax
														<a href="javascript:;" id="tax-settings" data-toggle="modal" data-target="#project-tax">
											            	<i class="ti-settings text-info"></i>
											            	</a>
											            	
														</label>
														<select name="tax[]" class="form-control type" id="taxes<?php echo $j; ?>" onchange="counttax(1);">
															<option value="">Select Tax</option>
															<?php
																foreach($tax as $row1)
																{
																	$str="";
																	if($row1->rate==$product[$i]->tax)
																	{
																		$str="selected";
																	}
																	echo '<option value="'.$row1->rate.'"'.$str.'>'.$row1->taxname."(".$row1->rate."%)".'</option>';
																}
															?>
														</select>
													</div>	
												</div>
												<div class="col-md-2 border-dark  text-center">
													<label class="control-label hidden-md hidden-lg">Amount</label>
												<input type="text" name="amount[]" id="amount<?php echo $j; ?>"  value="<?php echo !empty($product[$i]->amount) ? $product[$i]->amount : '' ?>">

													<!--<p class="form-control-static" id="amountdisplay"><span class="amount-html">0.00</span></p>
													<input type="hidden" class="amount" name="amount[]" id="amount1">-->
												</div>
											</div>
											<div class="row">
												<div class="form-group">
													<textarea name="item_Description[]" class="form-control" placeholder="Description" rows="2"><?php echo !empty($product[$i]->description) ? $product[$i]->description : '' ?></textarea>
												</div>
											</div>
										<?php } ?>

										</div>
											<input type="hidden" id="counter" value="<?php echo count($product); ?>">

											<div class="row">
												<div class="col-xs-12 m-t-5">
													<button type="button" class="btn btn-info" id="item-repeat"><i class="fa fa-plus"></i> Add Item</button>
												</div>
											</div>
												<div class="row m-t-5 font-bold">
														<div class="col-md-offset-9 col-md-1 col-xs-6 text-right p-t-10">Total</div>
															<p class="form-control-static col-xs-6 col-md-2"  name="total" id="total">
															<?php echo !empty($estimate[0]->total) ? $estimate[0]->total : '' ?>
															</p>
															<input type="hidden" class="total-field" name="finaltotal" id="finaltotal">
												</div>
																							<div class="row">
											<div class="col-sm-12">
													<div class="form-group">
														<label class="control-label">Note</label>
														<textarea name="note" class="form-control" rows="5"><?php echo !empty($estimate[0]->note) ? $estimate[0]->note : '' ?></textarea>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-12">
													<input type="submit" id="save-form" class="btn btn-success" name="btnsubmit" value="Save" > <i class="fa fa-check"></i>
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

			<!-- Modal -->
			
			<div class="modal fade project-tax" id="project-tax" tabindex="-1" role="dialog" aria-labelledby="project-tax" aria-hidden="true">
            	<div class="modal-dialog modal-lg" role="document">
            		<div class="modal-content br-0">
            			<div class="modal-header">
            				<h4 class="modal-title">Tax</h4>
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
					                    <th>Tax Name</th>
					                    <th>Rate %</th>
					                </tr>
					                </thead>
					                <tbody>
					                    <?php 
										$i = 1;
										foreach ($tax as $row) { ?>      
										      <tr>
										      	  <td><?php echo $i; ?></td>
										          <td><?php echo $row->taxname; ?></td>
										          <td><?php echo $row->rate; ?></td>
										      </tr>
										   <?php
											$i++;
										   } ?>
									</tbody>
					            </table>
					        </div>
					        <hr>
					        <form id="tax" class="" name="tax" method="post" >
						        <div class="form-body">
						            <div class="row">
						                <div class="col-md-6 ">
						                    <div class="form-group">
						                        <label>Tax Name</label>
						                        <input type="text" name="tax_name" id="tax_name" class="form-control">
						                    </div>
						                </div>
						                <div class="col-md-6 ">
						                    <div class="form-group">
						                        <label>Rate %</label>
						                        <input type="text" name="rate" id="rate" class="form-control">
						                    </div>
						                </div>
						            </div>
						        </div>
						        
						        <div class="form-actions">
						            <input type="submit" id="save-category" class="btn btn-success" name="btnsubmit" value="Save"> <i class="fa fa-check"></i> 
						        </div>
							</form>
            			</div>
            		</div>
            	</div>
            </div>s