 <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title"><i class="icon-basket"></i> Products</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url().'dashboard'?>">Home</a></li>
                            <li class="active">Products</li>
                        </ol>
                    </div>
                </div>
            </nav>

            <!-- contetn-wrap -->
<div class="content-in">  
                <div class="row">
                    <div class="col-md-3">
                        <div class="stats-box bg-black">
			                <h3 class="box-title text-white">Total Products</h3>
			                <ul class="list-inline two-wrap">
			                    <li><i class="icon-basket text-white"></i></li>
			                    <?php
			                    	 $productArr = $this->common_model->getData('tbl_product');
                       				 $total_products = count($productArr);
			                    ?>
			                    <li class="text-right"><span id="" class="counter text-white"><?php echo  $total_products; ?></span></li>
			                </ul>
			            </div>
                    </div>

                    <div class="col-md-12">
		                <div class="stats-box">
		                	<div class="row">
		                		<div class="col-md-6">
		                			<div class="form-group">
			                            <a href="<?php  echo base_url().'products/addproducts'?>" class="btn btn-outline-success btn-sm">Add New Products <i class="fa fa-plus" aria-hidden="true"></i></a>
			                        </div>
		                		</div>
		                	</div>
		                	<?php
		                    $mess = $this->session->flashdata('message_name');
		                    if(!empty($mess)){
		                        //warning 
		                    ?>
                    	<div class="col-md-12">
                        	<div class="submit-alerts">
                            	<div class="alert alert-success" role="alert" style="display:block;">
                                <?php echo $mess; ?>
                            	</div>
                        	</div>
                    	</div>
               			 <?php } ?>
		                	<div class="table-responsive">
			                	<table class="table table-bordered" id="products">
								   	<thead>
								      	<tr role="row">
									        <th>Id</th>
									        <th>Name</th>
									        <th>Price (Inclusive All Taxes)</th>
									        <th>Action</th>
								      	</tr>
								   	</thead>
								</table>
							</div>
		                </div>
		            </div>
                </div>
            </div>
            <!-- ends of contentwrap -->