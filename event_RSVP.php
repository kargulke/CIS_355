<?php 
	
	require 'database.php';
    session_start(); 	
	
	$event_id = null;
	if ( !empty($_GET['event_id'])) {
		$event_id = $_REQUEST['event_id'];
	
	}
	if ( !empty($_POST)) {
		// keep track validation errors
		$timeError = null;
		
		// keep track post values
		$rsvp_eta = $_POST['rsvp_eta'];
		$rsvp_etd = $_POST['rsvp_etd'];
		
		// validate input
		$valid = true;
		if (empty($rsvp_eta)) {
			$timeError = 'Please enter start time';
			$valid = false;
		}
		
		if (empty($rsvp_etd)) {
			$timeError = 'Please enter end time';
			$valid = false;
		}
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO RSVP (event_id, rsvp_eta, rsvp_etd, member_username) values(?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($event_id, $rsvp_eta, $rsvp_etd, "kevin" ));//This will be fixed later on
			Database::disconnect();
			header("Location: event_RSVP_index.php?event_id=". $event_id);
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
		    			<h3>When you plan on RVSPing</h3>
		    		</div>
	    			<form class="form-horizontal" action="event_RSVP.php?event_id=<?php echo $event_id?>" method="post">
					  <div class="control-group <?php echo !empty($timeError)?'error':'';?>">
					    <label class="control-label">Estimated Time of Arrival</label>
					    <div class="controls">
					      	<input name="rsvp_eta" type="time" placeholder="start_time" value="<?php echo !empty($rsvp_eta)?$rsvp_eta:'';?>">
					      	<?php if (!empty($timeError)): ?>
					      		<span class="help-inline"><?php echo $timeError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($timeError)?'error':'';?>">
					    <label class="control-label">Estimated Time of Departure</label>
					    <div class="controls">
					      	<input name="rsvp_etd" type="time" placeholder="end_time" value="<?php echo !empty($rsvp_etd)?$rsvp_etd:'';?>">
					      	<?php if (!empty($timeError)): ?>
					      		<span class="help-inline"><?php echo $timeError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="<?php echo "event_RSVP_index.php?event_id=". $event_id?>">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>