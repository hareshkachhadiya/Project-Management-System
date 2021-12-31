<div class="modal fade project-category" id="project-category1" tabindex="-1" role="dialog" aria-labelledby="project-category" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content br-0">
			<div class="modal-header">
				<h4 class="modal-title"> Project Category</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true" id="close">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
						<tr>
							<th>#</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
						</thead>
						 <tbody>
								<?php $i= 1;
								foreach ($category as $row) { 
									 ?>      
									  <tr id="cate_<?php echo $row->id;?>">
										  <td><?php echo $i; ?></td>
										  <td><?php echo $row->name; ?></td>
										  <td><a href="javascript:void(0);" data-cat-id="1" class="btn btn-sm btn-danger btn-rounded delete-category" onclick="deletecat('<?php echo $row->id; ?>')" id='deletecat'>Remove</a></td>
									  </tr>
							   <?php $i++; }  ?>
						</tbody>
					</table>
				</div>
				<hr>
				<form id="category" class="" id="category" name="category" method="post">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12 ">
								<div class="form-group">
									<label>Category Name</label>
									<input type="text" name="category_name" id="category_name" class="form-control">
									<p id="errormsg" class="text-danger"></p>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions">
						<input type="button" id="save-category" class="btn btn-success" value="Save"> <i class="fa fa-check"></i>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
