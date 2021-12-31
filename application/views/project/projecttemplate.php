<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="icon-layers"></i>  Project Template</h4>
		</div>
		<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
				<li class="active">Project Template</li>
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
							<a href="<?php echo base_url().'project/addtemplate';?>" class="btn btn-outline-success btn-sm">Add New Template <i class="fa fa-plus" aria-hidden="true"></i></a>
						</div>
					</div>
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
					<table class="table table-bordered" id="template" name="template">
						<thead>
							<tr role="row">
								<th>Id</th>
								<th>Template Name</th>
							   	<th>Template Members</th>
								<th>Category</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>