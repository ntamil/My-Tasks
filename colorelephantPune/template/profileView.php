<div class="container">
	<?php if(isset($_SESSION['msg'])){ ?>
		<div class="col-lg-12" style="color:green;" id="msg"><h5 style="text-align:center"><?=$_SESSION['msg'];?></h5></div>
	<?php $_SESSION['msg']=""; 
	} 
	?>

	<?php
	$profileObj =new profile();
	$conn =$profileObj->connect();
	$id = $_REQUEST['id'];
	$result = $profileObj->profileViewResult($conn,$id);
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
		<form class="form-horizontal" action="index.php?page=profileRating" method="POST" enctype="multipart/form-data">
			<div class="profileForm">
			<div class="form-group">
				<div class="col-xs-6 col-lg-6 col-md-6">
				<?php if($result['message']!="No Result Found"): ?>
					<dl class="dl-horizontal">
					<?php foreach($result['list'] as $key=> $val): ?>

					<dt class="">Name : </dt>
					<dd class=""><?=$val['name'];?></dd>

					<dt class="">E-Mail Id : </dt>
					<dd class=""><?=$val['email'];?></dd>

					<dt class="">Web Address : </dt>
					<dd class=""><?=$val['web_address'];?></dd>

					<dt class="">Cover Letter : </dt>
					<dd class=""><?=$val['cover_letter'];?></dd>

					<dt class="">Like working : </dt>
					<dd class=""><?=$val['question'];?></dd>

					<dt class="">IP Address : </dt>
					<dd class=""><?=$val['ip'];?></dd>

					<dt class="">Download Attachment : </dt>
					<dd class=""><a href="<?=$val['resume_file'];?>">Click here to download</a></dd>

					<dt class="">Avg Public Rating : </dt>
					<dd class=""><?=$val['public_rating'];?></dd>

<?php 
if($_REQUEST['ref'] == 'my') {
	$ddClass='disInactive';
	$starClass = 'disInactive';
	$dtClass = 'disInactive';
} else if($val['my_rating'] != '' && $val['my_rating'] != 0) {
	$ddClass='disActive';
	$starClass = 'disInactive';
	$dtClass = '';
} else {
	$starClass='disActive';
	$ddClass = 'disInactive';
	$dtClass = 'ratingLabel';
}
	?>

					<dt class="<?=$dtClass?>">My Rating : </dt>
					<dd class="<?=$ddClass?>"><?=$val['my_rating'];?></dd>

<dd class="<?=$starClass?>">
<div id="starRateAdd">
<div class="starrate">
<fieldset class="rating">
<input id="star5" name="rating" value="5" type="radio"><label class="full" for="star5"></label>
<input id="star4half" name="rating" value="4 and a half" type="radio"><label class="half" for="star4half"></label>
<input id="star4" name="rating" value="4" type="radio"><label class="full" for="star4"></label>
<input id="star3half" name="rating" value="3 and a half" type="radio"><label class="half" for="star3half"></label>
<input id="star3" name="rating" value="3" type="radio"><label class="full" for="star3"></label>
<input id="star2half" name="rating" value="2 and a half" type="radio"><label class="half" for="star2half"></label>
<input id="star2" name="rating" value="2" type="radio"><label class="full" for="star2"></label>
<input id="star1half" name="rating" value="1 and a half" type="radio"><label class="half" for="star1half"></label>
<input id="star1" name="rating" value="1" type="radio"><label class="full" for="star1"></label>
<input id="starhalf" name="rating" value="half" type="radio"><label class="half" for="starhalf"></label>
</fieldset>
</div>
</div>
<div class="rateItBtn <?=$starClass?>">
<input type="submit" name="save" id="save" value="Rate it" onclick="return validateRating();" class="btn btn-primary"/>
</div>
</dd>
<input type="hidden" id="checkedFeedRateId" name="checkedFeedRateId"/>
<input type="hidden" id="id" name="id" value="<?=$_REQUEST['id']?>"/>
<dd><span id="ratingErrMsg"></span></dd>
					<?php endforeach; ?>
					</dl>
				<?php endif; ?>
				</div>
				</div>
				
			</div>
		</form>
	</div>
	</div>
</div>
