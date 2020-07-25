<?php

	ob_start();
	session_start();
	require_once 'db_conn.php';
	
	// if session is not set this will redirect to login page
	if(!isset($_SESSION['user']) && !isset($_SESSION['admin'])){
		header("Location: index.php");
		exit;
	}
	if(isset($_SESSION['admin'])) {
		header("Location: admin.php");
		exit;
	}

	// select logged-in users details
	$res = mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['user']);
	$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

	$resPets = mysqli_query($conn, "SELECT * FROM `animals` WHERE `age` >7");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<!-- A grey horizontal navbar that becomes vertical on small screens -->
	<nav class="navbar navbar-expand-sm bg-warning navbar-dark sticky-top">
		<!-- Logo -->
		<a class="navbar-brand" href="home.php">
    		<img src="img/logo.png" alt="Logo" style="width:60px;">
  		</a>
  		<!-- Links -->
  		<ul class="navbar-nav">    		
    		<li class="nav-item">
      			<a class="nav-link text-danger" href="general.php">Teens</a>
    		</li>
    		<li class="nav-item">
      			<a class="nav-link text-danger" href="home.php">Home</a>
    		</li>
    		<li class="nav-item">
      			<a class="nav-link text-danger" href="logout.php?logout">Logout</a>
    		</li>
  		</ul>  		
	</nav>

	<!-- container start  -->
	<div class="container-fluid">

		<!-- container for welcome msg -->
		<div class="welcome mt-3">
			<p class="h2"> Welcome <?php echo $userRow['userName']?> auf unserer HomePage </p>
			<p class="h4">Hier siehst du unsere Senioren.</p>
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
							<img class='img-fluid' src='img/".$value["img"]."'>
  							<div class='card-body'>
  								<p>".$value["name"]."</p>
  								<p>Über mich: ".$value["description"]."</p>
  								<p>Meine Hobbys sind: ".$value["hobbies"]."</p>
  								<p>Ich bin ".$value["age"]." Jahre alt</p>
  								<p>".$value["typ"]."</p>
  								<p>Bin abzuholen in: ".$value["fk_location_city"]."</p>
  							</div>  							
							<a href=''>adopt</a> 							
					 </div>";

			}else {
				$rows = $resPets->fetch_all(MYSQLI_ASSOC);
				foreach ($rows as $value) {
					echo "<div class='card self mt-3'>
							<img class='img-fluid' src='img/".$value["img"]."'>
  							<div class='card-body'>
  								<p>".$value["name"]."</p>
  								<p>Über mich: ".$value["description"]."</p>
  								<p>Meine Hobbys sind: ".$value["hobbies"]."</p>
  								<p>Ich bin ".$value["age"]." Jahre alt</p>
  								<p>".$value["typ"]."</p>
  								<p>Bin abzuholen in: ".$value["fk_location_city"]."</p>
  							</div>  							
							<a href=''>adopt</a> 							
					 </div>";
				}
			}
		?>
		</div>
		<!-- container for output sql end with php -->		
	</div>
	<!-- container end -->
</body>
</html>
<?php ob_end_flush();?>