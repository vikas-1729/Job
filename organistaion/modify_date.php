
<?php
 include("connect_database.php");
 if(isset($_SESSION['username'],$_SESSION['type'],$_SESSION['dates'],$_GET['value'])){
	 
	 if(!empty($_SESSION['username'])&&!empty($_SESSION['type'])&&!empty($_SESSION['dates'])){
			 $i= $_GET['value'];
			 $_SESSION['value']=$i;
			 
			 
					   
				echo "<a style='background-color:yellow;'href='modify_date2.php'>CLICK HERE<a>";
				//header('Location:modify_date2.php');
	 	 
		 }
	 }
	 else{
		 header('location:login.php');
	 }
					 
	 
 
 
	 ?>
