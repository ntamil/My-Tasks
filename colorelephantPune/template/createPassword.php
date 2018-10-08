<div class="container">
	<?php if(isset($_SESSION['msg'])){ ?>
		<div class="col-lg-12" style="color:green;" id="msg"><h5 style="text-align:center"><?=$_SESSION['msg'];?></h5></div>
	<?php $_SESSION['msg']=""; 
	if($_SESSION['verifiedStatus']==1){
		$_SESSION['msg']="already done verification";
		header("Location:index.php?page=loginForm");
		exit;
	}
	} ?>
	<h3>Create New Password</h3>
	<div class="col-xs-12 col-lg-12 col-md-12">
		<form class="form-horizontal" action="index.php?page=updatePassword" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<div class="col-xs-6 col-lg-6 col-md-6">
					<label class="control-label">Email ID</label>
				</div>
				<div class="col-xs-6 col-lg-6 col-md-6">
					<label class="control-label"><?=$_SESSION['email'];?></label>
					
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-6 col-lg-6 col-md-6">
					<label class="control-label">Password<span style="color:red">*</span></label>
				</div>
				<div class="col-xs-6 col-lg-6 col-md-6">
					<input type="password" name="password" id="password" class="form-control"/>
					<span  style="color:red" id="passwordErr"></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-offset-6 col-xs-6 col-md-6 col-lg-6">
					<input type="submit" name="save" id="save" value="Submit" onclick="return validateLoginForm('createPassword');" class="btn btn-primary"/>
				</div>
			</div>
		</form>
	</div>
</div>