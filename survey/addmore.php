<?php include('server.php') ?>

<?php
	if(!empty($_POST["r_name"])){
		foreach ($_POST["r_name"] as $key => $value) {
			$sql = "INSERT INTO tagslist(r_name) VALUES ('".$value."')";
			$mysqli->query($sql);
		}
		echo json_encode(['success'=>'Names Inserted successfully.']);
	}
?>