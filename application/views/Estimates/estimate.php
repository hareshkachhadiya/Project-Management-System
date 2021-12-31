<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="ti-file"></i> Estimates</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                <li class="active">Estimates</li>
            </ol>
        </div>
    </div>
</nav>
<input type="hidden" id="estimateuserid" value="<?php echo $this->user_type;?>">
<!-- contetn-wrap -->
<div class="content-in">  
	<div class="row">
	    <div class="col-md-12">
	        <div class="stats-box">
	        		<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<?php
			        	if($this->user_type == 0){
			        	?>
	                        <a class="btn btn-outline-success btn-sm"  href="<?php echo base_url().'Finance/addestimates' ?>">Create Estimate <i class="fa fa-plus" aria-hidden="true"></i></a>
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
	        					<label class="control-label">Select Date Range</label>
								<div class="input-group input-daterange">
									<input type="text" class="start-date form-control br-0" id="startdate" name="startdate" data-date-format='yyyy-mm-dd'/>
									<!-- <input type="hidden" name="sdate" value="<?php echo $startdate; ?>" id="sdate"> -->
									<div class="input-group-prepend">
								      <span class="input-group-text bg-info text-white">To</span>
								    </div>
									<input type="text" class="end-date form-control br-0" id="enddate" name="enddate" data-date-format='yyyy-mm-dd'/>

								</div>
							</div>
			        		<div class="col-md-2">
			        			<label class="control-label">Status</label>
									<div class="form-group">
									<select id='status' class="select2 form-control" data-placeholder="Select Status">
							            <option value='all'>All</option>       
							            <option value='0'>Waiting</option>  
							            <option value='1'>Accepted</option> 
							            <option value='2'>Declined</option>   
									</select> 
								</div>
			        		</div>
	        		 		<div class="col-md-4">
	                			<div class="form-group m-t-10">
	                    			<label class="control-label col-12 mb-3">&nbsp;</label>
	                    			<button type="button" id="btnApplyEstimates" class="btn btn-success col-lg-4 co-md-5"><i class="fa fa-check"></i> Apply</button>
	                    			<button type="reset" id="reset-filters-estimates" class="btn btn-inverse col-lg-4 co-md-5 offset-md-1"><i class="fa fa-refresh"></i> Reset</button>
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
	            	<table class="table table-bordered" id="estimate">
					   	<thead>
					      	<tr role="row">
						         <th>Id</th>
						         <?php if($this->user_type == 0) { ?>
						         <th>Client</th>
						     <?php } ?>
						         <th>Project</th>
						         <th>Total</th>
						         <th>Created At</th>
								 <th>Valid Till</th>
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
