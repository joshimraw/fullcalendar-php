<?php 


$conn = new PDO('mysql:host=localhost; dbname=calendar', 'admin', 'Carbon@786');

if($conn){

	$query = "SELECT * FROM events ORDER BY id";
	$statement = $conn->prepare($query);
	$statement->execute();

	$result = $statement->fetchAll();
	$data = array();

	foreach($result as $row){
		$data[] = array(
			'id'			=> $row['id'],
			'title'			=> $row['title'],
			'start'			=> $row['event_start'],
			'end'			=> $row['event_end']
		);
	}

	echo json_encode($data);

}else{
	echo "Could not connected to database";
}