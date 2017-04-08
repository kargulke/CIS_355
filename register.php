<?php 
	
	require 'database.php';
    session_start(); 

	if ( !empty($_POST)) {
		// keep track validation errors
		$idError = null;
		$usernameError = null;	
		$sizeError = null;
		$emailError = null;
		$passwordError = null;
		
		// keep track post values

		$username = $_POST['member_username'];
		$size = $_POST['member_size'];
		$email = $_POST['member_email'];
		$password = $_POST['member_password'];
		
		// validate input
		$valid = true;

		if (empty($username)) {
			$usernameError = 'Please enter type of event';
			$valid = false;
		}
		if (empty($size)) {
			$sizeError = 'Please enter Name';
			$valid = false;
		}
		
		if (empty($email)) {
			$emailError = 'Please enter start time';
			$valid = false;
		}
		
		if (empty($password)) {
			$passwordError = 'Please enter password';
			$valid = false;
		}

		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO Members (member_username, member_size, member_email, member_password) values(?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($username, $size, $email, $password));
			Database::disconnect();
			header("Location: index.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Create an Event</h3>
		    		</div>
	    			<form class="form-horizontal" action="register.php" method="post">
					  <div class="control-group <?php echo !empty($usernameError)?'error':'';?>">
					    <label class="control-label">Username</label>
					    <div class="controls">
					      	<input name="member_username" type="text"  placeholder="username" value="<?php echo !empty($username)?$username:'';?>">
					      	<?php if (!empty($usernameError)): ?>
					      		<span class="help-inline"><?php echo $usernameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($sizeError)?'error':'';?>">
					    <label class="control-label">Shirt size</label>
					    <div class="controls">
					      	<input name="member_size" type="text" placeholder="shirt size" value="<?php echo !empty($size)?$size:'';?>">
					      	<?php if (!empty($sizeError)): ?>
					      		<span class="help-inline"><?php echo $sizeError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
					    <label class="control-label">Email</label>
					    <div class="controls">
					      	<input name="member_email" type="text" placeholder="email" value="<?php echo !empty($member_email)?$member_email:'';?>">
					      	<?php if (!empty($emailError)): ?>
					      		<span class="help-inline"><?php echo $emialError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
					    <label class="control-label">Password</label>
					    <div class="controls">
					      	<input name="member_password" type="password"  placeholder="" value="<?php echo !empty($password)?$password:'';?>">
					      	<?php if (!empty($passwordError)): ?>
					      		<span class="help-inline"><?php echo $passwordError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>


					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>