<?php 
include("user_record.php");
include("connect.php");

$na = $user_record['u_name'];
$mySQL = "SELECT * FROM allcourse WHERE tcansee = 1";
$my_query = mysqli_query($conn,$mySQL);
$my_record = mysqli_fetch_array($my_query);

?>