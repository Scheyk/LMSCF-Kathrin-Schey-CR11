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

			ob_start();
			session_start();
			
			// if session is not set this will redirect to login page
			if(!isset($_SESSION['admin']) && !isset($_SESSION['user'])){
			 header("Location: index.php");
			 exit;
			}	
			if(isset($_SESSION['user'])) {
				header("Location: home.php");
				exit;
			}
		
			require_once '../db_conn.php';
		
			if(($_POST)) {
				$id = $_POST["id"];
				$name = $_POST["name"];
				$img = $_POST["img"];
				$description = $_POST["description"];
				$age = $_POST["age"];
				$hobbies = $_POST["hobbies"];
				$typ = $_POST["typ"];
				$location = $_POST["location"];
		
					$sql = "UPDATE `animals` SET `name`='$name',`img`='$img',`description`='$description',`age`='$age',`hobbies`='$hobbies',`typ`='$typ',`fk_location_city`='$location' WHERE animal_id ='{$id}'";		
		
						if(mysqli_query($conn,$sql)) {
							echo "<div class='msg'>
									success <br>
									$name is updatet :) 
									<div>
										<img class='img-fluid' src='../img/$img'>
									</div>
							 	  	<a href='../admin.php'>back home</a>
							 	  </div>";
						} else {
							echo error3;
						}
		
						$conn->close();
					}
			?>	
				
	</div>

</body>
</html>

