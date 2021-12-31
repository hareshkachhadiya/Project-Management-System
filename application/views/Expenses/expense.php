     <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="ti-file"></i> Expenses</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                            <li class="active">Expenses</li>
                        </ol>
                    </div>
                </div>
            </nav>

            <!-- contetn-wrap -->
            <div class="content-in">  
                <div class="row">
                    <div class="col-md-12">
		                <div class="stats-box">
							<div class="row">
                				<div class="col-md-6">
                					<div class="form-group">
			                            <a class="btn btn-outline-success btn-sm"  href="<?php echo base_url().'Finance/addexpenses' ?>">Add Expense <i class="fa fa-plus" aria-hidden="true"></i></a>
										<a href="javascript:;" id="toggle-filter" class="btn btn-outline-danger btn-sm toggle-filter"><i class="fa fa-sliders"></i> Filter Results</a>
									</div>
                				</div>
							</div>
							<div class="row filter-from" id="ticket-filters" style="display: none;">
	             			 <div class="col-md-12">
	                    		<h4>Filter by <a href="javascript:;" class="pull-right toggle-filter"><i class="fa fa-times-circle-o"></i></a></h4>
	               			 </div>
	                		<form action="" id="filter-form">
							<div class="row">
		                		<div class="col-md-4">
		                			
            							<label class="control-label">Select Date Range</label>
											<input type="text"class="start-date form-control br-0" id="startdate" name="startdate" data-date-format='yyyy-mm-dd'/>
											<div class="input-group-prepend">
											      <span class="input-group-text bg-info text-white">To</span>
											    </div>
											<input type="text" class="end-date form-control br-0" id="enddate" name="enddate" data-date-format='yyyy-mm-dd' />
									
		                		</div>
		                		<div class="col-md-2">
		                			<label class="control-label">Employee</label>
            							<div class="form-group">
            								<select id='employee' name="employee" class="select2 form-control">
								        	 <option value="">select</option>
												<?php
													foreach($employee as $row)
													{
														echo '<option value="'.$row->id.'" >'.$row->employeename.'</option>';
													}
												?>
											</select> 
            							</div>
		                		</div>
								
		                		<div class="col-md-2">
		                			
            							<h5 class="control-label">Status</label>
            							<div class="form-group">
            							<select class="select2 form-control" id='status' data-placeholder="Select Status" name="status" >
								            <option value='all'>All</option>          
								            <option value='0'>Pending</option>  
								            <option value='1'>Approved</option> 
								            <option value='2'>Rejected</option>  
											
								        </select> 
            						</div>
		                		</div>
		                		 <div class="col-md-2">
		                        <div class="form-group m-t-10">
		                            <label class="control-label col-12 mb-3">&nbsp;</label>
		                            <button type="button" id="btnApplyExpanse" class="btn btn-success col-lg-4 co-md-5"><i class="fa fa-check"></i> Apply</button>
		                            <button type="reset" id="reset-filters-expense" class="btn btn-inverse col-lg-4 co-md-5 offset-md-1"><i class="fa fa-refresh"></i> Reset</button>
		                        </div>
		                    </div>
							</div>
		                </form>
		            </div>
							
							
								   <?php
										//warning 
										$mess = $this->session->flashdata('message_name');
										if(!empty($mess)){
									?>
						   <div class="col-md-12">
								<div class="submit-alerts">
									<div class="alert alert-success" role="alert" style="display:block;">
										<?php echo $mess; ?>
									</div>
								</div>
							</div>
                            <?php } ?>
   		                	
		                	<div class="table-responsive">
			                	<table class="table table-bordered" id="expenses">
								   	<thead>
								      	<tr role="row">
									         <th>Id</th>
									         <th>Item Name</th>
									         <th>Price</th>
									         <th>Purchased From</th>
											 <th>Employees</th>
											 <th>Purchase Date</th>
											 <th>Status</th>
											 <th>Action</th>
								      	</tr>
								   	</thead>
								 </table>
							</div>
		                </div>
		            </div>
                </div>
            </div>
            <!-- ends of contentwrap -->
