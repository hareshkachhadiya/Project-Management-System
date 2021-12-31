<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900&display=swap" rel="stylesheet"> 

	<title>Project Management</title>

	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fixedHeader.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/responsive.bootstrap4.min.css">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ie7.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/sidebar.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/validate-error.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.10.0/jquery.timepicker.css">
	<script type="text/javascript">
		var base_url = '<?php echo base_url(); ?>';
	</script>
</head>
<body>
	<div class="wrapper">
	   <nav id="sidebar">
         <div class="sidebar-header">
                <h3 class="text-left logo-left"><img class="img-fluid img-logo" src="<?php echo base_url().'images/logo.png'?>" alt="pecific school of engineering"></h3>
                <strong><img class="img-fluid" src="<?php echo base_url().'images/small-logo.png'?>"></strong>
        </div>
        <?php 
            $user_type = $this->session->userdata('login')->user_type;
            if( $user_type == '0'){
        ?>
            <div class="admin-panel">Admin Panel</div>
        
        <?php 

            $this->load->view('common/sidebar'); 
             }
            else if($user_type == '1'){ 
        ?>
            <div class="admin-panel">Client Panel</div>
        <?php 
            
            $this->load->view('common/clientsidebar'); }
            else{ 
        ?>
            <div class="admin-panel">Employee Panel</div>
        <?php
            $this->load->view('common/empsidebar');
                    } 
            ?>
        </nav>
        <!-- Page Content  -->
		 
		<div id="content" class="content">
		<?php $this->load->view('common/topheader'); ?>

         <!--Chart Report .js-->
        <script src="<?php echo base_url();?>assets/js/highcharts.js"></script>
        <script src="<?php echo base_url();?>assets/js/highstock.js"></script>
        <script src="<?php echo base_url();?>assets/js/data.js"></script>
        <script src="<?php echo base_url();?>assets/js/exporting.js"></script>
        <script src="<?php echo base_url();?>assets/js/export-data.js"></script>
        <script src="<?php echo base_url();?>assets/js/accessibility.js"></script>
        <!--End Chart Report .js-->