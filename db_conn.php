<?php

	$Name = "localhost";
	$user = "root";
	$pw = "";
	$db_name = "cr11_kathrinschey_petadoption";

	$conn = mysqli_connect($Name, $user, $pw, $db_name);

	if(!$conn){
		echo "error";
	}

?>