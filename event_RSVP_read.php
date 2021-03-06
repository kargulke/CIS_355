<?php
	require 'database.php';
    session_start(); 

	$id = null;
	if ( !empty($_GET['rsvp_id'])) {
		$id = $_REQUEST['rsvp_id'];
	}
	
	if ( null==$id ) {
		header("Location: event_RSVP_index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM RSVP where rsvp_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
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
		    			<h3>Read an RSVP</h3>
		    		</div>
		    		
	    			<div class="form-horizontal" >
					  <div class="control-group">
					    <label class="control-label">RSVP ID</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['rsvp_id'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Estimated Time of Arrival</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['rsvp_eta'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">Estimated Time of Departure</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['rsvp_etd'];?>
						    </label>
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">username</label>
					    <div class="controls">
					      	<label class="checkbox">
						     	<?php echo $data['member_username'];?>
						    </label>
					    </div>
					  </div>
					    <div class="form-actions">
						  <a class="btn" href=<?php echo "event_RSVP_index.php?event_id=". $data['event_id']?>>Back</a>
					   </div>
					</div>
				</div>
    </div> <!-- /container -->
  </body>
</html>
