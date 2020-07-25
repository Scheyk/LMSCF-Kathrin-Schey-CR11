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

	include 'db_conn.php';	

	//sql for user
	$res = mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['admin']);
	$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

	//sql for animals age and typ start
	$sql_animal_sm = mysqli_query($conn, "SELECT COUNT(animal_id) FROM `animals` WHERE `typ` = 'sm'");
	$row_sm = mysqli_fetch_array($sql_animal_sm, MYSQLI_ASSOC);
	$sql_animal_sm = mysqli_query($conn, "SELECT COUNT(animal_id) FROM `animals` WHERE `typ` = 'sm' AND  AGV(`age`)");	

	$sql_animal_lg = mysqli_query($conn, "SELECT COUNT(animal_id) FROM `animals` WHERE `typ` = 'lg'");
	$row_lg = mysqli_fetch_array($sql_animal_lg, MYSQLI_ASSOC);

	$sql_animal_senior = mysqli_query($conn, "SELECT COUNT(animal_id) FROM `animals` WHERE `age` >7");
	$row_senior = mysqli_fetch_array($sql_animal_senior, MYSQLI_ASSOC);

	$sql_animal_ges = mysqli_query($conn, "SELECT COUNT(animal_id) FROM `animals`");
	$row_animal_ges = mysqli_fetch_array($sql_animal_ges, MYSQLI_ASSOC);
	//sql for animals age and typ end

	//sql for animals location start
	$sql_loc_w = mysqli_query($conn, "SELECT COUNT(animal_id) FROM `animals` WHERE `fk_location_city` = 'Wien'");
	$row_w = mysqli_fetch_array($sql_loc_w, MYSQLI_ASSOC);

	$sql_loc_b = mysqli_query($conn, "SELECT COUNT(animal_id) FROM `animals` WHERE `fk_location_city` = 'Burgenland'");
	$row_b = mysqli_fetch_array($sql_loc_b, MYSQLI_ASSOC);

	$sql_loc_t = mysqli_query($conn, "SELECT COUNT(animal_id) FROM `animals` WHERE `fk_location_city` = 'Traiskirchen'");
	$row_t = mysqli_fetch_array($sql_loc_t, MYSQLI_ASSOC);

	$sql_loc_v = mysqli_query($conn, "SELECT COUNT(animal_id) FROM `animals` WHERE `fk_location_city` = 'Vösendorf'");
	$row_v = mysqli_fetch_array($sql_loc_v, MYSQLI_ASSOC);
	//sql for animals location end

	//sql for users start
	$sql_users_user = mysqli_query($conn, "SELECT COUNT(user_id) FROM `users` WHERE `status`= 'user'");
	$row_user = mysqli_fetch_array($sql_users_user, MYSQLI_ASSOC);

	$sql_users_admin = mysqli_query($conn, "SELECT COUNT(user_id) FROM `users` WHERE `status`= 'admin'");
	$row_admin = mysqli_fetch_array($sql_users_admin, MYSQLI_ASSOC);

	$sql_users_ges = mysqli_query($conn, "SELECT COUNT(user_id) FROM `users`");
	$row_users_ges = mysqli_fetch_array($sql_users_ges, MYSQLI_ASSOC);
	//sql for users end

	// $sql_w = mysqli_query($conn, "SELECT COUNT(loc_id) FROM `locations` WHERE `city` = 'Wien'");
	// $row_w = mysqli_fetch_array($sql_w, MYSQLI_ASSOC);

	// $sql_b = mysqli_query($conn, "SELECT COUNT(loc_id) FROM `locations` WHERE `city` = 'Burgenland'");
	// $row_b = mysqli_fetch_array($sql_b, MYSQLI_ASSOC);

	// $sql_t = mysqli_query($conn, "SELECT COUNT(loc_id) FROM `locations` WHERE `city` = 'Traiskirchen'");
	// $row_t = mysqli_fetch_array($sql_t, MYSQLI_ASSOC);

	// $sql_v = mysqli_query($conn, "SELECT COUNT(loc_id) FROM `locations` WHERE `city` = 'Vösendorf'");
	// $row_v = mysqli_fetch_array($sql_v, MYSQLI_ASSOC);

	// $sql_ges = mysqli_query($conn, "SELECT COUNT(loc_id) FROM `locations`");
	// $row_ges = mysqli_fetch_array($sql_ges, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>	
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<!-- A grey horizontal navbar that becomes vertical on small screens -->
	<nav class="navbar navbar-expand-sm bg-warning navbar-dark sticky-top">
		<!-- Logo -->
		<a class="navbar-brand" href="admin.php">
    		<img src="img/logo.png" alt="Logo" style="width:60px;">
  		</a>
  		<!-- Links -->
  		<ul class="navbar-nav">    		
    		<li class="nav-item">
      			<a class="nav-link text-danger" href="admin.php">CRUD</a>
    		</li>
    		<li class="nav-item">
      			<a class="nav-link text-danger" href="add.php">new Pet</a>
    		</li>
    		<li class="nav-item">
      			<a class="nav-link text-danger" href="logout.php?logout">Logout</a>
    		</li>
  		</ul>  		
	</nav>

 <!--  container start -->
	<div class="container">
		<div class="welcome mt-3">
			<p class="h2"> Hello <?php echo $userRow['userName']?></p>
			<p class="h4">Das ist dein Dashboard! :) </p>
		</div>		
		<div class="main row justify-content-around">
			<div class="dash mt-3">						
				<table class='table-sm'>
    				<thead>
      					<tr>
        					<th>Pets</th>
      					</tr>
    				</thead>
    				<tbody>
      					<tr>
        					<td>small Pets</td>
        					<td><?php echo $row_sm['COUNT(animal_id)']?></td>        					
      					</tr>
      					<tr>
      						<td>large Pets</td>
        					<td><?php echo $row_lg['COUNT(animal_id)']?></td>						
      					</tr>
      					<tr>
      						<td>Seniors</td>
        					<td><?php echo $row_senior['COUNT(animal_id)']?></td>						
      					</tr>
      					<tr>
      						<td>Pets gesammt</td>
        					<td><?php echo $row_animal_ges['COUNT(animal_id)']?></td>						
      					</tr>      					
    				</tbody>
  				</table>  								
			</div>

			<div class="dash mt-3">
				<table class='table-sm'>
    				<thead>
      					<tr>
        					<th>Pets at locations</th>
      					</tr>
    				</thead>
    				<tbody>
      					<tr>
        					<td>How many Pets in Vienna:</td>
        					<td><?php echo $row_w['COUNT(animal_id)']?></td>        					
      					</tr>
      					<tr>
      						<td>How many Pets in Burgenland:</td>
        					<td><?php echo $row_b['COUNT(animal_id)']?></td>						
      					</tr>
      					<tr>
      						<td>How many Pets in Traiskirchen</td>
        					<td><?php echo $row_t['COUNT(animal_id)']?></td>						
      					</tr>
      					<tr>
      						<td>how many Pets in Vösendorf</td>
        					<td><?php echo $row_v['COUNT(animal_id)']?></td>						
      					</tr>      					      					
    				</tbody>
  				</table>				
			</div>
			<div class="dash mt-3">
				<table class='table-sm'>
    				<thead>
      					<tr>
        					<th>Users</th>
      					</tr>
    				</thead>
    				<tbody>
      					<tr>
        					<td>Registriert als User:</td>
        					<td><?php echo $row_user['COUNT(user_id)']?></td>        					
      					</tr>
      					<tr>
      						<td>Registriert als Admin:</td>
        					<td><?php echo $row_admin['COUNT(user_id)']?></td>						
      					</tr>
      					<tr>
      						<td>Gesammt Useranzahl</td>
        					<td><?php echo $row_users_ges['COUNT(user_id)']?></td>						
      					</tr>					      					
    				</tbody>
  				</table>
			</div>
			<!-- <div class="dash">
				<table class='table-sm'>
    				<thead>
      					<tr>
        					<th>Locations</th>
      					</tr>
    				</thead>
    				<tbody>
      					<tr>
        					<td>Location Wien:</td>
        					<td><?php echo $row_w['COUNT(loc_id)']?></td>        					
      					</tr>
      					<tr>
      						<td>Location Burgenland:</td>
        					<td><?php echo $row_b['COUNT(user_id)']?></td>						
      					</tr>
      					<tr>
      						<td>Location Vösendorf:</td>
        					<td><?php echo $row_v['COUNT(user_id)']?></td>						
      					</tr>
      					<tr>
      						<td>Location Traiskirchen:</td>
        					<td><?php echo $row_t['COUNT(user_id)']?></td>						
      					</tr>
      					<tr>
      						<td>Gesammt:</td>
        					<td><?php echo $row_ges['COUNT(user_id)']?></td>						
      					</tr>					      					
    				</tbody>
  				</table>
			</div> -->
			
		</div>	
		<!-- main end -->
	</div>
	<!-- container end -->
</body>
</html>
<?php ob_end_flush();?>