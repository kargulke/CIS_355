<?php 
	
	require 'database.php';
    session_start(); 

	$rsvp_eta = null;
	if ( !empty($_GET['rsvp_id'])) {
		$rsvp_id = $_REQUEST['rsvp_id'];
	}
	
	if ( null==$rsvp_id ) {
		header("Location: index.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$etaError = null;
		$etdError = null;
		
		// keep track post values
		$rsvp_eta = $_POST['rsvp_eta'];
		$rsvp_etd = $_POST['rsvp_etd'];
		
		// validate input
		$valid = true;
		if (empty($rsvp_eta)) {
			$etaError = 'Please enter Arrival';
			$valid = false;
		}
		
		if (empty($rsvp_etd)) {
			$etdError = 'Please enter Departure';
			$valid = false;
		}		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE RSVP set rsvp_eta = ?, rsvp_etd = ? WHERE rsvp_id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array( $rsvp_eta, $rsvp_etd, $rsvp_id));

			//getting the event_id from the table
			$sql = "SELECT * FROM RSVP where rsvp_id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($rsvp_id));
			$data = $q->fetch(PDO::FETCH_ASSOC);
			$event_id = $data['event_id'];
			

			Database::disconnect();
			header("Location: event_RSVP_index.php?event_id=".$event_id);
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM RSVP where rsvp_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($rsvp_id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$rsvp_etd = $data['rsvp_etd'];
		$rsvp_eta = $data['rsvp_eta'];
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
    		
	    			<form class="form-horizontal" action="event_RSVP_update.php?rsvp_id=<?php echo $rsvp_id?>" method="post">
					  <div class="control-group <?php echo !empty($etaError)?'error':'';?>">
					    <label class="control-label">eta</label>
					    <div class="controls">
					      	<input name="rsvp_eta" type="time"  placeholder="eta" value="<?php echo !empty($rsvp_eta)?$rsvp_eta:'';?>">
					      	<?php if (!empty($etaError)): ?>
					      		<span class="help-inline"><?php echo $etaError;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  <div class="control-group <?php echo !empty($etdError)?'error':'';?>">
					    <label class="control-label">etd</label>
					    <div class="controls">
					      	<input name="rsvp_etd" type="time"  placeholder="etd" value="<?php echo !empty($rsvp_etd)?$rsvp_etd:'';?>">
					      	<?php if (!empty($etdError)): ?>
					      		<span class="help-inline"><?php echo $etdError;?></span>
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