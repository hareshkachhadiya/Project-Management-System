<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-people"></i> Clients</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                <li><a href="<?php echo base_url().'clients'?>">Clients</a></li>
                <li class="active">Edit</li>
            </ol>
        </div>
    </div>
</nav>
<?php
$sessData = "";
if($this->session->flashdata('sessData')){
    $sessData = $this->session->flashdata('sessData');
}
?>
<!-- contetn-wrap -->
<div class="content-in">  
    <div class="row">
        <div class="col-md-12">
            <div class="card br-0">
            	<div class="card-header br-0 card-header-inverse">
            		 UPDATE CLIENT INFO
            	</div>
            	<div class="card-wrapper collapse show">
            		<div class="card-body">
            			<form id="creatclient" class="aj-form" method="post">
            				<div class="submit-alerts">
            					<div class="alert alert-success" role="alert">
								  This is a success alert
								</div>
                                
								<div class="alert alert-warning" role="alert">
								  This is a warning alert
								</div>
            				</div>
            				<div class="form-body">
            					<h3 class="box-title">Company Details</h3>
            					<hr>
                                <?php
                                if($this->session->flashdata('message_name')){?>
                                    <div class="alert alert-danger" role="alert">
                                     <?php echo $this->session->flashdata('message_name');?>
                                    </div>
                                <?php
                                }?>
                                <input type="hidden" name="clientid" value="<?php echo $this->uri->segment(3);?>">
            					<div class="row">
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Company Name<span class="astric">*</span></label>
            								<input id="company_name" class="form-control" type="text" name="company_name" value="<?php
                                             if(!empty($sessData)) { echo $sessData['company_name']; } elseif(!empty($clients[0]->companyname)) { echo $clients[0]->companyname; } else{ }?>">
            							</div>
            						</div>
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Website<span class="astric">*</span></label>
            								<input id="website" class="form-control" type="text" name="website" value="<?php
                                             if(!empty($sessData)) { echo $sessData['website']; } elseif(!empty($clients[0]->website)) { echo $clients[0]->website; } else{ }?>">
            							</div>
            						</div>
            					</div>
            					<div class="row">
            						<div class="col-md-12">
            							<div class="form-group">
            								<label class="control-label">Address</label>
            								<textarea name="address" id="address" rows="5"  class="form-control"><?php
                                             if(!empty($sessData)) { echo $sessData['address']; } elseif(!empty($clients[0]->address)) { echo $clients[0]->address; } else{ }?></textarea>
            							</div>
            						</div>
            					</div>
            					<h3 class="box-title mt-4">Client Details</h3>
            					<hr>
            					<div class="row">
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Client Name<span class="astric">*</span></label>
            								<input id="name" class="form-control" type="text" name="name" value="<?php if(!empty($sessData)) { echo $sessData['name']; } elseif(!empty($clients[0]->clientname)) { echo $clients[0]->clientname; } else{ }?>">
            							</div>
            						</div>
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Client Email<span class="astric">*</span></label>
            								<input id="email" class="form-control" type="email" name="email" value="<?php if(!empty($sessData)) { echo $sessData['email']; } elseif(!empty($user[0]->emailid)) { echo $user[0]->emailid; } else{ }?>">
            								<span class="help-block">Client will login using this email.</span>
            							</div>
            						</div>
            					</div>
            					<div class="row">
            						<div class="col-md-4">
            							<div class="form-group">
            								<label>Password<span class="astric">*</span></label>
            								<input type="Password" style="display: none;">
            								<input id="password" type="Password" class="form-control" name="password">
            								<span class="help-block">Client will login using this password.</span>
            							</div>
            						</div>
            						<div class="col-md-4">
            							<div class="form-group">
            								<div class="form-group">
	                                            <label>Mobile<span class="astric">*</span></label>
	                                            <input type="tel" name="mobile" id="mobile" value="<?php if(!empty($sessData)) { echo $sessData['mobile']; } elseif(!empty($user[0]->mobile)) { echo $user[0]->mobile; } else{ }?>" class="form-control allow-no">
	                                       </div>
            							</div>
            						</div>
                                    <?php
                                    $optst=$optst1="";
                                //echo "<PRE>";print_r($sessData);exit();
                                if(isset($sessData['status'])){
                                    if(trim($sessData['status'])=='0'){
                                        $optst="selected";
                                    }else if(trim($sessData['status'])=='1'){
                                        $optst1="selected";
                                    }
                                }else if(isset($user[0]->status)){
                                    if(trim($user[0]->status)=='0'){
                                        $optst="selected";
                                    }else if(trim($user[0]->status)=='1'){
                                        $optst1="selected";
                                    }
                                }
                                ?>
									<div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" id="status" class="form-control">
                                               <option value="1" <?= $optst1;?>>Active</option>
												<option value="0" <?= $optst;?>>DeActive</option>
											</select>
                                        </div>
                                    </div>
                               </div>
								<div class="row">
            						<div class="col-md-3">
            							<div class="form-group">
            								<label class="control-label">Skype</label>
            								<input id="skype" class="form-control" type="text" name="skype" value="<?php if(!empty($sessData)) { echo $sessData['skype']; } elseif(!empty($clients[0]->skype)) { echo $clients[0]->skype; } else{ }?>">
            							</div>
            						</div>
            						<div class="col-md-3">
            							<div class="form-group">
            								<label class="control-label">Linkedin</label>
            								<input id="linkedin" class="form-control" type="text" name="linkedin" value="<?php if(!empty($sessData)) { echo $sessData['linkedin']; } elseif(!empty($clients[0]->linkedin)) { echo $clients[0]->linkedin; } else{ }?>">
            							</div>
            						</div>
            						<div class="col-md-3">
            							<div class="form-group">
            								<label class="control-label">Twitter</label>
            								<input id="twitter" class="form-control" type="text" name="twitter" value="<?php if(!empty($sessData)) { echo $sessData['twitter']; } elseif(!empty($clients[0]->twitter)) { echo $clients[0]->twitter; } else{ }?>">
            							</div>
            						</div>
            						<div class="col-md-3">
            							<div class="form-group">
            								<label class="control-label">Facebook</label>
            								<input id="facebook" class="form-control" type="text" name="facebook" value="<?php if(!empty($sessData)) { echo $sessData['facebook']; } elseif(!empty($clients[0]->facebook)) { echo $clients[0]->facebook; } else{ }?>">
            							</div>
            						</div>
            					</div>
            					<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="gst_number">GST Number</label>
                                            <input type="text" id="gst_number" name="gst_number" class="form-control" value="<?php if(!empty($sessData)) { echo $sessData['gst_number']; } elseif(!empty($clients[0]->gstnumber)) { echo $clients[0]->gstnumber; } else{ }?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Note</label>
                                        <div class="form-group">
                                            <textarea name="note" id="note" class="form-control" rows="5"><?php if(!empty($sessData)) { echo $sessData['note']; } elseif(!empty($clients[0]->note)) { echo $clients[0]->note; } else{ }?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $optstr=$optstr1="";
                                //echo "<PRE>";print_r($sessData);exit();
                                if(isset($sessData['login'])){
                                    if(trim($sessData['login'])=='0'){
                                        $optstr="selected";
                                    }else if(trim($sessData['login'])=='1'){
                                        $optstr1="selected";
                                    }
                                }else if(isset($user[0]->login)){
                                    if(trim($user[0]->login)=='0'){
                                        $optstr="selected";
                                    }else if(trim($user[0]->login)=='1'){
                                        $optstr1="selected";
                                    }
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <div class="form-group">
                                            <label>Log In</label>
                                            <select name="login" id="login" class="form-control">
                                               <option value="1" <?= $optstr1;?>>Enable</option>
												<option value="0" <?= $optstr;?>>Disable</option>
											</select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
	                                <button type="submit" name="btnupdate" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
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
