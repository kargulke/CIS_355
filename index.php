<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<script>
        function retrievePage() {
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    document.getElementById("body").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("GET", "https://csis.svsu.edu/~kckargul/" + "index.php", true);
            xhttp.send();
        }
    </script>
	</head>

<body onload = "retrievePage();">
    <div class="container">
    		<div class="row">
    			<h3>Events</h3>
    		</div>
			<div class="row">
				<p>
					<a href="event_create.php" class="btn btn-success">Create</a>
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
						session_start();
						include 'database.php';
						$pdo = Database::connect();
						$sql = 'SELECT * FROM Events ORDER BY event_id DESC';
						foreach ($pdo->query($sql) as $row) {
							echo '<tr>';
							echo '<td>'. $row['event_date'] . '</td>';
							echo '<td>'. $row['event_time_start'] . '</td>';
							echo '<td>'. $row['event_time_end'] . '</td>';
							echo '<td>'. $row['event_type'] . '</td>';
							echo '<td width=300>';
							echo '<a class="btn" href="event_read.php?event_id='.$row['event_id'].'">Read</a>';
							echo '&nbsp;';
							echo '<a class="btn btn-success" href="event_update.php?event_id='.$row['event_id'].'">Update</a>';
							echo '&nbsp;';
							echo '<a class="btn btn-danger" href="event_delete.php?event_id='.$row['event_id'].'">Delete</a>';
							echo '&nbsp;';
							echo '<a class="btn btn-info" href="event_RSVP_index.php?event_id='.$row['event_id'].'">RSVPs</a>';
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