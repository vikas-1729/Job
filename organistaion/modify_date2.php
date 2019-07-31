<?php
 include("connect_database.php");
 if(isset($_SESSION['username'],$_SESSION['type'],$_SESSION['dates'])){
	 
	 if(!empty($_SESSION['username'])&&!empty($_SESSION['type'])&&!empty($_SESSION['dates'])){
			 $i= $_SESSION['value'];
			 $date=mysqli_real_escape_string($link, $_SESSION['dates'][$i]);
			 $query="SELECT  `important_dates` FROM `create_a_job` WHERE `date`='$date'";
			 $query_run=mysqli_query($link,$query);
			 if($query_run==true){
				 
				 $count=mysqli_num_rows($query_run);
				 $row=mysqli_fetch_assoc($query_run);
				 echo "recently entered important dates".$row['important_dates'];
                if(isset($_POST['update_date'])&&!empty($_POST['update_date'])){
					$update_date=mysqli_real_escape_string($link,$_POST['update_date']);
					$query="UPDATE `create_a_job` SET `important_dates`='$update_date' WHERE `date`='$date'";
					$query_run=mysqli_query($link,$query);
					if($query_run==true){
						
						echo 'data has been updated';
					}else{
					echo mysqli_error($link);}
				}
					
			
 }
	 }
 }
 ?><html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styleCreateAjob.css">
  </head>
  <body>
  <button class="button1" style="vertical-align:middle" onclick="window.location='login_org.php';" ><span>HOME</span></button>
 <form action="modify_date2.php" method="POST" >
 ENTER A NEW IMPORATANT DATE:<br>
 <input type="text" name="update_date" ><br>
 <input type="submit" value="submit new date">
 </form>
 </body>
 </html>
			