<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>
</title>

<link href="css/common.css" rel="stylesheet" /> 
<link href="css/bootstrap.min.css" rel="stylesheet" /> 
<link href="css/font-awesome.css" rel="stylesheet" /> 
<link href="css/dataTables.bootstrap.min.css" rel="stylesheet" /> 

<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/datatables.min.js" type="text/javascript"></script>
<script src="js/common.js" type="text/javascript"></script>

</head>
<body>
<?php 

date_default_timezone_set('Asia/Calcutta');
ini_set('display_errors','off');

session_start();

@extract($_REQUEST);

require('profileClass.php');

$profileObj =new profile();
$conn =$profileObj->connect();

if(!isset($_SESSION['userId']) || $_SESSION['userId'] == '') {
	$pages = array('login','loginForm','registration','emailVerification','registrationSave');
	if(isset($page) && !in_array($page,$pages)) {
		$profileObj->loginForm($conn);
		exit;
	}
}

if(isset($page) && $page!=''){
	if(method_exists($profileObj,$page)){
		$profileObj->$page($conn);
	}else {
		echo "<h3 style='text-align:center'>page not found</h3>";
	}
} else {
	$profileObj->loginForm($conn);
} 

$conn->close();
?>
</body>
</html>
