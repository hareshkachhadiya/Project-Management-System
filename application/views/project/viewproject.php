<nav aria-label="breadcrumb" class="breadcrumb-nav">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title"><i class="icon-speedometer"></i> Projects</h4>
		</div>
		 <div class="col-lg-9 col-sm -8 col-md-8 col-xs-12">
			<ol class="breadcrumb">
				<li><a href="<?php echo base_url().'dashboard' ?>">Home</a></li>
				 <li class="active">Projects</li>
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
        					<strong>Project Name</strong> <br>
    						<p class="text-muted"><?php echo !empty($projectlist[0]->projectname) ?  $projectlist[0]->projectname : ' '?></p>
        				</div>
        				<div class="col-sm-6 b-r">
        					<strong>Project Summary</strong> <br>
    						<p class="text-muted"><?php echo !empty($projectlist[0]->projectsummary	) ?  $projectlist[0]->projectsummary : ' '?></p>
        				</div>
        			</div>
        			<hr>
        			<div class="row">
        				<div class="col-sm-6 b-r">
        					<strong>Start Date</strong> <br>
    						<p class="text-muted"><?php echo !empty($projectlist[0]->startdate) ?  $projectlist[0]->startdate : ' '?></p>
        				</div>
        				<div class="col-sm-6">
        					<strong>End Date</strong> <br>
        					<p class="text-muted"><?php echo !empty($projectlist[0]->deadline) ?  $projectlist[0]->deadline : ' '?></p>
        				</div>
        			</div>
        			<hr>
        			<div class="row">
        				<div class="col-sm-6 b-r">
        					<strong>Project Category</strong> <br>
    						<p class="text-muted"><?php echo !empty($pro_category[0]->name) ?  $pro_category[0]->name : ' '?></p>
        				</div>
        				<div class="col-sm-6">
        					<strong>Note</strong> <br>
        					<p class="text-muted"><?php echo !empty($projectlist[0]->note) ?  $projectlist[0]->note : ' '?></p>
        				</div>       
        			</div>
        			<hr>
        			<div class="row">
        				<div class="col-sm-6 b-r">
        					<strong>Client Info</strong> <br>
    						<p class="text-muted"><?php echo !empty($pro_client[0]->clientname) ?  $pro_client[0]->clientname : ' '?></p>
        				</div> 
        				<div class="col-sm-6">
        					<strong>Budget Info</strong> <br>
        					<p class="text-muted"><?php echo !empty($projectlist[0]->projectbudget) ?  $projectlist[0]->projectbudget : ' '?></p>
        				</div>
        			</div>
        			<hr>
        			<div class="row">
        				<div class="col-sm-6 b-r">
        					<strong>Currency</strong> <br>
        					<?php 
        					if($projectlist[0]->currency == '0'){
        						$currency = $projectlist[0]->currency = 'Dollars (USD)';
 
        					}else if($projectlist[0]->currency == '1'){
        						$currency = $projectlist[0]->currency = 'Pounds (GBP)';

        					}else if($projectlist[0]->currency == '2'){
        						$currency = $projectlist[0]->currency = ' Euros (EUR)';
        						
        					}else if($projectlist[0]->currency == '3'){
        						$currency = $projectlist[0]->currency = 'Rupee (INR)';
        					}
        					?>
         					<p class="text-muted"><?php echo !empty($projectlist[0]->currency) ?  $projectlist[0]->currency : ' '?></p>
        				</div>
        				<div class="col-sm-6">
        					<strong>Hours Allocated</strong> <br>
        					<p class="text-muted"><?php echo !empty($projectlist[0]->hoursallocated) ?  $projectlist[0]->hoursallocated : ' '?></p>
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
        </div>
    </div>
</div>
<!-- ends of contentwrap -->

            