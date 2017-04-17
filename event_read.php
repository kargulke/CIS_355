<?php
	require 'database.php';
    session_start(); 
	$id = null;
	if ( !empty($_GET['event_id'])) {
		$id = $_REQUEST['event_id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM Events where event_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
	}
?> <!DOCTYPE html> <html lang="en"> 
<?php


	include 'class.php';
	objectClass::headerShort();
?>
	<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Read an Event</h3>
		    		</div>
		    		
	    			<div class="form-horizontal" >
					 <div class="control-group">
					    <label class="control-label">Name</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['event_name'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Date</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['event_date'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Start Time</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['event_time_start'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">End Time</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['event_time_end'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Location</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['event_location'];?>
						    </label>
					    </div>
					  </div>
					 <div class="control-group">
					    <label class="control-label">Event Type</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['event_type'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Description</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['event_description'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Event ID</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['event_id'];?>
						    </label>
					    </div>
					  </div>
					    <div class="form-actions">
							<button onclick="window.location='index.php'" class="btn btn-success">Back</button>
					   </div>
					</div>
				</div>
    </div> <!-- /container -->
  </body>
</html>
