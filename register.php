<?php 
	
	require 'database.php';
    session_start(); 


	if ( !empty($_POST)) {
		// keep track validation errors

		$usernameError = null;	
		$sizeError = null;
		$emailError = null;
		$passwordError = null;
		$imgError = null;
		$tempname = null;
		$content = null;
		
		// keep track post values

		$username = $_POST['member_username'];
		$size = $_POST['member_size'];
		$email = $_POST['member_email'];
		$password = $_POST['member_password'];
		$img = $_POST['profile_pic'];
		
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
		if($_FILES['profile_pic']['size']>0 && $_FILES['profile_pic']['size'] < 2000000){
    		$tempname = $_FILES['profile_pic']['tmp_name'];
    		$fp = fopen($tempname, 'rb');
    		$content = fread($fp, filesize($tempname));
    		fclose($fp);
    							    var_dump($_FILES);
		}

		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO Members (member_username, member_size, member_email, member_password, profile_pic) values(?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($username, $size, $email, $password, $content));

			Database::disconnect();
			header("Location: index.php");
		}
		
	}
?>


<!DOCTYPE html>
<html lang="en">
<?php
	include 'class.php';
	objectClass::headerShort();
?>

<body>
    <div class="container">
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Create an Account</h3>
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
					  <div class="control-group <?php echo !empty($imgError)?'error':'';?>">
					    <label class="control-label">Profile Pic</label>
					    <div class="controls">
 					      	<input name="profile_pic" type="file" enctype="multipart/form-data" placeholder="">
					      	<?php if (!empty($imgError)): ?>
					      		<span class="help-inline"><?php echo $imgError;?></span>
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