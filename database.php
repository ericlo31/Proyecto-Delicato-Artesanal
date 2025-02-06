<?php
   $host = "localhost";
   $user = "root";
   $password = "";
   $db = "delicato";

   $conn = new mysqli("localhost","root","","delicato");
	if($conn->connect_error){
		die("Connection Failed!".$conn->connect_error);
	}
?>