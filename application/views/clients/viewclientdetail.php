<nav aria-label="breadcrumb" class="breadcrumb-nav">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title"><i class="icon-people"></i> Clients</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                <li><a href="<?php echo base_url().'Clients'?>">Clients</a></li>
                <li class="active">Project</li>
            </ol>
        </div>
    </div>
</nav>

            <!-- contetn-wrap -->
            <div class="content-in">  
                <div class="row">
                    <div class="col-md-12">
		                <div class="card br-0">
		                	<div class="stats-box">
	                			<div class="row">
	                				<div class="col-sm-6 b-r">
	                					<strong>Full Name</strong> <br>
                						<p class="text-muted"><?php echo !empty($clients[0]->clientname) ?  $clients[0]->clientname : ' '?></p>
	                				</div>
	                				<div class="col-sm-6">
	                					<strong>Mobile</strong> <br>
	                					<p class="text-muted"><?php echo !empty($users[0]->mobile) ?  $users[0]->mobile : ' '?></p>
	                				</div>
	                			</div>
	                			<hr>
	                			<div class="row">
	                				<div class="col-sm-6 b-r">
	                					<strong>Email</strong> <br>
                						<p class="text-muted"><?php echo !empty($users[0]->emailid) ?  $users[0]->emailid : ' '?></p>
	                				</div>
	                				<div class="col-sm-6">
	                					<strong>Company Name</strong> <br>
	                					<p class="text-muted"><?php echo !empty($clients[0]->companyname) ?  $clients[0]->companyname : ' '?></p>
	                				</div>
	                			</div>
	                			<hr>
	                			<div class="row">
	                				<div class="col-sm-6 b-r">
	                					<strong>Website</strong> <br>
                						<p class="text-muted"><?php echo !empty($clients[0]->website) ?  $clients[0]->website : ' '?></p>
	                				</div>
	                				<div class="col-sm-6">
	                					<strong>Address</strong> <br>
	                					<p class="text-muted"><?php echo !empty($clients[0]->address) ?  $clients[0]->address : ' '?></p>
	                				</div>
	                			</div>
	                			<hr>
	                		</div>
		                </div>
		            </div>
		            <div class="col-md-12">
		            	<div class="submit-alerts">
        					<div class="alert alert-success" role="alert">
							  Contact added Successfully
							</div>
							<div class="alert alert-danger" role="alert">
							  This is a danger alert
							</div>
							<div class="alert alert-warning" role="alert">
							  This is a warning alert
							</div>
        				</div>
		            	<section class="cview-detai">
	            			<div class="stats-box">
	            				<ul class="nav nav-tabs" id="myTab" role="tablist">
								  	<li class="nav-item">
								    	<a class="nav-link active" id="projects-tab" data-toggle="tab" href="#projects" role="tab" aria-controls="projects" aria-selected="true">Projects</a>
								  	</li>
								  	<li class="nav-item">
								    	<a class="nav-link" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="false">Invoices</a>
								  	</li>
								  	<li class="nav-item">
								    	<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contacts</a>
								  	</li>
								</ul>
	            			</div>
		            		<div class="contetn-tab">
		            			<div class="">
		            				<div class="tab-content" id="myTabContent">

									  	<div class="tab-pane fade show active" id="projects" role="tabpanel" aria-labelledby="projects-tab">
					            			<div class="stats-box">
					            				<h3>Devlopment Mode</h3>
					            				<!-- <h3 class="box-title b-b">Projects</h3>
					            				<div class="table-responsive">
		                                            <table class="table">
		                                                <thead>
		                                                <tr>
		                                                    <th>#</th>
		                                                    <th>Project Name</th>
		                                                    <th>Started On</th>
		                                                    <th>Deadline</th>
		                                                    <th>&nbsp;</th>
		                                                </tr>
		                                                </thead>
		                                                <tbody id="timer-list">
		                                                    <tr>
		                                                        <td>1</td>
		                                                        <td>Identification System</td>
		                                                        <td>22-04-2019</td>                                   <td>22-08-2019</td>
		                                                        <td>22-08-2019</td>
		                                                        <td><a href="project.html" ><span class="badge badge-info bic">View Details</span></a></td>
		                                                    </tr>
		                                                </tbody>
		                                            </table>
		                                        </div> -->
					            			</div>
									  	</div>
									 	<div class="tab-pane fade" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">
					            			<div class="stats-box">
					            				<h3>Devlopment Mode</h3>
					            				<!-- <h2>Invoices</h2>
					            				<ul class="list-group" id="invoices-list">
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-md-7">
												                Invoice # 14957053444
												            </div>
												            <div class="col-md-2">
												                $ 48848
												            </div>
												            <div class="col-md-3">
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                <span class="m-l-10">15 Jul, 19</span>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-md-7">
												                Invoice # 14957057979
												            </div>
												            <div class="col-md-2">
												                $ 44258
												            </div>
												            <div class="col-md-3">
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                <span class="m-l-10">07 Jul, 19</span>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-md-7">
												                Invoice # 14957057206
												            </div>
												            <div class="col-md-2">
												                $ 32115
												            </div>
												            <div class="col-md-3">
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                <span class="m-l-10">10 Jul, 19</span>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-md-7">
												                Invoice # 14957058289
												            </div>
												            <div class="col-md-2">
												                $ 34872
												            </div>
												            <div class="col-md-3">
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                <span class="m-l-10">21 Jul, 19</span>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-md-7">
												                Invoice # 14957055897
												            </div>
												            <div class="col-md-2">
												                $ 44294
												            </div>
												            <div class="col-md-3">
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                <span class="m-l-10">10 Jul, 19</span>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-md-7">
												                Invoice # 14957058228
												            </div>
												            <div class="col-md-2">
												                $ 31578
												            </div>
												            <div class="col-md-3">
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                <span class="m-l-10">12 Jul, 19</span>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-md-7">
												                Invoice # 14957054181
												            </div>
												            <div class="col-md-2">
												                $ 40288
												            </div>
												            <div class="col-md-3">
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                <span class="m-l-10">14 Jul, 19</span>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-md-7">
												                Invoice # 14957051890
												            </div>
												            <div class="col-md-2">
												                $ 47323
												            </div>
												            <div class="col-md-3">
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                <span class="m-l-10">22 Jul, 19</span>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-md-7">
												                Invoice # 14957052141
												            </div>
												            <div class="col-md-2">
												                $ 15978
												            </div>
												            <div class="col-md-3">
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                <span class="m-l-10">10 Jul, 19</span>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-md-7">
												                Invoice # 14957057255
												            </div>
												            <div class="col-md-2">
												                $ 48770
												            </div>
												            <div class="col-md-3">
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                <span class="m-l-10">11 Jul, 19</span>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-md-7">
												                Invoice # 14957055179
												            </div>
												            <div class="col-md-2">
												                $ 27779
												            </div>
												            <div class="col-md-3">
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                <span class="m-l-10">07 Jul, 19</span>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-md-7">
												                Invoice # 14957054485
												            </div>
												            <div class="col-md-2">
												                $ 61510
												            </div>
												            <div class="col-md-3">
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                <span class="m-l-10">28 Jul, 19</span>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-md-7">
												                Invoice # 14957058407
												            </div>
												            <div class="col-md-2">
												                $ 44926
												            </div>
												            <div class="col-md-3">
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                <span class="m-l-10">16 Jul, 19</span>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-md-7">
												                Invoice # 14957051961
												            </div>
												            <div class="col-md-2">
												                $ 50457
												            </div>
												            <div class="col-md-3">
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                <span class="m-l-10">26 Jul, 19</span>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-md-7">
												                Invoice # 14957057585
												            </div>
												            <div class="col-md-2">
												                $ 21612
												            </div>
												            <div class="col-md-3">
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                <span class="m-l-10">08 Jul, 19</span>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-md-7">
												                Invoice # 14957057154
												            </div>
												            <div class="col-md-2">
												                $ 51393
												            </div>
												            <div class="col-md-3">
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                <span class="m-l-10">19 Jul, 19</span>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-md-7">
												                Invoice # 14957056010
												            </div>
												            <div class="col-md-2">
												                $ 16602
												            </div>
												            <div class="col-md-3">
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                <span class="m-l-10">10 Jul, 19</span>
												            </div>
												        </div>
												    </li>
												    <li class="list-group-item">
												        <div class="row">
												            <div class="col-md-7">
												                Invoice # 14957057584
												            </div>
												            <div class="col-md-2">
												                $ 16134
												            </div>
												            <div class="col-md-3">
												                <a href="#" data-toggle="tooltip" data-original-title="Download" class="btn btn-inverse btn-circle"><i class="fa fa-download"></i></a>
												                <span class="m-l-10">25 Jul, 19</span>
												            </div>
												        </div>
												    </li>
												</ul> -->
					            			</div>
									 	</div>
									  	<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
					            			<div class="stats-box">
					            				<h3>Devlopment Mode</h3>
					            				<!-- <div class="table-responsive">
						            				<table class="table table-bordered" id="client-contacts">
													    <thead>
													        <tr role="row">
													             <th>Id</th>
													             <th>Name</th>
													             <th>Phone</th>
													             <th>Email</th>
													             <th>Action</th>
													        </tr>
													    </thead>
													    <tbody>
													      <tr role="row" class="odd">
													         <td class="" tabindex="0">1</td>
													         <td>Lemuel Padberg</td>
													         <td>8469585858</td>
													         <td>client@example.com</td>
													         <td>
													         	<a href="javascript:void(0);" class="btn btn-info btn-circle" data-original-title="Edit" data-toggle="modal" data-target="#cfromlong">
													         		<i class="fa fa-pencil" aria-hidden="true"></i>
													         	</a>
													            <a href="" class="btn btn-danger btn-circle sa-params" data-toggle="tooltip" data-user-id="3" data-original-title="Delete">
													            	<i class="fa fa-times" aria-hidden="true"></i>
													            </a>
													         </td>
													      </tr>
													    </tbody>
													</table>
												</div> -->
					            			</div>
									  	</div>
									</div>
		            			</div>
		            		</div>
		            	</section>
		            </div>
                </div>
            </div>
            <!-- ends of contentwrap -->

            