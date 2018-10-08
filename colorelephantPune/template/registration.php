<div class="container">
	<?php if(isset($_SESSION['msg'])){ ?>
		<div class="col-lg-12" style="color:green;" id="msg"><h5 style="text-align:center"><?=$_SESSION['msg'];?></h5></div>
	<?php $_SESSION['msg']=""; 
	} ?>
	<h3><a href="index.php?page=loginForm">Login</a> | Registration</h3>
	<div class="col-xs-12 col-lg-12 col-md-12">
		<form class="form-horizontal" action="index.php?page=registrationSave" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<div class="col-xs-6 col-lg-6 col-md-6">
					<label class="control-label">Email ID<span style="color:red">*</span></label>
				</div>
				<div class="col-xs-6 col-lg-6 col-md-6">
					<input type="text" name="emailId" id="emailId" class="form-control"/>
					<span  style="color:red" id="emailIdErr"></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-offset-6 col-xs-6 col-md-6 col-lg-6">
					<input type="submit" name="register" id="register" value="Submit" onclick="return validateRegistrationForm();" class="btn btn-primary"/>
				</div>
			</div>
		</form>
	</div>
</div>
