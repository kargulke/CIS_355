<?php
	require 'database.php';
    session_start(); 

	$rsvp_id = 0;
	
	if ( !empty($_GET['rsvp_id'])) {
		$rsvp_id = $_REQUEST['rsvp_id'];
	}
	
	if ( !empty($_POST)) {
		// keep track post values
		$rsvp_id = $_POST['rsvp_id'];
		
		// delete data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM RSVP WHERE rsvp_id = ?".$rsvp_id;
		$q = $pdo->prepare($sql);
		$q->execute(array($rsvp_id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		Database::disconnect();
		header("Location: event_RSVP_index.php?event_id=". $data['event_id']);
	} 
?> <!DOCTYPE html> <html lang="en"> <head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script> </head> <body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Delete an RSVP</h3>
		    		</div>
		    		
	    			<form class="form-horizontal" action="event_RSVP_delete.php" method="post">
	    			  <input type="hidden" name="rsvp_id" value="<?php echo $rsvp_id;?>"/>
					  <p class="alert alert-error">Are you sure to delete ?</p>
					  <div class="form-actions">
						  <button type="submit" class="btn btn-danger">Yes</button>
						  <a class="btn" href=<?php echo "event_RSVP_index.php?event_id=". $data['event_id']?>>No</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>
