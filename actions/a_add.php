<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>

	<div class="container-fluid">

<?php

	require_once '../db_conn.php';

	if($_POST){
		$name = $_POST["name"];
		$img = $_POST["img"];
		$description = $_POST["description"];
		$age = $_POST["age"];
		$hobbies = $_POST["hobbies"];
		$typ = $_POST["typ"];
		$location = $_POST["location"];

		$sql = "INSERT INTO `animals`(`name`, `img`, `description`, `age`, `hobbies`,`typ`, `fk_location_city`)
				VALUES ('$name','$img','$description','$age','$hobbies','$typ', '$location')";

		if(mysqli_query($conn, $sql)){
			echo "<div class='msg'>
					success <br>
					$name is in ouer database.
					<div>
						<img class='img-fluid' src='../img/$img'>
					</div>
					<a href='../admin.php'>back home</a>
				</div>";
		}else {
			echo "error2";
		}

		$conn->close();
	}


?>

</div>

</body>
</html>