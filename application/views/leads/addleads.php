<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-layers"></i> Projects</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        	<ol class="breadcrumb">
                <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                <li><a href="<?php echo base_url().'leads'?>">Leads</a></li>
                <li class="active">Add New</li>
            </ol>
        </div>
    </div>
</nav>

<!-- contetn-wrap -->
<?php
$sessData=array();
if(!empty($this->session->flashdata('sessData'))){
    $sessData = $this->session->flashdata('sessData');
}
?>
<div class="content-in">  
    <div class="row">
        <div class="col-md-12">
            <div class="card br-0">
            	<div class="card-header br-0 card-header-inverse">
            		Add Lead Info
            	</div>
            	<div class="card-wrapper collapse show">
            		<div class="card-body">
            			<form id="creatclient" class="aj-form" name="leadss" method="post" action="<?php echo base_url().'Leads/insertleads'?>">
                            <?php
                                    $mess = $this->session->flashdata('message_name');
                                    if(!empty($mess)){
                                        //warning 
                                    ?>
            				<div class="submit-alerts">
            					<div class="alert alert-success" role="alert" style="display:block;">
								</div>
                            </div>
                            <div class="submit-alerts">
								<div class="alert alert-danger" role="alert" style="display:block;">
								 <?php echo $mess; ?>
								</div>
                            </div>
                            <?php  } ?>
                            <div class="submit-alerts">
								<div class="alert alert-warning" role="alert">
								  This is a warning alert
								</div>
            				</div>
                            
            				<div class="form-body">
            					<h3 class="box-title">Company Details</h3>
            					<hr>
            					<div class="row">
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Company Name<span class="astric">*</span></label>
            								<input id="company_name" class="form-control" type="text" name="company_name" value="<?php if(!empty($sessData['company_name'])){echo $sessData['company_name'];}?>">
            							</div>
            						</div>
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Website<span class="astric">*</span></label>
            								<input id="website" class="form-control" type="text" name="website" value="<?php if(!empty($sessData['website'])){echo $sessData['website'];}else{ }?>">
            							</div>
            						</div>
            					</div>
            					<div class="row">
                            		<div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Address</label>
                                            <textarea name="address" id="address" class="form-control" rows="4"><?php if(!empty($sessData['address'])){echo $sessData['address'];}else{ }?></textarea>
                                        </div>
                                    </div>
                    			</div>
                    			<h3 class="box-title mt-4">Lead Details</h3>
                    			<hr>
            					<div class="row">
								    <div class="col-md-6">
								        <div class="form-group">
								            <label class="control-label">Client Name<span class="astric">*</span></label>
								            <input type="text" name="name" id="name" class="form-control" value="<?php if(!empty($sessData['name'])){echo $sessData['name'];}else{ }?>">
								        </div>
								    </div>
								    <div class="col-md-6">
								        <div class="form-group">
								            <label class="control-label">Client Email<span class="astric">*</span></label>
								            <input type="text" name="email" id="email" class="form-control" value="<?php if(!empty($sessData['email'])){echo $sessData['email'];}else{ }?>">
								            <span class="help-desk">Lead will login using this email.</span>
								        </div>
								    </div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-6">
										<div class="form-group">
											<label class="control-label">Mobile<span class="astric">*</span></label>
											<input type="text" id="mobile" name="mobile" class="form-control allow-no" value="<?php if(!empty($sessData['mobile'])){echo $sessData['mobile'];}else{ }?>">
										</div>
									</div>
                                    <?php
                                    $optst=$optst1="";
                                    if(isset($sessData['follow_up'])){
                                        if(trim($sessData['follow_up'])=='0'){
                                            $optst="selected";
                                        }else if(trim($sessData['follow_up'])=='1'){
                                            $optst1="follow_up";
                                        }
                                    }?>
									<div class="col-lg-4 col-md-6">
										<div class="form-group">
											<label class="control-label">Next Follow Up</label>
											<select id="follow_up" name="follow_up" class="form-control">
												<option value="1" <?= $optst1;?>>Yes</option>
												<option value="0" <?= $optst;?>>No</option>
											</select>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Note</label>
											<textarea id="note" name="note" class="form-control" rows="4"><?php if(!empty($sessData['note'])){echo $sessData['note'];}else{ }?></textarea>
										</div>
									</div>
								</div>
                    			
								<!-- action btn -->
                                <div class="form-actions">
                                    <button type="submit" name="btnsave" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
	                                <a href="<?php echo base_url().'leads'?>" class="btn btn-default">Back</a>
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