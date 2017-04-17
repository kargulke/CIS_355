<?php
	include 'database.php';
	$pdo = Database::connect();
	if($_GET['member_id']){
		$sql = "SELECT * FROM Members WHERE member_id=" . $_GET['member_id']; 			
	} else {
		$sql = "SELECT * FROM Members";
	}
	$arr = array();
	foreach ($pdo->query($sql) as $row){
		array_push($arr, $row['member_id']);
	}
	Database::disconnect();
	//print_r($arr);
	echo '{"IDs":' . json_encode($arr) . '}';
?>