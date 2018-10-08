<?php
//session_start(); 
class profile {
	protected $dbname="profile";
	protected $username="";
	protected $password="";
	protected $host="localhost";

	protected $mailUserName="";
	protected $mailPassword="";
	function __contruct(){
	
	}

/* MySQL Connection */

	function connect(){
		$conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		return $conn;
	}

/* Profile page redirection */

	function profileForm(){
		$this->view('profileForm');
	}

/*
 * New profile save logic
 */

	function profileSave($conn){
		
		@extract($_REQUEST);
		
		if(!is_dir(dirname(__FILE__).'/upload')){
			mkdir(dirname(__FILE__).'/upload');
			chmod(dirname(__FILE__).'/upload','0777');
		}
		$upload_dir='upload/';
		$path =$upload_dir.$_FILES['file']['name'];
		$userId = $_SESSION['userId'];
		$ipAddress =$this->get_client_ip();
		$time =microtime(true);
		copy($_FILES['file']['tmp_name'],$path);
		$query ="insert into profile (user_id,name,email,web_address,cover_letter,question,resume_file,ip,timestamp)
		values('".$userId."','".$name."','".$email."','".$webAddress."','".$coverLetter."','".$question."','".$path."','".$ipAddress."','".$time."')";
		if($conn->query($query)){
			$_SESSION['msg'] ="Profile successfully saved";
			header("Location:index.php?page=profileList&ref=my");
			exit;
		}	
	}

/*
 * Getting client ip address with different possibilities
 */

	function get_client_ip() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

/*
 * Login authentication process and session set up
 */
	function login($conn){
		@extract($_REQUEST);
		$query ="select user.role,id from user where email='".$emailId."' and 	password='".$password."'";
		$result =$conn->query($query);
		if($result->num_rows > 0){
			$_SESSION['userId']=$result->fetch_object()->id;
			$_SESSION['roleId']=$result->fetch_object()->role;
			$_SESSION['isLoggedIn']=true;
			if($result->fetch_object()->role==1)
				header("Location:index.php?page=profileList&ref=public");
			else 
				header("Location:index.php?page=profileList&ref=my");
			exit;
		} else {
			$_SESSION['msg']="Invaild email id or password";
			header("Location:index.php?page=loginForm");
			exit;
		}
	}
	function registration(){
		$this->view('registration');
	}

/*
 *  Database update for one time link generation
 *  Mail send to user email id with the activation link
 */
	function registrationSave($conn){
		@extract($_REQUEST);
		$query ="select email,id,verified_status from user where email='".$emailId."' AND ( encryption_key != '' OR verified_status = '1' )";
		$result =$conn->query($query);
		if($result->num_rows > 0){
			$_SESSION['msg']="mail id already registered";
			header("Location:index.php?page=registration");
			exit;
		} else {
			$str ="abcdefghijklmnopqrstuvwxyz1234567890";
			$encKey =substr(str_shuffle($str),0,10);
			$query ="insert into user (email,role,encryption_key)values('".$emailId."','2','".$encKey."')";
			if($conn->query($query)){
				$scriptName =explode("?",$_SERVER['REQUEST_URI']);
				require dirname(__FILE__).'/library/PHPMailer/PHPMailerAutoload.php';
				$mail = new PHPMailer;
				$mail->isSMTP();                                      // Set mailer to use SMTP
				$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
				$mail->SMTPAuth = true;                               // Enable SMTP authentication
				$mail->Username = $this->mailUserName;                 // SMTP username
				$mail->Password = $this->mailPassword;                           // SMTP password
				$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 465;                                    // TCP port to connect to

				$mail->setFrom($this->mailUserName);
				$mail->addAddress($emailId);     // Add a recipient
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Email Verification - Color Elephant Dev Portal';
				$mail->Body    = "Hi, <br><br>
Thanks for registering at our portal. <br><br>
Please click on the below link to activate and complete your registration process. <br><br><br>
http://".$_SERVER['HTTP_HOST'].$scriptName[0]."?page=emailVerification&q=".$encKey." <br><br><br>
Regards, <br>
Tamilvanan - Colorelephant Testing Team";
				if(!$mail->send()) {
					$_SESSION['msg']="Mail server down. Please try after some time.";
					header("Location:index.php?page=registration");
				} else {
					$_SESSION['msg']="Please Check your inbox or spam folder for activating your account";
					header("Location:index.php?page=loginForm");
				}
				exit;
			}
		}
	}

/* 
 * Profile list page result
 */
 
	function profileListResult($conn){
		$userId = $_SESSION['userId'];
		if($_REQUEST['ref'] == 'my')
			$op = '=';
		else
			$op = '!=';
		$query ="select profile_id,name,email,web_address,cover_letter,question from profile where user_id $op '".$userId."'";
		$result =$conn->query($query);
		$resultSet = array();
		$i = 0;
		if($result->num_rows > 0){
			while($row = $result->fetch_object()) {
				$resultSet[$i]['id'] = $row->profile_id;
				$resultSet[$i]['name'] = $row->name;
				$resultSet[$i]['email'] = $row->email;
				$resultSet[$i]['web_address'] = $row->web_address;
				$resultSet[$i]['cover_letter'] = $row->cover_letter;
				$resultSet[$i]['question'] = $row->question;
				$i++;
			}
		}
		if(count($resultSet) > 0) {
			$resultArr['message'] = 'success';
			$resultArr['list'] = $resultSet;
		} else
			$resultArr['message'] = 'No Result Found';
		return $resultArr;
	}

/*
 * Individual profile view with document download link and rating provision
 * Rating can't be done for own profiles
 * Rating can be done for public profiles / other profiles
 */

	function profileViewResult($conn,$id){
		$userId = $_SESSION['userId'];
		$query ="select profile.profile_id,name,email,web_address,cover_letter,question,ip,resume_file,
				ROUND(AVG(public_review.rating),1) as 'public_rating',
				my_review.rating as 'my_rating'
				from profile
				left join reviews as public_review ON public_review.profile_id = profile.profile_id
				left join reviews as my_review ON ( my_review.profile_id = profile.profile_id
				AND my_review.user_id = '".$userId."' )
				where profile.profile_id = '".$id."'";
		$result =$conn->query($query);
		$resultSet = array();
		$i = 0;
		if($result->num_rows > 0){
			while($row = $result->fetch_object()) {
				$resultSet[$i]['id'] = $row->profile_id;
				$resultSet[$i]['name'] = $row->name;
				$resultSet[$i]['email'] = $row->email;
				$resultSet[$i]['web_address'] = $row->web_address;
				$resultSet[$i]['cover_letter'] = $row->cover_letter;
				$resultSet[$i]['question'] = $row->question;
				$resultSet[$i]['ip'] = $row->ip;
				$resultSet[$i]['resume_file'] = $row->resume_file;
				$resultSet[$i]['public_rating'] = $row->public_rating;
				$resultSet[$i]['my_rating'] = $row->my_rating;
				$i++;
			}
		}
		if(count($resultSet) > 0) {
			$resultArr['message'] = 'success';
			$resultArr['list'] = $resultSet;
		} else
			$resultArr['message'] = 'No Result Found';
		return $resultArr;
	}

/*
 * OTP mail link verification process
 */

	function emailVerification($conn){
		@extract($_REQUEST);
		$query ="select email,id,verified_status from user where encryption_key='".$q."'";
		$result =$conn->query($query);
		if($result->num_rows > 0){
			while($row = $result->fetch_object()) {
				//session_destroy();
				$update="update user set encryption_key='',verified_status=0 where id='".$row->id."'";
				$conn->query($update);
				$_SESSION['email']=$row->email;
				$_SESSION['userId']=$row->id;
			}
			header("Location:index.php?page=createPassword");
			exit;
		} else {
			echo "<h3 style='text-align:center'>This link valid one time only.</h3>"; 
		}
	}

/*
 * Creation of password - Page redir
 */

	function createPassword($conn){
		$query ="select verified_status from user where id='".$_SESSION['userId']."'";
		$result =$conn->query($query);
		$_SESSION['verifiedStatus']=$result->fetch_object()->verified_status;
		$this->view('createPassword');
	}

/*
 * Updation of password - Page redir
 */
	function updatePassword($conn){
		@extract($_REQUEST);
		$update="update user set password='".$password."',verified_status=1 where id='".$_SESSION['userId']."'";
		if($conn->query($update)){
			$_SESSION['msg'] ="Account successfully created. Please login to create and view profiles";
			header('Location:index.php?page=loginForm');
			exit;
		}
	}
	
/*
 * Rating update
 */
 
	function profileRating($conn){
		@extract($_REQUEST);
		$userId = $_SESSION['userId'];
		$profileId = $_REQUEST['id'];
		$time =microtime(true);
		$query ="insert into reviews (profile_id,user_id,rating,timestamp)values('".$profileId."','".$userId."','".$checkedFeedRateId."','".$time."')";
		if($conn->query($query)){
			$_SESSION['msg'] ="Rating star updated successfully";
			header('Location:index.php?page=profileList&ref=public');
			exit;
		}
	}

	function loginForm($conn){
		$this->view('login');
	}
	function profileList($conn){
		$getKey['ref'] = $_REQUEST['ref'];
		$this->view('profileList',$getKey);
	}
	function profileView($conn){
		$this->view('profileView');
	}

/*
 * View - public function to get the all pages based on page get key
 */
	function view($template,$getKey=''){
		if($getKey != '')
			$getStr = implode('=',$getKey);
		require(dirname(__FILE__).'/template/'.$template.'.php');
	}

/*
 * Logout - Session clear
 */
	function logout(){
		session_destroy();
		header("Location:index.php?page=loginForm");
		exit;
	}
}
?>
