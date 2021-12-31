 <nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-people"></i> Clients</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                <li class="active">Clients</li>
            </ol>
        </div>
    </div>
</nav>

<!-- contetn-wrap -->
<div class="content-in">  
    <div class="row">
        <div class="col-md-3">
            <div class="stats-box bg-black">
                <h3 class="box-title text-white">Total Clients</h3>
                <ul class="list-inline two-wrap">
                    <li><i class="icon-user text-white"></i></li>
					<?php 
							$whereArr = array('user_type'=>1,'is_deleted'=>0);
							$userclientData = $this->common_model->getData('tbl_user',$whereArr);
							$total_clients = count($userclientData);
					?>
                    <li class="text-right"><span id="" class="counter text-white"><?php if($total_clients != '') { echo  $total_clients; } else { echo 0; } ?></span></li>
                </ul>
            </div>
        </div>
       
		<div class="col-md-12">
            <div class="stats-box">
            	
				<div class="row">
    				<div class="col-md-6">
    					<div class="form-group">
    						<?php if($this->user_type == 0) {  ?>
                            	<a class="btn btn-outline-success btn-sm"  href="<?php echo base_url().'Clients/addclients' ?>">Add New Client <i class="fa fa-plus" aria-hidden="true"></i></a>
                            <?php } ?>
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
		                    	<h5>Select Date Range</h5>
		                        <div class="input-group input-daterange">
								    <input type="text" class="start-date form-control br-0" id="startdate" name="startdate" data-date-format='yyyy-mm-dd'>
								    <div class="input-group-prepend">
								      <span class="input-group-text bg-info text-white">To</span>
								    </div>
								    <input type="text" class="end-date form-control br-0" id="enddate" name="enddate" data-date-format='yyyy-mm-dd' >
								</div>
		                    </div>
		                    <div class="col-md-2">
		                        <h5>Select Status</h5>
		                        <div class="form-group">
		                        	<select class="select2 form-control" id="status" data-placeholder="Select Status" >
		                        		<option value='all'>All</option>          
							            <option value='1'>Active</option>  
							            <option value='0'>Deactive</option>
		                        	</select>
		                        </div>
		                    </div>
		                    <div class="col-md-2">
		                        <h5>Select Client</h5>
		                        <div class="form-group">
		                        	<select class="select2 form-control" id="clientname">
			                        	<option value="">Select</option>
										<?php
											foreach($clients as $row)
											{
												if(!empty($row->clientname)){
													echo '<option value="'.$row->clientname.'" >'.$row->clientname.'</option>';
												}
											}
										?>
									</select>
		                        </div>
		                    </div>
		                    <div class="col-md-4">
		                        <div class="form-group m-t-10">
		                            <label class="control-label col-12 mb-3">&nbsp;</label>
		                            <button type="button" id="btnApplyClients" class="btn btn-success col-lg-4 co-md-5"><i class="fa fa-check"></i> Apply</button>
		                            <button type="button" id="reset-filters" class="btn btn-inverse col-lg-4 co-md-5 offset-md-1"><i class="fa fa-refresh"></i> Reset</button>
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
                	<table class="table table-bordered" id="clients">
					   	<thead>
					      	<tr role="row">
						         <th>Id</th>
						         <th>Name</th>
						         <th>Company Name</th>
						         <th>Email</th>
						         <th>Status</th>
						         <th>Created At</th>
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
