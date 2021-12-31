<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="icon-speedometer"></i> Projects</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
                 <li class="active">Projects</li>
			</ol>
		</div>
	</div>
</nav>
<div class="content-in">  
	<div class="row">
		<div class="col-md-3">
			<div class="stats-box bg-black pt-1 pb-1">
				<h3 class="box-title text-white">TOTAL ARCHIVED PROJECTS</h3>
				<ul class="list-inline two-wrap">
					<li><i class="icon-layers text-white"></i></li>
					 <?php 
                        $whereArr =  array('archive' => 1);
                        $archiveArr = $this->common_model->getData('tbl_project_info',$whereArr);
                        $total_archive = count($archiveArr);
					 ?>
              
					<li class="text-right"><span id="" class="counter text-white"><?php echo  $total_archive; ?></span></li>
				</ul>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="stats-box">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<a href="<?php echo base_url().'project/index'?>" class="btn btn-outline-success btn-sm">All Project <i class="fa fa-search" aria-hidden="true"></i></a>	
						</div>
					</div>
				</div>
				<div class="row">
					<!--<div class="col-lg-3 col-md-4">
						<div class="form-group">
							<label class="control-label">Projects Status</label>
							<select id='project_status' class="custom-select">
								<option value='0'>All</option>          
								<option value='1'>Complete</option>  
								<option value='2'>Incomplete</option>   
							</select> 
						</div>
					</div>-->
					<div class="col-md-4">
						<div class="form-group">
						<label class="control-label">Project Status</label>
							<select name="status" id="project_status" class="custom-select" name="status">
								<option value='all'>All</option> 
								<option value='0'>Incomplete </option>
								<option value='1'>Complete </option>
								<option value='2'>In Progress </option>
								<option value='3'>On Hold  </option>
								<option value='4'>Canceled </option>
						   </select>
					   </div>
                    </div>
					<div class="col-lg-3 col-md-4">
						<div class="form-group">
							<label class="control-label">Client Name</label>
							<select id="clientname" class="custom-select" name="clientname">
								<option value="">--Select--</option>
									<?php
											foreach($client as $row)
											{
												echo '<option value="'.$row->id.'" >'.$row->clientname.'</option>';
											}
									?>
							</select>		
						</div>
					</div>
				</div>
				<div class="table-responsive">
                    <table class="table table-bordered table-hover toggle-circle default footable-loaded footable" id="archievdata" name="archievdata">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Project Name</th>
                            <th>Project Members</th>
                            <th>Deadline</th>
                            <th>Client</th>
                            <th>Completion</th>
                            <th>Action</th>
                        </tr>
                        </thead>
						<tbody></tbody>
                    </table>
                </div>
			</div>
		</div>
	</div>
</div>
            <!-- ends of contentwrap -->









