<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,900|Roboto:300,300i,400,400i,500,500i,700,700i,900&display=swap" rel="stylesheet"> 

	<title>Project Menagement - Login</title>

	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ie7.css">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/sidebar.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">

</head>
<body>
<?php
$sessData = "";
if($this->session->flashdata('sessData')){
    $sessData = $this->session->flashdata('sessData');
}
?>
	<div id="login-wrapp" class="login-block">
		<div class="login-wrapp">
			<a class="logo" href="javascript:void(0);" style="padding: 25px 0px;">
				<img class="img-fluid" src="<?php echo base_url();?>assets/images/logo.png" alt="home" style="max-width: 280px;">
			</a>
			<div class="stats-box">
				<form id="loginform" method="post" class="form-material" action="<?php echo base_url().'login/checklogin'?>"> 
					<?php
						//Success msg 
						$mess = $this->session->flashdata('successmsg');
						if(!empty($mess)){
					?>
				   	<div class="col-md-12">
						<div class="submit-alerts">
							<div class="alert alert-success" role="alert" style="display:block;">
								<?php echo $mess; ?>
							</div>
						</div>
					</div>
                    <?php } 
						//warning 
						$fmsg = $this->session->flashdata('failmsg');
						if(!empty($fmsg)){
					?>
				   	<div class="col-md-12">
						<div class="submit-alerts">
							<div class="alert alert-danger" role="alert" style="display:block;">
								<?php echo $fmsg; ?>
							</div>
						</div>
					</div>
                    <?php } ?>
					<div class="row" id="login">
						<div class="col-md-12">
							<div class="form-group">
								<label style="font-size: 18px;"><b>Email</b><span class="astric">*</span></label>
								<input type="email" id="email" class="form-control" name="email" placeholder="Email" value="<?php
                                             if(!empty($sessData)) { echo $sessData['email']; }else { echo ''; } ?>">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label style="font-size: 18px;"><b>Password</b><span class="astric">*</span></label>
								<input type="password" name="password" id="password" class="form-control" placeholder="password" value="<?php
                                             if(!empty($sessData)) { echo $sessData['password']; }else { echo ''; } ?>">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<div class="custom-control custom-checkbox my-1 mr-sm-2 float-left">
								    <input type="checkbox" class="custom-control-input" name="remember_me" id="remember_me">
								    <label class="custom-control-label" for="remember_me" style="padding-top: 2px;">Remember Me</label>
								</div>
								<!-- <a class="float-right forgot-link text-light-black" href="<?php echo base_url().'Login/forgotPassword' ?>"><i class="fa fa-lock m-r-5"></i> Forgot password?</a> -->
								<button class="float-right forgot-link text-light-black" type="button" onclick="changediv();" ><i class="fa fa-lock m-r-5"></i> Forgot password?</button>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" name="btnlogin" class="btn btn-info btn-lg btn-block rounded-4" value="Log In">
							</div>
						</div>
					</div>
					<!-- <div class="row" id="forgot" >
						<div class="col-md-12">
							<div class="form-group">
								<label style="font-size: 18px;"><b>Email</b><span class="astric">*</span></label>
								<input type="email" id="forgotemail" class="form-control" name="email" placeholder="Email" value="">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label style="font-size: 18px;"><b>Password</b><span class="astric">*</span></label>
								<input type="password" name="password" id="password" class="form-control" placeholder="password" value="">
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
								<input type="button" name="btnsave" class="btn btn-info btn-lg btn-block rounded-4" value="Change Password" onclick="forgotPassword();" >
							</div>
						</div>
					</div> -->
				</form>
					<form method="post" class="form-material" action="<?php echo base_url().'login/insertforgotData'?>" style="display: none;" id="forgotform"> 
					<?php
						//Success msg 
						$mess = $this->session->flashdata('successmsg');
						if(!empty($mess)){
					?>
				   	<div class="col-md-12">
						<div class="submit-alerts">
							<div class="alert alert-success" role="alert" style="display:block;">
								<?php echo $mess; ?>
							</div>
						</div>
					</div>
                    <?php } 
						//warning 
						$fmsg = $this->session->flashdata('failmsg');
						if(!empty($fmsg)){
					?>
				   	<div class="col-md-12">
						<div class="submit-alerts">
							<div class="alert alert-danger" role="alert" style="display:block;">
								<?php echo $fmsg; ?>
							</div>
						</div>
					</div>
                    <?php } ?>
					
				 <div class="row" >
						<div class="col-md-12">
							<div class="form-group">
								<label style="font-size: 18px;"><b>Email</b><span class="astric">*</span></label>
								<input type="email" id="forgotemail" class="form-control" name="email" placeholder="Email" value="">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label style="font-size: 18px;"><b>Password</b><span class="astric">*</span></label>
								<input type="password" name="password" id="password" class="form-control" placeholder="password" value="">
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" name="btnsave" class="btn btn-info btn-lg btn-block rounded-4" value="Change Password" >
							</div>
						</div>
					</div> 
				</form>
			</div>
		</div>
	</div>

    <script src="<?php echo base_url();?>assets/js/jquery-3.2.1.slim.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
	    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>

	<script>
	setTimeout(function(){
	   jQuery('.alert-success').hide();
	},5000);

	setTimeout(function(){
	   jQuery('.alert-danger').hide();
	},5000);
			var base_url = '<?php echo base_url(); ?>';
	function changediv() {
		$('#loginform').hide();
		$('#forgotform').show();
		var emailname = $('#email').val();
		return emailname;
	}

	/*function forgotPassword(){
		email = $('#email').val();
		alert(email);
		$.ajax({
		url : base_url+"login/insertforgotData",
        type : 'POST',
        dataType: 'file',
        data : {email: email},
        error: function() {
              alert('Something is wrong');
           },
        success: function(data){
        	//$('input[name="amount"]').val(data.amountdata);
        }
	});*/
		
	
	</script>
	<?php $a = a.val();
	echo $a;die;
	 ?>
    <!-- sidebar -->
</body>

</html>








