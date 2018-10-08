
<!DOCTYPE html>

<html>
<title>Quintype Design</title>
<!-- <link rel="stylesheet" href="design.css"> -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<head><h2><center>One Screen News Application </center></h2></head>
<body>
<div class="container">
<nav class="navbar navbar-default navbar-fixed-top">
<div class="container">
<div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><b>Qunitype News App.</b></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Menu <span class="sr-only">(current)</span></a></li>

<?php
$api2 = "http://sketches.quintype.com/api/v1/config";
$api2Json = file_get_contents($api2);
$api2Res = json_decode($api2Json,true);
$liTags = '';	 
foreach($api2Res['sections'] as $api2Key => $api2Val){
	$liTags .= "<li><a href='#''>".$api2Val['name']."</a></li>";
}
echo $liTags;
?>
</ul>
</div><!-- /.navbar-collapse -->
</nav>
</div>
<?php

$api1 = "http://sketches.quintype.com/api/v1/stories";
$api1Json = file_get_contents($api1);
$api1Res = json_decode($api1Json,true);

$imgHostName = 'http://quintype-01.imgix.net';
$storyHtml = '<div class="container" style="padding-top:10%"><div class="col-lg-12 col-sm-12 col-md-12">';
$i=1;

foreach($api1Res['stories'] as $api1Key => $api1Val) {
	if($i==4){
		$storyHtml .= '<div class="col-lg-12 col-md-12 col-sm-12">';
		$i=1;
	}
	$secArr = '';
	$storyHtml .= '<div class="col-lg-4 col-md-4 col-sm-4"><div class="thumbnail">';
	$image =''.$imgHostName.'/'.$api1Val['hero-image-s3-key'].'';
	$storyHtml.='<img src="'.$image.'" alt="'.$api1Val['headline'].'">';
	$storyHtml.= '<div class="caption"><h3>'.$api1Val['headline'].'</h3>';
	$storyHtml.='<p><ul><li> Author-name : '.$api1Val['author-name'].'</li>';
	foreach($api1Val['sections'] as $secKey => $secVal){
		$secArr[] = $secVal['name'];
	}
	$storyHtml.='<li> Section(s) : '.implode(',',$secArr).'</li></ul></p></div></div></div>';
	if($i==3){
		$storyHtml .= '</div>';
	}
	$i++;
}
$storyHtml .= '</div>';
echo $storyHtml;
?>

</div><!-- /.container-fluid -->
</body></html>