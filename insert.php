<?php

$conn = new PDO('mysql:host=localhost; dbname=calendar', 'admin', 'Carbon@786');

if(isset($_POST['title'])){
	$query = "INSERT INTO events(title, event_start, event_end)
	VALUES(:title, :event_start, :event_end)";

	$statement = $conn->prepare($query);
	$statement->execute(
		array(
			':title'		=> $_POST['title'],
			':event_start'	=> $_POST['start'],
			':event_end'	=> $_POST['end']
		)
	);
}