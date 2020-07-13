<!DOCTYPE html>
<html>
<head>
	<title> Login </title>
</head>

<body>
	<div class="container">
		</br><h1>Welcome!! Enter information to start quiz</h1></br>
		<div class="row">
			<div class="column">
				<h2> Login Form</h2>
				<!-- create the desired Oracle log-in form -->
				<form method="post"
					action="validation.php">   
					<div class="form-group">
						<label> username: </label></br>
						<input type="text" name="user" class="form-control"/>
					</div>
						
					<div class="form-group">
						<label> password: </label></br>
						<input type="password" name="password" class="form-control"/>
					</div>
						
						<input type="submit" value="login" />
				</form>
			</div>
			
			<div class="column">
				<h2> Signin Form</h2>
				<form method="post"
					action="registration.php">   
					<div class="form-group">
						<label> username: </label></br>
						<input type="text" name="user" class="form-control"/>
					</div>
						
					<div class="form-group">
						<label> password: </label></br>
						<input type="password" name="password" class="form-control"/>
					</div>
						
						<input type="submit" value="login" />
				</form>
			</div>
			
		</div>
	</div>
</body>
</html>