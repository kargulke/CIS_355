<!DOCTYPE html>
<html lang="en">
<?php

	include 'class.php';
	objectClass::headerShort();
		session_start();
?>
<body onload = "retrievePage();">
    <div class="container">
    		<div class="row">
    			<h3><?php echo $_SESSION['member_username'];?>'s Profile
				</h3>
    		</div>
			<div class="row">
				<p><button onclick="window.location='index.php'" class="btn btn-success">Home</button>
				</p>
				
				<table class="table table-striped table-bordered">
		            <thead>
		                <tr>
							<th>Event Name</th>
							<th>Date</th>
							<th>Type</th>
							<th>Action</th>
		                </tr>
		            </thead>
					<tbody>
						<?php 								
						include 'database.php';
						$pdo = Database::connect();
						
						$sql = "SELECT * FROM RSVP JOIN Events ON RSVP.event_id = Events.event_id WHERE RSVP.member_username = '" . $_SESSION['member_username']."'";

															foreach ($pdo->query($sql) as $row) {
							echo '<tr>';

							echo '<td>'. $row['event_name'] . '</td>';
							echo '<td>'. $row['event_date'] . '</td>';							
							echo '<td>'. $row['event_type'] . '</td>';
							echo '<td width=300>';
							echo "<button class='btn' onclick=\"window.location='event_read.php?event_id=".$row["event_id"]."'\">Read</button>";							
							if( !($_SESSION['member_username'] == null) )
							{
								echo '&nbsp;';
								echo "<button class='btn btn-success' onclick=\"window.location='event_update.php?event_id=".$row["event_id"]."'\">Update</button>";
								echo '&nbsp;';
								echo "<button class='btn btn-danger' onclick=\"window.location='event_delete.php?event_id=".$row["event_id"]."'\">Delete</button>";
							}
							echo '</td>';
							echo '</tr>';
						}
						Database::disconnect();

						?>
					</tbody>
	            </table>
    	</div>
    </div> <!-- /container -->
  </body>
</html>
