<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

//$_SESSION["username"] = $username;
//$_SESSION["password"] = $password;

if(!isset ($_SESSION['username']))
{
	require_once("login.php");
}

//$conn = hsu_conn_sess($username, $password);
/*if($conn)
{
	echo "success";
}*/
//mysqli_select_db($conn, '');
?>
<!DOCTYPE html>
<html>
	<head>
		<title> </title>
	</head>
	
	<body>
		<div class="container">
			</br><h1> Interactive Quiz </h1></br>
		<div>
			<div>
				<h3> Welcome <?php echo $_SESSION['username'];?>, you have to select only one answer for each question. Best of luck!
				</h3>
				<form method="post" action="quiz_form.php" >
				<?php
					$q = "select * 
						 from questions
						 where questions_order = 1";
					//$query = oci_parse($conn, $q);
					//oci_execute($query);
					
					while($rows = oci_fetch($query))
					{?>
						<div>
							<h4> <?php echo $rows['questions']?> </h4>
						</div>
					<?php	
						
						$q = "select * 
						 from answers
						 where answers_id = 1";
					$query = oci_parse($conn, $q);
					oci_execute($query);
					
					while($rows = oci_fetch($query))
					?>
				
					<?php
					}
				?>
				</form>
			</div>
			<a href="logout.php"> Logout </a>
		</div>
		</div>
	</body>
</html>