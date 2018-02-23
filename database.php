<?php
//connect to MySQL
$con = mysqli_connect("leann.ceajr6hul8xx.us-east-2.rds.amazonaws.com", "cis525project", "cis525project", "cis525project"); 

//Test connection
if(mysqli_connect_errno()){
    echo 'Failed to connect to MySQL: '.mysqli_connect_error();
 }
 ?>