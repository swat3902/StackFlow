<?php  

	session_start();
	$username='';
	$email='';
	$errors=array();
	$res='';
	$resultss='';

	$db=mysqli_connect('localhost','root','','stackoverflow');

	$record_per_page=3;
	$page='';
	if (isset($_GET["page"]))
	 {
		$page=$_GET["page"];
	}
	else
	{
		$page=1;
	}
	$start_from=($page-1)*$record_per_page;
	$query="SELECT * FROM questions order by qid DESC LIMIT $start_from,$record_per_page";
	$res=mysqli_query($db,$query);


	if (isset($_POST['register'])) {
		$username=mysql_real_escape_string($_POST['username']);
		$email=mysql_real_escape_string($_POST['email']);
		$pass1=mysql_real_escape_string($_POST['pass1']);
		$pass2=mysql_real_escape_string($_POST['pass2']);
				
		if (empty($username)) {
			array_push($errors,"Username is required");
		}

		if (empty($email)) {
			array_push($errors,"Email is required");
		}

		if (empty($pass1)) {
			array_push($errors,"Password is required");
		}

		if ($pass1!=$pass2) {
			array_push($errors,"Password do not match");
		}

		if (count($errors)==0) {
			$sql="INSERT INTO users(email,username,password)VALUES('$email','$username','$pass1')";
			$inset=mysqli_query($db,$sql);
			if ($inset>0) {
				array_push($errors,"Registraion Completed Successfully");
			}
			
		}

	}

	if (isset($_POST["login"])) {

		$username = mysql_real_escape_string($_POST['user']);
		$pass=mysql_real_escape_string($_POST['pass']);


		if (empty($username)) {
			array_push($errors,"Username is required");
		}

		if (empty($pass)) {
			array_push($errors, "Password is required");
		}

		if (count($errors)==0) {
			$query="SELECT * FROM users WHERE username='$username' AND password='$pass'";
			$result=mysqli_query($db,$query);

			if (mysqli_num_rows($result)==1) {
				$_SESSION['username']=$username;
				$_SESSION['success']="Logged In";
				header('location:Home.php');
			}
			else
			{
				array_push($errors, "Username or password is incorrect");
			}
		}
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location:Index.php");
	}

	if (isset($_POST["submit"])) {
		$ques=mysql_real_escape_string($_POST['qname']);
		$tags=mysql_real_escape_string($_POST['tags-input']);
						
		if (empty($ques)) {
			array_push($errors,"Question is required");
		}

		if (empty($tags)) {
			array_push($errors,"At least one tag is required");
		}

		if (count($errors)==0) {
			$uname=$_SESSION['username'];
			$sqlq="SELECT id FROM users WHERE username='$uname'";
			$result=mysqli_query($db,$sqlq);
			$uid=mysqli_fetch_array($result);

			$uuid=$uid['id'];
			$datetime=date('y-m-d H:i:s');
			
			$sql="INSERT INTO questions(uid,username,question,tags,datetime)VALUES('$uuid','$uname','$ques','$tags','$datetime')";
			$inset=mysqli_query($db,$sql);
			if ($inset>0) {
				array_push($errors,"Question Inserted Successfully");
				header("location:Home.php");
			}
						
		}

	}

	if (isset($_POST['anssubmit']))
	{
		$ans=$_POST['aans'];
		if (empty($ans)) 
		{
			array_push($errors, "!!!Field is required");
		}
		else
		{
			$datime=date('y-m-d  H:i:s');
			$qid=$_SESSION['qqid'];
			$username=$_SESSION['username'];
			$sql="INSERT INTO answers(qid,username,answer,datetime)VALUES('$qid','$username','$ans','$datime')";
			$ress=mysqli_query($db,$sql);
			if ($ress>0) {
				array_push($errors,"Answer submitted successfully");
				header("location:Answers.php?qid=$qid");
			}

		}
		
	}

	
 ?>