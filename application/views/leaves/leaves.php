<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="icon-logout"></i> Leaves</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
				 <li class="active">Leaves</li>
			</ol>
		</div>
	</div>
</nav>

<!-- contetn-wrap -->
<div class="content-in">  
	<div class="row">
		<?php if($this->user_type == 0){?>
		<div class="col-md-2">
			<div class="stats-box bg-black"> 
				<h3 class="box-title text-white">Pending Leaves</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-user text-white"></i></li>
					 <?php 
					 	$where = array('status' => 0);
						$Total = $this->common_model->getData('tbl_leaves',$where);
						$total_leaves = count($Total);
					 ?>
					<li class="text-right"><span id="" class="counter text-white"><?php echo $total_leaves;?></span></li>
				</ul>
			</div>
		</div>
		<?php 
		}
		?>
	
		<div class="col-md-12">
			<div class="stats-box">
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group custom-action">
							<a href="<?php echo base_url().'Leaves/addleaves';?>"  class="btn btn-outline-success btn-sm"><i class="ti-plus" aria-hidden="true"></i>Apply For Leave </a>
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
								    <input type="text" class="start-date form-control br-0" id="startdate" name="startdate" value="" data-date-format='yyyy-mm-dd'>
								    <div class="input-group-prepend">
								      <span class="input-group-text bg-info text-white">To</span>
								    </div>
								    <input type="text" class="end-date form-control br-0" id="enddate" name="enddate" data-date-format='yyyy-mm-dd' value="">
						</div>
				   </div>
				</div>
				<?php if($this->user_type == 0) { ?>
				<div class="col-lg-3 col-md-4">
					<div class="form-group">
						<label class="control-label">EMPLOYEE NAME
						</label>
						<select id="empname" class="custom-select" name="empname">
							<option value="">--Select--</option>
								<?php
									foreach($employee as $row)
									{
										echo '<option value="'.$row->id.'" >'.$row->employeename.'</option>';
									}
								?>
					     </select>
					</div>
				</div>
			    <?php } ?>
			    <div class="col-md-4">
		                        <div class="form-group m-t-10">
		                            <label class="control-label col-12 mb-3">&nbsp;</label>
		                            <button type="button" id="btnApplyLeaves" class="btn btn-success col-lg-4 co-md-5"><i class="fa fa-check"></i> Apply</button>
		                            <button type="button" id="reset-filters-leaves" class="btn btn-inverse col-lg-4 co-md-5 offset-md-1"><i class="fa fa-refresh"></i> Reset</button>
		                        </div>
		        </div>
			</div>
	                </form>
	            </div>
			
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
					<table class="table table-bordered table-hover" id="leaves">
						<thead>
							<tr role="row">
								 <th>Id</th>
								 <th>Employee</th>
								 <th>Leave Date</th>
								 <th>Leave Status</th>
								 <th>Leave Type</th>
								<!-- <th>Completion</th>-->
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
<?php 
	$this->load->view('common/projectcategory');
?>

<!--model for leaves data-->


<div class="modal fade project-category" id="leaves-popup" tabindex="-1" role="dialog" aria-labelledby="project-category" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content br-0">
			<div class="modal-header">
				<h4 class="modal-title">  Leaves Details</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive" id="leave-preview">

				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade edit" id="editleaves" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content br-0">
			<div class="modal-header">
				<h4 class="modal-title"> Edit Leaves</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive" id="leave_edit">

				</div>
			</div>
		</div>
	</div>
</div> 