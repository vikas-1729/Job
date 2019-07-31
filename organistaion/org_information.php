
<?php
 include("connect_database.php");
 if(isset($_SESSION['username'],$_SESSION['type'],$_SESSION['dates'],$_GET['value'])){
	 
	 if(!empty($_SESSION['username'])&&!empty($_SESSION['type'])&&!empty($_SESSION['dates'])){
			 $i= $_GET['value'];
			 $_SESSION['value']=$i;
			   if(($_SERVER['HTTP_REFERER'])=="http://localhost/dsc_start/end/view_applicant.php")
			   {
				echo "<a href='profile_view.php'>CLICK HERE<a>";
			   }else {
				   echo "<a href='org_information2.php'>CLICK HERE<a>";
			   }
				   
	 	 }
	 }
	 else{
		 header('location:login.php');
	 }
					 
	 
 
 
	 ?>
