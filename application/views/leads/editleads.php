<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-layers"></i> Leads</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        	<ol class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="leads.html">Leads</a></li>
                <li class="active">Add New</li>
            </ol>
        </div>
    </div>
</nav>
<?php
$sessData=array();
if(!empty($this->session->flashdata('sessData'))){
    $sessData = $this->session->flashdata('sessData');
}
?>
<!-- contetn-wrap -->
<div class="content-in">  
    <div class="row">
        <div class="col-md-12">
            <div class="card br-0">
            	<div class="card-header br-0 card-header-inverse">
            		Edit Lead Info
            	</div>
            	<div class="card-wrapper collapse show">
            		<div class="card-body">
            			<form id="creatclient" class="aj-form" method="post">
                            <?php
                                    $mess = $this->session->flashdata('message_name');
                                    if(!empty($mess)){
                                        //warning 
                                    ?>
            				<div class="submit-alerts">
            					<div class="alert alert-success" role="alert">
                                    <?php echo $mess; ?>
								</div>
								<div class="alert alert-danger" role="alert">
								  This is a danger alert
								</div>
								<div class="alert alert-warning" role="alert">
								  This is a warning alert
								</div>
            				</div>
                            <?php } ?>
            				<div class="form-body">
            					<h3 class="box-title">Company Details</h3>
            					<hr>
                                <?php
                                if($this->session->flashdata('message_name')){?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $this->session->flashdata('message_name');?>
                                    </div>
                                <?php
                                }
                                ?>
                                
                                <input type="hidden" name="leadid" value="<?php echo $this->uri->segment(3);?>">
            					<div class="row">
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Company Name</label>
            								<input id="company_name" class="form-control" type="text" name="company_name" value="<?php
                                             if(!empty($sessData)) { echo $sessData['company_name']; } elseif(!empty($leads[0]->companyname)) { echo $leads[0]->companyname; } else{ }?>">
            							</div>
            						</div>
            						<div class="col-md-6">
            							<div class="form-group">
            								<label class="control-label">Website</label>
            								<input id="website" class="form-control" type="text" name="website" value="<?php
                                             if(!empty($sessData)) { echo $sessData['website']; } elseif(!empty($leads[0]->website)) { echo $leads[0]->website; } else{ }?>">
            							</div>
            						</div>
            					</div>
            					<div class="row">
                            		<div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Address</label>
                                            <textarea name="address" id="address" class="form-control" rows="4"><?php 
                                            if(!empty($sessData)) { echo $sessData['address']; } elseif(!empty($leads[0]->address)) { echo $leads[0]->address; } else{ }?>
                                            </textarea>
                                        </div>
                                    </div>
                    			</div>
                    			<h3 class="box-title mt-4">Lead Details</h3>
                    			<hr>
            					<div class="row">
								    <div class="col-md-6">
								        <div class="form-group">
								            <label class="control-label">Client Name</label>
								            <input type="text" name="name" id="name" class="form-control" value="<?php 
                                            if(!empty($sessData)) { echo $sessData['name']; } elseif(!empty($leads[0]->clientname)) { echo $leads[0]->clientname; } else{ }?>">
								        </div>
								    </div>
								    <div class="col-md-6">
								        <div class="form-group">
								            <label class="control-label">Client Email</label>
								            <input type="text" name="email" id="email" class="form-control" value="<?php 
                                            if(!empty($sessData)) { echo $sessData['email']; } elseif(!empty($leads[0]->clientemail)) { echo $leads[0]->clientemail; } else{ }?>">
								            <span class="help-desk">Lead will login using this email.</span>
								        </div>
								    </div>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-6">
										<div class="form-group">
											<label class="control-label">Mobile</label>
											<input type="text" id="mobile" name="mobile" class="form-control allow-no" value="<?php 
                                            if(!empty($sessData)) { echo $sessData['mobile']; } elseif(!empty($leads[0]->mobile)) { echo $leads[0]->mobile; } else{ }?>">
										</div>
									</div>
                                    <?php
                                    $optst=$optst1="";
                                    //echo "<PRE>";print_r($sessData);exit();
                                    if(isset($sessData['follow_up'])){
                                        if(trim($sessData['follow_up'])=='0'){
                                            $optst="selected";
                                        }else if(trim($sessData['follow_up'])=='1'){
                                            $optst1="selected";
                                        }
                                    }else if(isset($user[0]->nextfollowup)){
                                        if(trim($user[0]->nextfollowup)=='0'){
                                            $optst="selected";
                                        }else if(trim($user[0]->nextfollowup)=='1'){
                                            $optst1="selected";
                                        }
                                    }
                                    ?>
									<div class="col-lg-4 col-md-6">
										<div class="form-group">
											<label class="control-label">Next Follow Up</label>
											<select id="follow_up" name="follow_up" class="form-control">
												<option value="0" <?= $optst;?>>Yes</option>
												<option value="1" <?= $optst1;?>>No</option>
											</select>
										</div>
									</div>
                                </div>
                                <?php
                                $optstr=$optstr1=$optstr2="";
                                //echo "<PRE>";print_r($sessData);exit();
                                if(isset($sessData['status'])){
                                    if(trim($sessData['status'])=='0'){
                                        $optstr="selected";
                                    }else if(trim($sessData['status'])=='1'){
                                        $optstr1="selected";
                                    }else if(trim($sessData['status'])=='2'){
                                        $optstr2="selected";
                                    }
                                }else if(isset($user[0]->status)){
                                    if(trim($user[0]->status)=='0'){
                                        $optstr="selected";
                                    }else if(trim($user[0]->status)=='1'){
                                        $optstr1="selected";
                                    }else if(trim($user[0]->status)=='2'){
                                        $optstr2="selected";
                                    }
                                }
                                $socialstr=$socialstr1=$socialstr2="";
                                //echo "<PRE>";print_r($sessData);exit();
                                if(isset($sessData['source'])){
                                    if(trim($sessData['source'])=='0'){
                                        $socialstr="selected";
                                    }else if(trim($sessData['source'])=='1'){
                                        $socialstr1="selected";
                                    }else if(trim($sessData['source'])=='2'){
                                        $socialstr2="selected";
                                    }
                                }else if(isset($user[0]->source)){
                                    if(trim($user[0]->source)=='0'){
                                        $socialstr="selected";
                                    }else if(trim($user[0]->source)=='1'){
                                        $socialstr1="selected";
                                    }else if(trim($user[0]->source)=='2'){
                                        $socialstr2="selected";
                                    }
                                }
                                ?>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Status</label>
                                            <select id="status" name="status" class="form-control">
                                                <option value="0" <?= $optstr;?>>Pending</option>
                                                <option value="1" <?= $optstr1;?>>Overview</option>
                                                <option value="2" <?= $optstr2;?>>Confirmed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Source</label>
                                            <select id="source" name="source" class="form-control">
                                                <option value="0" <?= $socialstr;?>>Social Media</option>
                                                <option value="1" <?= $socialstr1;?>>Google</option>
                                                <option value="2" <?= $socialstr2;?>>Other</option>
                                            </select>
                                        </div>
                                    </div>
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Note</label>
											<textarea id="note" name="note" class="form-control" rows="4"><?php
                                            if(!empty($sessData)) { echo $sessData['note']; } elseif(!empty($leads[0]->note)) { echo $leads[0]->note; } else{ }?></textarea>
                                             
										</div>
									</div>
								</div>
                    			
								<!-- action btn -->
                                <div class="form-actions">
                                    <button type="submit" name="btnupdate" id="save-form" class="btn btn-success"> <i class="fa fa-check"></i> Update</button>
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