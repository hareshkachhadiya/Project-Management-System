<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-people"></i> Clients</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                <li><a href="<?php echo base_url().'Clients'?>">Clients</a></li>
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
            		 ADD CLIENT INFO
            	</div>
            	<div class="card-wrapper collapse show">
            		<div class="card-body">
            			<?php if(!empty($editID))  { ?>
            			<form id="creatclient" class="aj-form" method="post" action="<?php echo base_url().'Clients/insertclients/'.base64_encode($editID)?>" name="client" >
            			<?php } 
            			else { ?>
            				<form id="creatclient" class="aj-form" method="post" action="<?php echo base_url().'Clients/insertclients'?>" name="client" >
            				<?php } 
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
            					<h3 class="box-title">Company Details</h3>
            					<hr>
            					<div class="row">
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Company Name<span class="astric">*</span></label>
            								<input id="company_name" class="form-control" type="text" name="company_name" value="<?php if(!empty($sessData['company_name'])) { echo $sessData['company_name']; } else { echo !empty($leads[0]->companyname) ?  $leads[0]->companyname :''; } ?>">
            							</div>
            						</div>
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Website<span class="astric">*</span></label>
            								<input id="website" class="form-control" type="text" name="website" value="<?php if(!empty($sessData['website'])) { echo $sessData['website']; } else { echo !empty($leads[0]->website) ?  $leads[0]->website :'';} ?>">
            							</div>
            						</div>
            					</div>
            					<div class="row">
            						<div class="col-md-12">
            							<div class="form-group">
            								<label class="control-label">Address</label>
            								<textarea name="address" id="address" rows="5" class="form-control"><?php if(!empty($sessData['address'])) { echo $sessData['address']; } else {} ?></textarea>
            							</div>
            						</div>
            					</div>
            					<h3 class="box-title mt-4">Client Details</h3>
            					<hr>
            					<div class="row">
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Client Name<span class="astric">*</span></label>
            								<input id="name" class="form-control" type="text" name="name" value="<?php if(!empty($sessData['name'])) { echo $sessData['name']; } else { echo !empty($leads[0]->clientname) ?  $leads[0]->clientname :'';} ?>">
            							</div>
            						</div>
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Client Email<span class="astric">*</span></label>
            								<input id="email" class="form-control" type="email" name="email" value="<?php if(!empty($sessData['email'])) { echo $sessData['email']; } else { echo !empty($leads[0]->clientemail) ?  $leads[0]->clientemail :'';} ?>">
            								<span class="help-block">Client will login using this email.</span>
            							</div>
            						</div>
            					</div>
            					<div class="row">
            						<div class="col-md-4">
            							<div class="form-group required pass-eye">
            								<label class="pass-change">Password<span class="astric">*</span></label>

            								<input id="password" type="Password" class="form-control pass-change" name="password" >
                                            <span class="hidden-eye">

                                            <span class="pass-view" onclick="passwordAction(1)"><i class="fa fa-eye"></i></span>
                                            <span class="pass-hide" onclick="passwordAction(0)"><i class="fa fa-eye-slash"></i></span></span>
            								<span class="help-block">Client will login using this password.</span>
            							</div>
            						</div>
            						<div class="col-xs-12 col-md-4 mt-4">
            							<div class="form-group">
            								<div class="checkbox checkbox-info">
                                                <input id="randompassword" name="randompassword" type="checkbox" onclick="checkuncheck();"  >
                                                <label for="randompassword">Generate Random Password</label>
                                            </div>
            							</div>
            						</div>
            						<div class="col-md-4">
            							<div class="form-group">
            								<div class="form-group">
	                                            <label>Mobile<span class="astric">*</span></label>
	                                            <input type="tel" name="mobile" id="mobile" class="form-control allow-no" value="<?php if(!empty($sessData['mobile'])) { echo $sessData['mobile']; } else {} ?>">
	                                        </div>
            							</div>
            						</div>
            					</div>
            					<div class="row">
            						<div class="col-md-3">
            							<div class="form-group">
            								<label class="control-label">Skype</label>
            								<input id="skype" class="form-control" type="text" name="skype" value="<?php if(!empty($sessData['skype'])) { echo $sessData['skype']; } else {} ?>">
            							</div>
            						</div>
            						<div class="col-md-3">
            							<div class="form-group">
            								<label class="control-label">Linkedin</label>
            								<input id="linkedin" class="form-control" type="text" name="linkedin" value="<?php if(!empty($sessData['linkedin'])) { echo $sessData['linkedin']; } else {} ?>">
            							</div>
            						</div>
            						<div class="col-md-3">
            							<div class="form-group">
            								<label class="control-label">Twitter</label>
            								<input id="twitter" class="form-control" type="text" name="twitter" value="<?php if(!empty($sessData['twitter'])) { echo $sessData['twitter']; } else {} ?>">
            							</div>
            						</div>
            						<div class="col-md-3">
            							<div class="form-group">
            								<label class="control-label">Facebook</label>
            								<input id="facebook" class="form-control" type="text" name="facebook" value="<?php if(!empty($sessData['facebook'])) { echo $sessData['facebook']; } else {} ?>">
            							</div>
            						</div>
            					</div>
            					<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gst_number">GST Number</label>
                                            <input type="text" id="gst_number" name="gst_number" class="form-control" value="<?php if(!empty($sessData['gst_number'])) { echo $sessData['gst_number']; } else {} ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Note</label>
                                        <div class="form-group">
                                            <textarea name="note" id="note" class="form-control" rows="5"><?php if(!empty($sessData['note'])) { echo $sessData['note']; } else {} ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label>Log In</label>
                                            <select name="login" id="login" class="form-control">
                                               <option value="1" <?php if($sessData['login']=='1'){ echo 'selected'; } ?>>Enable</option>
                                                <option value="0" <?php if($sessData['login']=='0'){ echo 'selected'; }?>>Disable</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
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
