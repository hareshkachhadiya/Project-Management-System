<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="ti-layout-media-overlay"></i> Notice Board</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                <li><a href="<?php echo base_url().'Clients'?>">NoticeBoard</a></li>
                <li class="active">Add New</li>
            </ol>
        </div>
    </div>
</nav>

<!-- contetn-wrap -->
<div class="content-in">  
    <div class="row">
        <div class="col-md-12">
            <div class="card br-0">
            	<div class="card-header br-0 card-header-inverse">
            		 Notice  Board
            	</div>
            	<div class="card-wrapper collapse show">
            		<div class="card-body">
            			
            				<form id="creatclient" class="aj-form" method="post" action="<?php echo base_url().'NoticeBoard/insertNotice'?>" name="notice" >
            				<?php
									$mess = $this->session->flashdata('message_name');
									if(!empty($mess)){
										//warning 
								?>
				
							<div class="submit-alerts">
            					<div class="alert alert-success" role="alert" style="display:block;">
								
								  This is a success alert
								</div>
							</div>
							<div class="submit-alerts">
								<div class="alert alert-danger" role="alert" style="display:block;">
									<?php echo $mess; ?>
								</div>
							</div>
									<?php } ?>
						
							<div class="submit-alerts">
								<div class="alert alert-warning" role="alert">
								  This is a warning alert
								</div>
            				</div>
            				<div class="form-body">
            					<h3 class="box-title">Add New Notice</h3>
            					<hr>
            					<div class="row">
            						<div class="col-md-12">
            							<div class="form-group">
            								<label class="control-label">Notice Heading <span class="astric">*</span></label>
            								<input id="heading" class="form-control" type="text" name="heading">
            							</div>
            						</div>
            					</div>
                                <hr>
            					<div class="row">
            						<div class="col-md-12">
            							<input type="radio" name="noticeto" value="1">To Clients
                                        <input type="radio" name="noticeto" value="2">To Employees
            						</div>
            					</div>
                                <hr>
                                  <div class="col-md-12">
                                <h5>Department</h5>
                                <div class="form-group">
                                    <select class="select2 form-control" id="department" name="department">
                                        <option value="">All</option>
                                        <?php
                                            foreach($department as $row)
                                            {
                                                if(!empty($row->name)){
                                                    echo '<option value="'.$row->id.'" >'.$row->name.'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Notice Description</label>
                                        <div class="form-group">
                                            <textarea name="desc" id="desc" class="form-control" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions">
	                                <!-- <input type="submit" id="save-form" class="btn btn-success" name="btnsubmit" value="Save" > <i class="fa fa-check"></i> -->
	                                <button type="submit" name="btnsubmit" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
									<button type="Reset" name="btnreset" id="btnreset" class="btn btn-inverse"> <i class="fa fa-check"></i> Reset</button>
	                            </div>
            				</div>
            			</form>
            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>
<!-- ends of contentwrap -->
