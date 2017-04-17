<?php 
	
	require 'database.php';
    session_start(); 

	if ( !empty($_POST)) {
		// keep track validation errors
		$dateError = null;
		$typeError = null;	
		$nameError = null;
		$timeStartError = null;
		$timeEndError = null;
		$locationError = null;
		$descriptionError = null;		
		
		// keep track post values
		$name = $_POST['event_name'];
		$date = $_POST['event_date'];
		$time_start = $_POST['event_time_start'];
		$time_end = $_POST['event_time_end'];
		$location = $_POST['event_location'];
		$description = $_POST['event_description'];
		$type = $_POST['event_type'];
		
		// validate input
		$valid = true;
		if (empty($date)) {
			$dateError = 'Please enter Date';
			$valid = false;
		}
		if (empty($type)) {
			$typeError = 'Please enter type of event';
			$valid = false;
		}
		if (empty($name)) {
			$nameError = 'Please enter Name';
			$valid = false;
		}
		
		if (empty($time_start)) {
			$timeStartError = 'Please enter start time';
			$valid = false;
		}
		
		if (empty($time_end)) {
			$timeEndError = 'Please enter end time';
			$valid = false;
		}
		
		if (empty($location)) {
			$locationError = 'Please enter Location';
			$valid = false;
		}
		if (empty($description)) {
			$descriptionError = 'Please enter Description';
			$valid = false;
		}
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO Events (event_date, event_time_start, event_time_end, event_location, event_type, event_name, event_description) values(?, ?, ?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($date, $time_start, $time_end, $location, $type, $name, $description));
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
		    			<h3>Create an Event</h3>
		    		</div>
	    			<form class="form-horizontal" action="event_create.php" method="post">
					  <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
					    <label class="control-label">Name</label>
					    <div class="controls">
					      	<input name="event_name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
					      	<?php if (!empty($nameError)): ?>
					      		<span class="help-inline"><?php echo $nameError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($dateError)?'error':'';?>">
					    <label class="control-label">Date</label>
					    <div class="controls">
					      	<input name="event_date" type="text"  placeholder="Date" value="<?php echo !empty($date)?$date:'';?>">
					      	<?php if (!empty($dateError)): ?>
					      		<span class="help-inline"><?php echo $dateError;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($timeError)?'error':'';?>">
					    <label class="control-label">Start Time</label>
					    <div class="controls">
					      	<input name="event_time_start" type="text" placeholder="start_time" value="<?php echo !empty($time_start)?$time:'';?>">
					      	<?php if (!empty($timeError)): ?>
					      		<span class="help-inline"><?php echo $timeError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($timeError)?'error':'';?>">
					    <label class="control-label">End Time</label>
					    <div class="controls">
					      	<input name="event_time_end" type="text" placeholder="end_time" value="<?php echo !empty($time_end)?$time:'';?>">
					      	<?php if (!empty($timeError)): ?>
					      		<span class="help-inline"><?php echo $timeError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($locationError)?'error':'';?>">
					    <label class="control-label">Location</label>
					    <div class="controls">
					      	<input name="event_location" type="text"  placeholder="Location" value="<?php echo !empty($location)?$location:'';?>">
					      	<?php if (!empty($locationError)): ?>
					      		<span class="help-inline"><?php echo $locationError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($typeError)?'error':'';?>">
					    <label class="control-label">Type</label>
					    <div class="controls">
					      	<input name="event_type" type="text"  placeholder="type" value="<?php echo !empty($type)?$type:'';?>">
					      	<?php if (!empty($typeError)): ?>
					      		<span class="help-inline"><?php echo $typeError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
					    <label class="control-label">Description</label>
					    <div class="controls">
					      	<input name="event_description" type="text"  placeholder="Description" value="<?php echo !empty($description)?$description:'';?>">
					      	<?php if (!empty($descriptionError)): ?>
					      		<span class="help-inline"><?php echo $descriptionError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>


					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <button onclick="window.location='index.php'" class="btn btn-success">Back</button>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>