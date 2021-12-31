<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="icon-speedometer"></i>Time Log Report</h4>
		</div>
		 <div class="col-lg-9 col-sm -8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
				 <li class="active">Time Log Report</li>
			</ol>
		</div>
	</div> 
</nav>

<div class="content-in">
	
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">SELECT DATE RANGE</label>
		    		<div class="input-group input-daterange">
				  	    <input type="text" class="start-date form-control br-0" id="start_date" name="start_date" value="<?php echo $sdate;?>" data-date-format='yyyy-mm-dd'>
				   		<div class="input-group-prepend">
				        	<span class="input-group-text bg-info text-white">To</span>
			    		</div>
			  		    <input type="text" class="end-date form-control br-0" id="deadline" name="deadline" value="<?php echo $edate;?>" data-date-format='yyyy-mm-dd'>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label class="control-label">Select Project</label>
					<select id="projectData" class="custom-select" name="projectData">
						<option value="">--Select--</option>
							<?php foreach($allProjectData as $project){ ?>
								<option value="<?php echo $project->id; ?>"><?php echo $project->projectname; ?></option>
							<?php } ?>
					</select> 
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
	            <div class="form-group m-t-10">
	                <label class="control-label col-12 mb-3">&nbsp;</label>
	                <button type="submit" id="btnApplyTimeReport" class="btn btn-success col-lg-4 co-md-5"><i class="fa fa-check"></i> Apply</button>
	            </div>
	        </div>
	    </div>
	
	<div id="timelog_container" style="height: 400px"></div>
	<div class="table-responsive">
		<table class="table table-bordered table-hover" id="timelogreport_table">
			<thead>
				<tr role="row">
				 <th>Id</th>
				 <th>Project</th>
				 <th>Employees</th> 
				 <th>Start Time</th>
				 <th>End Time</th>
				 <th>Total Hours</th>
				 <th>Earnings</th>
					<!--  <th>Remark</th> -->
				</tr>
			</thead>
		</table>
	</div>
	
</div>



