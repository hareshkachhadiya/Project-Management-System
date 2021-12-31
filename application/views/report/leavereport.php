<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="icon-logout"></i> Leaves Report</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
				 <li class="active">Leaves Report</li>
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
				    <input type="text" class="start-date form-control br-0" id="startdate" name="startdate" value="<?php echo $startdate;?>" data-date-format='yyyy-mm-dd'>
				    <div class="input-group-prepend">
				      <span class="input-group-text bg-info text-white">To</span>
				    </div>
				    <input type="text" class="end-date form-control br-0" id="enddate" name="enddate" data-date-format='yyyy-mm-dd' value="<?php echo $enddate;?>">
				</div>
			</div>
		</div>

		<?php if($this->user_type == 0) { ?>
			<div class="col-lg-3 col-md-4">
				<div class="form-group">
					<label class="control-label">EMPLOYEE NAME</label>
				    <select id="empname" class="custom-select" name="empname">
						<option value="">--Select--</option>
							<?php
								foreach($employee as $row){
									echo '<option value="'.$row->id.'" >'.$row->employeename.'</option>';
							} ?>
					</select>
				</div>
			</div>
		<?php } ?>
		<div class="col-md-4">
		    <div class="form-group m-t-10">
		        <label class="control-label col-12 mb-3">&nbsp;</label>
		            <button type="button" id="btnApplyLeavesReport" class="btn btn-success col-lg-4 co-md-5"><i class="fa fa-check"></i> Apply</button>
		     </div>
		</div>
	</div>
	<div class="row">
		<div class="table-responsive">
			<table class="table table-bordered table-hover" id="leavesreport">
				<thead>
					<tr role="row">
						 <th>Id</th>
						 <th>Employee</th>
						 <th>Approved Leave</th>
						 <th>Pending Leave</th> 
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<!-- //common model leave -->
<div class="modal fade project-category" id="commonleave" tabindex="-1" role="dialog"  aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content br-0">
			<div class="modal-header">
				<h4 class="modal-title"> Approved Leaves Details</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<div class="row">
						<div id="counter"></div>
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Leave Type</th>
									<th>Date</th>
									<th>Reason For Absence</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div><hr>
				</div>
			</div>
		</div>
	</div>
</div>
