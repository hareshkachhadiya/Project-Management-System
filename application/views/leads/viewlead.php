 <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="icon-people"></i> leads #1 -<?php echo $leads[0]->companyname;?></h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                            <li><a href="<?php echo base_url().'leads'?>">leads</a></li>
                            <li class="active">Files</li>
                        </ol>
                    </div>
                </div>
            </nav>

            <!-- contetn-wrap -->
            <section class="cview-detai">
	            			<div class="stats-box">
	            				<ul class="nav nav-tabs" id="myTab" role="tablist">
								  	<li class="nav-item">
								    	<a class="nav-link active" id="projects-tab" data-toggle="tab" href="#projects" role="tab" aria-controls="projects" aria-selected="true">Profile</a>
								  	</li>
								  	<li class="nav-item">
								    	<a class="nav-link" id="invoice-tab" data-toggle="tab" href="#invoice" role="tab" aria-controls="invoice" aria-selected="false">Proposal</a>
								  	</li>
								  	<li class="nav-item">
								    	<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Files</a>
								  	</li>
								  	
								</ul>
	            			</div>
	         </section>
            <div class="content-in">  
                <div class="row">
                    <div class="col-md-12">
		                <div class="card br-0">
		                	<div class="stats-box">
		                		<h2>Lead Detail</h2>
	                			<div class="row">
	                				<div class="col-sm-6 b-r">
	                					<strong>Company Name</strong> <br>
                						<p class="text-muted"><?php echo !empty($leads[0]->companyname) ?  $leads[0]->companyname : ' '?></p>
	                				</div>
	                				<div class="col-sm-6">
	                					<strong>Website</strong> <br>
	                					<p class="text-muted"><?php echo !empty($leads[0]->website) ?  $leads[0]->website : ' '?></p>
	                				</div>
	                			</div>
	                			<hr>
	                			<div class="row">
	                				<div class="col-sm-6 b-r">
	                					<strong>Mobile</strong> <br>
                						<p class="text-muted"><?php echo !empty($leads[0]->mobile) ?  $leads[0]->mobile : ' '?></p>
	                				</div>
	                				<div class="col-sm-6">
	                					<strong>Address</strong> <br>
	                					<p class="text-muted"><?php echo !empty($leads[0]->address) ?  $leads[0]->address : ' '?></p>
	                				</div>
	                			</div>
	                			<hr>
	                			<div class="row">
	                				<div class="col-sm-6 b-r">
	                					<strong>Client Name</strong> <br>
                						<p class="text-muted"><?php echo !empty($leads[0]->clientname) ?  $leads[0]->clientname : ' '?></p>
	                				</div>
	                				<div class="col-sm-6">
	                					<strong>Client Email</strong> <br>
	                					<p class="text-muted"><?php echo !empty($leads[0]->clientemail) ?  $leads[0]->clientemail : ' '?></p>
	                				</div>
	                			</div>
	                			<hr>
	                			<div class="row">
	                				<div class="col-sm-6 b-r">
	                					<strong>Source</strong> <br>
                						<p class="text-muted"><?php 
                						if($leads[0]->status == '0'){
											$source = $leads[0]->source = 'Social Media';
										}
										else if($leads[0]->status == '1'){
											$source = $leads[0]->source = 'Google';
										}
										else{
											$source = $leads[0]->source = 'Other';
										}
                						echo !empty($leads[0]->source) ?  $source : ' '?></p>
	                				</div>
	                				<div class="col-sm-6">
	                					<strong>Status</strong> <br>
	                					<p class="text-muted"><?php 
	                					if($leads[0]->status == '0'){
											$status = $leads[0]->status = 'Pending';
										}
										else if($leads[0]->status == '1'){
											$status = $leads[0]->status = 'Overview';
										}
										else{
											$status = $leads[0]->status = 'Confirmed';
										}
	                					echo !empty($leads[0]->status) ?  $status : ' '?></p>
	                				</div>
	                			</div>
	                			<hr>
	                			<div class="row">
	                				<div class="col-sm-12 b-r">
	                					<strong>Note</strong> <br>
                						<p class="text-muted"><?php echo !empty($leads[0]->note) ?  $leads[0]->note : ' '?></p>
	                				</div>
	                			</div>
	                			<hr>
	                		</div>
		                </div>
		            </div>