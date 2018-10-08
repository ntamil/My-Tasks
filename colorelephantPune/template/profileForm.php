<div class="container">
	<?php if(isset($_SESSION['msg'])){ ?>
		<div class="col-lg-12" style="color:green;" id="msg"><h5 style="text-align:center"><?=$_SESSION['msg'];?></h5></div>
	<?php $_SESSION['msg']=""; 
	} 
	?>
	<div class="col-xs-12 col-lg-12 col-md-12">
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <a class="navbar-brand" href="#">Home</a>
		</div>
		<ul class="nav navbar-nav">
		  <li class=""><a href="index.php?page=profileList&ref=public">Public profiles</a></li>
		  <li class=""><a href="index.php?page=profileList&ref=my">My profiles</a></li>
		  <li class="active"><a href="index.php?page=profileForm">Add new profile</a></li>
		  <li class="logoutMenu"><a href="index.php?page=logout">Logout</a></li>
		</ul>
	  </div>
	</nav>
		<form class="form-horizontal" action="index.php?page=profileSave" method="POST" enctype="multipart/form-data">
			<div class="profileForm">
			<div class="form-group">
				<div class="col-xs-6 col-lg-6 col-md-6">
					<label class="control-label">Name<span style="color:red">*</span></label>
				</div>
				<div class="col-xs-6 col-lg-6 col-md-6">
					<input type="text" name="name" id="name" class="form-control"/>
					<span  style="color:red" id="nameErr"></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-6 col-lg-6 col-md-6">
					<label class="control-label">Email ID<span style="color:red">*</span></label>
				</div>
				<div class="col-xs-6 col-lg-6 col-md-6">
					<input type="text" name="email" id="email" class="form-control"/>
					<span  style="color:red" id="emailErr"></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-6 col-lg-6 col-md-6">
					<label class="control-label">Web Address<span style="color:red">*</span></label>
				</div>
				<div class="col-xs-6 col-lg-6 col-md-6">
					<input type="text" name="webAddress" id="webAddress" value="http://" class="form-control"/>
					<span  style="color:red" id="webAddressErr"></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-6 col-lg-6 col-md-6">
					<label class="control-label">Cover Letter<span style="color:red">*</span></label>
				</div>
				<div class="col-xs-6 col-lg-6 col-md-6">
					<textarea name="coverLetter" id="coverLetter" class="form-control"></textarea>
					<span  style="color:red" id="coverLetterErr"></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-6 col-lg-6 col-md-6">
					<label class="control-label">Attachment<span style="color:red">*</span></label>
				</div>
				<div class="col-xs-6 col-lg-6 col-md-6">
					<input type="file" name="file" id="file" />
					<span  style="color:red" id="fileErr"></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-6 col-lg-6 col-md-6">
					<label>Do You Like Working<span style="color:red">*</span></label>
				</div>
				<div class="col-xs-6 col-lg-6 col-md-6 checkbox">
					<input type="radio" name="question" id="question" value="Yes" checked/><label>Yes</label>
					<input type="radio" name="question" id="question" value="No"/><label>No</label>
					<span  style="color:red" id="questionErr"></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-6 col-lg-6 col-md-6">
					<label>Captcha<span style="color:red">*</span></label>
				</div>
				<div class="col-xs-6 col-lg-6 col-md-6">
					<div class="col-xs-5 col-lg-5 col-md-5">
					<input type="hidden" id="txtCaptcha">
					<input type="text" id="txtCaptchaVal" disabled="" class="form-control captchaBox">
					</div>
					<div class="col-xs-1 col-lg-1 col-md-1">
					<i class="fa fa-hand-o-right" aria-hidden="true"></i>
					</div>
					<div class="col-xs-6 col-lg-6 col-md-6">
						
						<input type="text" id="txtInput" class="form-control" placeholder="Please type a captcha"/>
					</div>
					<span  style="color:red" id="captchaErr"></span>
				</div>
				
			</div>
			<div class="form-group">
				<div class="col-lg-offset-6 col-xs-6 col-md-6 col-lg-6">
					<input type="submit" name="save" id="save" value="Submit" onclick="return validateProfileForm();" class="btn btn-primary"/>
				</div>
			</div>
		</form>
	</div>
	</div>
</div>
<script>captcha();</script>
