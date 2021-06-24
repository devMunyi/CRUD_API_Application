<?php
	if(ISSET($_GET['id'])){
		include_once 'dbconn.php';
		$id = $_GET['id'];
		$sql = "DELETE from `members` WHERE `mem_id`= $id";
		$stmt = $conn->prepare($sql);
		
		$stmt->execute();

		$conn->NULL;
		header('location:index.php');
	}
?>