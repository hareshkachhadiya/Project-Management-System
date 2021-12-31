<nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="icon-people"></i> Clients</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="clients.html">Clients</a></li>
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
		                		 Add Client Info
		                	</div>
		                	<div class="card-wrapper collapse show">
		                		<div class="card-body">
		                			<form id="creatclient" class="aj-form" method="post" action="<?php echo base_url().'leads/changeleadtoclient/'.base64_encode($editID)?>" name="leadtoclient">
		                				<div class="submit-alerts">
		                					<div class="alert alert-success" role="alert">
											  This is a success alert
											</div>
											<div class="alert alert-danger" role="alert">
											  This is a danger alert
											</div>
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
		                								<label class="control-label">Company Name</label>
		                								<input id="company_name" class="form-control" type="text" name="company_name" value="<?php echo !empty($leads[0]->companyname) ?  $leads[0]->companyname : ' '?>">
		                							</div>
		                						</div>
		                						<div class="col-md-6">
		                							<div class="form-group">
		                								<label class="control-label">Website</label>
		                								<input id="website" class="form-control" type="text" name="website" value="<?php echo !empty($leads[0]->website) ?  $leads[0]->website : ' '?>">
		                							</div>
		                						</div>
		                					</div>
		                					<div class="row">
		                						<div class="col-md-12">
		                							<div class="form-group">
		                								<label class="control-label">Address</label>
		                								<textarea name="address" id="address" rows="5" value="" class="form-control"></textarea>
		                							</div>
		                						</div>
		                					</div>
		                					<h3 class="box-title mt-4">Client Details</h3>
		                					<hr>
		                					<div class="row">
		                						<div class="col-md-6">
		                							<div class="form-group">
		                								<label class="control-label">Client Name</label>
		                								<input id="name" class="form-control" type="text" name="name" value="<?php echo !empty($leads[0]->clientname) ?  $leads[0]->clientname : ' '?>">
		                							</div>
		                						</div>
		                						<div class="col-md-6">
		                							<div class="form-group">
		                								<label class="control-label">client Email</label>
		                								<input id="email" class="form-control" type="email" name="email" value="<?php echo !empty($leads[0]->clientemail) ?  $leads[0]->clientemail : ' '?>">
		                								<span class="help-block">Client will login using this email.</span>
		                							</div>
		                						</div>
		                					</div>
		                					<div class="row">
		                						<div class="col-md-4">
		                							<div class="form-group">
		                								<label>Password</label>
		                								<input type="Password" style="display: none;">
		                								<input id="password" type="Password" class="form-control" name="password">
		                								<span class="help-block">Client will login using this password.</span>
		                							</div>
		                						</div>
		                						<div class="col-xs-12 col-md-4 mt-4">
		                							<div class="form-group">
		                								<div class="checkbox checkbox-info">
			                                                <input id="randompassword" name="randompassword" value="0" type="checkbox" onclick="checkuncheck();">
			                                                <label for="randompassword">Generate Random Password</label>
			                                            </div>
		                							</div>
		                						</div>
		                						<div class="col-md-4">
		                							<div class="form-group">
		                								<div class="form-group">
				                                            <label>Mobile</label>
				                                            <input type="tel" name="mobile" id="mobile" value="<?php echo !empty($leads[0]->mobile) ?  $leads[0]->mobile : ' '?>" class="form-control">
				                                        </div>
		                							</div>
		                						</div>
		                					</div>
		                					<div class="row">
		                						<div class="col-md-3">
		                							<div class="form-group">
		                								<label class="control-label">skype</label>
		                								<input id="skype" class="form-control" type="text" name="skype">
		                							</div>
		                						</div>
		                						<div class="col-md-3">
		                							<div class="form-group">
		                								<label class="control-label">Linkedin</label>
		                								<input id="linkedin" class="form-control" type="text" name="linkedin">
		                							</div>
		                						</div>
		                						<div class="col-md-3">
		                							<div class="form-group">
		                								<label class="control-label">Twitter</label>
		                								<input id="twitter" class="form-control" type="text" name="twitter">
		                							</div>
		                						</div>
		                						<div class="col-md-3">
		                							<div class="form-group">
		                								<label class="control-label">facebook</label>
		                								<input id="facebook" class="form-control" type="text" name="facebook">
		                							</div>
		                						</div>
		                					</div>
		                					<div class="row">
			                                    <div class="col-md-6">
			                                        <div class="form-group">
			                                            <label for="gst_number">GST Number</label>
			                                            <input type="text" id="gst_number" name="gst_number" class="form-control" value="">
			                                        </div>
			                                    </div>
			                                </div>
			                                <div class="row">
			                                    <div class="col-md-12">
			                                        <label>Note</label>
			                                        <div class="form-group">
			                                            <textarea name="note" id="note" class="form-control" rows="5"></textarea>
			                                        </div>
			                                    </div>
			                                </div>
			                                <div class="row">
			                                    <div class="col-md-6 ">
			                                        <div class="form-group">
			                                            <label>Log In</label>
			                                            <select name="login" id="login" class="form-control">
			                                                <option value="0">Enable</option>
			                                                <option value="1">Disable</option>
			                                            </select>
			                                        </div>
			                                    </div>
			                                </div>
			                                <div class="form-actions">
				                                <input type="submit" id="save-form" class="btn btn-success" value="Save" name="btnsave"> <i class="fa fa-check"></i> 
				                                <button type="reset" class="btn btn-default">Reset</button>
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