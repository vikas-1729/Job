<?php
include('connect_database.php');
 $day=date('d-M-Y H:i:s A', strtotime('4 hour 20 minute'));$day=mysqli_real_escape_string($link,$day);$username=$_SESSION['username'];
 $query="UPDATE `login`SET `time`='$day' WHERE `username`='$username'";
 $query_run=mysqli_query($link,$query);
 if($query_run==true)
 {
session_destroy();
 header('location:login.php');}
 else
 {echo 'logout fali';}
?>