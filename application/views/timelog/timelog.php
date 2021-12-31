<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="ti-ticket"></i> Timelog</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'ticket' ?>">Home</a></li>
				 <li class="active">Timelog</li>
			</ol>
		</div>
	</div>
</nav>
<input type="hidden" id="timeloguserid" value="<?php echo $this->user_type;?>">

<!-- contetn-wrap -->

<?php if($this->user_type == 0){
?>
<div class="content-in">
	<div class="row">
		<div class="col-sm-12">
			<div class="form-group custom-action">
				<a href="<?php echo base_url().'timelog/addtimelog'?>" class="btn btn-outline-success btn-sm">Add TimeLog <i class="fa fa-plus" aria-hidden="true"></i></a>
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
			<div class="form-group">
				<label class="control-label">SELECT DATE RANGE</label>
			    <div class="input-group input-daterange">
				    <input type="text" class="start-date form-control br-0" id="start_date" name="start_date"  data-date-format='yyyy-mm-dd' value="">
				    <div class="input-group-prepend">
				      <span class="input-group-text bg-info text-white">To</span>
				    </div>
				    <input type="text" class="end-date form-control br-0" id="deadline" name="deadline" value="" data-date-format='yyyy-mm-dd'>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Select Project</label>
				<select id="projectData" class="custom-select" name="projectData">
					<option value="">--Select--</option>
					<?php 
						foreach($projectinfo as $project){
					?>
					<option value="<?php echo $project->id; ?>"><?php echo $project->projectname; ?></option>
						<?php	
				
						}
					?>
				</select> 
			    
			</div>
		</div>
		<?php if($this->user_type == 0) { ?>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label">Select Employee</label>
				<select id="employeeData" class="custom-select" name="employeeData">
					<option value="">--Select--</option>
					<?php
						foreach($empinfo as $emp){
					?>
						<option value="<?php echo $emp->id ;?>"><?php echo $emp->employeename;?></option>
					<?php 

						} 
					?>		
				</select> 
			</div>
		</div>
	<?php }	 ?>
	</div>
	<div class="row">
		<div class="col-md-4">
            <div class="form-group m-t-10">
                <label class="control-label col-12 mb-3">&nbsp;</label>
                <button type="button" id="btnApplyLogs" class="btn btn-success col-lg-4 co-md-5"><i class="fa fa-check"></i> Apply</button>
                 <button type="button" id="reset-filters-timelog" class="btn btn-inverse col-lg-4 co-md-5 offset-md-1"><i class="fa fa-refresh"></i> Reset</button>
            </div>
        </div>
    </div>
	                </form>
	            </div>
</div>

<?php
}else {

}
?>
<div class="row">
	<div class="col-md-12">
		<div class="stats-box"> 
			<?php
				$mess = $this->session->flashdata('message_name');

				if(!empty($mess)){
					//warning 
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
				<table class="table table-bordered table-hover" id="timelog">
					<thead>
						<tr role="row">
							 <th>Id</th>
							 <th>Project</th>
						<?php if($this->user_type == 0){ ?>
							<th>Employee Name</th>
						<?php } ?>
							 <th>Start Date</th> 
							 <th>End Date</th> 
							 <th>Total Hours</th>
							 <th>Earnings</th>
							 <?php 
								    if($this->user_type == 0){ ?>
								    	<th>Action</th>
								<?php }else { } ?>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</div>
			
<!-- ends of contentwrap -->


<div class="modal fade project-category" id="timelog-popup" tabindex="-1" role="dialog" aria-labelledby="project-category" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content br-0">
			<div class="modal-body">
				<div class="table-responsive" id="timelogpreview">
					<div class="form-body">
						<h3 class="box-title">Timelog Info</h3><hr>
					</div>
					<div class="modal-body">
						<div class="table-responsive" id="timelog_edit">

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

