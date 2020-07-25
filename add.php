<?php

	ob_start();
	session_start();
	require_once 'db_conn.php';
	
	// if session is not set this will redirect to login page
	if(!isset($_SESSION['admin']) && !isset($_SESSION['user'])){
	 header("Location: index.php");
	 exit;
	}
	if(isset($_SESSION['user'])) {
		header("Location: home.php");
		exit;
	}

  $res = mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['admin']);
  $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>new Pet</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<!-- A grey horizontal navbar that becomes vertical on small screens -->
	<nav class="navbar navbar-expand-sm bg-warning navbar-dark sticky-top ">
		<!-- Logo -->
		<a class="navbar-brand" href="admin.php">
    		<img src="img/logo.png" alt="Logo" style="width:60px;">
  		</a>
  		<!-- Links -->
  		<ul class="navbar-nav"> 
    		<li class="nav-item">
      			<a class="nav-link text-danger" href="admin.php">home</a>
    		</li> 
        <li class="nav-item">
            <a class="nav-link text-danger" href="adminDash.php">Dashboard</a>
        </li>    		
    		<li class="nav-item">
      			<a class="nav-link text-danger" href="logout.php?logout">Logout</a>
    		</li>
  		</ul>  		
  	</nav>

    <!-- container start -->
  	<div class="container-fluid">

      <!--  container welcome msg start -->
    <div class="welcome mt-3">
      <p class="h2">
        Hello <?php echo $userRow['userName']?>
          <br>
        leider weider mal zeit ein Fündling aufzunehmen...
        </p>     
    </div>
    <!--  container welcome msg end -->

      <!-- container form start -->
  		<div class="back mt-3">
  			<form action="actions/a_add.php" method="post">
  				<input type="hidden" name="id">
				<div class="form-group">
    				<label for="name">Name:</label>
    				<input type="text" class="form-control" name="name">
  				</div>
  				<div class="form-group">
    				<label for="img">Img:</label>
    				<input type="text" class="form-control" name="img">
  				</div>
  				<div class="form-group">
    				<label for="description">Description:</label>
    				<textarea rows="4" class="form-control" name="description"></textarea>    				
  				</div>
  				<div class="form-group">
    				<label for="age">Age:</label>
    				<input type="number" class="form-control" name="age">
  				</div>
  				<div class="form-group">
    				<label for="hobbies">Hobbys:</label>
    				<input type="text" class="form-control" name="hobbies">
  				</div>
  				<div class="form-group">
    				<label for="typ">Typ:</label>
					<select name="typ" id="typ">
						<option value="sm">small</option>
						<option value="lg">large</option>
					</select>    
  				</div>
  				<div class="form-group">
    				<label for="location">Location:</label>
    				<input type="text" class="form-control" name="location">
  				</div>  
  				<button type="submit" name="submit">go!</button>
  			</form>
  		</div>
      <!-- container form start -->

  	</div>
    <!-- container end -->


</body>
</html>
<?php ob_end_flush();?>