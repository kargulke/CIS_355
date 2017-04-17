<!DOCTYPE html>
<html lang="en">
<?php

	include 'class.php';
	//include 'class.php';
	objectClass::headerShort();
							session_start();
?>
<body onload = "retrievePage();">
    <div class="container">
			<div class = "row">
				<p>		

					<?php
						echo "<button onclick=\"window.location='register.php'\" class='btn btn-success'>Register</button>";
						if ($_SESSION['member_username']!=null){
							echo "<button onclick=\"window.location='profile.php'\" class = 'btn btn-success'>Profile</button>";
							echo "<button onclick=\"<?php session_destroy();?> window.location='index.php'\" class = 'btn btn-success'>Logout</button>";
						} else{
							echo "<button onclick=\"window.location='login.php'\" class='btn btn-success'>LOGIN</button>";
						}
					?>
				</p>
			</div>
    		<div class="row">
    			<h3>Events</h3>
    		</div>
			<div class="row">
				<p>
					<button onclick="window.location='event_create.php'" class="btn btn-success">Create</button>
				</p>
				<table class="table table-striped table-bordered">
		            <thead>
		                <tr>
							<th>Date</th>
							<th>Start Time</th>
							<th>End Time</th>
							<th>Type</th>
							<th>Action</th>
		                </tr>
		            </thead>
					<tbody>
						<?php 
						
						include 'database.php';
						$pdo = Database::connect();
						$sql = 'SELECT * FROM Events ORDER BY event_id';
						foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
							echo '<td>'. $row['event_date'] . '</td>';
							echo '<td>'. $row['event_time_start'] . '</td>';
							echo '<td>'. $row['event_time_end'] . '</td>';
							echo '<td>'. $row['event_type'] . '</td>';
							echo '<td width=300>';
							echo "<button class='btn' onclick=\"window.location='event_read.php?event_id=".$row["event_id"]."'\">Read</button>";							
							if( !($_SESSION['member_username'] == null) )
							{	echo '&nbsp;';
								echo "<button class='btn btn-success' onclick=\"window.location='event_update.php?event_id=".$row["event_id"]."'\">Update</button>";
								echo '&nbsp;';
								echo "<button class='btn btn-danger' onclick=\"window.location='event_delete.php?event_id=".$row["event_id"]."'\">Delete</button>";
								echo '&nbsp;';
								echo "<button class='btn btn-info' onclick=\"window.location='event_RSVP_index.php?event_id=".$row["event_id"]."'\">RSVPs</button>";
							}
							echo '</td>';
							echo '</tr>';
						}
						Database::disconnect();
						?>
					</tbody>
	            </table>
				In order to update, delete, or RSVP for an event, you need to login
    	</div>
    </div> <!-- /container -->
  </body>
</html>
