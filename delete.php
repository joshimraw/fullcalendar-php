<?php

$conn = new PDO('mysql:host=localhost; dbname=calendar', 'admin', 'Carbon@786');

if(isset($_POST['id'])){
	$query = "DELETE FROM events WHERE id = :id";
	$statement = $conn->prepare($query);
	$statement->execute(
		array( ':id' => $_POST['id'])
	);
}