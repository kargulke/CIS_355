<?php 
	
	require 'database.php';
    session_start(); 

	$event_id = null;
	if ( !empty($_GET['event_id'])) {
		$event_id = $_REQUEST['event_id'];
	}
	
	if ( null==$event_id ) {
		header("Location: index.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$nameError = null;
		$dateError = null;
		$time_startError = null;
		$time_endError = null;
		$locationError = null;
		$typeError = null;
		$descriptionError = null;
		
		// keep track post values
		$event_name = $_POST['event_name'];
		$event_date = $_POST['event_date'];
		$event_location = $_POST['event_location'];
		$event_time_start = $_POST['event_time_start'];
		$event_time_end = $_POST['event_time_end'];
		$event_description = $_POST['event_description'];
		$event_type = $_POST['event_type'];
		
		// validate input
		$valid = true;
		if (empty($event_name)) {
			$nameError = 'Please enter Name';
			$valid = false;
		}
		
		if (empty($event_date)) {
			$dateError = 'Please enter Email Address';
			$valid = false;
		}
		
		if (empty($event_location)) {
			$locationError = 'Please enter Mobile Number';
			$valid = false;
		}
		if (empty($event_time_start)) {
			$time_startError = 'Please enter Mobile Number';
			$valid = false;
		}
		if (empty($event_time_end)) {
			$time_endError = 'Please enter Mobile Number';
			$valid = false;
		}
		
		if (empty($event_description)) {
			$descriptionError = 'Please enter Mobile Number';
			$valid = false;
		}
		if (empty($event_type)) {
			$typeError = 'Please enter Mobile Number';
			$valid = false;
		}
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE Events set event_name = ?, event_date = ?, event_time_start = ?, event_time_end = ?, event_description = ?, event_type = ?, event_location = ? WHERE event_id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($event_name, $event_date, $event_time_start, $event_time_end, $event_description, $event_type, $event_location, $event_id));
			Database::disconnect();
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM Events where event_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($event_id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$event_name = $data['event_name'];
		$event_location = $data['event_location'];
		$event_time_start = $data['event_time_start'];
		$event_time_end = $data['event_time_end'];
		$event_date = $data['event_date'];
		$event_type = $data['event_type'];
		$event_description = $data['event_description'];
		Database::disconnect();
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
		    			<h3>Update a Customer</h3>
		    		</div>
    		
	    			<form class="form-horizontal" action="event_update.php?event_id=<?php echo $event_id?>" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="event_name" type="text"  placeholder="Name" value="<?php echo !empty($event_name)?$event_name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($locationError)?'error':'';?>">
					    <label class="control-label">Location</label>
					    <div class="controls">
					      	<input name="event_location" type="text" placeholder="Location" value="<?php echo !empty($event_location)?$event_location:'';?>">
					      	<?php if (!empty($locationError)): ?>
					      		<span class="help-inline"><?php echo $locationError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($dateError)?'error':'';?>">
					    <label class="control-label">Date</label>
					    <div class="controls">
					      	<input name="event_date" type="text"  placeholder="Date" value="<?php echo !empty($event_date)?$event_date:'';?>">
					      	<?php if (!empty($dateError)): ?>
					      		<span class="help-inline"><?php echo $dateError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($time_startError)?'error':'';?>">
					    <label class="control-label">Start Time</label>
					    <div class="controls">
					      	<input name="event_time_start" type="text"  placeholder="Start Time" value="<?php echo !empty($event_time_start)?$event_time_start:'';?>">
					      	<?php if (!empty($time_startError)): ?>
					      		<span class="help-inline"><?php echo $time_startError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
  					  <div class="control-group <?php echo !empty($time_endError)?'error':'';?>">
					    <label class="control-label">End Time</label>
					    <div class="controls">
					      	<input name="event_time_end" type="text"  placeholder="End Time" value="<?php echo !empty($event_time_end)?$event_time_end:'';?>">
					      	<?php if (!empty($time_endError)): ?>
					      		<span class="help-inline"><?php echo $time_endError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($typeError)?'error':'';?>">
					    <label class="control-label">Type</label>
					    <div class="controls">
					      	<input name="event_type" type="text"  placeholder="Type" value="<?php echo !empty($event_type)?$event_type:'';?>">
					      	<?php if (!empty($typeError)): ?>
					      		<span class="help-inline"><?php echo $typeError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
					    <label class="control-label">Description</label>
					    <div class="controls">
					      	<input name="event_description" type="text"  placeholder="Description" value="<?php echo !empty($event_description)?$event_description:'';?>">
					      	<?php if (!empty($descriptionError)): ?>
					      		<span class="help-inline"><?php echo $descriptionError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>