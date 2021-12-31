<nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="icon-basket"></i> Products</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                            <li><a href="<?php echo base_url().'products'?>">Products</a></li>
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
		                		Add Project 
		                	</div>
		                	<div class="card-wrapper collapse show">
		                		<div class="card-body">
		                			<form  class="aj-form" name="product" id="product" action="<?php echo base_url().'products/insertproducts'?>" method="post">
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
		                					<h3 class="box-title">Project Info</h3>
		                					<hr>
		                					<div class="row">
											    <div class="col-md-6">
											        <div class="form-group">
											            <label class="control-label">Name</label>
											            <input type="text" name="name" id="name" class="form-control">
											        </div>
											    </div>
											    <div class="col-md-6">
											        <div class="form-group">
											            <label class="control-label">Price</label>
											            <input type="text" name="price" id="price" class="form-control">
											            <span class="help-desk">Insert price without currency code.</span>
											        </div>
											    </div>
											    <div class="col-md-6">
											        <div class="form-group">
											            <label class="control-label">Tax 
											            	<a href="javascript:;" id="tax-settings" data-toggle="modal" data-target="#project-tax">
											            	<i class="ti-settings text-info"></i>
											            	</a>
											            	</label>
			                							<select id='project-select' class="custom-select" name="tax">
			                								<option value="">Select Tax</option>
												            <?php foreach($tax as $row) { ?>
												            	<option value="<?php echo $row->rate?>" ><?php echo $row->taxname;?>(<?php echo $row->rate?>%)</option>
												            <?php
												            	}
												            ?>
												        </select> 
											        </div>
											    </div>
											    <div class="col-md-6">
											        <div class="form-group">
											            <label class="control-label">Description</label>
											            <textarea id="" class="form-control" name="description" rows="4"></textarea>
											        </div>
											    </div>
											</div>
											
											<!-- action btn -->
			                                <div class="form-actions">
				                                <input type="submit" id="save-form" class="btn btn-success" value="Save"><i class="fa fa-check"></i> 
				                                <button type="reset" class="btn btn-default">Reset</button>
				                            </div>
		                				</div>
		                			</form>
		                		</div>/
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
					            <table class="table" id="table_tax">
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
					                    foreach ($tax as $row) { 
					                	 ?>      
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
						            <input type="button" id="save-product" class="btn btn-success" name="Save" value="Save"> <i class="fa fa-check"></i> 
						        </div>
							</form>
            			</div>
            		</div>
            	</div>
            </div>