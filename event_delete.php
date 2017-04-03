<?php
	require 'database.php';
    session_start(); 

	
	$event_id = 0;
	
	if ( !empty($_GET['event_id'])) {
		$event_id = $_REQUEST['event_id'];
	}
	
	if ( !empty($_POST)) {
		// keep track post values
		$event_id = $_POST['event_id'];
		
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM Events WHERE event_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($event_id));
		$sql = "DELETE FROM RSVP WHERE event_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($event_id));
		Database::disconnect();
		header("Location: index.php");
		
	} 
?> <!DOCTYPE html> <html lang="en"> <head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script> </head> <body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Delete an Event</h3>
		    		</div>
		    		
	    			<form class="form-horizontal" action="event_delete.php" method="post">
	    			  <input type="hidden" name="event_id" value="<?php echo $event_id;?>"/>
					  <p class="alert alert-error">Are you sure to delete ?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Yes</button>
						  <a class="btn" href="index.php">No</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>