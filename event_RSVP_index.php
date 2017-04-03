<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    		<div class="row">
    			<h3>Event's RSVPs</h3>
    		</div>
			<div class="row">
				
				<table class="table table-striped table-bordered">
		              <thead>
		                <tr>
		                  <th>Arrival</th>
		                  <th>Departrue</th>
		                  <th>Username</th>
						  <th>Action</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php 
						$id = null;
						if ( !empty($_GET['event_id'])) {
							$id = $_REQUEST['event_id'];
						
						}
					   include 'database.php';
						session_start(); 

					   $pdo = Database::connect();
					   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					   $sql = "SELECT * FROM RSVP where event_id = ". $id;
	 				   foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
							echo '<td>'. $row['rsvp_eta'] . '</td>';
							echo '<td>'. $row['rsvp_etd'] . '</td>';
							echo '<td>'. $row['member_username'] . '</td>';
							echo '<td width=300>';
							echo '<a class="btn" href="event_RSVP_read.php?rsvp_id='.$row['rsvp_id'].'">Read</a>';
							echo '&nbsp;';
							echo '<a class="btn btn-success" href="event_RSVP_update.php?rsvp_id='.$row['rsvp_id'].'">Update</a>';
							echo '&nbsp;';
							echo '<a class="btn btn-danger" href="event_RSVP_delete.php?rsvp_id='.$row['rsvp_id'].'">Delete</a>';
							echo '</td>';
							echo '</tr>';
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
									  <div class="form-actions">
					<a href=<?php echo "event_RSVP.php?event_id=". $id;?> class="btn btn-success">Create</a>
						  <a class="btn" href="index.php">Back</a>
						</div>
    	</div>
    </div> <!-- /container -->
  </body>
</html>
