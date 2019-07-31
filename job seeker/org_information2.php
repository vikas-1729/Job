<html>
 <head>
 <script type="text/javascript">
 var xmlhttp="false";

if(window.XMLHttpRequest){
	xmlhttp=new XMLHttpRequest();
}else if (window.ActiveXObject){
	xmlhttp= new ActiveXObject('Microsoft.XMLHTTP');
}
 function profile_status(i){
	 var check=i;
	 if(check==0){
		 alert('first complete your profile');
	 }else if(check==1){
		 if(xmlhttp){
			 
		v=check;
		
		xmlhttp.onreadystatechange=function (){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById("list").innerHTML=xmlhttp.responseText;
			document.location.reload();
			}
		}
				xmlhttp.open('GET','checking.php?value='+v,true);
		xmlhttp.send(null);
	}
}
 }	
</script>
		 
		 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styleCreateAjob.css">
  </head>
  <body>
  <button class="button1" style="vertical-align:middle;display:inline;float:right;background-color:yellow; " onclick="window.location='login_org.php';" ><span>HOME</span></button>
  <p class="log" style="margin-left:center">Welcome Organization Name</p>
  </body>
  </html>
<?php
 include("connect_database.php");
 if(isset($_SESSION['username'],$_SESSION['type'],$_SESSION['dates'])){
	 
	 if(!empty($_SESSION['username'])&&!empty($_SESSION['type'])&&!empty($_SESSION['dates'])){
			 $i= $_SESSION['value'];
			 
			 $date=mysqli_real_escape_string($link, $_SESSION['dates'][$i]);
			 $query="SELECT  * FROM `create_a_job` WHERE `date`='$date'";
			 $query_run=mysqli_query($link,$query);
			 if($query_run==true){
				 print '<table width="80%" border="1" cellpadding="1" cellspacing="1"  border-collapse= "collapse".>';
				 $count=mysqli_num_rows($query_run);
				 $row=mysqli_fetch_assoc($query_run);
				 echo "<tr><th>JOB NAME</th><td>".$row['job_name']."</td></tr>";
				 echo "<tr><th>JOB LOCATION</th><td>".$row['location']."</td></tr>"; 
				  echo "<tr><th>MIN QUALIFICATION</th><td>".$row['qualification']."</td></tr>";
				   echo "<tr><th>EXPERIENCE</th><td>".$row['experience']."</td></tr>";
				    echo "<tr><th>AGE GROUP</th><td>".$row['age_group']."</td></tr>";
					 echo "<tr><th>MIN SALARY</th><td>".$row['salary']."</td></tr>";
			 echo "<tr><th>IMPORTANT DATES</th><td>".$row['important_dates']."</td></tr>";
			 echo "<div id='list'></div>";
					 if($_SESSION['type']=='c'){
						 $folder_name=substr($_SESSION['org_name'],0,10);
					  $job_name=$row['job_name'];
					 $to=$folder_name.'/'.$job_name.'/';}
					 else if($_SESSION['type']=='j'){
						 $folder_name=substr($_SESSION['username'],0,10);
					 $to=$folder_name.'/';}
					  
					   echo "<tr><th>FILE LINK</th><td><a href='$to'>CLICK HERE FOR PDF<a></td></tr></table>";
			 }
			 if($_SESSION['type']=='j'){
				 $apply="no";
						  $query="SELECT `job_status` FROM `job_status` WHERE `username`='".$_SESSION['username']."' AND `date`='".$_SESSION['dates'][$i]."'";
						    $query_run=mysqli_query($link,$query);
						  if($query_run==true){
							 $counting=mysqli_num_rows($query_run);
							  $row=mysqli_fetch_assoc($query_run);
							  if($counting!=0){//user has apllied for job
								  print "<div style='margin-top:20px;margin-left:480px;font-size:20px;font-type:bold;'>Status = ".$row['job_status']."</div>";$apply="yes";
						  }else if($counting==0){							  								  
						  $query="SELECT `status` FROM `profile` WHERE `username`='".$_SESSION['username']."'";
						  $query_run=mysqli_query($link,$query);
						  if($query_run==true){
							  $row=mysqli_fetch_assoc($query_run);
							  $status=$row['status'];
							  if($status=="complete"){
							  $j=1;}
							  else{
							  $j=0;}
						  }else{
						  echo mysqli_error($link);}
						  print "<input type='button' style='margin-top:20px;margin-left:480px;font-size:20px;font-type:bold;' value='APPLY FOR IT' onclick='profile_status($j)'>";
						 						 
	 }
	 }else{
	 echo mysqli_error($link);}		 
			 }
			 else if($_SESSION['type']=='c'){
				 echo "<a href='view_applicant.php'>VIEW APPLICATANT</a>";
			 }
				 
	 }
 }else{
	 header('location:login.php');
 }
 
					 
	 
 
 
	 ?>
	