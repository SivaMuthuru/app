<?php
	include "db.php";
	session_start();
	date_default_timezone_set('Asia/Kolkata');
	
	if(isset($_POST["action"]) && $_POST["action"]=="add")
	{
		if(isset($_POST['request_question']) && $_POST['request_question']!='')
		{
			$question = $_POST['request_question'];
		} else {
			$question = '';
		}
		
		if(isset($_POST['guest_room_id']) && $_POST['guest_room_id']!='')
		{
			$room_id = $_POST['guest_room_id'];
		} else {
			$room_id = '';
		}
		
		if(isset($_POST['department']) && $_POST['department']!='')
		{
			$dep_id = $_POST['department'];
		} else {
			$dep_id = 0;
		}
		
		if(isset($_POST['guest_id']) && $_POST['guest_id']!='')
		{
			$guest_id = $_POST['guest_id'];
		} else {
			$guest_id = 0;
		}
		
		if(isset($_POST['location_id']) && $_POST['location_id']!='')
		{
			$location_id = $_POST['location_id'];
		} else {
			$location_id = 0;
		}
		
		if(isset($_POST['posted_by']) && $_POST['posted_by']!='')
		{
			$posted_by = $_POST['posted_by'];
		} else {
			$posted_by = 0;
		}
		$query = "INSERT INTO requests (question, room_id, status, time_to_serve, location_id, dep_id, request_date, action, request_guest_id, posted_by)
		VALUES ('".$question."', '".$room_id."', 'PENDING', 'new', '".$location_id."', '".$dep_id."', now(), 'open', '".$guest_id."', '".$posted_by."')";

		if (mysqli_query($conn, $query)) {
			$last_id = mysqli_insert_id($conn);
			echo $last_id;
		}else{
			echo 0;
		}
	
	}
?>