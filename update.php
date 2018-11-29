<?php

$conn = new PDO('mysql:host=localhost; dbname=calendar', 'admin', 'Carbon@786');

if(isset($_POST['id'])){
	$query = "UPDATE events
	SET title=:title, event_start=:event_start, event_end=:event_end
	WHERE id=:id";
	$statement = $conn->prepare($query);
	$statement->execute(
		array(
			':id'		=> $_POST['id'],
			':title'	=> $_POST['title'],
			':event_start' => $_POST['start'],
			':event_end'	=> $_POST['end']
		)
	);
}