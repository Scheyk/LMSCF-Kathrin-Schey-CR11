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

  $res = mysqli_query($conn, "SELECT * FROM users WHERE user_id=".$_SESSION['admin']);
  $userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

  if(isset($_GET["id"])) {
    $id = $_GET["id"];

    $id = $_GET["id"];

    $sql = "SELECT * FROM animals WHERE animal_id = '$id'";
    $result = mysqli_query($conn, $sql);   

    $row = $result->fetch_assoc();
  }

  // $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>change</title>
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
            <a class="nav-link text-danger" href="admin.php">Home</a>
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
  <div class="container-fluid">

   <!--  container welcome msg start -->
    <div class="welcome mt-3">
      <p class="h2">
        Hello <?php echo $userRow['userName']?>
          <br>
        zeit zum updaten...
        </p>     
    </div>
    <!--  container welcome msg end -->

    <!--  container form start -->
    <div class="back mt-3">

        <!-- form start -->
        <form action="actions/a_update.php" method="post">
          <input type="hidden" name="id" value="<?php echo $row['animal_id']?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="<?php echo $row['name']?>">
          </div>
          <div class="form-group">
            <label for="img">Img:</label>
            <input type="text" class="form-control" name="img" value="<?php echo $row['img']?>">
          </div>
          <div class="form-group">
            <label for="description">Description:</label>
            <textarea rows="4" class="form-control" name="description" value="<?php echo $row['description']?>">
              <?php echo $row['description']?>
            </textarea>            
          </div>
          <div class="form-group">
            <label for="age">Age:</label>
            <input type="text" class="form-control" name="age" value="<?php echo $row['age']?>">
          </div>
          <div class="form-group">
            <label for="hobbies">Hobbys:</label>
            <input type="text" class="form-control" name="hobbies" value="<?php echo $row['hobbies']?>">
          </div>
          <div class="form-group">
            <label for="typ">Typ:</label>
          <select name="typ" id="typ" value="<?php echo $row['typ']?>">
            <option value="sm">small</option>
            <option value="lg">large</option>
          </select>    
          </div>
          <div class="form-group">
            <label for="location">Location:</label>
            <input type="text" class="form-control" name="location" value="<?php echo $row['fk_location_city']?>">
          </div>  
          <button type="submit" name="submit">go!</button>
        </form>
        <!-- form end -->
      </div>
      <!--  container form end -->    
  </div>
  <!-- container end -->

</body>
</html>
<?php ob_end_flush();?>