<?php
 include("connect_database.php");
 if(isset($_SESSION['username'],$_SESSION['type'])){
	 if(!empty($_SESSION['username'])&&!empty($_SESSION['type'])&&$_SESSION['type']=='j'){
		 $query="SELECT `job_status`,`date` FROM `job_status` WHERE `username`='".$_SESSION['username']."'";
		 $query_run=mysqli_query($link,$query);
		 if($query_run==true){
			 $i=0;
			 $count=mysqli_num_rows($query_run);
			 if($count>0){
			 $date_j=array($count);
			 $status_j=array($count);
			  print '<table width="70%" border="1" cellpadding="1" cellspacing="1"  border-collapse= "collapse">';
			  print '<tr><th>ORG NAME</th><th>job type</th><th>status</th></tr>';
			 while($row=mysqli_fetch_assoc($query_run)){
				 $status_j($i)=$row['job_status'];
				 $date_j($i)=$row['date'];
				 $i++;
			 }
			 for($i=0;$i<$count;$i++){
				 $query="SELECT `job_name` ,`org_name` FROM `create_a_job` WHERE `date` ='$date($i)'";
				 $query_run=mysqli_query($link,$query);
				 if($query_run==true){
					 $row=mysqli_fetch_assoc($query_run);
					 print "<tr><td>".$row['org_name']."</td><td>".$row['job_name']."</td>"
					 
				 