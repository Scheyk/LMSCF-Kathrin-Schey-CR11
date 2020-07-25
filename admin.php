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

	require_once 'db_conn.php';

	// select logged-in users details
	$res = mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['admin']);
	$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

	$resPets = mysqli_query($conn, "SELECT * FROM animals");

?>

<!DOCTYPE html>
<html>
<head>
	<script
  	src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
  	crossorigin="anonymous"></script>
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>	
	<title>Home</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>

	<!-- A grey horizontal navbar that becomes vertical on small screens -->
	<nav class="navbar navbar-expand-sm bg-warning navbar-dark sticky-top">
		<!-- Logo -->
		<a class="navbar-brand" href="#">
    		<img src="img/logo.png" alt="Logo" style="width:60px;">
  		</a>
  		<!-- Links -->
  		<ul class="navbar-nav">    		
    		<li class="nav-item">
      			<a class="nav-link text-danger" href="#">Pets</a>
    		</li>
    		<li class="nav-item">
      			<a class="nav-link text-danger" href="add.php">new Pet</a>
    		</li>
    		<li class="nav-item">
      			<a class="nav-link text-danger" href="logout.php?logout">Logout</a>
    		</li>
    		<li class="nav-item">
      			<a class="nav-link text-danger" href="adminDash.php">Dashboard</a>
    		</li>	 
  		</ul>  		
	</nav>

	<!-- container start -->
	<div class="container-fluid">

		<!-- container for for welcome msg -->
		<div class="welcome mt-3">
			<p class="h2"> Hello <?php echo $userRow['userName']?>!</p>
			<p class="h4">Was steht für heute an?</p>
		</div>
				
		<!-- container for output sql start with php -->
		<div class="row justify-content-around">		
		
		<?php
		
			include 'db_conn.php';

			if(mysqli_num_rows($resPets) == 0) {
				echo "no Pets";

			}elseif (mysqli_num_rows($resPets) == 1) {
				$row = $resPets->fetch_assoc();
				echo "<div class='card self mt-3'>
							<img class='img-fluid' src='img/".$row["img"]."'>
  							<div class='card-body body'>
  								<p>".$row["name"]."</p>
  								<p>Über mich:<br>".$row["description"]."</p>
  								<p>Meine Hobbys sind:<br>".$row["hobbies"]."</p>
  								<p>Ich bin ".$row["age"]." Jahre alt</p>
  								<p>".$row["typ"]."</p>
  								<p>Bin abzuholen in:<br>".$row["fk_location_city"]."</p>
  							</div>
  							<div class='d-flex justify-content-around'>
								<a class='crud' href='update.php?id=".$row["animal_id"]."'>change</a>
								<a class='crud' href='delete.php?id=".$row["animal_id"]."'>delete</a>
  							</div>
						 </div>";

			}else {
				$rows = $resPets->fetch_all(MYSQLI_ASSOC);
				foreach ($rows as $value) {
					echo "<div class='card self mt-3'>
							<img class='img-fluid' src='img/".$value["img"]."'>
  							<div class='card-body body'>
  								<p>".$value["name"]."</p>
  								<p>Über mich:<br>".$value["description"]."</p>
  								<p>Meine Hobbys sind:<br>".$value["hobbies"]."</p>
  								<p>Ich bin ".$value["age"]." Jahre alt</p>
  								<p>".$value["typ"]."</p>
  								<p>Bin abzuholen in:<br>".$value["fk_location_city"]."</p>
  							</div>
  							<div class='d-flex justify-content-around'>
								<a class='crud' href='update.php?id=".$value["animal_id"]."'>change</a>
								<a class='crud' href='delete.php?id=".$value["animal_id"]."'>delete</a>
  							</div>
						 </div>";					       
				}
			}
		?>
		</div>
		<!-- container for output sql end with php -->				
	</div>
	<!-- container end -->


<script type="text/javascript" src="script.js"></script>
</body>
</html>
<?php ob_end_flush();?>